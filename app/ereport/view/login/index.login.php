<body style="
    background-image: url('img/bg_login.jpg');
    background-repeat: no-repeat;
    background-size: cover;
    height: 100vh;
    ">
    <!-- Login Container -->
    <div id="login-container" style="top: 0px;">
        <!-- Login Header -->
        <h1 class="h2 text-light text-center push-top-bottom animation-slideDown">
            <!-- <i class="fa fa-cube"></i>  -->
            <img src="img/app_icon.png" style="width: 130px;" alt=""><br>
            <strong><?= $this->web_description; ?></strong>
        </h1>
        <!-- END Login Header -->

        <!-- Login Block -->
        <div class="block animation-fadeInQuickInv" style="background-color: #0c096c; filter: opacity(.8); color: #fff;">
            <!-- Login Title -->
            <div class="block-title">
                <h2>Please Login</h2>
            </div>
            <!-- END Login Title -->

            <!-- Login Form -->
            <?= !empty($this->sessionMessage) ? '<div class="alert alert-danger alert-dismissable"><h4><strong>'.$this->sessionMessage.'</strong></h4></div>' : ''; ?>
            <form id="form-login" action="<?= $url_path.'/validate' ?>" method="post" class="form-horizontal" autocomplete="off">
                <div class="form-group">
                    <div class="col-xs-12">
                        <?= comp\BOOTSTRAP::inputText('username', 'text', '', 'class="form-control" placeholder="Input Username" autofocus required') ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <?= comp\BOOTSTRAP::inputText('password', 'password', '', 'class="form-control" placeholder="Input Password" required') ?>
                    </div>
                </div>
                <div class="form-group form-actions">
                    <div class="col-xs-4 text-right">
                        <button type="submit" class="btn btn-effect-ripple btn-sm btn-primary"><i class="fa fa-check"></i> Sign In</button>
                    </div>
                </div>
            </form>
            <!-- END Login Form -->
        </div>
        <!-- END Login Block -->

        <!-- Footer -->
        <footer class="text-muted text-center animation-pullUp" style="display: none;">
            <!-- <small><span id="year-copy"></span> &copy; <a href="http://goo.gl/RcsdAh" target="_blank">AppUI 2.9</a></small> -->
            <small style="text-transform: uppercase; font-weight: bold; color: #fff;"><?= $this->web_footer; ?></small>
        </footer>
        <!-- END Footer -->
    </div>
    <!-- END Login Container -->

    <!-- jQuery, Bootstrap, jQuery plugins and Custom JS code -->
    <?= $jsPath; ?>
</body>