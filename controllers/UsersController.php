<?php
/**
 * Ce contrôleur gère tous ce qui concerne les utilisateurs
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

		//On stocke un texte de captcha dans la session de l'utilisation qui essaye de se connecter et on l'envoie au formulaire
		if ( session_status() === PHP_SESSION_ACTIVE ) {
			$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
			$_SESSION['captcha_text'] = substr(str_shuffle($chars), 0, 8);
		}


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

		if (LoginManager::verifyToken($_POST) && $_POST['captcha'] === $_SESSION['captcha_text']) {
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

	//Genère une image basée sur le code du captcha, stocké dans la session utilisateur
	public function generateCaptcha() {
    	if ( !array_key_exists('captcha_text', $_SESSION)) {
    		return false;
	    }

		$imageWidth = 180;
		$imageHeigth = 60;

    	try {
		    $captcha = @imagecreatetruecolor($imageWidth, $imageHeigth);
	    } catch (Error $err) {
    		die( $err->getMessage() );
	    }

	    //Background
		$bgColor = imagecolorallocate($captcha, 255, 255, 255);
    	ImageFilledRectangle($captcha, 0, 0, $imageWidth, $imageHeigth, $bgColor);

    	//Text
		$textColor = imagecolorallocate($captcha, 0, 0, 60 );
		imagettftext($captcha, 18, 0,25, 40, $textColor, '/fonts/times_new_yorker.ttf',$_SESSION['captcha_text']);

		//Affichage de l'image
		header('Content-type: image/jpeg');
		imagejpeg($captcha);

		//Libération de l'espace mémoire
		imagedestroy($captcha);
	}
}