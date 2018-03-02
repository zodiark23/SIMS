<?php


require_once ("classes/view.php");

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