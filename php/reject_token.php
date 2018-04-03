<?php

include("../config.php");
include("../classes/autoloader.php");
loadPackage("../");

use SIMS\App\Models\RejectModel;


$student_id = new RejectModel();

$id = $student_id->getStudentID($_POST['id']);
$reject = $student_id->deleteStudentDetails($id);


if($reject){

        $callback['code'] = "00";
        $callback['message'] = "Successfully rejected the student.";

    }else{
        $callback['code'] = "01";
        $callback['message'] = "There was a problem with the rejecting process.";
    }



echo json_encode($callback, JSON_PRETTY_PRINT);
