<?php
  session_name("SESSION");
  session_start();

  //Appel des fonctions d'accès aux données
  require "modele/config.php";
  require "modele/modele.php";

  //En cas de déconnexion,  on supprime la session et on affiche le formulaire de connexion
  if (array_key_exists("action", $_GET) AND $_GET["action"] == "logout") {
    $_SESSION = array(); //écraser les variables contenues dans la session
    session_destroy();

    $log_message = "Vous avez été déconnecté avec succès.";
    require "views/login.php";

  //Vérification des autorisations
  } elseif (array_key_exists("authorization", $_SESSION) AND $_SESSION["authorization"] == true) {

    //Action de l'utilisateur
    if(array_key_exists("action", $_GET)) {
      switch ($_GET["action"]) {
        //Ajout d'un nouvel utilisateur
        case "create":
          //if(array_key_exists("confirm", $_GET) AND $_GET["confirm"] == "true") {
            //Insertion dans la base de données
            /*$test = addUser(); //OLD

            $users = getUsersList();
            require "views/users_list.php";
          } else {*/
            //Création du script à ajouter au formulaire
            ob_start();
          ?>
            <script type="text/javascript">
              $(document).ready(function() {

                //Evenement sur le formulaire

                $("#new-user-form").on('submit', function() {

                  //GO AJAX!
                  $.post("modele/add_user.php", $('#new-user-form').serialize(), function(data) {
										console.log(data);
                    $('#new-user-form').before("Utilisateur ajouté à la base de données");
                    //Toggle le formulaire
                    $('#new-user-form').slideToggle();
                  });

                  return false; //Pas de changement de page
                });
              });
            </script>

          <?php
            $script = ob_get_contents();
            ob_end_clean();
            //Affichage du formulaire
            $form_fields = getFormFields();

            require "views/new_user_form.php";
          //}
            break;
        //Statistiques sur les utilisateurs
        case "stats":
          $users_stats = getUsersStats();

          require "views/users_stats.php";
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
          $users = getUsersList();

          require "views/users_list.php";

          break;
      }

    } else {
      //Récupération et affichage des utilisateurs
        $users = getUsersList();

        require "views/users_list.php";
    }

  //En cas de session non valide, on vérifie si un formulaire a été renvoyé
  } elseif(!empty($_POST)) {

    //Vérification du mot de passe haché
    $pass = verifyPass();

    //modification de l'autorisation
    if ($pass) {

      $_SESSION["authorization"] = true;

      //Affichage de la liste de contacts
      $users = getUsersList();
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
