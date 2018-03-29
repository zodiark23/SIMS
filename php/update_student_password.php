<?php

include_once("../config.php");
include("../classes/autoloader.php");

use SIMS\App\Models\accesstokenModel;

loadPackage("../");

$accessTokenModel = new AccessTokenModel();

$confirmPass = $_POST['s_pass_confirm'];

$isValid = $accessTokenModel->addRole($getRole);

if($isValid){
	$callback['code'] = "00";
	$callback['message'] = "Success";
}else{
	$callback['code'] = "01";
	$callback['message'] = "Role already exists.";
}



echo json_encode($callback, JSON_PRETTY_PRINT);
