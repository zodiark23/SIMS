<?php


use SIMS\App\Controllers\IndexController;
use SIMS\App\Controllers\FakeController;
use SIMS\App\Controllers\AccountController;
use SIMS\App\Controllers\AdminController;
use SIMS\App\Controllers\LoginController;

use SIMS\Classes\Router;
use SIMS\Classes\Controller;



$indexController = new IndexController();

Router::$defaultController = $indexController;
Router::setRoute("", $indexController );
Router::setRoute("home",$indexController );
Router::setRoute("account",new AccountController() );
Router::setRoute("admin",new AdminController() );
Router::setRoute("fake",new FakeController() );
Router::setRoute("home",new LoginController() );
