<?php
/**
 * Controller in charge to everything user's related
 */

class UsersController extends AbstractController {

    public function index() {
        global $db;
        global $router;

        if ( LoginManager::verifyToken() !== true ) {
        	$router->redirect('/login', 'GET');
        }

        $users = $db->getUsersList();

        $this->render([
            'title' => 'Liste des utilisateurs',
            'view' => 'users_list',
            'has_drawer_menu' => true,
            'data' =>   [ 'users' => $users ]
        ]);
    }

	//Affichage du formulaire de connexion
	public function authenticateUser() {
    	global $router;

		if (array_key_exists( 'email', $_GET ) &&
		    array_key_exists( 'password', $_GET ) &&
		    LoginManager::verifyPassWord($_GET['email'], $_GET['password']) == true
		) {
			$router->redirect('/', 'GET');
		}

		$this->render([
			'title' => 'Authentification',
			'view' => 'login'
		]);
	}

	public function logOutUser() {
    	global $router;

    	session_unset();
    	$router->redirect('/');
	}

	//Affiche le formulaire d'inscription
	public function newUser() {
		global $db;

		$this->render([
			'title' => 'Inscription',
			'has_drawer_menu' => false,
			'view' => 'user_form',
			'action' => 'register',
			'scripts' => array(
				'sendForm'
			),
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