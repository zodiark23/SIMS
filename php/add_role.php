<?php

include_once("../config.php");
include("../classes/autoloader.php");

use SIMS\App\Models\RoleModel;

loadPackage("../");


$roleModel = new RoleModel();

$getRole = $_POST['r_name'];

/*
 * If valid new role name will be inserted to the database.
 * */

$isValid = $roleModel->addRole($getRole);

if($isValid){
    $callback['code'] = "00";
    $callback['message'] = "Success";
}else{
	$callback['code'] = "01";
	$callback['message'] = "Role already exists.";
    }



echo json_encode($callback, JSON_PRETTY_PRINT);
