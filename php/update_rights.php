<?php

include_once("../config.php");
include("../classes/autoloader.php");

loadPackage("../");

use SIMS\App\Models\RoleModel;

$roleModel = new RoleModel();

$rightsid = $_POST['rights'] ?? "";

$role_name = $_POST['r_name'];


/**
 *
 * Check if the user checked atleast 1 checkbox
 * If false, the current rights will be deleted and inserted with the newly selected rights.
 */
if(empty($rightsid)){
	$callback['code'] = "01";
	$callback['message'] = "Please select atleast 1.";
}else {

	$updateRights = $roleModel->updateRights($_POST['rid'], $_POST['rights'], $role_name);
	if($updateRights){

		$callback['code'] = "00";
		$callback['message'] = "Successfully updated the rights";
	}else{
		$callback['code'] = "01";
		$callback['message'] = "Unable to process the request.";
	}
}


echo json_encode($callback, JSON_PRETTY_PRINT);