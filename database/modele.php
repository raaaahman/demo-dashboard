<?php
	//Connexion  à la base de données
	function setConnection () {
		$bdd = new PDO('mysql:host=localhost;dbname=demo-dashboard;charset=utf8', 'root', 'l00kout');

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

	function getUser($id) {
		$bdd = setConnection();
		$request = $bdd->prepare('SELECT * FROM utilisateur WHERE identifiant_utilisateur = :id;');
		$request->bindParam(':id', $id);
		$request->execute();
		$results = $request->fetch();
		$bdd = null;
		return $results;
	}

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
