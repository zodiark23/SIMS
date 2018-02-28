<?php

include("classes/router.php");
include("classes/controller.php");
include("controllers/indexController.php");

define("BASE_URL", "/sims");
$indexController = new IndexController();

Router::setRoute("", $indexController );
Router::setRoute("index",$indexController );