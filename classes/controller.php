<?php


abstract class Controller{
    /**
     * The model this controller will use
     */
    protected $model;
    /**
     * Unused implementation <depcr pending>
     */
    protected $defaultView;
    /**
     * The view class instance to retrieve the markup
     */
    protected $view;


    public function default(){
        $this->view->render();
    }


    public function error(){
        $this->view->error();
    }
}