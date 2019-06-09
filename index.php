<?php
ini_set('session.use_only_cookies', true);
//Gestion de la session
session_name("SESSION");
session_start();

require 'bootstrap.php';

if (!array_key_exists('last_connection', $_SESSION)
|| $_SESSION['last_connection'] < (time() - 60)) {
	session_regenerate_id();
	$_SESSION['last_connection'] = time();
	$_SESSION['token'] = LoginManager::getToken();
}



//On parse l'uri comme route pour trouver la page demandée
$route_requested = parse_url( $_SERVER['REQUEST_URI'], PHP_URL_HOST) . parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH);
$router->direct($route_requested);