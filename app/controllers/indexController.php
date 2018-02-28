<?php

require_once("classes/view.php");

class IndexController extends Controller
{
 
    

    public function __construct(){
        $this->view = new View("index");
    }

    public function register(){
        $this->view = new View("register_form");
        $this->view->render();
    }


    public function dashboard(){
        $this->view = new View("dashboard");
        $this->view->render();
    }

    public function facilities(){
        $this->view = new View("facilities");
        $this->view->render();
    }

    public function mv(){
        $this->view = new View("mv");
        $this->view->render();
    }
    
    
}
