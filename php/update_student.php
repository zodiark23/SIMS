<?php

include_once("../config.php");
include("../classes/autoloader.php");

loadPackage("../");

use SIMS\App\Models\ProfileModel;


$profileModel = new ProfileModel();
// File saving
//$file = $_FILES['file'];
//var_dump($_FILES);
//$fileName = $file['name'];
//$fileTmpName = $file['tmp_name'];
//$fileSize = $file['size'];
//$fileError = $file['error'];
//$fileType = $file['type'];
//$fileExt = explode(".", $fileName);
//$fileActualExt = strtolower(end($fileExt));
//
//$allowed = array('jpg','jpeg','png');

//if(in_array($fileActualExt, $allowed)){
//	if($fileError === 0){
//		if($fileSize < 15000){
//			$fileNameNew = ":.".".$fileActualExt;
//			$fileDestination = '../user_uploads/students'.$fileNameNew;
//			$result = move_uploaded_file($fileTmpName, $fileDestination);
//			if($result){
//				return true;
//			}
//		}else{
//			$callback['code'] = "04";
//			$callback['message'] = "Your file is too big!";
//		}
//	}else{
//		$callback['code'] = "03";
//		$callback['message'] = "Unexpected error happen. Please contact support.";
//	}
//}else{
//	$callback['code'] = "02";
//	$callback['message'] = "You cannot upload files of this type!";
//}




$student_id = $_POST['sid'];
$f_name = $_POST['student_first_name'];
$m_name = $_POST['student_middle_name'];
$l_name = $_POST['student_last_name'];
$email = $_POST['student_email'];
$pass = md5($_POST['student_pass_confirm']);
$house = $_POST['student_house_num'];
$sub = $_POST['student_barangay'];
$town = $_POST['student_town'];
$province = $_POST['student_province'];
$tel = $_POST['student_tel_num'];
$cell = $_POST['student_cell_num'];

$isValid = $profileModel->setStudent($student_id,$f_name,$m_name,$l_name,$email,$pass,$house,$sub,$town,$province,$tel,$cell);


if($isValid && $result){
    $callback['code'] = "00";
    $callback['message'] = "Successfully updated your profile.";

}else{
    $callback['code'] = "01";
    $callback['message'] = "Unexpected error happen. Please contact support.";
}

echo json_encode($callback , JSON_PRETTY_PRINT);
