<?php
/**
 * Controller in charge to everything user's related
 */

class UsersController extends AbstractController {

    public function index() {
        global $db;
        LoginManager::verifyToken();

        $users = $db->getUsersList();

        $this->render([
            'title' => 'Liste des utilisateurs',
            'view' => 'users_list',
            'data' =>   [ 'users' => $users ]
        ]);
    }

	//Affichage du formulaire de connexion
	public function authenticateUser() {
		$this->render([
			'title' => 'Authentification',
			'view' => 'login'
		]);
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