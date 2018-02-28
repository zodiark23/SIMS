<?php


abstract class Controller{

    protected $model;
    protected $defaultView;
    protected $view;


    public function default(){
        $this->view->render();
    }


    public function error(){
        $this->view->error();
    }
}