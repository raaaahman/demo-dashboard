<?php
class Router {

    private $routes = [
        //Les routes accessibles via la méthode GEt
        'GET' => [],
        //Les routes accesibles via la méthode POSt
        'POST' => []
    ];

    public function get($route, $controller) {
        $this->routes['GET'][$route] = $controller;
    }

    public function post($route, $controller) {
        $this->routes['POST'][$route] = $controller;
    }

    //Charge le contrôleur associé à la route
    //Lance la méthode demandée
    public function direct($route, $force_method = false) {
    	$request_method = $force_method ? $force_method : $_SERVER['REQUEST_METHOD'];
    	$page_found = false;

    	//Sur un serveur local, l'URI peut inclure la hiérarchie des dossiers
	    //cette ligne prend uniquement la partie qui nous intéresse
	    if (preg_match(
	    	 '/' . preg_replace('/\//',  '\/', SITE_URL) . '/',
		    $route)
	    ) {
			$route = substr($route, strlen(SITE_URL ) );
	    }

        if (array_key_exists( $route , $this->routes[$request_method])) {
            $route = explode('@',
                $this->routes[$request_method][$route]
            );
            $controller_file = CTRL_DIR . $route[0] . '.php';

            require_once $controller_file;
            $controller = new $route[0];
            $method_name = empty($route[1]) ? 'index' : $route[1];

            if (method_exists($controller, $method_name)) {
                $controller->$method_name();
                $page_found = true;
            }
        }

        if (!$page_found) {
	        require SITE_ROOT . '/views/404.view.php';
        }
    }

	public function redirect($route, $force_method = false ) {
    	//Indique au navigateur une redirection
    	header('Status-Code', 302 );

    	$this->direct($route, $force_method);

    	//Interrompt le script original
		die();
	}
}