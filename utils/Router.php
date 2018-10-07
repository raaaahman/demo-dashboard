<?php
class Router {

    private $routes;
    
    public function __construct($routes)
    {
        if (isset($routes)) {
            $this->routes = $routes;
        }
    }

    //Charge le contrôleur associé à la route
    public function direct($route) {
        
        $route = explode('@', 
            trim($this->routes[$route], '/')
        );
        require SITE_ROOT . 'controllers' . DIRECTORY_SEPARATOR . $route[0] . '.php';
        $controller = new $route[0];
        $method_name = $route[1];
        
        if (method_exists($controller, $method_name)) {
           return $controller->$method_name();
        }
    }
}