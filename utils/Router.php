<?php
class Router {

    private $routes = [
        //Les routes accessibles via la méthode GEt
        'GET' => [],
        //Les routes accesibles via la méthode POSt
        'POST' => []
    ];

    public function get($route, $controller) {
        $this->routes['GET'][SITE_URL . DIRECTORY_SEPARATOR . $route] = $controller;
    }

    public function post($route, $controller) {
        $this->routes['POST'][SITE_URL . DIRECTORY_SEPARATOR . $route] = $controller;
    }

    //Charge le contrôleur associé à la route
    //Lance la méthode demandée
    public function direct($route) {

        if (array_key_exists($route, $this->routes[$_SERVER['REQUEST_METHOD']])) {
            $route = explode('@',
                trim($this->routes[$_SERVER['REQUEST_METHOD']][$route], '/')
            );
            $controller_file = CTRL_DIR . $route[0] . '.php';

            require $controller_file;
            $controller = new $route[0];
            $method_name = empty($route[1]) ? 'index' : $route[1];

            if (method_exists($controller, $method_name)) {
                $controller->$method_name();
            }
        } else {
            require SITE_ROOT . '/views/404.view.php';
        }
    }
}