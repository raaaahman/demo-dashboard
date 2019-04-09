<?php

class LoginManager {

	//TODO: store token in database for each user
	//Chaque jour, le token de sécurité est changé
    public static function getToken() {
    	return md5(strval(date("d")) . SITE_SALT);
    }

    //Vérifie le token stocké dans la session PHP
	//Si l'utilisateur n'est pas loggé, renvoie vers le formulaire de connexion
    public static function verifyToken() {
		global $router;

	    if ( !array_key_exists('token', $_SESSION) ||  $_SESSION['token'] != LoginManager::getToken() ) {
		    $router->direct('/login', 'GET'); //TODO: Use a redirect instead
	    }
    }

    public function verifyPassword() {
        global $db;
        global $router;

        if ($db->verifyPass()) {
        	$_SESSION['token'] = LoginManager::getToken();
        	$router->direct('/', 'GET');
        }
    }

}