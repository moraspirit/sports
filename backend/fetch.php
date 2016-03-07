<?php

/**
 * @author Chathura WIdanage <chathurawidanage@gmail.com>
 */
header("Access-Control-Allow-Origin: *");
include_once './ScoreUtilities.php';
$type = filter_input(INPUT_GET, "type");

if (is_null($type)) {
    echo 0;
} else {
    switch ($type) {
        case "alls":
            echo json_encode(getAll());
            break;
        case "allg":
            echo json_encode(getAllGames());
            break;
        case "allu":
            echo json_encode(getAllUniversities());
            break;
        case "scr":
            echo json_encode(getScoreTable());
            break;
        case "points":
            echo json_encode(getPointsTable());
            break;
        case "sum":
            $offset = filter_input(INPUT_GET, 'offset', FILTER_VALIDATE_INT);
            $count = filter_input(INPUT_GET, 'count', FILTER_VALIDATE_INT);
            if ($offset == NULL || $offset == FALSE) {
                $offset = 0;
            }

            if ($count == NULL || $count == FALSE) {
                $count = 20;
            }
            echo json_encode(getSummarys($offset, $count));
            break;
        case "events":
            echo json_encode(getEvents());
            break;    
        default :
            echo 0;
    }
}
