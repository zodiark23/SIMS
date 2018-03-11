<?php namespace SIMS\App\Controllers;

use SIMS\Classes\Controller;
use SIMS\Classes\View;


class FakeController extends Controller{

    public function __construct(){
        $this->view = new View("index");
    }

    // pupunta ka lagi dito sa controller na to fakeCont

    public function testPage(){
        $this->view = new View("mv");
        $this->view->render();
    }
}