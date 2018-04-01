<?php

@session_start();
include("../config.php");
include("../classes/autoloader.php");
loadPackage("../");



use SIMS\App\Entities\Grade;
use SIMS\App\Models\GradeModel;

$gradeModel = new GradeModel();
$grade = new Grade();
$grade->grade_id = $_POST['cid'] ?? 0;
$grade->section_id = $_POST['section_id'] ?? 0;
$grade->student_id = $_POST['student_id'] ?? 0;
$grade->subject_id = $_POST['subject_id'] ?? 0;
$grade->grade = $_POST['grade'] ?? 0;
$grade->flags = $_POST['flag'] ?? 0;
$grade->created_date = date("Y-m-d H:i:s");
$grade->modified_date = date("Y-m-d H:i:s");
$grade->result = "";


    $result = $gradeModel->amendGrade($grade);
    if($result){
        $callback['code'] = "00";
        $callback['cid'] = (int)$result;
        $callback['message'] = "Grade amended";
    }else{
        $callback['code'] = "400";
        $callback['message'] = "Unable to process";
    }


echo json_encode($callback, JSON_PRETTY_PRINT);