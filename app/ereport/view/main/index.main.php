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
                            <?= comp\BOOTSTRAP::inputKey('start_date', '') ?>
                            <?= comp\BOOTSTRAP::inputKey('end_date', '') ?>
                            <div class="form-group form-actions">
                                <div class="col-sm-3">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-search"></i>
                                        </span>
                                        <?= comp\BOOTSTRAP::inputText('cari', 'text', '', 'class="form-control filter-chart" placeholder="Cari satker ..."') ?>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <?= comp\BOOTSTRAP::inputSelect('group', $pilihan_group, '', 'class="form-control filter-chart select-select2" placeholder="Pilih Group ..."') ?>
                                </div>
                                <div class="col-sm-3">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-bar-chart-o"></i>
                                        </span>
                                        <?= comp\BOOTSTRAP::inputSelect('size', $pilihan_size, '', 'class="form-control filter-chart select-select2" placeholder="Pilih Size ..."') ?>
                                    </div>
                                </div>
                                <div class="col-sm-3">
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
    <script src="<?= $url_path.'/script'; ?>"></script>
</body>