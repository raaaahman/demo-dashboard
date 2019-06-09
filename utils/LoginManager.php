<?php

class LoginManager {

	//Chaque jour, le token de sécurité est changé
    public static function getToken() {
    	return md5(strval(date("d")) . SITE_SALT);
    }

    //Vérifie le token stocké dans la session PHP
    public static function verifyToken( $location ) {
	    return array_key_exists( 'token', $location ) && $location['token'] === LoginManager::getToken();
    }

    //Vérifie que l'utilisateur est actuellement connecté
	public static function isLogged() {
    	return self::verifyToken($_SESSION) && array_key_exists('logged', $_SESSION) && $_SESSION['logged'] == true;
	}

    //Vérifie le mot de pass de l'utilisateur, et stocke un token s'il est valide
    public static function verifyPassword($user, $password) {
        global $db;
        $user = $db->getEntry('utilisateur', 'email', $user);
        if ($user['mot_de_passe'] === $password) {
	        return true;
        } else {
        	return false;
        }
    }

}