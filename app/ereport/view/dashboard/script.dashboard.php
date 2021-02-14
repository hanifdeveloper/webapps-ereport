dashboard = {
    init: function(){
        url_path = "<?= $url_path; ?>";
        complaintResponseChoice = JSON.parse(window.atob("<?= base64_encode(json_encode($complaintResponseChoice)); ?>"));
        statistical_report = JSON.parse(window.atob("<?= base64_encode(json_encode($statistical_report)); ?>"));
        chartCategory = dashboard.createLineChart("#report-category-chart", statistical_report.complaintCategory);
        chartIsDeviation = dashboard.createPieChart("#report-isDeviation-chart", statistical_report.complaintResponse.isDeviation);
        chartNoDeviation = dashboard.createPieChart("#report-noDeviation-chart", statistical_report.complaintResponse.noDeviation);
        $("#chartCategory").on("change", function(e){
            e.preventDefault();
            dashboard.updateChart(chartCategory, statistical_report, this.value);
        });

        $("#filterDate").daterangepicker({
            open: "left"
        }, function(start, end){
            startDate = start.format("YYYY-MM-DD");
            endDate = end.format("YYYY-MM-DD");
            app.sendData({
                url: "/complaint/dashboard/chart",
                data: {startDate, endDate},
                token: "<?= $this->token; ?>",
                onSuccess: function(response){
                    // console.info(response);
                    statistical_report = response.data;
                    dashboard.updateChart(chartCategory, statistical_report, "complaintCategory");
                    dashboard.updateChart(chartIsDeviation, statistical_report.complaintResponse, "isDeviation");
                    dashboard.updateChart(chartNoDeviation, statistical_report.complaintResponse, "noDeviation");
                },
                onError: function(error){
                    console.error(error);
                }
            });
        });

        $("#searchList").on("input", function(e){
            e.preventDefault();
            let query = this.value;
            let tabel = $("table tbody tr");
            if(query.length > 0){
                tabel.each(function() {
                    if($(this).text().search(new RegExp(query, "i")) > 0) $(this).show();
                    else $(this).hide();
                });
            }else{
                tabel.show();
            }
        });

        $("#frmInput").on("submit", function(e){
            e.preventDefault();
            const data = $(this).serializeArray();
            console.log(data);
            app.sendData({
                url: "/complaint/dashboard/response",
                data: data,
                token: "<?= $this->token; ?>",
                onSuccess: function(response){
                    console.info(response);
                    alert(response.message.text);
                    window.location.reload();
                },
                onError: function(error){
                    console.error(error);
                }
            });
            $("#report-modal-preview").modal("hide");
        });

        $(".btn-detail").on("click", function(e){
            e.preventDefault();
            const list = JSON.parse(window.atob($(this).data("list")));
            //console.log(list);
            $("#idComplaint").val(list.idComplaint);
            $("#fullName").val(list.fullName);
            $("#genderType").val(list.genderType);
            $("#emailAddress").val(list.emailAddress);
            $("#phoneNumber").val(list.phoneNumber);
            $("#identityDocument").val(list.identityDocument);
            $("#complaintCategory").val(list.complaintCategory);
            $("#complaintDate").val(list.complaintDate);
            $("#complaintLocation").val(list.complaintLocation);
            $("#complaintDescription").val(list.complaintDescription);
            $("input[name='complaintStatus'][value='"+list.complaintStatus+"']").prop("checked", true);
            $("#personalName").val(list.personalName);
            $("#fileAttachment").val(list.fileAttachment);
            
            app.updateForm.selectOption($(".complaintResponse"), complaintResponseChoice[list.complaintStatus], list.complaintResponse);
            $("input[name='complaintStatus']").off();
            $("input[name='complaintStatus']").on("click", function(e){
                //console.log(this.value);
                app.updateForm.selectOption($(".complaintResponse"), complaintResponseChoice[this.value], list.complaintResponse);
            });
            
            $("#report-modal-preview").modal("show");
        });
    },
    getData: function(data){
        let myLabels = [], dataSet = [], backgroundColor = [], hoverBackgroundColor = [];
        for (const key in data) {
            if (data.hasOwnProperty(key)) {
                myLabels.push(data[key].text);
                dataSet.push((data[key].hasOwnProperty("percent")) ? data[key].percent : data[key].count);
                backgroundColor.push(data[key].color);
                hoverBackgroundColor.push(data[key].color);
            }
        }

        return {myLabels, dataSet, backgroundColor, hoverBackgroundColor};
    },
    createLineChart: function(id, data){
        if ($(id).length == 0) return;
        data = dashboard.getData(data);
        let obj = $(id)[0].getContext("2d");
        let myChart = new Chart(obj, {
            type: "bar",
            data: {
                labels: data.myLabels,
                datasets: [{
                    data: data.dataSet,
                    backgroundColor: data.backgroundColor,
                    hoverBackgroundColor: data.hoverBackgroundColor,
                    borderWidth: 2,
                    borderColor: "#fff",
                }]
            },
            // type: "line",
            // data: {
            //     labels: myLabels,
            //     datasets: [{
            //         data: dataSet,
            //         borderWidth: 2,
            //         borderColor: '#3160D8',
            //         backgroundColor: 'transparent',
            //         pointBorderColor: backgroundColor
            //     }]
            // },
            options: {
                legend: { display: false },
                scales: {
                    xAxes: [{
                        ticks: {
                            fontSize: "12",
                            fontColor: "#777777"
                        },
                        gridLines: {
                            display: false
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            fontSize: "12",
                            fontColor: "#777777",
                            min: 0
                        },
                        gridLines: {
                            color: "#D8D8D8",
                            zeroLineColor: "#D8D8D8",
                            borderDash: [2, 2],
                            zeroLineBorderDash:  [2, 2],
                            drawBorder: false
                        }
                    }]
                }
            }
        });

        return myChart;
    },
    createPieChart: function(id, data){
        if ($(id).length == 0) return;
        data = dashboard.getData(data);
        let obj = $(id)[0].getContext("2d");
        let myChart = new Chart(obj, {
            // type: "pie",
            type: "doughnut",
            data: {
                labels: data.myLabels,
                datasets: [{
                    data: data.dataSet,
                    backgroundColor: data.backgroundColor,
                    hoverBackgroundColor: data.hoverBackgroundColor,
                    borderWidth: 5,
                    borderColor: "#fff"
                }]
            },
            options: {
                legend: { display: false },
                // cutoutPercentage: 80
            }
        });

        return myChart;
    },
    updateChart: function(chart, data, index){
        chartData = data[index];
        for (const key in chartData) {
            const label = $("."+index+"-"+key);
            if (label.length > 0) {
                //console.log("."+index+"-"+key);
                label.text((chartData[key].hasOwnProperty("percent")) ? chartData[key].percent + "%" : chartData[key].count)
            }
        }

        data = dashboard.getData(chartData);
        chart.data.labels = data.myLabels;
        chart.data.datasets[0] = {
            data: data.dataSet,
            backgroundColor: data.backgroundColor,
            hoverBackgroundColor: data.hoverBackgroundColor,
            borderWidth: 2,
            borderColor: "#fff",
        };
        chart.update();
    },
};

dashboard.init();