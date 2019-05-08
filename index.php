<?php
//Gestion de la session
session_name("SESSION");
session_start();

require 'bootstrap.php';

//On parse l'uri comme route pour trouver la page demandée
$route_requested = parse_url( $_SERVER['REQUEST_URI'], PHP_URL_HOST) . parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH);
$router->direct($route_requested);