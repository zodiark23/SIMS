<?php

include("../config.php");
include("../classes/autoloader.php");
loadPackage("..");

use SIMS\App\Models\StudentModel;
use SIMS\App\Entities\Student;
use SIMS\App\Entities\EducationalAttainment;


/************************************************
 * Load all the student info to student objects *
 * **********************************************
 */
$student = new Student();
$student->first_name = "Reyan";
$student->middle_name = "Celestial";
$student->last_name = "Tropia";
$student->email = "r23516@gmail.com";
$student->password = md5("12qwas");
$student->contact_number = "183123";
$student->create_date = date("Y-m-d H:i:s");
$student->last_updated = date("Y-m-d H:i:s");
$student->gender = 1;
$student->house_street_number = "0502 Purok 4";
$student->subdivision_barangay = "Sitio Mapanao Asinan Proper";
$student->town_city = "Subic Zambales";
$student->province = "Zambales";
$student->tel_number = "09391760491";
$student->cell_number = "48488";
$student->status = 0;
$student->role_id = 3;


/*************************
 * START PROCESSING INFO *
 * ***********************
 */

$studentModel = new StudentModel();
$studentResult = $studentModel->create($student);



if(!empty($studentResult['student_id'])){
    // Since we now have the student_id we will insert it to the educational table
    $educAttainment = new EducationalAttainment();
    $educAttainment->student_id = $studentResult['student_id'];
    $educAttainment->address = "Subic Zambales";
    $educAttainment->description = "Subic Central Elementary School";
    $educAttainment->description = "sdfsdfsdf";
    $educAttainment->create_date = date("Y-m-d H:i:s");
    $educAttainment->last_modified = date("Y-m-d H:i:s");

    $educResult = $studentModel->addEducationAttainment($educAttainment);

    if($educResult === true){

        $callback['code'] = "00";
        $callback['message'] = "Successfully added. Approval is still needed to activate this account.";
    }else{
        $callback['code'] = "02";
        $callback['message'] = "Student was created. But unable to proceed with the educational attainment data.";
    }
} else if ( !empty($studentResult['code'])){
    if($studentResult['code'] == "DUPLICATE"){
        $callback['code'] = "01";
        $callback['message'] = "The email associated with this request is already taken.";
    }
}else{
    $callback['code'] = "02";
    $callback['message'] = "Unexpected error occurred.";
}


echo json_encode($callback, JSON_PRETTY_PRINT);
