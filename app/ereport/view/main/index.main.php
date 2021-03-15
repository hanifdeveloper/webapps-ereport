<body>
    <div id="page-wrapper" class="page-loading">
        <?php $this->preloader(); ?>
        <div id="page-container" class="header-fixed-top sidebar-visible-lg-full">
            <!-- Main Sidebar -->
            <?php $this->navbar(); ?>
            <!-- END Main Sidebar -->

            <!-- Main Container -->
            <div id="main-container">
                <!-- Header -->
                <?php $this->header(); ?>
                <!-- END Header -->

                <!-- Page content -->
                <div id="page-content">
                    <!-- Blank Header -->
                    <div class="content-header">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="header-section">
                                    <h1><?= $page_title ?></h1>
                                </div>
                            </div>
                            <div class="col-sm-6 hidden-xs">
                                <div class="header-section">
                                    <ul class="breadcrumb breadcrumb-top">
                                        <?= $breadcrumb ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END Blank Header -->

                    <!-- Get Started Block -->
                    <div id="dashboard" class="block full">
                        <div class="block-title">
                            <h2>Top Rank Laporan Satker</h3>
                            <div class="block-options pull-left">
                                <button onclick="javascript:dashboard.generatedChart();" class="btn btn-effect-ripple btn-default" data-toggle="tooltip" title="" style="overflow: hidden; position: relative;" data-original-title="Reload"><i class="fa fa-refresh"></i></button>
                            </div>
                        </div>
                        <form class="form-chart form-horizontal form-bordered" onsubmit="return false;" autocomplete="off">
                            <?= comp\BOOTSTRAP::inputKey('page', '1') ?>
                            <?= comp\BOOTSTRAP::inputKey('size', '10') ?>
                            <?= comp\BOOTSTRAP::inputKey('start_date', '') ?>
                            <?= comp\BOOTSTRAP::inputKey('end_date', '') ?>
                            <div class="form-group form-actions">
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-search"></i>
                                        </span>
                                        <?= comp\BOOTSTRAP::inputText('cari', 'text', '', 'class="form-control filter-chart" placeholder="Cari satker ..."') ?>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <?= comp\BOOTSTRAP::inputSelect('group', $pilihan_group, '', 'class="form-control filter-chart select-select2" placeholder="Pilih Group ..."') ?>
                                </div>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <?= comp\BOOTSTRAP::inputText('filterDate', 'text', '', 'class="form-control filter-chart" placeholder="" readonly') ?>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <br>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="block full">
                                    <div class="block-title">
                                        <h2>Laporan Cek Tahanan</h2>
                                    </div>
                                    <div id="chart-tahanan" style="height: 500px;"></div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="block full">
                                    <div class="block-title">
                                        <h2>Laporan Cegah Kebakaran</h2>
                                    </div>
                                    <div id="chart-kebakaran" style="height: 500px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END Get Started Block -->
                </div>
                <!-- END Page Content -->
            </div>
            <!-- END Main Container -->
        </div>
        <!-- END Page Container -->
    </div>
    <!-- END Page Wrapper -->

    <!-- jQuery, Bootstrap, jQuery plugins and Custom JS code -->
    <?= $jsPath; ?>
    <script src="<?= $api_path.'/script'; ?>"></script>
    <script>
    const createBarChart = function(id, statistik){
        if ($(id).length == 0) return;

        const cvs = $("<canvas>").attr({width: "400", height: "400"});
        $(id).html("").append(cvs);
        let obj = cvs[0].getContext("2d");
        // console.log(obj);
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
        }
    }, function(start, end, label){
        startDate = start.format("YYYY-MM-DD");
        endDate = end.format("YYYY-MM-DD");
        console.log(startDate, endDate);

        $(".form-chart").find("#start_date").val(startDate);
        $(".form-chart").find("#end_date").val(endDate);
    });
    </script>
</body>