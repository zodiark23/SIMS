<?php

session_start();



include_once("../config.php");
include("../classes/autoloader.php");

use SIMS\App\Models\LoginModel;

loadPackage("../");

$loginModel = new LoginModel();

$getEmail = $_POST['userid'];
$getPassword = $_POST['userpass'];

/**
 * Beta Algorithm
 * 
 * Check if its admin
 * Check if its student
 * Check if its parent
 * 
 * Attempt 3 times to find if this login is existing
 * 
 */


/**
 * * * * * * * * * * * * * * * * * *
 * ADMIN & TEACHER BLOCK
 * * * * * * * * * * * * * * * * * *
 */
$isValid = $loginModel->adminLogin($getEmail, $getPassword);

if($isValid){
    $callback['code'] = "00";
    $callback['message'] = "Success";
}else{
    /**
     * * * * * * * * * * * * * * * * * *
     * STUDENT BLOCK
     * * * * * * * * * * * * * * * * * *
     */
    $isValid = $loginModel->studentLogin($getEmail, $getPassword);

    if($isValid){
        $callback['code'] = "00";
        $callback['message'] = "Success";
    }else{
        /**
         * * * * * * * * * * * * * * * * * *
         * PARENTS BLOCK
         * * * * * * * * * * * * * * * * * *
         */
        $isValid = $loginModel->parentLogin($getEmail, $getPassword);
        if($isValid){
            $callback['code'] = "00";
            $callback['message'] = "Success";
        }
        else{
            $callback['code'] = "01";
            $callback['message'] = "Unauthorize";
        }

    }
}


echo json_encode($callback, JSON_PRETTY_PRINT);