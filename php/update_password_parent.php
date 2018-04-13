<?php

include_once("../config.php");
include("../classes/autoloader.php");

loadPackage("../");

use SIMS\App\Models\ProfileModel;


$profileModel = new ProfileModel();
$parent_id = $_POST['pid'];
$pass = $_POST['parent_pass_confirm'];


$isValid = $profileModel->setParentPass($parent_id,$pass);


if($isValid){
    $callback['code'] = "00";
    $callback['message'] = "Successfully updated your password.";
}else{
    $callback['code'] = "01";
    $callback['message'] = "Unexpected error happen. Please contact support.";
}

echo json_encode($callback , JSON_PRETTY_PRINT);


