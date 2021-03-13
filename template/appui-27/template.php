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

        /* Frameduz Progress */
        .fzprogress {
            display: flex;
            background-color: #fefefe;
            width: 100%;
            height: 100%;
            position: absolute;
            margin: 0;
            padding: 0;
            z-index: 999;
            filter: opacity(0.9);
        }

        .fzprogress span {
            margin: auto;
            margin-top: 50%;
        }

        .fzprogress div.spinner {
            position: absolute;
            width: 54px;
            height: 54px;
            left: 50%;
            top: 50%;
        }

        .fzprogress div.spinner div {
            width: 6%;
            height: 16%;
            background: #de4b39;
            background: #aaa;
            position: absolute;
            opacity: 0;
            -webkit-border-radius: 50px;
            -webkit-box-shadow: 0 0 3px rgba(0,0,0,0.2);
            -webkit-animation: fade 1s linear infinite;
        }

        @-webkit-keyframes fade {
            from {opacity: 1;}
            to {opacity: 0.25;}
        }

        .fzprogress div.spinner div.bar1 {
            -webkit-transform:rotate(0deg) translate(0, -130%);
            -webkit-animation-delay: 0s;
        }    

        .fzprogress div.spinner div.bar2 {
            -webkit-transform:rotate(30deg) translate(0, -130%); 
            -webkit-animation-delay: -0.9167s;
        }

        .fzprogress div.spinner div.bar3 {
            -webkit-transform:rotate(60deg) translate(0, -130%); 
            -webkit-animation-delay: -0.833s;
        }
        .fzprogress div.spinner div.bar4 {
            -webkit-transform:rotate(90deg) translate(0, -130%); 
            -webkit-animation-delay: -0.7497s;
        }
        .fzprogress div.spinner div.bar5 {
            -webkit-transform:rotate(120deg) translate(0, -130%); 
            -webkit-animation-delay: -0.667s;
        }
        .fzprogress div.spinner div.bar6 {
            -webkit-transform:rotate(150deg) translate(0, -130%); 
            -webkit-animation-delay: -0.5837s;
        }
        .fzprogress div.spinner div.bar7 {
            -webkit-transform:rotate(180deg) translate(0, -130%); 
            -webkit-animation-delay: -0.5s;
        }
        .fzprogress div.spinner div.bar8 {
            -webkit-transform:rotate(210deg) translate(0, -130%); 
            -webkit-animation-delay: -0.4167s;
        }
        .fzprogress div.spinner div.bar9 {
            -webkit-transform:rotate(240deg) translate(0, -130%); 
            -webkit-animation-delay: -0.333s;
        }
        .fzprogress div.spinner div.bar10 {
            -webkit-transform:rotate(270deg) translate(0, -130%); 
            -webkit-animation-delay: -0.2497s;
        }
        .fzprogress div.spinner div.bar11 {
            -webkit-transform:rotate(300deg) translate(0, -130%); 
            -webkit-animation-delay: -0.167s;
        }
        .fzprogress div.spinner div.bar12 {
            -webkit-transform:rotate(330deg) translate(0, -130%); 
            -webkit-animation-delay: -0.0833s;
        }

        /* Frameduz Form Content */
        .fzform-content {
            display: none;
            position: relative;
        }

        /* Frameduz Table Content */
        .fztable-content {
            display: none;
            position: relative;
        }
        
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

        /* Frameduz Table Empty */
        .fztable-empty {
            padding: 10px;
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