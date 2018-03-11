<?php

include_once("../config.php");
include("../classes/autoloader.php");

loadPackage("../");

use SIMS\App\Models\TeacherModel;
use SIMS\App\Entities\Teacher;


$teacherModel = new TeacherModel();

$teacher = new Teacher();
$teacher->role_id = DEFAULT_TEACHER_ROLE_ID; // to prevent error on AI column not accepting blank string
$teacher->first_name = $_POST['t_first_name'] ?? "";
$teacher->middle_name = $_POST['t_middle_name'] ?? "";
$teacher->last_name = $_POST['t_last_name'] ?? "";
$teacher->email = $_POST['t_email'] ?? "";
$teacher->password = md5($_POST['t_pass']);
$teacher->status = 1;
$teacher->contact = $_POST['t_contact'] ?? "";
$teacher->nationality = $_POST['t_nationality'] ?? "";
$teacher->civil_status = $_POST['t_civil_status'] ?? "";
$teacher->address = $_POST['t_address'] ?? "";
$teacher->gender = $_POST['t_gender'] ?? "";

$teacher->date_of_birth = ($_POST['t_birth_year'] ?? "") . "-".($_POST['t_birth_month'] ?? "")."-".($_POST['t_birth_day'] ?? "");


$result = $teacherModel->create($teacher);


if($result === true){
    $callback['code'] = "00";
    $callback['message'] = "Teacher ". $teacher->first_name . " was added to the system.";
}else if($result === 409){
    $callback['code'] = "03";
    $callback['message'] = "Duplicate. Email already existing.";
}
else if($result === 401){
    $callback['code'] = "02";
    $callback['message'] = "You don't have privilege to perform this action";
}
else{
    $callback['code'] == "01";
    $callback['message'] = "Unexpected error happen. Please contact support.";
}

echo json_encode($callback , JSON_PRETTY_PRINT);


