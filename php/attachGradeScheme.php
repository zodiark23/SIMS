<?php

@session_start();
include("../config.php");
include("../classes/autoloader.php");
loadPackage("../");



use SIMS\App\Models\GradeModel;


$gradeModel = new GradeModel();
$schemeId = (int)$_POST['scheme_id'] ?? 0;
$levelId = (int)$_POST['level_id'] ?? 0;

$result = $gradeModel->gradeSchemeAttachTo($schemeId, $levelId);

if($result == true){
    $callback['code'] = "00";
    $callback['message'] = "Grade scheme updated.";
}else{
    $callback['code'] = "01";
    $callback['message'] = "Unable to proceed with the operation. Unexpected error";
}

echo json_encode($callback, JSON_PRETTY_PRINT);