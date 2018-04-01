<?php

include_once("../config.php");
include("../classes/autoloader.php");

loadPackage("../");

use SIMS\App\Models\ProfileModel;


$profileModel = new ProfileModel();
$teacher_id = $_POST['tid'];
$f_name = $_POST['teacher_first_name'];
$m_name = $_POST['teacher_middle_name'];
$l_name = $_POST['teacher_last_name'];
$email = $_POST['teacher_email'];
$pass = md5($_POST['teacher_pass_confirm']);
$civil_status = $_POST['teacher_civil_status'];
$address = $_POST['teacher_address'];

$isValid = $profileModel->setTeacher($teacher_id,$f_name,$m_name,$l_name,$email,$pass,$civil_status,$address);


if($isValid){
    $callback['code'] = "00";
    $callback['message'] = "Successfully updated your profile.";
}else{
    $callback['code'] = "01";
    $callback['message'] = "Unexpected error happen. Please contact support.";
}

echo json_encode($callback , JSON_PRETTY_PRINT);


