<?php
include_once("../config.php");
include("../classes/autoloader.php");

loadPackage("../");

use SIMS\App\Models\AdminModel;


$adminModel = new AdminModel();


$result = $adminModel->insertEducational($_POST['description'] , $_POST['duration']);


echo $result;