<?php
class Router {

    private $routes;

    public function __construct($routes)
    {
        if (isset($routes))
            $this->setRoutes($routes);
    }

    //Enregistre les routes pour l'application
    public function setRoutes($routes)
    {
        $this->routes = $routes;
    }

    //Retourne le chemin vers le contrôleur selon l'URI
    public function getRoute($uri)
    {
        return $this->routes[$uri];
    }
}