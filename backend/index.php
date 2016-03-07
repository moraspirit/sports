<?php
include_once './global.inc.php';
?>
<!DOCTYPE html>
<!--
@author : chathura widanage <chathurawidanage@gmail.com>
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Inter university Games 2015 - Backend</title>
        <link rel="stylesheet" href="css/bootstrap.css">
    </head>
    <body>
        <?php
        include './header.php';
        ?>

        <div class="container">

            <div class="col-xs-12">
                <div class="row">
                    <h1 class="page-header">What do you want to do?</h1>
                </div>
                <div class="row">
                    <a href="events">
                        <h3>Manage Events</h3>
                    </a>
                </div>
                <div class="row">
                    <a href="ddsummery.php">
                        <h3>Add summary</h3>
                    </a>
                </div>
                <div class="row">
                    <a href="addscore.php">
                        <h3>Add Score</h3>
                    </a>
                </div>
                <div class="row">
                    <a href="updatescore.php">
                        <h3>Edit Score</h3>
                    </a>
                </div>
                <div class="row">
                    <a href="tweet.php">
                        <h3>Tweet All</h3>
                    </a>
                </div>
            </div>
        </div>
    </body>
</html>
