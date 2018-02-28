<?php



class Router {

    /**
     * Default error page
     */
    public $error_page;

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
    public static function call($url, $action = ""){
        $controller = self::$routes[$url]["controller"];

        if(!$controller){
            return false;
        }

        $action = empty($action) ? "default": $action;
        
        $controller->$action();
        
    }


}