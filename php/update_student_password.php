<?php

include_once("../config.php");
include("../classes/autoloader.php");

loadPackage("../");

use SIMS\App\Models\ProfileModel;

$accessTokenModel = new ProfileModel();

$pass =$_POST['student_pass_confirm'];
$student_id = $_POST['sid'];

$isValid = $accessTokenModel->setStudentPass($student_id,$pass);

if($isValid){
	$callback['code'] = "00";
	$callback['message'] = "Successfully updated your password";
}else{
	$callback['code'] = "01";
	$callback['message'] = "Failed.";
}



echo json_encode($callback, JSON_PRETTY_PRINT);
