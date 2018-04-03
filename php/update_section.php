<?php

include("../config.php");
include("../classes/autoloader.php");
loadPackage("../");

use SIMS\App\Entities\Section;
use SIMS\App\Models\SectionModel;

//@TODO : Implement the real data input
$section = new Section();
$section->section_adviser = (int)$_POST['teacher_id'] ?? 0;
$section->level_id = (int)$_POST['level'] ?? 0;
$section->curr = (int)$_POST['curr'] ?? 0;
$section->section_name = $_POST['section_name'];
$section->section_id = (int)$_POST['section_id'] ?? 0;

$sectionModel = new SectionModel();


try {

    $result = $sectionModel->update($section);

    if($result === true){
        $callback['code'] = "00";
        $callback['message'] = "Section updated.";
    }else{
        $callback['code'] = "01";
        $callback['message'] = "Unexpected error occurred.";
    }

} catch(Exception $e){
    $callback['code'] = "500";
    $callback['message'] = "Invalid Teacher ID.";
}


echo json_encode($callback, JSON_PRETTY_PRINT);
