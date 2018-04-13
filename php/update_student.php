<?php

include_once("../config.php");
include("../classes/autoloader.php");

loadPackage("../");

use SIMS\App\Models\ProfileModel;


$profileModel = new ProfileModel();

$student_id = $_POST['sid'];
$f_name = $_POST['student_first_name'];
$m_name = $_POST['student_middle_name'];
$l_name = $_POST['student_last_name'];
$email = $_POST['student_email'];
$house = $_POST['student_house_num'];
$sub = $_POST['student_barangay'];
$town = $_POST['student_town'];
$province = $_POST['student_province'];
$tel = $_POST['student_tel_num'];
$cell = $_POST['student_cell_num'];

$isValid = $profileModel->setStudent($student_id,$f_name,$m_name,$l_name,$email,$house,$sub,$town,$province,$tel,$cell);


if($isValid){
    $callback['code'] = "00";
    $callback['message'] = "Successfully updated your profile.";

}else{
    $callback['code'] = "01";
    $callback['message'] = "Unexpected error happen. Please contact support.";
}

echo json_encode($callback , JSON_PRETTY_PRINT);
