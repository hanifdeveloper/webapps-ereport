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
                    <div id="satker" class="block full">
                        <div class="block-title">
                            <h2>Total Satker : <span class="total-data">0</span> Data</h3>
                            <div class="block-options pull-left">
                                <button class="btn btn-effect-ripple btn-default btn-reload" data-toggle="tooltip" title="" style="overflow: hidden; position: relative;" data-original-title="Reload"><i class="fa fa-refresh"></i></button>
                            </div>
                        </div>
                        <form class="form-table form-horizontal form-bordered" onsubmit="return false;" autocomplete="off">
                            <?= comp\BOOTSTRAP::inputKey('page', '1') ?>
                            <?= comp\BOOTSTRAP::inputKey('size', '5') ?>
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
                                        <th>No Urut</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{number}</td>
                                            <td>{nama_satker}</td>
                                            <td>{nama_group}</td>
                                            <td>{nourut}</td>
                                            <td>
                                                <button data-toggle="tooltip" title="Edit Data" id="{id_satker}" class="btn btn-effect-ripple btn-sm btn-success btn-edit"><i class="fa fa-pencil"></i></button>
                                                <button data-toggle="tooltip" title="Delete Data" id="{id_satker}" class="btn btn-effect-ripple btn-sm btn-danger btn-delete" data-message="Yakin data satker {nama_satker} akan dihapus ?"><i class="fa fa-times"></i></button>
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
                                <label for="nourut">No. Urut</label>
                                <span data-form-object="nourut"></span>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <span data-form-object="password"></span>
                                <span class="help-block">*) Digunakan untuk login ke aplikasi mobile</span>
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