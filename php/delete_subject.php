<?php

include_once("../config.php");
include("../classes/autoloader.php");

loadPackage("../");

use SIMS\App\Models\SubjectModel;


$id = $_POST['id'] ?? 0;
$subjectModel = new SubjectModel();


$result = $subjectModel->delete($id);

if($result){

    $callback['code'] = "00";
    $callback['message'] = "Successfully deleted the subject.";
}else{
    $callback['code'] = "01";
    $callback['message'] = "Unable to remove/perform the operation";
}

echo json_encode($callback, JSON_PRETTY_PRINT);