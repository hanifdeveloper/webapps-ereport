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
                <div id="modal-fade" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h3 class="modal-title"><strong>Modal</strong></h3>
                            </div>
                            <div class="modal-body">
                                Content..
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-effect-ripple btn-danger" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-effect-ripple btn-primary">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
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
                    <div id="satker" class="block full">
                        <div class="block-title">
                            <h2>Total Satker : <span class="total-data">0</span> Data</h3>
                            <div class="block-options pull-left">
                                <button onclick="javascript:satker.showTable();" class="btn btn-effect-ripple btn-default" data-toggle="tooltip" title="" style="overflow: hidden; position: relative;" data-original-title="Reload"><i class="fa fa-refresh"></i></button>
                            </div>
                        </div>
                        <form class="form-table form-horizontal form-bordered" onsubmit="return satker.showTable();" autocomplete="off">
                            <div class="form-group form-actions">
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <button type="submit" class="btn btn-effect-ripples btn-primary"><i class="fa fa-search"></i></button>
                                        </span>
                                        <?= comp\BOOTSTRAP::inputText('cari', 'text', '', 'class="form-control" placeholder="Cari satker ..."') ?>
                                        <?= comp\BOOTSTRAP::inputKey('page', '1') ?>
                                        <?= comp\BOOTSTRAP::inputKey('size', '5') ?>
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
                            <div class="fztable-paging" style="border-top:2px solid #ccc;">
                                <ul class="pagination pagination-sm">
                                    <li><a href="javascript:void(0)" page-number="">{page}</a></li>
                                </ul>
                            </div>
                        </div>
                        <form action="page_forms_components.html" method="post" class="fzform-content form-bordered" onsubmit="return false;" autocomplete="off">
                            <div class="form-group">
                                <label for="nama_satker">Nama Satker</label>
                                <span data-form-object="id_satker"></span>
                                <span data-form-object="nama_satker"></span>
                            </div>
                            <div class="form-group">
                                <label for="group_satker">Group Satker</label>
                                <span data-form-object="group_satker"></span>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <span data-form-object="password"></span>
                            </div>
                        </form>
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