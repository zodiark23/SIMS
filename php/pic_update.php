<?php
@session_start();
if(!empty($_FILES['uploaded_file'])) {
    $user = $_SESSION['user']['student_id'];
    $path = "../user_uploads/";
    $path = $user . "_". basename($_FILES['uploaded_file']['name']);

    if (move_uploaded_file($_FILES["uploaded_file"]["tmp_name"], $path)) {
//        echo "The file " . basename($_FILES['uploaded_file']['name']) .
//            " has been uploaded";
//        echo __DIR__;
        header('Location: ../account');
        return true;

    } else {
        $error =  "There was an error uploading the file, please try again!";
        return $error;
//        echo __DIR__;'
    }
}

