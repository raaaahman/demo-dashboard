<?php

class LoginController extends AbstractController {
//Si l'utilisateur a demandé une déconnexion, on affiche le message lui précisant qu'elle a été effectuée

    //Affichage du formulaire de connexion
    public function index() {
        
        return $this->render('login');
    }

    //Affiche le formulaire d'inscription
    public function newUser() {

        return $this->render( 'user_form');
    }

    //Enregistre un nouvel utilisateur
    public function registerUser() {
        global $db;

        $db->insertInto('utilisateur', $_POST);
    }
}