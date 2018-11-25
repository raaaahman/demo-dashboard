<?php
//Gestion de la session
session_name("SESSION");
session_start();

//define('SERVER_ROOT', dirname(__FILE__));

//Initialisation de l'accès à la base de données
$db = require 'bootstrap.php';

//Instanciation d'un routeur
require UTIL_DIR . 'Router.php';
$router = new Router();
$routes = require UTIL_DIR . 'routes.php';

//Si l'utilisateur n'est pas connecté, on le dirige vers la page de connexion
if ( !array_key_exists("authorization", $_SESSION) || !$_SESSION["authorization"] ) {
   require $router->direct('login');
} else {
//Sinon, on utilise l'uri comme route pour trouver la page demandée
   require $router->direct($_SERVER['REQUEST_URI']);
}