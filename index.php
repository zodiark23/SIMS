<?php
include("classes/autoloader.php");
loadPackage(__DIR__);

include_once("config.php");
include_once("app/bootstrap.php");

use SIMS\Classes\Router;

/**
 * Basic routing 
 */
$request = explode("/", trim($_REQUEST['path'] ?? "" , "/") );
$url = $request[0] ?? "";
$action = $request[1] ?? "";
$id = $request[2] ?? "";
Router::call( str_replace(".php", "" , $url ), $action, $id);
