<?php
//Gestion de la session
session_name("SESSION");
session_start();

//Initialisation de l'accès à la base de données
$db = require 'utils/bootstrap.php';

//Instanciation d'un routeur
$router = new Router($routes);

var_dump($router->getRoute(''));

//Si l'utilisateur n'est pas connecté, on le dirige vers la page de connexion

//Sinon, on utilise l'uri comme route pour trouver la page demandée