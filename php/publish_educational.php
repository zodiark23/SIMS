<?php

include_once("../config.php");
include("../classes/autoloader.php");

loadPackage("../");

use SIMS\App\Models\AdminModel;


$curr_id = $_POST['curr_id'] ?? "";

$adminModel = new AdminModel();
$result = $adminModel->publishSchoolLevels($curr_id);

if($result){
    $callback["code"] = "00";
    $callback["message"] = "Successfully published.";
}else{
    $callback["code"] = "01";
    $callback["message"] = "Unable to publish.";
}

echo json_encode($callback, JSON_PRETTY_PRINT);
