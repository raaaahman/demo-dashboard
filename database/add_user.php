<?php
$db = require "bootstrap.php";

if (array_key_exists("abonnement_newsletter", $_POST)) {
      $abo = $_POST["abonnement_newsletter"];
    } else {
      $abo = 0;
    }

    if (array_key_exists("pref_accept_conditions", $_POST)) {
      $accept = $_POST["pref_accept_conditions"];
    } else {
      $accept = 0;
    }

    //Hashage du mot de passe
    $mdp = $db->password_hash($_POST["mot_de_passe"], PASSWORD_BCRYPT);

    //Requête vers la base de données
    $add = $db->prepare('INSERT INTO utilisateur
        VALUES (NULL, :civ, :nom, :prenom,
        :d_naiss,
        :add, :add_comp,
        :mdp, :email,
        :tel, :mobile,
        :abo, :accept, :repas, :dispo, :motiv,
        :bio, :philo,
        :code_comm, :langage, :niveau)
      ;');

    $add->bindParam("civ", $_POST["civilite"], PDO::PARAM_INT);
    $add->bindParam("nom", $_POST["nom"]);
    $add->bindParam("prenom", $_POST["prenom"]);
    $add->bindParam("d_naiss", $_POST["date_naissance"]);
    $add->bindParam("add", $_POST["adresse"]);
    $add->bindParam("add_comp", $_POST["adresse_complement"]);
    $add->bindParam("mdp", $mdp);
    $add->bindParam("email", $_POST["email"]);
    $add->bindParam("tel", $_POST["tel"]);
    $add->bindParam("mobile", $_POST["mobile"]);
    $add->bindParam("abo", $abo, PDO::PARAM_INT);
    $add->bindParam("accept", $accept, PDO::PARAM_INT);
    $add->bindParam("repas", $_POST["pref_heure_repas"]);
    $add->bindParam("dispo", $_POST["date_dispo"]);
    $add->bindParam("motiv", $_POST["motivation"], PDO::PARAM_INT);
    $add->bindParam("bio", $_POST["biographie"]);
    $add->bindParam("philo", $_POST["philosophie"]);
    $add->bindParam("code_comm", $_POST["code_commune_insee_ville"]);
    $add->bindParam("langage", $_POST["id_langage_langage"], PDO::PARAM_INT);
    $add->bindParam("niveau", $_POST["id_niveau_niveau"], PDO::PARAM_INT);

    $add->execute();

    return $add->debugDumpParams();


