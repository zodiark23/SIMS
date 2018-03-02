<?php


use SIMS\App\Controllers\IndexController;
use SIMS\App\Controllers\FakeController;
use SIMS\Classes\Router;
use SIMS\Classes\Controller;



$indexController = new IndexController();

Router::$defaultController = $indexController;
Router::setRoute("", $indexController );
Router::setRoute("home",$indexController );
Router::setRoute("fake",new FakeController() );
