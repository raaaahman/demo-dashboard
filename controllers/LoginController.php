<?php

class LoginController extends AbstractController {
//Si l'utilisateur a demandé une déconnexion, on affiche le message lui précisant qu'elle a été effectuée

    //Affichage du formulaire de connexion
    public function index() {
        
        return $this->render('login');
    }
}