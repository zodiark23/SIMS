<?php

include_once("../config.php");
include("../classes/autoloader.php");

loadPackage("../");

use SIMS\App\Models\RoleModel;

$roleModel = new RoleModel();

$id = $_POST['delete_id'];


$isValid = $roleModel->deleteRole($id);

if($isValid){
	$callback['code'] = "00";
	$callback['message'] = "Success";
}else{
	$callback['code'] = "01";
	$callback['message'] = "Role was not deleted!";
}

echo json_encode($callback, JSON_PRETTY_PRINT);
