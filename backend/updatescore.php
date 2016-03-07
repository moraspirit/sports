<?php
include_once './global.inc.php';
$id = filter_input(INPUT_GET, "id");
$delete = filter_input(INPUT_GET, 'delete');
$score = filter_input(INPUT_GET, 'score');

if ($id != NULL) {
    if ($delete != NULL) {
        removeScore($id);
        echo 1;
    } else if ($score != NULL) {
        if ($score != FALSE) {
            updateScore($id, $score);
            echo 1;
        } else {
            echo 0;
        }
    }

    die();
}
?>
<!DOCTYPE html>
<!--
@author : chathura widanage <chathurawidanage@gmail.com>
-->
<html data-ng-app="update">
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="css/bootstrap.css" rel="stylesheet">
        <script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="js/angular.min.js"></script>
        <script type="text/javascript" src="js/update.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <style>
            .entry{
                cursor: pointer;
            }
            .entry:hover td{
                background-color: #66afe9 !important;
                color: white;
            }
        </style>
    </head>
    <body data-ng-controller="updatectrl
            as
            uct">
        <?php
        include_once './header.php';
        ?>
        <div class="container">
            <div class="row">
                <h1 class="page-header">What do you want to edit?</h1>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <input type="text" class="form-control" placeholder="Search" data-ng-model="searchTxt" data-ng-keyup="updateVisibleArray()">
                </div>
            </div>
            <div class="row">
                &nbsp;
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <td>Entry</td>
                                <td>University</td>
                                <td>Game</td>
                                <td>Category</td>
                                <td>Score</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr data-ng-repeat="scr in visibleArr" class="entry" data-ng-click="updateReq(scr)">
                                <td>{{scr.id}}</td>
                                <td>{{scr.university_name}}</td>
                                <td>{{scr.game_name}}</td>
                                <td>{{scr.category}}</td>
                                <td>{{scr.score}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="modal fade" id="upd_modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h3 class="modal-title">Update</h3>
                        <h4>{{theChosenOne.university_name}}</h4>
                        <h4>{{theChosenOne.game_name}} {{theChosenOne.category}}</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group-sm">
                            <lable>Score</lable>
                            <input type="number" name="score" class="form-control"  data-ng-value="theChosenOne.score" id="new_score">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-ng-click="update()">Save</button>
                        <button type="button" class="btn btn-danger" data-ng-click="delete()">DELETE!</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </body>
</html>
