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
                    <div class="block full">
                        <div class="block-title">
                            <h2>Top Rank Laporan Satker</h3>
                            <div class="block-options pull-left">
                                <button onclick="javascript:laporan.showTable();" class="btn btn-effect-ripple btn-default" data-toggle="tooltip" title="" style="overflow: hidden; position: relative;" data-original-title="Reload"><i class="fa fa-refresh"></i></button>
                            </div>
                        </div>
                        <form class="form-chart form-horizontal form-bordered" onsubmit="return false;" autocomplete="off">
                            <?= comp\BOOTSTRAP::inputKey('page', '1') ?>
                            <?= comp\BOOTSTRAP::inputKey('size', '10') ?>
                            <?= comp\BOOTSTRAP::inputKey('kategori', '') ?>
                            <div class="form-group form-actions">
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-search"></i>
                                        </span>
                                        <?= comp\BOOTSTRAP::inputText('cari', 'text', '', 'class="form-control filter-table" placeholder="Cari satker ..."') ?>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <?= comp\BOOTSTRAP::inputSelect('group', $pilihan_group, '', 'class="form-control filter-table select-select2" placeholder="Pilih Group ..."') ?>
                                </div>
                                <div class="col-sm-4">
                                    <div class="input-group input-daterange" data-date-format="yyyy-mm-dd">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input type="text" id="example-daterange1" name="example-daterange1" class="form-control" placeholder="From">
                                        <span class="input-group-addon"><i class="fa fa-chevron-right"></i></span>
                                        <input type="text" id="example-daterange2" name="example-daterange2" class="form-control" placeholder="To">
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
                                    <div id="chart-tahanan" style="height: 380px;"></div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="block full">
                                    <div class="block-title">
                                        <h2>Laporan Cegah Kebakaran</h2>
                                    </div>
                                    <div id="chart-kebakaran" style="height: 380px;"></div>
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
</body>