<?php
include("../config.php");
include("../classes/autoloader.php");
loadPackage("../");


use SIMS\App\Models\CurriculumModel;
$subject = $_POST['subject'] ?? 0;
$level = $_POST['level'] ?? 0;

$curriculumModel = new CurriculumModel();
try{
    $result = $curriculumModel->detachSubjectToSchoolLevel($subject, $level);
    if($result == true){
        $callback['code'] = "00";
        $callback['message'] = "Subject detached to this level.";
    }else{
        $callback['code'] = "01";
        $callback['message'] = "Unable to detach this subject.";
    }
}catch(Exception $e){
    $callback['code'] = $e->getCode();
    $callback['message'] = $e->getMessage();
}


echo json_encode($callback, JSON_PRETTY_PRINT);
