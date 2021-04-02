<body>
    <div id="page-wrapper" class="page-loading">
        <?php $this->getView('ereport', 'main', 'preloader', ''); ?>
        <div id="page-container" class="header-fixed-top sidebar-visible-lg-full">
            <!-- Main Sidebar -->
            <?php $this->getView('ereport', 'main', 'navbar', ''); ?>
            <!-- END Main Sidebar -->

            <!-- Main Container -->
            <div id="main-container">
                <!-- Header -->
                <?php $this->getView('ereport', 'main', 'header', ''); ?>
                <!-- END Header -->

                <!-- Modal -->
                <?php $this->getView('ereport', 'main', 'modal', ''); ?>
                <!-- END Modal -->

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
                    <div id="laporan" class="block full">
                        <div class="block-title">
                            <h2>Total Laporan : <span class="total-data">0</span> Data</h3>
                            <div class="block-options pull-left">
                                <button onclick="javascript:laporan.showTable();" class="btn btn-effect-ripple btn-default" data-toggle="tooltip" title="" style="overflow: hidden; position: relative;" data-original-title="Reload"><i class="fa fa-refresh"></i></button>
                            </div>
                        </div>
                        <form class="form-table form-horizontal form-bordered" onsubmit="return false;" autocomplete="off">
                            <?= comp\BOOTSTRAP::inputKey('page', '1') ?>
                            <?= comp\BOOTSTRAP::inputKey('size', '10') ?>
                            <?= comp\BOOTSTRAP::inputKey('group', $group) ?>
                            <?= comp\BOOTSTRAP::inputKey('kategori', $kategori) ?>
                            <div class="form-group form-actions">
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-search"></i>
                                        </span>
                                        <?= comp\BOOTSTRAP::inputText('cari', 'text', '', 'class="form-control filter-table" placeholder="Cari satker ..."') ?>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <?= comp\BOOTSTRAP::inputText('tanggal', 'text', date('Y-m-d'), 'class="form-control input-datepicker filter-table" data-date-format="yyyy-mm-dd" placeholder="dd-mm-yyyy" readonly') ?>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="fztable-content">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <th>#</th>
                                        <th>Nama Satker</th>
                                        <th>Group</th>
                                        <th>Last Update</th>
                                        <th></th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{number}</td>
                                            <td>
                                                {nama_satker}
                                                <blockquote class="hal_menonjol pull-right" style="display: none;">
                                                    <p>{hal_menonjol}</p>
                                                    <small>Hal Menonjol</small>
                                                </blockquote>
                                                <blockquote class="hal_menonjol_1 pull-right" style="display: none;">
                                                    <p>{hal_menonjol_1}</p>
                                                    <small>Hal Menonjol (Kondisi Tahanan)</small>
                                                </blockquote>
                                                <blockquote class="hal_menonjol_2 pull-right" style="display: none;">
                                                    <p>{hal_menonjol_2}</p>
                                                    <small>Hal Menonjol (Penggeledahan)</small>
                                                </blockquote>
                                            </td>
                                            <td>{nama_group}</td>
                                            <td>{tanggal_laporan}</td>
                                            <td>
                                                <a href="<?= $this->modul.'/'.$kategori.'/' ?>{id_laporan}" target="_blank" data-toggle="tooltip" title="Detail Laporan" id="{id_laporan}" class="btn btn-effect-ripple btn-sm btn-info btn-detail">Detail</a>
                                                <button data-toggle="tooltip" title="Delete Data" id="{id_laporan}" class="btn btn-effect-ripple btn-sm btn-danger btn-delete" data-message="Yakin data laporan tahanan {nama_satker} akan dihapus ?"><i class="fa fa-times"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="fztable-paging" style="border-top:2px solid #ccc;">
                                <ul class="pagination pagination-sm">
                                    <li><a href="javascript:void(0)" page-number="">{page}</a></li>
                                </ul>
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