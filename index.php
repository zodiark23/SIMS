<?php

include_once("config.php");
include_once("app/bootstrap.php");
include_once("classes/router.php");

/**
 * Basic routing 
 */

$request = explode("/", trim($_REQUEST['path'] ?? "" , "/") );
$url = $request[0] ?? "";
$action = $request[1] ?? "";
$id = $request[1] ?? "";
Router::call( str_replace(".php", "" , $url ), $action, $id);
