<body>
<img src="img/background.png" alt="Full Background" class="full-bg animation-pulseSlow">
<div id="login-page">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="row">
                <div class="col-md-6">
                    <img src="img/logo_sipmas.png" alt="Logo Sipmas" class="login-icon push-top-bottom animation-slideDown">
                </div>
                <div class="col-md-6">
                    <div class="push-top-bottom">
                        <div class="divider hidden-xs"></div>
                        <form class="frmSignin animation-fadeInQuickInv" onsubmit="return false;" autocomplete="off">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="username">Username : </label>
                                    <div class="form-group">
                                        <?= comp\BOOTSTRAP::inputText('username', 'text', '', 'class="form-login" placeholder="Nomer Identitas" required'); ?>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="password">Password : </label>
                                    <div class="form-group">
                                    <?= comp\BOOTSTRAP::inputText('password', 'password', '', 'class="form-login" placeholder="Password" required'); ?>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <span class="error-message"></span>
                                </div>
                                <div class="col-md-4 text-right">
                                    <span class="loader"><i class="fa fa-spinner fa-2x fa-spin"></i></span>
                                    <button type="submit" class="btn btn-effect-ripple btn-info btn-signin">Sign In</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- Script -->
<?= $jsPath; ?>
<!-- <script src="<?= $api_path.'/script'; ?>"></script> -->
<!-- <script src="<?= $app_path.'/script'; ?>"></script> -->
<!-- <script src="<?= $app_path.'/portal'; ?>"></script> -->
</body>
