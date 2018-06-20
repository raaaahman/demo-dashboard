<?php
	require "config.php";
	require "modele.php";

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

	$mdp = password_hash($_POST["mot_de_passe"], PASSWORD_BCRYPT);

	$bdd = setConnection();

	$update = $bdd->prepare('UPDATE utilisateur
	SET civilite = :civ, nom = :nom, prenom = :prenom, date_naissance = :d_naiss,	adresse = :adr, adresse_complement = :adr_comp, mot_de_passe = :mdp, email = :email, tel = :tel, mobile = :mobile, photo_profil = :photo, cv = :cv, abonnement_newsletter = :abo,	pref_accept_conditions = :accept,	pref_heure_repas = :repas, date_dispo = :dispo,	 motivation = :motiv,	biographie = :bio,	philosophie = :philo,	code_commune_insee_ville = :code_comm, 	id_langage_langage = :langage,	id_niveau_niveau = :niveau
	WHERE identifiant_utilisateur = :user_id;');

	$update->bindParam("user_id", $_POST["identifiant_utilisateur"]);
	$update->bindParam("civ", $_POST["civilite"], PDO::PARAM_INT);
	$update->bindParam("nom", $_POST["nom"]);
	$update->bindParam("prenom", $_POST["prenom"]);
	$update->bindParam("d_naiss", $_POST["date_naissance"]);
	$update->bindParam("adr", $_POST["adresse"]);
	$update->bindParam("adr_comp", $_POST["adresse_complement"]);
	$update->bindParam("mdp", $mdp);
	$update->bindParam("email", $_POST["email"]);
	$update->bindParam("tel", $_POST["tel"]);
	$update->bindParam("mobile", $_POST["mobile"]);
	$update->bindValue("photo", "photos/user_photo.jpg");
	$update->bindValue("cv", "cv/user_cv.pdf");
	$update->bindParam("abo", $abo, PDO::PARAM_INT);
	$update->bindParam("accept", $accept, PDO::PARAM_INT);
	$update->bindParam("repas", $_POST["pref_heure_repas"]);
	$update->bindParam("dispo", $_POST["date_dispo"]);
	$update->bindParam("motiv", $_POST["motivation"], PDO::PARAM_INT);
	$update->bindParam("bio", $_POST["biographie"]);
	$update->bindParam("philo", $_POST["philosophie"]);
	$update->bindParam("code_comm", $_POST["code_commune_insee_ville"]);
	$update->bindParam("langage", $_POST["id_langage_langage"], PDO::PARAM_INT);
	$update->bindParam("niveau", $_POST["id_niveau_niveau"], PDO::PARAM_INT);

	$update->execute();
	echo $update->debugDumpParams();
	$bdd = null;
