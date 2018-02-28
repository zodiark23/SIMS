<?php

require_once("classes/view.php");

class IndexController extends Controller
{
 
    public $view;

    public function __construct(){
        $this->view = new View("index");
    }

    public function register(){
        $this->view = new View("register_form");
        $this->view->render();
    }
    
    
}
