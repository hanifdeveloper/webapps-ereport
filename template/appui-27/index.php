<!DOCTYPE html>
<!--[if IE 9]>
<html class="no-js lt-ie10" lang="en"> <![endif]-->
<!--[if gt IE 9]>
<!--> <html class="no-js" lang="en"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title><?= $this->web_title; ?></title>
        <meta name="description" content="<?= $this->web_description; ?>">
        <meta name="author" content="<?= $this->web_author; ?>">
        <meta name="robots" content="noindex, nofollow">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="<?= $this->templatePath; ?>img/icon/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">
        <!-- Icons -->
        <link rel="apple-touch-icon" sizes="57x57" href="<?= $this->templatePath; ?>img/icon/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="<?= $this->templatePath; ?>img/icon/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="<?= $this->templatePath; ?>img/icon/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="<?= $this->templatePath; ?>img/icon/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="<?= $this->templatePath; ?>img/icon/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="<?= $this->templatePath; ?>img/icon/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="<?= $this->templatePath; ?>img/icon/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="<?= $this->templatePath; ?>img/icon/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="<?= $this->templatePath; ?>img/icon/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="<?= $this->templatePath; ?>img/icon/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="<?= $this->templatePath; ?>img/icon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="<?= $this->templatePath; ?>img/icon/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="<?= $this->templatePath; ?>img/icon/favicon-16x16.png">
        <link rel="manifest" href="/manifest.json">
        <!-- END Icons -->
        <!-- Stylesheets -->
        <!-- Bootstrap is included in its original form, unaltered -->
        <link rel="stylesheet" href="<?= $this->templatePath; ?>css/bootstrap.min.css">
        <!-- Related styles of various icon packs and plugins -->
        <link rel="stylesheet" href="<?= $this->templatePath; ?>css/plugins.css">
        <link rel="stylesheet" href="<?= $this->templatePath; ?>plugins/sweetalert/sweetalert.css">
        <!-- The main stylesheet of this template. All Bootstrap overwrites are defined in here -->
        <link rel="stylesheet" href="<?= $this->templatePath; ?>css/main.css">
        <!-- Include a specific file here from css/themes/ folder to alter the default theme of the template -->
        <!-- The themes stylesheet of this template (for using specific theme color in individual elements - must included last) -->
        <!-- <link rel="stylesheet" href="<?= $this->templatePath; ?>css/themes/amethyst.css"> -->
        <!-- <link rel="stylesheet" href="<?= $this->templatePath; ?>css/themes/classy.css"> -->
        <!-- <link rel="stylesheet" href="<?= $this->templatePath; ?>css/themes/creme.css"> -->
        <!-- <link rel="stylesheet" href="<?= $this->templatePath; ?>css/themes/flat.css"> -->
        <!-- <link rel="stylesheet" href="<?= $this->templatePath; ?>css/themes/passion.css"> -->
        <!-- <link rel="stylesheet" href="<?= $this->templatePath; ?>css/themes/social.css"> -->
        <link rel="stylesheet" href="<?= $this->templatePath; ?>css/themes/customs.css">
        <link rel="stylesheet" href="<?= $this->templatePath; ?>css/themes.css">
        <!-- END Stylesheets -->
        <!-- Modernizr (browser feature detection library) -->
        <script src="<?= $this->templatePath; ?>js/vendor/modernizr-3.3.1.min.js"></script>
        <!-- jQuery, Bootstrap, jQuery plugins and Custom JS code -->
        <script src="<?= $this->templatePath; ?>plugins/sweetalert/sweetalert.min.js"></script>
        <script src="<?= $this->templatePath; ?>js/vendor/jquery-2.2.4.min.js"></script>
        <script src="<?= $this->templatePath; ?>js/vendor/bootstrap.min.js"></script>
        <!-- <script src="https://code.highcharts.com/highcharts.js"></script> -->
        <!-- <script src="https://code.highcharts.com/modules/exporting.js"></script> -->
        <!-- <script src="https://code.highcharts.com/modules/export-data.js"></script> -->
        <script src="<?= $this->templatePath; ?>plugins/highcharts/highcharts.js"></script>
        <script src="<?= $this->templatePath; ?>plugins/highcharts/exporting.js"></script>
        <script src="<?= $this->templatePath; ?>plugins/highcharts/export-data.js"></script>
    </head>
    <?php require_once $this->viewPath; ?>
</html>
