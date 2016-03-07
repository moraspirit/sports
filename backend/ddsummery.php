<?php
include_once './global.inc.php';
include_once './ScoreUtilities.php';

$title = filter_input(INPUT_POST, 'title');
$uni1 = filter_input(INPUT_POST, 'uni1');
$uni2 = filter_input(INPUT_POST, 'uni2');
$uni1scr = filter_input(INPUT_POST, 'uni1scr');
$uni2scr = filter_input(INPUT_POST, 'uni2scr');
$summary = filter_input(INPUT_POST, 'summary');

if ($title != NULL) {
    $id = addSummary($title, $uni1, $uni1scr, $uni2, $uni2scr, $summary);
    echo $id;
echo '<br>'.'<a class="btn btn-success center-block" href="http://sports.moraspirit.com/backend/ddsummery.php">Back</a>';
    die();
}
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Add Sumemry</title>
        <link rel="stylesheet" href="css/bootstrap.css">
    </head>
    <body>
        <?php
        include_once './header.php';
        ?>
        <div class="container">
            <div class="row">
                <h1 class="page-header">Add Summary</h1>                  
            </div>
            <div class="row">
                <form class="form-horizontal" method="post" action="ddsummery.php">
                    <div class="form-group-sm">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title">
                    </div>
                    <div class="row">
                        &nbsp;
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="row">
                                <h3 class="text-center">Team A</h3>
                            </div>
                            <div class="form-group-sm">
                                <label>University</label>
                                <?php
                                $unis = getAllUniversities();
                                ?>
                                <select class="form-control" name="uni1">
                                    <?php
                                    for ($i = 0; $i < sizeof($unis); $i++) {
                                        $uni = $unis[$i];
                                        ?>
                                        <option value="<?php echo $uni['code'] ?>"><?php echo $uni['name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group-sm">
                                <label>Score</label>
                                <input type="number" step="0.1" name="uni1scr" class="form-control">
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="row">
                                <h3 class="text-center">Team B</h3>
                            </div>
                            <div class="form-group-sm">
                                <label>University</label>
                                <select class="form-control" name="uni2">
                                    <?php
                                    for ($i = 0; $i < sizeof($unis); $i++) {
                                        $uni = $unis[$i];
                                        ?>
                                        <option value="<?php echo $uni['code'] ?>"><?php echo $uni['name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group-sm">
                                <label>Score</label>
                                <input type="number" step="0.1" name="uni2scr" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        &nbsp;
                    </div>
                    <div class="form-group-lg">
                        <label>Summary</label>
                        <textarea class="form-control" name="summary"></textarea>
                    </div>
                    <div class="row">
                        &nbsp;
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Save" class="btn btn-success center-block">
                    </div>
                </form>
            </div>

        </div>
    </body>
</html>
