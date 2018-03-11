<?php

include_once("../config.php");
include("../classes/autoloader.php");

loadPackage("../");

use SIMS\App\Models\RoleModel;

$roleModel = new RoleModel();

$rightsid = $_POST['rights'] ?? "";

/**
 *
 * Check if the user checked atleast 1 checkbox
 * If false, the current rights will be deleted and inserted with the newly selected rights.
 */
if(empty($rightsid)){
	$callback['code'] = "01";
	$callback['message'] = "Please select atleast 1.";
}else {
	foreach ( $_POST['rights'] as $r) {

		$updateRights = $roleModel->updateRights($_POST['rid'], $r);
	}
	$callback['code'] = "00";
	$callback['message'] = "Successfully updated the rights";
}


echo json_encode($callback, JSON_PRETTY_PRINT);