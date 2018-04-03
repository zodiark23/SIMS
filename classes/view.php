<?php namespace SIMS\Classes;


/**
 * Include the the corresponding view depending on the the declared property
 */
class View {

    /**
     * The filename to be rendered
     */
    public $view;
    /**
     * The data passed by controller
     */
    public $data = [];
    /**
     * The controller action will pass a pointer here
     */
    public $pointer;


    public function __construct($view){
        
        $this->view = $view;
    }



    public function render(){
        require_once ("app/views/master.layout.php");
    }

    public function raw_view(){
        require_once("app/views/".$this->view.".php");
    }


    public function error(){
        require_once ("app/views/404.php");
    }

	public function unauthorized(){
		require_once ("app/views/401.php");
	}
}