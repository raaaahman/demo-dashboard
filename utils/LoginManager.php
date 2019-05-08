<?php

class LoginManager {

	//TODO: store token in database for each user
	//Chaque jour, le token de sécurité est changé
    public static function getToken() {
    	return md5(strval(date("d")) . SITE_SALT);
    }

    //Vérifie le token stocké dans la session PHP
    public static function verifyToken() {
    	$logged = false;

	    if ( array_key_exists('token', $_SESSION) &&  $_SESSION['token'] === LoginManager::getToken() ) {
		    $logged = true;
	    }

	    return $logged;
    }

    //Vérifie le mot de pass de l'utilisateur, et stocke un token s'il est valide
    public static function verifyPassword($user, $password) {
        global $db;
        $authorize = false;

        if ($db->verifyPass($user, $password)) {
        	$_SESSION['token'] = LoginManager::getToken();
        	$authorize = true;
        }

        return $authorize;
    }

}