<body>
    <!-- Login Container -->
    <div id="login-container" style="top: 0px;">
        <!-- Login Header -->
        <h1 class="h2 text-light text-center push-top-bottom animation-slideDown">
            <!-- <i class="fa fa-cube"></i>  -->
            <img src="img/app_icon.png" style="width: 130px;" alt=""><br>
            <strong>E-Report Polda Kalbar</strong>
        </h1>
        <!-- END Login Header -->

        <!-- Login Block -->
        <div class="block animation-fadeInQuickInv">
            <!-- Login Title -->
            <div class="block-title">
                <h2>Please Login</h2>
            </div>
            <!-- END Login Title -->

            <!-- Login Form -->
            <form id="form-login" action="index.html" method="post" class="form-horizontal">
                <div class="form-group">
                    <div class="col-xs-12">
                        <?= comp\BOOTSTRAP::inputText('username', 'text', '', 'class="form-control" placeholder="Input Username"') ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <?= comp\BOOTSTRAP::inputText('password', 'password', '', 'class="form-control" placeholder="Input Password"') ?>
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
        <footer class="text-muted text-center animation-pullUp">
            <small><span id="year-copy"></span> &copy; <a href="http://goo.gl/RcsdAh" target="_blank">AppUI 2.9</a></small>
        </footer>
        <!-- END Footer -->
    </div>
    <!-- END Login Container -->

    <!-- jQuery, Bootstrap, jQuery plugins and Custom JS code -->
    <script src="js/vendor/jquery-2.2.4.min.js"></script>
    <script src="js/vendor/bootstrap.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/app.js"></script>

    <!-- Load and execute javascript code used only in this page -->
    <script src="js/pages/readyLogin.js"></script>
    <script>$(function(){ ReadyLogin.init(); });</script>
</body>