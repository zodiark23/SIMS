<?php
include_once("../config.php");
include("../classes/autoloader.php");

loadPackage("../");

use SIMS\App\Models\SubjectModel;



$subjectModel = new SubjectModel();

$subject_name = $_POST['subject_name'] ?? "";
$curr_id = $_POST['curr'] ?? "";

$result = $subjectModel->create($subject_name,$curr_id);


if($result == true){
    $callback['code'] = "00";
    $callback['message'] = "Subject added";
}else{
    $callback['code'] = "01";
    $callback['message'] = "Unable to process subject creation. Contact Support.";
}

echo json_encode($callback , JSON_PRETTY_PRINT);