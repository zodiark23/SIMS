<?php

include("../config.php");
include("../classes/autoloader.php");
loadPackage("../");

use SIMS\App\Entities\Section;
use SIMS\App\Models\SectionModel;

//@TODO : Implement the real data input
$section = new Section();
$section->section_adviser = "2";
$section->section_name = "Quigley";

$sectionModel = new SectionModel();


try {

    $result = $sectionModel->create($section);

    if($result === true){
        $callback['code'] = "00";
        $callback['message'] = "Section was created.";
    }

} catch(Exception $e){
    $callback['code'] = "500";
    $callback['message'] = "Invalid Teacher ID.";
}


echo json_encode($callback, JSON_PRETTY_PRINT);
