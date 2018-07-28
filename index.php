<?php
  session_name("SESSION");
  session_start();

  $db = require 'database/bootstrap.php';

  //En cas de déconnexion,  on supprime la session et on affiche le formulaire de connexion
  if (array_key_exists("action", $_GET) AND $_GET["action"] == "logout") {
    $_SESSION = array(); //écraser les variables contenues dans la session
    session_destroy();

    $log_message = "Vous avez été déconnecté avec succès.";
    require "views/login.php";
	} elseif (array_key_exists("action", $_GET) AND $_GET["action"] == "create") {
		require "views/new_user_form.php";
  //Vérification des autorisations
  } elseif (array_key_exists("authorization", $_SESSION) AND $_SESSION["authorization"] == true) {

    //Action de l'utilisateur
    if(array_key_exists("action", $_GET)) {
      switch ($_GET["action"]) {
        //Statistiques sur les utilisateurs
        case "stats":
          $users_stats = $db->getUsersStats();

          require "views/users_stats.php";
          break;

				case "edit":
					$user_id= htmlspecialchars($_GET["id"]);
					require "views/new_user_form.php";
					break;
        //Suppression d'un utilisateur
        case "suppr":
          //Vérifie la confirmation
          if (array_key_exists("confirm", $_GET) AND $_GET["confirm"] == "true") {
            supprUser($_GET["id"]);
          }
        //affichage de la liste des utilisateurs
        case "list":
        //DEFAULT
        default:
          $users = $db->getUsersList();

          require "views/users_list.php";

          break;
      }

    } else {
      //Récupération et affichage des utilisateurs
        $users = $db->getUsersList();

        require "views/users_list.php";
    }

  //En cas de session non valide, on vérifie si un formulaire a été renvoyé
  } elseif(!empty($_POST)) {

    //Vérification du mot de passe haché
    $pass = $db->verifyPass();

    //modification de l'autorisation
    if ($pass) {

      $_SESSION["authorization"] = true;

      //Affichage de la liste de contacts
      $users = $db->getUsersList();
      require "views/users_list.php";
    } else {

      $_SESSION["authorization"] = false;

      //Retour au login
      $log_message = "Votre email et/ou mot de passe est incorrect";
      require "views/login.php";
    }
  //Si le formulaire n'a pas été renvoyé
  } else {

    require "views/login.php" ;
  }
