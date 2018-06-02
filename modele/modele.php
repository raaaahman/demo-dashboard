<?php
	//Connexion  à la base de données
	function setConnection () {
		global $db_user;
		global $db_pass;
		$bdd = new PDO("mysql:host=localhost;dbname=demo-dashboard;charset=utf8", $db_user, $db_pass);

		return $bdd;
	}
	//Récupération des utilisateurs dans la bdd
	function getUsersList() {

		$bdd = setConnection();

		$users = $bdd->query('SELECT
				u.identifiant_utilisateur as ID,
				CONCAT(u.civilite, " ", u.nom, " ", u.prenom) as Noms,
				v.nom_ville as NomVille,
				pays.nom_pays as NomPays,
				langage.nom_langage as Langage,
				niveau.description_niveau as Niveau
					FROM utilisateur u
				LEFT JOIN ville v
					ON u.code_commune_insee_ville = v.code_commune_insee
					LEFT JOIN pays
						ON v.code_pays_pays = pays.code_pays
				LEFT JOIN langage
					ON u.id_langage_langage = langage.id_langage
				LEFT JOIN niveau
					ON u.id_niveau_niveau = niveau.id_niveau
				ORDER BY nom, prenom;');

		$bdd = null;

		return $users;
	}

	//Récupération des statistiques sur les utilisateurs
	function getUsersStats() {

		$bdd = setConnection();

		//récupérer les ages
		$users_stats["ages"] = $bdd->query('SELECT (CASE
	      WHEN (YEAR(NOW()) - YEAR(date_naissance)) < 18 THEN "-18"
	      WHEN (YEAR(NOW()) - YEAR(date_naissance)) >= 18 AND (YEAR(NOW()) - YEAR(date_naissance)) < 26 THEN "18-26"
	      WHEN (YEAR(NOW()) - YEAR(date_naissance)) >= 26 AND (YEAR(NOW()) - YEAR(date_naissance)) < 40 THEN "26-40"
	      WHEN (YEAR(NOW()) - YEAR(date_naissance)) >= 40 AND (YEAR(NOW()) - YEAR(date_naissance)) < 65 THEN "40-65"
	      ELSE "65+"
	    END) as "tranche_age",
	    COUNT(CASE civilite
	      WHEN "M." THEN 1
	    END) as "nb_hommes",
	    COUNT(CASE civilite
	      WHEN "Mme" THEN 1
	      WHEN "Mlle" THEN 1
	    END) as "nb_femmes"
	    FROM utilisateur
	    GROUP BY tranche_age');

		//récupérer les genres
	    $users_stats["genres"] = $bdd->query('SELECT COUNT(civilite) as "nb",
	    	 IF(civilite = "M.", "homme", "femme") as "genre"
	    	 FROM utilisateur
	    	 GROUP BY genre;');

	    //récupérer les pays
	    $users_stats["countries"] = $bdd->query('SELECT COUNT(code_pays_pays) as "nb_users",
	    		UCASE(code_pays_pays) as "pays"
	    	FROM utilisateur
	    		LEFT JOIN ville
	    			ON utilisateur.code_commune_insee_ville = ville.code_commune_insee
		    GROUP BY code_pays_pays');

	    $bdd = null;

	   	return $users_stats;
	}

	function getFormFields() {
		$bdd = setConnection();
		$form_fields = array();
		$form_fields["ville"] = $bdd->query('SELECT * FROM ville');
		$form_fields["langage"] = $bdd->query('SELECT * FROM langage');
		$form_fields["niveau"] = $bdd->query('SELECT * FROM niveau');
		$bdd = null;
		return $form_fields;
	}

	function verifyPass() {
		$bdd = setConnection();

		//Récupérer le hash
      $get_hash = $bdd->prepare('SELECT mot_de_passe FROM utilisateur WHERE email = :user_email');

      $get_hash->bindParam(":user_email", $mail);
      $mail = $_POST["email"];

      $get_hash->execute();
      $hash = $get_hash->fetch();

      $get_hash->closeCursor();

      //Comparaison du hash avec le mdp
      return password_verify($_POST["password"], $hash['mot_de_passe']);
	}

	/*
	function addUser() {

		//Valeur par défaut des champs abbonnement et acceptation des conditions
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
		$mdp = password_hash($_POST["mot_de_passe"], PASSWORD_BCRYPT);

		//Requête vers la base de données
		$bdd = setConnection();

		//$add = $bdd->prepare('$request');

		$add = $bdd->prepare('INSERT INTO utilisateur
				VALUES (NULL, :civ, :nom, :prenom,
				:d_naiss,
				:add, :add_comp,
				:mdp, :email,
				:tel, :mobile,
				:photo, :cv,
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
		$add->bindValue("photo", "photos/user_photo.jpg");
		$add->bindValue("cv", "cv/user_cv.pdf");
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

		echo $add->rowCount() . "lignes affectées";

		$bdd = null;
	}
	*/

	function supprUser($id) {
		//Si la confirmation est validée, l'utilisateur est supprimé
		$bdd = setConnection();
		//$bdd->exec('DELETE FROM utilisateur WHERE identifiant_utilisateur = ' . $_GET["id"]);
		//Préparation de la requête
		$req = $bdd->prepare('DELETE FROM utilisateur WHERE identifiant_utilisateur = :id;');
		//Liaison du paramètre
		$req->bindParam(':id', $id);
		//Exécution de la requête
		$req->execute();

		$bdd = null;
	}
