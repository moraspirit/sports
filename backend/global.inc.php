<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    die();
}

require_once './ScoreUtilities.php';



