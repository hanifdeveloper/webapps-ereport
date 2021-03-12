<!DOCTYPE html>
<html lang="en">
    <head>
    <!-- Title -->
    <title><?= $this->web_title; ?></title>
    <base href="<?= $basePath; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta charset="UTF-8">
    <meta name="description" content="<?= $this->web_description; ?>" />
    <meta name="keywords" content="<?= $this->web_keywords; ?>" />
    <meta name="author" content="<?= $this->web_author; ?>" />
    <!-- <link rel="shortcut icon" href="assets/images/favicon.ico"> -->
    <!-- CSS -->
    <?= $cssPath; ?>
    <style>
        
        /* Frameduz Table Loader */
        .fztable-loader {
            margin: 50px auto;
            width: 70px;
            text-align: center;
        }

        .fztable-loader > div {
            width: 18px;
            height: 18px;
            background-color: #de4b39;

            border-radius: 100%;
            display: inline-block;
            -webkit-animation: sk-bouncedelay 1.4s infinite ease-in-out both;
            animation: sk-bouncedelay 1.4s infinite ease-in-out both;
        }

        .fztable-loader .bounce1 {
            -webkit-animation-delay: -0.32s;
            animation-delay: -0.32s;
        }

        .fztable-loader .bounce2 {
            -webkit-animation-delay: -0.16s;
            animation-delay: -0.16s;
        }

        @-webkit-keyframes sk-bouncedelay {
            0%, 80%, 100% { -webkit-transform: scale(0) }
            40% { -webkit-transform: scale(1.0) }
        }

        @keyframes sk-bouncedelay {
            0%, 80%, 100% { 
                -webkit-transform: scale(0);
                transform: scale(0);
            } 40% { 
                -webkit-transform: scale(1.0);
                transform: scale(1.0);
            }
        }

        .block-title h2 {
            text-transform: capitalize!important;
        }
        .table thead th {
            font-size: 14px!important;
        }
    </style>
    </head>
    <?php require_once $viewPath; ?>
</html>