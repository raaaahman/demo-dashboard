<?php

class LoginController extends AbstractController {
//Si l'utilisateur a demandé une déconnexion, on affiche le message lui précisant qu'elle a été effectuée

    //Affichage du formulaire de connexion
    public function index() {
        
        $this->render([
            'title' => 'Authentification',
            'view' => 'login'
        ]);
    }

    public function verify() {
        global $db;
        global $router;

        if ($db->verifyPass()) {
            $router->direct('users-list');
        } else {
        	$router->direct('', 'GET');
        }
    }

    //Affiche le formulaire d'inscription
    public function newUser() {
        global $db;

        $this->render([
            'title' => 'Inscription',
            'has_drawer_menu' => false,
            'view' => 'user_form',
            'action' => 'register',
            'script' => 'sendForm',
            'data' => [
                'user' => [],
                'ville' => $db->getList('ville'),
                'langage' => $db->getList('langage'),
                'niveau' => $db->getList('niveau')
            ]
        ]);
    }

    //Enregistre un nouvel utilisateur
    public function registerUser() {
        global $db;

        $db->insertInto('utilisateur', $_POST);
    }
}