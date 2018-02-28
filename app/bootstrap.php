<?php

include("classes/router.php");
include("classes/controller.php");
include("controllers/indexController.php");
include("controllers/fakeController.php");

define("BASE_URL", "/sims");
$indexController = new IndexController();

Router::$defaultController = $indexController;
Router::setRoute("", $indexController );
Router::setRoute("home",$indexController );
Router::setRoute("fake",new FakeController() );