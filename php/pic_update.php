<?php
@session_start();
include_once("../config.php");
include("../classes/autoloader.php");

loadPackage("../");

use SIMS\App\Models\ProfileModel;


$profileModel = new ProfileModel();

$email = $_SESSION['user']['email'];
$role_id = $_SESSION['user']['role_id'];
// Saves the actual file name
$fileName = $_FILES["uploaded_file"]["name"];

// Breaks the file name in to array and use (.) dot as delimiter
$fileExt = explode(".", $fileName);

// Save the last entry on $fileExt (file extension) and convert it to lower case if necessarily.
$fileActualExt = strtolower(end($fileExt));

// Use tile as the new file name
$fileNameNew = time() . "." . $fileActualExt;
$target_dir = "../user_uploads/";
$target_file = $target_dir . $fileNameNew;



// Data to be inserted on database
$path_img = "/user_uploads/";
$full_path = $path_img.$fileNameNew;

//$full_img = BASE_URL."../user_uploads/";

$uploadOk = 1;



// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
	$check = getimagesize($_FILES["uploaded_file"]["tmp_name"]);
	if($check !== false) {
		echo "File is an image - " . $check["mime"] . ".";
		$uploadOk = 1;
		return true;
	} else {
		echo "File is not an image.";
		$uploadOk = 0;
		return false;
	}
}
// Check if file already exists
if (file_exists($target_file)) {
	echo "Sorry, file already exists.";
	$uploadOk = 0;
	return false;
}

// Check file size
if ($_FILES["uploaded_file"]["size"] > 2000000) {
	echo "Sorry, your file is too large. 2mb file limit";
	$uploadOk = 0;
	return false;
} elseif($_FILES["uploaded_file"]["size"] <=0) {
	echo "Please upload a valid image.";
	$uploadOk = 0;
	return false;
}

// Allow certain file formats
if($fileActualExt != "jpg" && $fileActualExt != "png" && $fileActualExt != "jpeg") {
	echo "Sorry, only JPG, JPEG & PNG files are allowed.";
	$uploadOk = 0;
	return false;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
	echo "Sorry, your file was not uploaded.";
	return false;
// if everything is ok, try to upload file
} else {
	if (move_uploaded_file($_FILES["uploaded_file"]["tmp_name"], $target_file)) {
//		echo "The file ". basename( $_FILES["uploaded_file"]["name"]). " has been uploaded as ". $fileNameNew.".";
		$profileModel->setProfileImage($role_id,$email,$full_path);
		header('Location: ../account/image');
		return true;
	} else {
		echo "Sorry, there was an error uploading your file.";

		return false;
	}
}