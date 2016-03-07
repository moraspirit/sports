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
        <title>Tweet all</title>
        <link rel="stylesheet" href="css/bootstrap.css">
        <script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
    </head>
    <body>
        <?php
        include_once './header.php';
        ?>
        <div class="container">
            <div class="row">
                <h1 class="page-header">Type it.. And hit 'send'</h1>
            </div>
            <form action="" method="post" onsubmit="javascript: return warning()">
                <div class="form-group">
                    <textarea class="form-control" placeholder="sports update." maxlength="160" id="tweet_txt"></textarea>
                    <p id="length_txt">0/160</p>
                    <div class="row">&nbsp;</div>
                    <input type="submit" class="btn btn-primary pull-right" value="Send">
                </div>
            </form>
        </div>
        <script>
            $('#tweet_txt').on('keyup', function () {
                var length = $('#tweet_txt').val().length;
                $('#length_txt').text(length + "/" + 160);
            });

            function warning() {
                var text = $('#tweet_txt').val();
                var length = text.length;
                if (text === '' || length > 160) {
                    alert("Invalid tweet.");
                    return false;
                } else {
                    var cn = confirm(text + "\n\nThis tweet will be sent to all the subscribers. Are you sure?");
                    return cn;
                }
            }
        </script>
    </body>
</html>
