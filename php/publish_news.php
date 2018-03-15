<?php

session_start();

include_once("../config.php");
include("../classes/autoloader.php");

use SIMS\App\Models\NewsModel;

loadPackage("../");

$newsModel = new NewsModel();

$newsTitle = $_POST['newsTitle'];

$newsContent = $newsModel->validatetinyMCE($_POST['newsContent']);
//var_dump($newsContent);

$loggedinUser = $_SESSION['user']['role_id'];

$isValid = $newsModel->addNews($loggedinUser,$newsTitle,$newsContent);

if($isValid){
	$callback['code'] = "00";
	$callback['message'] = "Success";
}else{
	$callback['code'] = "01";
	$callback['message'] = "News was not added!";
}

echo json_encode($callback, JSON_PRETTY_PRINT);