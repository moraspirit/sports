<?php
require_once './medoo.min.php';
/*
 * @author Chathura Widanage <chathurawidanage@gmail.com>
 * @date  2015-05-22 
 */

$date = filter_input(INPUT_POST, 'date');
$game = filter_input(INPUT_POST, 'game');
$cat = filter_input(INPUT_POST, 'cat');
$teams = filter_input(INPUT_POST, 'teams');
$org = filter_input(INPUT_POST, 'org');
$venue = filter_input(INPUT_POST, 'venue');


$db=new medoo();
$datas=array(
  'dates'=>$date,
    'sport'=>$game,
    'category'=>$category,
    'teams'=>$teams,
    'org_by'=>$org,
    'venue'=>$venue
    
);

$db->insert('events', $datas);



