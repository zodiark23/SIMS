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


/************************************************
 * Load all the student info to student objects *
 * **********************************************
 */
$student = new Student();
$student->first_name = $_POST['s_first_name'] ?? "";
$student->middle_name = $_POST['s_middle_name'] ?? "";
$student->last_name = $_POST['s_last_name'] ?? "";
$student->email = $_POST['s_email'] ?? "";
$student->password = md5(time());
$student->contact_number = "-";
$student->create_date = date("Y-m-d H:i:s");
$student->last_updated = date("Y-m-d H:i:s");
$student->birth_date = ($_POST['s_year'] ?? "")."-".($_POST['s_month'] ?? "")."-".($_POST['s_day'] ?? "");
$student->gender = $_POST['sex'] ?? "";
$student->house_street_number = $_POST['s_house_street_number'] ?? "";
$student->subdivision_barangay = $_POST['s_sub_barangay'] ?? "";
$student->town_city = $_POST['s_town_city'] ?? "";
$student->province = $_POST['province'] ?? "";
$student->tel_number = $_POST['s_tel_number'] ?? "";
$student->cell_number = $_POST['s_cell_number'] ?? "";
$student->region = $_POST['s_region'] ?? "";
$student->status = 0;
$student->role_id = 3;


/*************************
 * START PROCESSING INFO *
 * ***********************
 */

$studentModel = new StudentModel();
$studentResult = $studentModel->create($student);
$setToken = $studentModel->setToken($student);
$getToken = $studentModel->getToken($student);



if(!empty($studentResult['student_id'])){
    // Since we now have the student_id we will insert it to the educational table
    $educAttainment = new EducationalAttainment();
    $educAttainment->student_id = $studentResult['student_id'];
    $educAttainment->address = $_POST['edu_elem_address'] ?? "";
    $educAttainment->description = $_POST['edu_elementary_name'] ?? "";
    $educAttainment->year_completed = $_POST['edu_elem_year_completed'] ?? "";
    $educAttainment->create_date = date("Y-m-d H:i:s");
    $educAttainment->last_modified = date("Y-m-d H:i:s");

    $educResult = $studentModel->addEducationAttainment($educAttainment);

    if($educResult === true){

        $callback['code'] = "00";
        $callback['message'] = "Successfully added. Approval is still needed to activate this account.";

	    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
	    try {
		    //Server settings
		    $mail->SMTPDebug = 2;                                 // Enable verbose debug output, 1 or 2
		    $mail->isSMTP();                                      // Set mailer to use SMTP
		    $mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
		    $mail->SMTPAuth = true;                               // Enable SMTP authentication
		    $mail->Username = 'jd1388813@gmail.com';              // SMTP username
		    $mail->Password = 'tempass';                          // SMTP password
		    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
		    $mail->Port = 465;                                    // TCP port to connect to; 465 for ssl and 587 for TLS

		    //Recipients
		    $mail->setFrom('simsofficial@gmail.com', 'SIMS'); // Sender (SIMS)
		    $mail->addAddress($student->email, $student->first_name);     // Add a recipient; Name is optional
		    $mail->addReplyTo('noreply@sims.com', 'Information');


		    //Content
		    $mail->isHTML(true);                                  // Set email format to HTML
		    $mail->Subject = 'Verify account for SIMS';
		    $mail->Body    = 'Please validate your account here <b>http://localhost/sims/home/validate/'.$getToken.'</b>';
		    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		    $mail->send();
		    echo 'Message has been sent';
	    } catch (Exception $e) {
		    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
		    return false;
	    }
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
