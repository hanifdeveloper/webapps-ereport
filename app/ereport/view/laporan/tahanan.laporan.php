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
                                <li class="active"><a href="#kondisi_tahanan">I. Kondisi Tahanan</a></li>
                                <li><a href="#penggeledahan">II. Penggeledahan</a></li>
                                <li><a href="#penerangan">III. Penerangan</a></li>
                                <li><a href="#cctv">IV. CCTV</a></li>
                            </ul>
                        </div>

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
                                <div class="form-group">
                                    <blockquote>
                                        <p><?= $data_laporan['data_entry']['hal_menonjol_1'] ?></p>
                                        <small>Hal Menonjol (Kondisi Tahanan)</small>
                                    </blockquote>
                                </div>
                            </div>
                            <div class="tab-pane" id="penggeledahan">
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
                                    <?= comp\BOOTSTRAP::inputText('kondisi_jeruji', 'text', $data_laporan['data_entry']['kondisi_jeruji'], 'class="form-control" readonly') ?>
                                </div>
                                <div class="form-group">
                                    <label for="material_platfon">Material Plafon</label>
                                    <?= comp\BOOTSTRAP::inputText('material_plafon', 'text', $data_laporan['data_entry']['material_plafon'], 'class="form-control" readonly') ?>
                                </div>
                                <div class="form-group">
                                    <label for="jendela_ventilasi">Jendela/Ventilasi</label>
                                    <?= comp\BOOTSTRAP::inputText('jendela_ventilasi', 'text', $data_laporan['data_entry']['jendela_ventilasi'], 'class="form-control" readonly') ?>
                                </div>
                                <div class="form-group">
                                    <label for="barang_temuan">Barang Temuan</label>
                                    <?= comp\BOOTSTRAP::inputText('barang_temuan', 'text', $data_laporan['data_entry']['barang_temuan'], 'class="form-control" readonly') ?>
                                </div>
                                <div class="form-group">
                                    <blockquote>
                                        <p><?= $data_laporan['data_entry']['hal_menonjol_2'] ?></p>
                                        <small>Hal Menonjol (Penggeledahan)</small>
                                    </blockquote>
                                </div>
                            </div>
                            <div class="tab-pane" id="penerangan">
                                <div class="form-group">
                                    <label for="kondisi_penerangan">Kondisi Penerangan</label>
                                    <?= comp\BOOTSTRAP::inputText('kondisi_penerangan', 'text', $data_laporan['data_entry']['kondisi_penerangan'], 'class="form-control" readonly') ?>
                                </div>
                            </div>
                            <div class="tab-pane" id="cctv">
                                <div class="form-group">
                                    <label for="kondisi_cctv">Kondisi CCTV</label>
                                    <?= comp\BOOTSTRAP::inputText('kondisi_cctv', 'text', $data_laporan['data_entry']['kondisi_cctv'], 'class="form-control" readonly') ?>
                                </div>
                            </div>
                        </div>
                        <!-- END Tabs Content -->
                    </div>
                    <!-- END Get Started Block -->

                    <!-- Get Started Block -->
                    <div class="block full">
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
                                        <div class="row">
                                            <?php foreach ($value['file_upload'] as $file_upload): ?>
                                            <div class="col-sm-6 col-md-4 block-section">
                                                <a href="<?= $file_upload ?>" data-toggle="lightbox-image">
                                                    <img src="<?= $file_upload ?>" alt="image">
                                                </a>
                                            </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <!-- END Timeline Content -->
                    </div>
                    <!-- END Get Started Block -->
                    <!-- <pre><?php //print_r($data_laporan); ?></pre> -->
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