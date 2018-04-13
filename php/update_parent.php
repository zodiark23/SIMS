<?php

include_once("../config.php");
include("../classes/autoloader.php");

loadPackage("../");

use SIMS\App\Models\ProfileModel;


$profileModel = new ProfileModel();
$parent_id = $_POST['pid'];
$f_name = $_POST['parent_first_name'];
$m_name = $_POST['parent_middle_name'];
$l_name = $_POST['parent_last_name'];
$email = $_POST['parent_email'];
$contact = $_POST['parent_contact'];


$isValid = $profileModel->setParent($parent_id,$f_name,$m_name,$l_name,$email,$contact);


if($isValid){
    $callback['code'] = "00";
    $callback['message'] = "Successfully updated your profile.";

}else{
    $callback['code'] = "01";
    $callback['message'] = "Unexpected error happen. Please contact support.";
}

echo json_encode($callback , JSON_PRETTY_PRINT);


