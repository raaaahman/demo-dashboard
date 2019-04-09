<?php
//Une classe permettant d'effectuer les requêtes vers la base de données
class DbQuery
{
	public $pdo;

	function __construct($pdo) {
		$this->pdo = $pdo;
	}

	public function getList($table)
	{
		$statement =$this->pdo->prepare("SELECT * FROM {$table}");

		$statement->execute();

		return $statement->fetchAll();
	}

	public function insertInto($table, $data) {
	    $keys = implode(', ', array_keys($data));
	    $values = implode('\', \'', array_values($data));
        $statement = $this->pdo->prepare("INSERT INTO {$table} ({$keys}) VALUES ('{$values}')");

        $statement->execute();
    }

	//Récupération des utilisateurs dans la bdd
	function getUsersList() {

		$users = $this->pdo->query('SELECT
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

		return $users;
	}

	//Récupération des statistiques sur les utilisateurs
	function getUsersStats() {

		//récupérer les ages
		$users_stats["ages"] = $this->pdo->query('SELECT (CASE
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
	    $users_stats["genres"] = $this->pdo->query('SELECT COUNT(civilite) as "nb",
	    	 IF(civilite = "M.", "homme", "femme") as "genre"
	    	 FROM utilisateur
	    	 GROUP BY genre;');

	    //récupérer les pays
	    $users_stats["countries"] = $this->pdo->query('SELECT COUNT(code_pays_pays) as "nb_users",
	    		UCASE(code_pays_pays) as "pays"
	    	FROM utilisateur
	    		LEFT JOIN ville
	    			ON utilisateur.code_commune_insee_ville = ville.code_commune_insee
		    GROUP BY code_pays_pays');

	   	return $users_stats;
	}

	function verifyPass() {
		//Récupérer le hash
      $get_hash = $this->pdo->prepare('SELECT mot_de_passe FROM utilisateur WHERE email = :user_email');

      $mail = $_POST["email"];

      $get_hash->bindParam(":user_email", $mail);

      $get_hash->execute();

      $hash = $get_hash->fetch();

      $get_hash->closeCursor();

      //Comparaison du hash avec le mdp
      return password_verify($_POST["password"], $hash['mot_de_passe']);
	}

	function getUser($id) {
		$request = $this->pdo->prepare('SELECT * FROM utilisateur WHERE identifiant_utilisateur = :id;');
		$request->bindParam(':id', $id);
		$request->execute();
		$results = $request->fetch();
		return $results;
	}

	function supprUser($id) {
		//Si la confirmation est validée, l'utilisateur est supprimé
		//Préparation de la requête
		$req = $this->pdo->prepare('DELETE FROM utilisateur WHERE identifiant_utilisateur = :id;');
		//Liaison du paramètre
		$req->bindParam(':id', $id);
		//Exécution de la requête
		$req->execute();

	}

	//TODO Finish refactoring
	function udpateUser($id, $values) {
        $update = $this->pdo->prepare(
            'UPDATE utilisateur
    	  SET civilite = :civ, nom = :nom, prenom = :prenom, date_naissance = :d_naiss,	adresse = :adr, adresse_complement = :adr_comp, mot_de_passe = :mdp, email = :email, tel = :tel, mobile = :mobile, abonnement_newsletter = :abo,	pref_accept_conditions = :accept,	pref_heure_repas = :repas, date_dispo = :dispo,	 motivation = :motiv,	biographie = :bio,	philosophie = :philo,	code_commune_insee_ville = :code_comm, 	id_langage_langage = :langage,	id_niveau_niveau = :niveau
	      WHERE identifiant_utilisateur = :user_id;
	    ');

        $update->bindParam("user_id", $values["identifiant_utilisateur"]);
        $update->bindParam("civ", $values["civilite"], PDO::PARAM_INT);
        $update->bindParam("nom", $values["nom"]);
        $update->bindParam("prenom", $values["prenom"]);
        $update->bindParam("d_naiss", $values["date_naissance"]);
        $update->bindParam("adr", $values["adresse"]);
        $update->bindParam("adr_comp", $values["adresse_complement"]);
        $update->bindParam("mdp", $mdp);
        $update->bindParam("email", $values["email"]);
        $update->bindParam("tel", $values["tel"]);
        $update->bindParam("mobile", $values["mobile"]);
        $update->bindParam("abo", $abo, PDO::PARAM_INT);
        $update->bindParam("accept", $accept, PDO::PARAM_INT);
        $update->bindParam("repas", $values["pref_heure_repas"]);
        $update->bindParam("dispo", $values["date_dispo"]);
        $update->bindParam("motiv", $values["motivation"], PDO::PARAM_INT);
        $update->bindParam("bio", $values["biographie"]);
        $update->bindParam("philo", $values["philosophie"]);
        $update->bindParam("code_comm", $values["code_commune_insee_ville"]);
        $update->bindParam("langage", $values["id_langage_langage"], PDO::PARAM_INT);
        $update->bindParam("niveau", $values["id_niveau_niveau"], PDO::PARAM_INT);

        $update->execute();

    }

}
