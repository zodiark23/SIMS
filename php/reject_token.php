<?php

include("../config.php");
include("../classes/autoloader.php");
loadPackage("../");

use SIMS\App\Models\StudentModel;
use SIMS\App\Entities\Student;
use SIMS\App\Entities\EducationalAttainment;
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../phpmailer/autoload.php';


$studentModel = new StudentModel();
$student_id = $_POST['id'];

$rejectStudent = $studentModel->rejectToken($student_id);

if($rejectStudent){

        $callback['code'] = "00";
        $callback['message'] = "Successfully rejected the student.";

    }else{
        $callback['code'] = "01";
        $callback['message'] = "There was a problem with the rejecting process.";
    }



echo json_encode($callback, JSON_PRETTY_PRINT);
