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
$student_id = $_POST['sid'];
$fname = $_POST['fname'];
$email = $_POST['email'];
$resendToken = $studentModel->resendToken($student_id);

if(!empty($student_id)){

        $callback['code'] = "00";
        $callback['message'] = "Successfully forwarded the approval code.";

	    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
	    try {
		    //Server settings
		    $mail->SMTPDebug = 2;                                 // Enable verbose debug output, 1 or 2
		    $mail->isSMTP();                                      // Set mailer to use SMTP
		    $mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
		    $mail->SMTPAuth = true;                               // Enable SMTP authentication
		    $mail->Username = 'jd1388813@gmail.com';              // SMTP username
		    $mail->Password = 'temppass';                          // SMTP password
		    $mail->SMTPSecure = 'TLS';                            // Enable TLS encryption, `ssl` also accepted
		    $mail->Port = 587;                                    // TCP port to connect to; 465 for ssl and 587 for TLS

		    //Recipients
		    $mail->setFrom('simsofficial@gmail.com', 'SIMS'); // Sender (SIMS)
		    $mail->addAddress($email, $fname);     // Add a recipient; Name is optional
		    $mail->addReplyTo('noreply@sims.com', 'Information');


		    //Content
		    $mail->isHTML(true);                                  // Set email format to HTML
		    $mail->Subject = 'Verify account for SIMS';
		    $mail->Body    = 'Please validate your account here <b>'.BASE_URL.'/home/validate/'.$resendToken.'</b>';
		    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		    $mail->send();
		    echo 'Message has been sent';
	    } catch (Exception $e) {
		    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
		    return false;
	    }
    }else{
        $callback['code'] = "01";
        $callback['message'] = "There was a problem with the resending of approval codes.";
    }



echo json_encode($callback, JSON_PRETTY_PRINT);
