<?php


require_once ("classes/view.php");

class FakeController extends Controller{

    public function __construct(){
        $this->view = new View("index");
    }
}