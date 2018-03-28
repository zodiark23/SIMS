<?php

@session_start();
include("../config.php");
include("../classes/autoloader.php");
loadPackage("../");



use SIMS\App\Entities\GradeScheme;
use SIMS\App\Models\GradeModel;


$gradeModel = new GradeModel();
$gradeScheme = new GradeScheme();

$gradeScheme->description = $_POST['gs_description'] ?? "";
$gradeScheme->date_implemented = date("Y-m-d H:i:s");
$gradeScheme->pass_threshold = $_POST['pass_threshold'] ?? 0;
$gradeScheme->published = 0;

$result = $gradeModel->createScheme($gradeScheme);

if(!empty($result['grade_scheme_id'])){
    $callback['code'] = "00";
    $callback['message'] = "Grade Scheme was added to the system";
}else{
    $callback['code'] = "01";
    $callback['message'] = "Unable to proceed with the operation. Unexpected error";
}

echo json_encode($callback, JSON_PRETTY_PRINT);