<?php
/**
 * Controller in charge to everything user's related
 */

class UsersController extends AbstractController {

    public function index() {
        global $db;
        global $router;

        if ( LoginManager::isLogged() !== true ) {
        	$router->redirect('/login', 'GET');
        }

        $users = $db->getUsersList();

        $this->render([
            'title' => 'Liste des utilisateurs',
            'view' => 'users_list',
            'has_drawer_menu' => true,
            'scripts' => [
            	'handleButton'
            ],
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
			session_regenerate_id();
			$_SESSION['token'] = LoginManager::getToken();
			$_SESSION['logged'] = true;
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
			'scripts' => [
				'sendForm'
			],
			'data' => [
				'user' => [],
				'ville' => $db->getList('CitiesTable'),
				'language' => $db->getList('LanguagesTable'),
				'niveau' => $db->getList('SkillTable')
			]
		]);
	}

	//Enregistre un nouvel utilisateur
	public function registerUser() {
		global $db;
		global $router;

		if (LoginManager::verifyToken($_POST)) {
			$db->insertInto( 'UsersTable', $_POST, ['token' => false] );
		}
		$router->redirect('/', 'GET');
	}

	//Formulaire de modification d'un utilisateur existant
	public function editUser() {
    	global  $db;
    	$id = htmlspecialchars($_GET['id']);

    	$this->render([
    		'title' => 'Modifier l\'utilisateur',
		    'has_drawer_menu' => true,
		    'view' => 'user_form',
		    'action' => 'update-user',
		    'data' => [
		    	'user' => $db->getEntry('UsersTable', 'identifiant_utilisateur', $id),
			    'ville' => $db->getList('CitiesTable'),
			    'language' => $db->getList('LanguagesTable'),
			    'niveau' => $db->getList('SkillTable')
		    ]

	    ]);
	}

	//Enregistre les modification en base de données
	public function updateUser() {
    	global $db;
    	global $router;

    	if (LoginManager::verifyToken($_POST)) {
		    $db->update('UsersTable', $_POST);
	    }
	    $router->redirect('/users-list', 'GET');
	}

	//Supprime un utilisateur de la base de données
	public function deleteUser() {
    	global $db;
    	global $router;

    	$db->delete('UsersTable', $_POST['userId']);
	}
}