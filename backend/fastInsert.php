<?php
require_once './medoo.min.php';
/*
 * @author Chathura Widanage <chathurawidanage@gmail.com>
 * @date  2015-05-22 
 */
echo "rec";
$date = filter_input(INPUT_POST, 'date');
$game = filter_input(INPUT_POST, 'game');
$cat = filter_input(INPUT_POST, 'cat');
$teams = filter_input(INPUT_POST, 'teams');
$org = filter_input(INPUT_POST, 'org');
$venue = filter_input(INPUT_POST, 'venue');

if($date==NULL){
	$date="";
}


if($game==NULL){
	$game="";
}


if($cat==NULL){
	$cat="";
}


if($teams==NULL){
	$teams="";
}


if($org==NULL){
	$org="";
}


if($venue==NULL){
	$venue="";
}

$db=new medoo();
$datas=array(
  'dates'=>$date,
    'sport'=>$game,
    'category'=>$cat,
    'teams'=>$teams,
    'org_by'=>$org,
    'venue'=>$venue
    
);

echo print_r($datas,true);

$db->insert('events', $datas);

echo print_r($db->error(),true);


