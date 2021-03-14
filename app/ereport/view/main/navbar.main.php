<div id="sidebar">
    <!-- Sidebar Brand -->
    <div id="sidebar-brand" class="themed-background">
        <a href="<?= $this->link(); ?>" class="sidebar-title">
            <i class="fa fa-cube"></i> <span class="sidebar-nav-mini-hide"><strong>ADMIN PANEL</strong></span>
        </a>
    </div>
    <!-- END Sidebar Brand -->

    <!-- Wrapper for scrolling functionality -->
    <div id="sidebar-scroll">
        <!-- Sidebar Content -->
        <div class="sidebar-content">
            <!-- Sidebar Navigation -->
            <ul class="sidebar-menu sidebar-nav">
                <li><a href="<?= $this->link() ?>"><i class="gi gi-home sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Dashboard</span></a></li>
                <li>
                    <a href="<?= $this->link('laporan') ?>" class="sidebar-nav-menu"><i class="fa fa-chevron-left sidebar-nav-indicator sidebar-nav-mini-hide"></i><i class="gi gi-file_export sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Laporan</span></a>
                    <ul>
                        <li><a href="<?= $this->link('laporan/tahanan') ?>">Cek Tahanan</a></li>
                        <li><a href="<?= $this->link('laporan/kebakaran') ?>">Cegah Kebakaran</a></li>
                    </ul>
                </li>
                <li>
                    <a href="<?= $this->link('management') ?>" class="sidebar-nav-menu"><i class="fa fa-chevron-left sidebar-nav-indicator sidebar-nav-mini-hide"></i><i class="gi gi-file_export sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Management</span></a>
                    <ul>
                        <li><a href="<?= $this->link('management/satker') ?>">Satker</a></li>
                        <!-- <li><a href="<?= $this->link('management/user') ?>">User</a></li> -->
                    </ul>
                </li>
                <li class="sidebar-separator">
                    <i class="fa fa-ellipsis-h"></i>
                </li>
            </ul>
            <!-- END Sidebar Navigation -->
        </div>
        <!-- END Sidebar Content -->
    </div>
    <!-- END Wrapper for scrolling functionality -->

    <!-- Sidebar Extra Info -->
    <div id="sidebar-extra-info" class="sidebar-content sidebar-nav-mini-hide" style="display: none;">
        <div class="text-center">
            <small>Crafted with <i class="fa fa-heart text-danger"></i> by <a href="http://goo.gl/vNS3I" target="_blank">pixelcave</a></small><br>
            <small><span id="year-copy"></span> &copy; <a href="http://goo.gl/RcsdAh" target="_blank">AppUI 2.9</a></small>
        </div>
    </div>
    <!-- END Sidebar Extra Info -->
</div>