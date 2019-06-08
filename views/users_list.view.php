<?php
	$page_title = "Liste des utilisateurs";
	$has_drawer_menu = true;
	ob_start();
?>
	<div class="mdl-cell mdl-cell--12-col">
		<table class="mdl-data-table">
			<thead>
				<tr>
					<th class="mdl-data-table__cell--non-numeric">
						Utilisateur
					</th>
					<th class="mdl-data-table__cell--non-numeric">
						Ville
					</th>
					<th class="mdl-data-table__cell--non-numeric">
						Pays
					</th>
					<th class="mdl-data-table__cell--non-numeric">
						Langage préféré
					</th>
					<th class="mdl-data-table__cell--non-numeric">
						Niveau
					</th>
					<th class="mdl-data-table__cell--non-numeric">
						Editer
					</th>
					<th class="mdl-data-table__cell--non-numeric">
						Supprimer
					</th>
				</tr>
			</thead>
			<tbody>

<?php

	//La boucle affiche les utilisateurs un par un
	foreach($page['data']['users'] as $user) {

		echo "<tr><td class='mdl-data-table__cell--non-numeric'>" . $user["Noms"] ."</td>" .
		"<td class='mdl-data-table__cell--non-numeric'>" . $user["NomVille"] . "</td>" .
		"<td class='mdl-data-table__cell--non-numeric'>" . $user["NomPays"] . "</td>" .
		"<td class='mdl-data-table__cell--non-numeric'>" . $user["Langage"] . "</td>" .
		"<td class='mdl-data-table__cell--non-numeric'>" . $user["Niveau"] . "</td>" .
		"<td class='mdl-data-table__cell--non-numeric'><a href='edit-user?id=" . $user["ID"] . "'><i class='mdl-color-text--blue-grey-400 material-icons' role='presentation'>edit</i></a></td>" .
		"<td class='mdl-data-table__cell--non-numeric'><a class='ajax-button' href='#' data-action='delete-user' data-user-id='" . $user["ID"] . "'><i class='mdl-color-text--blue-grey-400 material-icons' role='presentation'>delete</i></a></td>" .
		"</tr>";

		if (array_key_exists("action", $_GET) AND $_GET["action"] == "suppr" AND $_GET["id"] == $user["ID"]) {
			//si l'on a demandé la supression et que l'utilisateur correspond à l'id passé dans l'url

			echo "<tr><td colspan='8'>";

			if (array_key_exists("confirm", $_GET) AND $_GET["confirm"] == "true") {

				//On affiche un message pour en informer l'utilisateur
				echo $user["Noms"] . " a bien été supprimé de la base de données!".
				//Puis on retourne à la liste des utilisateurs
				"<a href='?action=list.php'>Ok</a>";

			} elseif (array_key_exists("action", $_GET) AND $_GET["action"] == "suppr") {
				echo "Vous vous apprêtez à supprimer " . $user["Noms"] .
				" de la base de données, voulez-vous continuer?" .
				"<a href='?action=suppr&id=" . $_GET["id"] . "&confirm=true'>Oui</a>\t" .
				"<a href='?action=list'>Non</a>";
			}

			echo "</td></tr>";
		}
	}

?>

			</tbody>
		</table>
	</div>

<?php $main_content = ob_get_contents();
	ob_end_clean();

	require "template.view.php";
