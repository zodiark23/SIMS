<?php namespace SIMS\App\Controllers;

use SIMS\Classes\Controller;
use SIMS\Classes\View;

class AccountController extends Controller{

    public function __construct(){
        $this->view = new View("dashboard");
    }


    public function account(){
        $this->view = new View("dashboard");
    }
}