const createBarChart = function(id, statistik){
    if ($("#"+id).length == 0) return;

    Highcharts.chart(id, {
        chart: {
            type: "area",
            inverted: true
        },
        title: {
            text: null
        },
        accessibility: {
            keyboardNavigation: {
                seriesNavigation: {
                    mode: "serialize"
                }
            }
        },
        xAxis: {
            categories: statistik.labels,
        },
        yAxis: {
            title: {
                text: null
            },
            allowDecimals: false,
            min: 0
        },
        plotOptions: {
            area: {
                fillOpacity: 0.5
            }
        },
        series: [{
            name: "Total Laporan",
            data: statistik.values
        }],
        credits: {
            enabled: false
        },
    });
}

const dashboard = new frameduz("#dashboard");
dashboard.showChart = function(kategori){
    const contexts = "chart-"+kategori;
    const progress = dashboard.createProgress($("#"+contexts));
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