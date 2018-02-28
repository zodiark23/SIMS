<?php


class View {

    public $view;


    public function __construct($view){
        
        $this->view = $view;
    }



    public function render(){
        require_once ("app/views/master.layout.php");
    }


    public function error(){
        require_once ("app/views/404.php");
    }
}