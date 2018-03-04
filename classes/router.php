<?php namespace SIMS\Classes;


/**
 * Handles the requests of the user
 * 
 * Uses the correct controller depending on the controller action
 */
class Router {

    /**
     * Default error page
     */
    public $error_page;

    public static $defaultController;

    /**
     * List of all registered known routes
     */
    public static $routes = [];

    public static function setRoute($url, $controller){
        self::$routes[$url] = ["url" => $url , "controller" => $controller];
    }

    /**
     * Call the controller base on the route given
     */
    public static function call($url, $action = "", $id = ""){
        $controller = self::$routes[$url]["controller"] ?? "";

        if(!$controller){

            if(empty(self::$defaultController)){
                throw new Exception("No default route found.The server can't process this request");
            }
            //invoke the default controller
            $ctrl = new self::$defaultController();
            $ctrl->error();
            return false;
        }

        $action = empty($action) ? "default": str_replace("-","_",$action);
        
        $valid = method_exists($controller, $action);

        if(!$valid){
            $controller->error();
            return false;
        }

        $controller->$action($id);
        
    }


}