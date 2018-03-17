<?php namespace SIMS\Classes;

use SIMS\Classes\Model;

/**
 * Base Controller with default methods
 */
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

    // Instantiates the model class
	public function __construct()
	{
		$this->model = new Model();

	}


	public function default(){
        $this->view->render();
    }


    public function error(){
        $this->view->error();
    }

	public function unauthorized(){
		$this->view->unauthorized();
	}
}