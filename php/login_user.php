<?php

session_start();

$role_id = $_SESSION['role_id'];

include_once("../config.php");
include("../classes/autoloader.php");

use SIMS\App\Models\LoginModel;

loadPackage("../");

$loginModel = new LoginModel();

$getEmail = $_POST['userid'];
$getPassword = $_POST['userpass'];


