<?php

include_once("../config.php");
include("../classes/autoloader.php");

loadPackage("../");

use SIMS\App\Models\ProfileModel;


$profileModel = new ProfileModel();
$teacher_id = $_POST['tid'];
$pass = $_POST['teacher_pass_confirm'];


$isValid = $profileModel->setTeacherPass($teacher_id,$pass);


if($isValid){
    $callback['code'] = "00";
    $callback['message'] = "Successfully updated your profile.";
}else{
    $callback['code'] = "01";
    $callback['message'] = "Unexpected error happen. Please contact support.";
}

echo json_encode($callback , JSON_PRETTY_PRINT);


