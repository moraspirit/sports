<?php
include_once './global.inc.php';

//save mode
$uni = filter_input(INPUT_GET, 'uni');
$game = filter_input(INPUT_GET, 'game');
$category = filter_input(INPUT_GET, 'category');
$score = filter_input(INPUT_GET, 'score');



if ($score != NULL) {
    $res = addScore($game, $uni, $category, $score);
    if ($res > 0) {
        
    } else {
        echo getEntryID($game, $uni, $category)['id'];
    }
}
?>
<!DOCTYPE html>
<!--
@author : chathura widanage <chathurawidanage@gmail.com>
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Inter university Games 2015 - Score</title>
        <link rel="stylesheet" href="css/bootstrap.css">
        
    </head>
    <body>
        <?php
        include_once './header.php';
        ?>

        <div class="container">

            <div class="col-xs-12">
                <div class="row">
                    <h1 class="page-header">Add Points</h1>
                </div>
                <div class="row">
                    <form class="form form-horizontal">
                        <div class="form-group-sm">                            
                            <label>University</label>
                            <?php
                            $unis = getAllUniversities();
                            ?>
                            <select class="form-control" name="uni">
                                <?php
                                for ($i = 0; $i < sizeof($unis); $i++) {
                                    $uni = $unis[$i];
                                    ?>
                                    <option value="<?php echo $uni['code'] ?>"><?php echo $uni['name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div>&nbsp;</div>
                        <div class="form-group-sm">
                            <label>Game</label>
                            <?php
                            $games = getAllGames();
                            ?>
                            <select class="form-control" name="game">
                                <?php
                                for ($i = 0; $i < sizeof($games); $i++) {
                                    $game = $games[$i];
                                    ?>
                                    <option value="<?php echo $game['game_code'] ?>"><?php echo $game['game_name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div>&nbsp;</div>
                        <div class="form-group-sm">
                            <label>Category</label>
                            <select name="category" class="form-control">
                                <option value="M">Male</option>
                                <option value="F">Female</option>
                            </select>
                        </div>
                        <div>&nbsp;</div>
                        <div class="form-group-sm">
                            <label>Score</label>
                            <input type="number" step="any" class="form-control" name="score" value="0">
                        </div>
                        <div>&nbsp;</div>
                        <div class="form-group-sm">
                            <input type="submit" value="Save" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
