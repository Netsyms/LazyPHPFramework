<?php
require 'required.php';

redirectifnotloggedin();
?>
<!DOCTYPE html>
<html>
    <head>
        <!-- TODO: add sarcastic easter egg comments. -->
        <meta charset="UTF-8">
        <title><?php echo APP_NAME; ?></title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/app.css">
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/tinymce/tinymce.min.js"></script>
        <script>tinymce.init({selector: 'textarea'});</script>
    </head>
    <body>
        <div class="container">
            <?php
            include 'header.php';
            ?>
            <?php
            /**
             * This is still better than `include "pages/" . $_GET['action']`.
             */
            switch ($_GET['action']) {
                case 'login':
                    include 'pages/login.php';
                    break;
                case 'loggedout':
                    include 'pages/loggedout.php';
                    break;
                case 'edituser':
                    include 'pages/edituser.php';
                    break;
                case '':
                case 'home':
                    include 'pages/home.php';
                    break;
                case 'userlist':
                    include 'pages/userlist.php';
                    break;
                default:
                    include 'pages/404.php';
                    break;
            }
            ?>
        </div>
        <br />
    </body>
</html>
