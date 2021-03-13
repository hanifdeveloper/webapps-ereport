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
                    <div id="satker" class="block full">
                        <div class="block-title">
                            <h2>Total Satker : <span class="total-data">0</span> Satker</h3>
                        </div>
                        <form class="form-horizontal form-bordered" onsubmit="return false;">
                            <div class="form-group form-actions">
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-effect-ripple btn-primary"><i class="fa fa-search"></i></button>
                                        </span>
                                        <?= comp\BOOTSTRAP::inputText('cari', 'text', '', 'class="form-control" placeholder="Cari satker ..."') ?>
                                        <!-- <input type="text" id="example-input1-group2" name="example-input1-group2" class="form-control" placeholder="Username"> -->
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                <button type="button" id="" class="btn btn-effect-ripple btn-primary btn-form"><i class="fa fa-plus"></i> Tambah Data</button>
                                </div>
                            </div>
                        </form>
                        <div class="fztable-content">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <th>#</th>
                                        <th>Nama Satker</th>
                                        <th>Group Satker</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{number}</td>
                                            <td>{nama_satker}</td>
                                            <td>{nama_group}</td>
                                            <td>{action}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="fztable-paging">
                                <ul class="pagination pagination-sm">
                                    <li><a href="javascript:void(0)" page-number="">{page}</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="fztable-loader">
                            <div class="bounce1"></div>
                            <div class="bounce2"></div>
                            <div class="bounce3"></div>
                        </div>
                        <div class="fztable-empty">
                            <div class="alert alert-danger alert-dismissable">
                                <p><strong>Data tidak ditemukan !</strong></p>
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