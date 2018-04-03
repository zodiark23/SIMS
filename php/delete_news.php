<?php

include_once("../config.php");
include("../classes/autoloader.php");

loadPackage("../");

use SIMS\App\Models\NewsModel;

$newsModel = new NewsModel();

$id = $_POST['delete_id'];


$isValid = $newsModel->deleteNews($id);

if($isValid){
	$callback['code'] = "00";
	$callback['message'] = "Success";
}else{
	$callback['code'] = "01";
	$callback['message'] = "News was not added!";
}

echo json_encode($callback, JSON_PRETTY_PRINT);
