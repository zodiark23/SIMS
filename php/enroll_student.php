<?php

include("../config.php");
include("../classes/autoloader.php");
loadPackage("../");


use SIMS\App\Models\StudentModel;

$studentModel = new StudentModel();

$student_id = (int)$_POST['student_id'] ?? 0;
$level_id = (int)$_POST['level'] ?? 0;
$section_id = (int)$_POST['section'] ?? 0;
try {

    $result = $studentModel->enroll($student_id , $level_id, $section_id);
    if($result){
        $callback['code'] = "00";
        $callback['message'] = "Student successfully enrolled";
    }
}catch (Exception $e){
    $callback['code'] = $e->getCode();
    $callback['message'] = $e->getMessage();
}

echo json_encode($callback, JSON_PRETTY_PRINT);