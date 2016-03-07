<?php
session_start();
$username = filter_input(INPUT_POST, 'username');
$password = filter_input(INPUT_POST, 'password');
if ($username != NULL && $password != NULL) {
    if ($username == 'web2015') {
        if ($password == 'WEB@InterUni2015') {
            $_SESSION['username'] = $username;
            header("Location:  index.php");
        } else {
            echo 'password inc';
        }
    } else {
        echo 'username not valid';
    }
}
?>
<!DOCTYPE html>
<!--
@author : chathurawidanage <chathurawidanage@gmail.com>
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Inter university Games 2015 - Login</title>
        <link rel="stylesheet" href="css/bootstrap.css">
    </head>
    <body>
        <div class="container">
            <div class="col-xs-12">
                <form action="" method="post" class="form-horizontal">
                    <div class="form-group-sm">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control">
                    </div>
                    <div class="form-group-sm">
                        <label>password</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div>
                        &nbsp;
                    </div>
                    <div class="form-group-sm">
                        <input type="submit" value="login" class="btn btn-success">
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
