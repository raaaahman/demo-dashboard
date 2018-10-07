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
    public function direct($uri) {
        if (array_key_exists($uri, $this->routes)) {
            $route = $this->routes[trim($uri, '/')];
            return SITE_ROOT . $route[0];
        }
    }
}