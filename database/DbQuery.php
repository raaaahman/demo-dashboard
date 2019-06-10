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
		$statement =$this->pdo->prepare("SELECT * FROM {$table::$name}");

		$statement->execute();

		return $statement->fetchAll();
	}

	public function insertInto($table, $data) {
		$data = filter_var_array($data, $table::$fields);

		$keys = [];
	    foreach(array_keys($data) as $key){
		    $keys[] = addslashes(htmlspecialchars($key, ENT_QUOTES, SITE_CHARSET));
	    }
		$keys = implode(', ', $keys);

	    $values = [];
		foreach (array_values($data) as $value) {
			$values[] = addslashes(htmlspecialchars($value, ENT_QUOTES, SITE_CHARSET));
		}
	    $values = implode('\', \'', $values);

        $statement = $this->pdo->prepare("INSERT INTO {$table::$name} ({$keys}) VALUES ('{$values}')");

        $statement->execute();
    }

	function getEntry($table, $field, $value) {
		$request = $this->pdo->prepare("SELECT * FROM {$table::$name} WHERE {$field} = :value");
		$request->bindParam(':value', $value);
		$request->execute();
		$results = $request->fetch();
		return $results;
	}

    public function update($table, $data) {
		$sql_set = '';
		$fields =  $table::$fields;
		$data = filter_var_array($data, $table::$fields);

	    foreach ($data as $key => $value) {
			if ($key !== $table::$primary_key) {
				$sql_set .= $key . ' = \'' . addslashes($value) . '\', ';
			}
		}
		$sql_set = trim($sql_set, ', ');

		$statement = $this->pdo->prepare("UPDATE {$table::$name} SET {$sql_set} WHERE {$table::$primary_key} = {$data[$table::$primary_key]};");

		$statement->execute();
    }

    public function delete($table, $id) {
		$statement = $this->pdo->prepare("DELETE FROM {$table::$name} WHERE {$table::$primary_key} = :id");

		$statement->bindParam(':id', intval($id));

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

	function verifyPass($user, $password) {
		//TODO: store password as a hash
		//Récupérer le hash
      $get_hash = $this->pdo->prepare('SELECT mot_de_passe FROM utilisateur WHERE email = :user_email');

      $get_hash->bindParam(":user_email", $user);

      $get_hash->execute();

      $hash = $get_hash->fetch();

      $get_hash->closeCursor();

      //Comparaison du hash avec le mdp
      return $password == $hash['mot_de_passe'];
	}
}
