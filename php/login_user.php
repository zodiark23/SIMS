<?php

session_start();

include_once("../config.php");
include("../classes/autoloader.php");

use SIMS\App\Models\LoginModel;
use SIMS\App\Models\RoleModel;

loadPackage("../");

$loginModel = new LoginModel();


$roleModel = new RoleModel();

// Fetch all the right(s) of the logged in user.


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
	$_SESSION['userRights'] = $roleModel->loadRights($_SESSION['user']['role_id']);
    if($_SESSION['user']['teacher_id'] == "1"){
        $callback['type'] = 'admin';
    }else{
        $callback['type'] = 'teacher';
    }
}else{
    /**
     * * * * * * * * * * * * * * * * * *
     * STUDENT BLOCK
     * * * * * * * * * * * * * * * * * *
     */
    $isValid = $loginModel->studentLogin($getEmail, $getPassword);

    if($isValid){
        $callback['code'] = "00";
        $callback['type'] = 'student';
        $callback['message'] = "Success";
	    $_SESSION['userRights'] = $roleModel->loadRights($_SESSION['user']['role_id']);
    }else{
        /**
         * * * * * * * * * * * * * * * * * *
         * PARENTS BLOCK
         * * * * * * * * * * * * * * * * * *
         */
        $isValid = $loginModel->parentLogin($getEmail, $getPassword);
        if($isValid){
            $callback['code'] = "00";
            $callback['type'] = 'parent';
            $callback['message'] = "Success";
	        $_SESSION['userRights'] = $roleModel->loadRights($_SESSION['user']['role_id']);
        }
        else{
            $callback['code'] = "01";
            $callback['message'] = "Unauthorize";
        }

    }
}
//


echo json_encode($callback, JSON_PRETTY_PRINT);
