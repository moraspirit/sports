<?php

/**
 * @author Chathura WIdanage <chathurawidanage@gmail.com>
 */
include_once 'medoo.min.php';

$db = new medoo();

function getAll() {
    global $db;
    return $db->query("SELECT * FROM score")->fetchAll(PDO::FETCH_ASSOC);
}

function addScore($gameCode, $universityCode, $category, $score) {
    global $db;
    $datas = array(
        "game_code" => $gameCode,
        "category" => $category,
        "score" => $score,
        "university_code" => $universityCode
    );

    $insert = $db->insert("score", $datas);
    return $insert;
    //error_log("as");
}

function getEntryID($gameCode, $universityCode, $category) {
    global $db;
    $res = $db->query("SELECT id,score FROM score WHERE "
                    . "game_code='$gameCode' AND "
                    . "university_code='$universityCode' AND "
                    . "category='$category' LIMIT 1")->fetchAll(PDO::FETCH_ASSOC);
    return $res[0];
}

function updateScore($entry, $score) {
    global $db;
    $datas = array(
        "score" => $score
    );
    $db->query("UPDATE score SET score=$score WHERE id=$entry");
    //$res=$db->update("score", $datas, "id=$entry");
}

function removeScore($entry) {
    global $db;
    $db->query("DELETE FROM score WHERE id=$entry");
}

function getAllGames() {
    global $db;
    return $db->query("SELECT game_code,game_name FROM game")->fetchAll(PDO::FETCH_ASSOC);
}

function getAllUniversities() {
    global $db;
    return $db->query("SELECT code,name FROM university")->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * scores with uni codes and game codes only (no names)
 * @global medoo $db
 * @return type row of data
 */
function getScoreTable() {
    global $db;
    return $db->query("SELECT university_code,sum(score) as score "
                    . "FROM `score` "
                    . "GROUP BY university_code")->fetchAll(PDO::FETCH_ASSOC);
}

function getSummarys($offset, $rowCount) {
    global $db;
    return $db->query("SELECT * FROM summary ORDER BY id DESC LIMIT $offset,$rowCount")->fetchAll(PDO::FETCH_ASSOC);
}

function getPointsTable() {
    global $db;
    return $db->query("SELECT * "
                    . "FROM `points_table` ")->fetchAll(PDO::FETCH_ASSOC);
}

function getEvents() {
    global $db;
    return $db->query("SELECT * "
                    . "FROM `events` where dates >= curdate() order by dates asc")->fetchAll(PDO::FETCH_ASSOC);
}

function addSummary($title, $uni1, $uni1scr, $uni2, $uni2scr, $summary) {
    global $db;
    $datas = array(
        "heading" => $title,
        "team_a_code" => $uni1,
        "team_a_score" => $uni1scr,
        "team_b_code" => $uni2,
        "team_b_score" => $uni2scr,
        "summary" => $summary
    );

    $insert = $db->insert("summary", $datas);
    return $insert;
    //error_log("as");
//$query = "INSERT INTO summary (team_a_code,team_b_code,team_a_score,team_b_score,heading,summary) VALUES ('$uni1','$uni2','$uni1scr','$uni2scr','$title','$summary')";
}
