const createBarChart = function(id, statistik){
    if ($(id).length == 0) return;

    const cvs = $("<canvas>").attr({width: "400", height: "400"});
    $(id).html("").append(cvs);
    let obj = cvs[0].getContext("2d");
    obj.clearRect(0, 0, obj.width, obj.height);
    let charts = new Chart(obj, {
        type: "horizontalBar",
        data: {
            labels: statistik.labels,
            datasets: [{
                label: 'Total Laporan',
                data: statistik.values,
                backgroundColor: "#de4b39",
                borderWidth: 2,
                borderColor: "#fff",
            }]
        },
        options: {
            legend: { display: false },
            scales: {
                xAxes: [{
                    ticks: {
                        fontSize: "12",
                        fontColor: "#777777",
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

    return charts;
}

const dashboard = new frameduz("#dashboard");
dashboard.showChart = function(kategori){
    const contexts = "#chart-"+kategori;
    const progress = dashboard.createProgress($(contexts));
    setTimeout(function(){
        app.sendData({
            url: "/ereport/statistik/"+kategori,
            data: $(".form-chart").serialize(),
            token: "<?= $this->token; ?>",
            onSuccess: function(response){
                console.log(response);
                createBarChart(contexts, response.data.statistik);
            },
            onError: function(error){
                console.log(error);
            }
        });
    }, 500);
    
    console.clear();
    return false;
}
dashboard.generatedChart = function(){
    dashboard.showChart('tahanan');
    dashboard.showChart('kebakaran');
}

dashboard.modul.find(".filter-chart").on("change", function(e){
    e.preventDefault();
    $(".form-chart").find("#page").val(1);
    dashboard.generatedChart();
});

dashboard.modul.find("#filterDate").daterangepicker({
    locale: {
        format: "DD/MM/YYYY",
    },
    ranges: {
        'Hari Ini': [moment(), moment()],
        'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        '7 Hari Terakhir': [moment().subtract(6, 'days'), moment()],
        '30 Hari Terakhir': [moment().subtract(29, 'days'), moment()],
        'Bulan Ini': [moment().startOf('month'), moment().endOf('month')],
        'Bulan Kemarin': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    }
}, function(start, end, label){
    startDate = start.format("YYYY-MM-DD");
    endDate = end.format("YYYY-MM-DD");
    console.log(startDate, endDate);

    $(".form-chart").find("#start_date").val(startDate);
    $(".form-chart").find("#end_date").val(endDate);
});