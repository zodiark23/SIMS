<?php

include("../config.php");
include("../classes/autoloader.php");
loadPackage("../");


use SIMS\App\Models\GradeModel;
use SIMS\App\Models\CurriculumModel;


$curModel = new CurriculumModel();


try {
    $result = $curModel->finalizeGrade($_POST['sid'] ?? 0);
    if($result){

        $callback['code'] = "00";
        $callback['message'] =  "Grade finalized for ". count($result). " student(s)";
    }else{
        $callback['code'] = "01";
        $callback['message'] =  "Unable to finalize the grades";

    }

}catch(\Exception $e){
    $callback['code'] = $e->getCode();
    $callback['message'] =  $e->getMessage();
}

echo json_encode($callback, JSON_PRETTY_PRINT);