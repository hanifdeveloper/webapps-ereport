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
                        </div>

                        <blockquote class="pull-right">
                            <p><?= $data_laporan['data_entry']['hal_menonjol'] ?></p>
                            <small>Hal Menonjol</small>
                        </blockquote>

                        <div style="clear:both;"></div>
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