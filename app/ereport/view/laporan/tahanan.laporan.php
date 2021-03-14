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
                    <div class="block full">
                        <div class="block-title">
                            <h2>
                                <?= $data_laporan['data_entry']['nama_satker'] ?>
                                <span style="display: block;font-size: 12px;font-weight: normal;">Last Update: <?= $data_laporan['data_entry']['lastupdate']; ?></span>
                            </h2>
                            <ul class="nav nav-tabs" data-toggle="tabs">
                                <li class="active"><a href="#kondisi_tahanan">Kondisi Tahanan</a></li>
                                <li><a href="#kondisi_ruang_tahanan">Kondisi Ruang Tahanan</a></li>
                                <li><a href="#temuan_penggeledahan">Temuan Penggeledahan</a></li>
                                <li><a href="#cctv">CCTV</a></li>
                            </ul>
                        </div>

                        <blockquote class="pull-right">
                            <p><?= $data_laporan['data_entry']['hal_menonjol'] ?></p>
                            <small>Hal Menonjol</small>
                        </blockquote>

                        <!-- Tabs Content -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="kondisi_tahanan">
                                <div class="form-group">
                                    <label for="jumlah_tahanan">Jumlah Tahanan</label>
                                    <?= comp\BOOTSTRAP::inputText('jumlah_tahanan', 'text', $data_laporan['data_entry']['jumlah_tahanan'], 'class="form-control" readonly') ?>
                                </div>
                                <div class="form-group">
                                    <label for="surat_aktif">Jumlah SP Han (Keseluruhan)</label>
                                    <?= comp\BOOTSTRAP::inputText('surat_aktif', 'text', $data_laporan['data_entry']['surat_aktif'], 'class="form-control" readonly') ?>
                                </div>
                                <div class="form-group">
                                    <label for="surat_expired">Jumlah SP Han (Yang Habis Waktu)</label>
                                    <?= comp\BOOTSTRAP::inputText('surat_expired', 'text', $data_laporan['data_entry']['surat_expired'], 'class="form-control" readonly') ?>
                                </div>
                            </div>
                            <div class="tab-pane" id="kondisi_ruang_tahanan">
                                <div class="form-group">
                                    <label for="kamar_mandi">Kamar Mandi</label>
                                    <?= comp\BOOTSTRAP::inputText('kamar_mandi', 'text', $data_laporan['data_entry']['kamar_mandi'], 'class="form-control" readonly') ?>
                                </div>
                                <div class="form-group">
                                    <label for="dinding_tembok">Dinding/Tembok</label>
                                    <?= comp\BOOTSTRAP::inputText('dinding_tembok', 'text', $data_laporan['data_entry']['dinding_tembok'], 'class="form-control" readonly') ?>
                                </div>
                                <div class="form-group">
                                    <label for="jeruji">Kondisi Jeruji</label>
                                    <?= comp\BOOTSTRAP::inputText('jeruji', 'text', $data_laporan['data_entry']['jeruji'], 'class="form-control" readonly') ?>
                                </div>
                                <div class="form-group">
                                    <label for="material_platfon">Material Plafon</label>
                                    <?= comp\BOOTSTRAP::inputText('material_platfon', 'text', $data_laporan['data_entry']['material_platfon'], 'class="form-control" readonly') ?>
                                </div>
                                <div class="form-group">
                                    <label for="jendela_ventilasi">Jendela/Ventilasi</label>
                                    <?= comp\BOOTSTRAP::inputText('jendela_ventilasi', 'text', $data_laporan['data_entry']['jendela_ventilasi'], 'class="form-control" readonly') ?>
                                </div>
                            </div>
                            <div class="tab-pane" id="temuan_penggeledahan">
                                <div class="form-group">
                                    <label for="barang_temuan">Barang Temuan</label>
                                    <?= comp\BOOTSTRAP::inputText('barang_temuan', 'text', $data_laporan['data_entry']['barang_temuan'], 'class="form-control" readonly') ?>
                                </div>
                            </div>
                            <div class="tab-pane" id="cctv">
                                <div class="form-group">
                                    <label for="cctv">Kondisi</label>
                                    <?= comp\BOOTSTRAP::inputText('cctv', 'text', $data_laporan['data_entry']['cctv'], 'class="form-control" readonly') ?>
                                </div>
                            </div>
                        </div>
                        <!-- END Tabs Content -->
                    </div>
                    <!-- END Get Started Block -->

                    <!-- Get Started Block -->
                    <div class="block full">
                        <!-- Get Started Title -->
                        <div class="block-title">
                            <h2>Upload Dokumen</h2>
                        </div>
                        
                        <!-- Timeline Content -->
                        <div class="timeline block-content-full">
                            <ul class="timeline-list">
                                <?php foreach ($data_laporan['data_list_upload'] as $value): ?>
                                <li>
                                    <div class="timeline-time"><?= $value['lastupdate'] ?></div>
                                    <div class="timeline-icon themed-background-danger text-light-op"><i class="gi gi-picture"></i></div>
                                    <div class="timeline-content">
                                        <p class="push-bit"><strong><?= $value['category_document_text'] ?></strong></p>
                                        <p class="push-bit"><?= $value['text_caption'] ?></p>
                                        <!-- <div class="row">
                                            <div class="col-sm-6 col-md-4 block-section">
                                                <a href="img/placeholders/photos/photo11.jpg" data-toggle="lightbox-image">
                                                    <img src="img/placeholders/photos/photo11.jpg" alt="image">
                                                </a>
                                            </div>
                                        </div> -->
                                    </div>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <!-- END Timeline Content -->
                    </div>
                    <!-- END Get Started Block -->
                    <pre><?php print_r($data_laporan); ?></pre>
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