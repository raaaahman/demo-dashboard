<?php
	//On récupère les viles saisies dans le formulaire
	$form_fields = getFormFields();

	$page_title = "Ajouter un utilisateur";
  ob_start();
?>
<div class="mdl-layout-spacer"></div>
<div class="mdl-cell mdl-cell--8-col">
	<form id="new-user-form" enctype="multipart/form-data" action="modele/add_user.php" method="post">
	    <fieldset>
	      <div class="control is-horizontal">
	        <div class="control-label">
	            <label class="label" for="civilite">Civilité :</label>
	        </div>
	        <div class="control">
	          <span class="select is-fullwidth">
	            <select name="civilite" id="civilite">
	              <option value="M.">M.</option>
	              <option value="Mlle">Mlle</option>
	              <option value="Mme">Mme</option>
	              <option value=""></option>
	            </select>
	          </span>
	        </div>
	      </div>
	      <div class="control is-horizontal">
	        <div class="control-label">
	          <label class="label" for="nom">Nom :</label>
	        </div>
	        <p class="control">
	          <input class="input" type="text" name="nom" id="nom" required aria-required="true">
	        </p>
	      </div>
	      <div class="control is-horizontal">
	        <div class="control-label">
	          <label class="label" for="prenom">Prénom :</label>
	        </div>
	        <p class="control">
	          <input class="input" type="text" name="prenom" id="prenom" required aria-required="true">
	        </p>
	      </div>
	      <div class="control is-horizontal">
	        <div class="control-label">
	          <label class="label" for="date_naissance">Date de naissance :</label>
	        </div>
	        <p class="control">
	          <input class="input" type="date" name="date_naissance" id="date_naissance">
	        </p>
	      </div>

	      <div class="control is-horizontal">
	        <div class="control-label">
	          <label class="label" for="photo_profil">Votre photo :</label>
	        </div>
	        <p class="control">
	          <input type="file" accept="image/*" name="photo_profil" id="photo_profil">
	        </p>
	      </div>

	    </fieldset>

	    <!--Votre CV-->
	    <fieldset>
				<div class="control is-horizontal">
					<div class="control-label">
	          <label class="label" for="cv">Votre CV :</label>
	        </div>
	        <p class="control">
	          <input type="file" accept=".pdf" name="cv" id="cv">
	        </p>
				</div>
	    </fieldset>

	<!-- Vos coordonnées -->
	    <fieldset>
	      <div class="control is-horizontal">
	        <div class="control-label">
	          <label class="label" for="email">e-mail :</label>
	        </div>
	        <p class="control">
	          <input class="input" type="email" name="email" id="email" required aria-required="true">
	        </p>
	      </div>
	      <div class="control is-horizontal">
	        <div class="control-label">
	          <label class="label" for="tel">Téléphone :</label>
	        </div>
	        <p class="control">
	          <input class="input" type="tel" name="tel" id="tel" required aria-required="true">
	        </p>
	      </div>
	      <div class="control is-horizontal">
	        <div class="control-label">
	          <label class="label" for="mobile">Mobile :</label>
	        </div>
	        <p class="control">
	          <input class="input" type="tel" name="mobile" id="mobile" required aria-required="true">
	        </p>
	      </div>

	      <div class="control is-horizontal">
	        <div class="control-label">
	          <label class="label" for="adresse">Adresse :</label>
	        </div>
	        <p class="control">
	          <input class="input" type="text" name="adresse" id="adresse">
	        </p>
	      </div>

	      <div class="control is-horizontal">
	        <div class="control-label">
	          <label class="label" for="adresse_complement">Complément d'adresse :</label>
	        </div>
	        <p class="control">
	          <input class="input" type="text" name="adresse_complement" id="adresse_complement">
	        </p>
	      </div>

	      <div class="control is-horizontal">

	        <div class="control-label">
	          <label class="label" for="ville">Code postal / Ville :</label>
	        </div>
	        <div class="control">
	          <span class="select is-fullwidth">
	            <select name="code_commune_insee_ville" id="ville">
	            <?PhP
	                foreach($form_fields["ville"] as $show) {
	                  echo "<option value=\"" . $show["code_commune_insee"] . "\">" . $show["code_postal"] . " " . $show["nom_ville"] . "</option>";
	                }
	            ?>
	            </select>
	          </span>
	        </div>
	      </div>

	    </fieldset>

	<!-- Vos identifiants -->
	    <fieldset>
	        <div class="control is-horizontal">
	          <div class="control-label">
	            <label class="label" for="mot_de_passe">Mot de passe :</label>
	          </div>
	          <p class="control">
	            <input class="input" type="password" name="mot_de_passe" id="mot_de_passe" required aria-required="true"  autocomplete="off"/>
	          </p><!--autocomplete off pour stopper l'autocompletion-->
	        </div>
	    </fieldset>

	<!-- Vos préférences -->
	    <fieldset>
	      <div class="control is-horizontal">
	        <div class="control-label">
	          <label class="label" for="langage">Quel langage préférez-vous? </label>
	        </div>
	        <div class="control">
	          <span class="select is-fullwidth">
	            <select name="id_langage_langage" id="langage">
	            <?PhP
	                foreach($form_fields["langage"] as $show) {

	                  echo "<option value=\"" . $show["id_langage"] . "\">" . $show["nom_langage"] . "</option>";
	                }
	            ?>
	            </select>
	          </span>
	        </div>
	      </div>
	    </fieldset>

	<!-- Votre niveau -->
	    <fieldset>
	        <div class="control is-horizontal">
	        <?PhP
	            foreach($form_fields["niveau"] as $show) {
	        ?>

	        <p class="control">
	          <label class="radio" for="<?php echo $show["id_niveau"]; ?>">
	            <input class="radio" type="radio" name="id_niveau_niveau" value="<?php echo $show["id_niveau"]; ?>" id="<?php echo $show["id_niveau"]; ?>"/>

	            <?php echo $show["description_niveau"] ?>

	          </label>
	        </p>

	        <?php } ?>
	        </div>
	    </fieldset>
	<!-- Lettre d'information -->
	    <fieldset>
	          <label class="checkbox" for="newsletter">
	            <input class="checkbox" type="checkbox" name="abonnement_newsletter" id="newsletter" value="1">
	            <!--Ne pas oublier de mettre une value sinon retourne rien-->
	             Je souhaite m'inscrire à la lettre d'infromation
	          </label>

	    </fieldset>
	<!-- Un peu plus sur vous... -->
	    <fieldset>
	        <div class="control is-horizontal">
	          <div class="control-label">
	            <label class="label" for="bio">Biographie</label>
	          </div>
	          <div class="control">
	            <textarea class="textarea" name="biographie" id="bio" cols="60" rows="8" maxlength="50" required aria-required="true" ></textarea>
	          </div><!--maxlength = nbr max de caracteres-->
	        </div>
	        <div class="control is-horizontal">
	          <div class="control-label">
	            <label class="label" for="philosophie">Philosophie</label>
	          </div>
	          <div class="control">
	            <textarea class="textarea" name="philosophie" id="philosophie" cols="40" rows="4" placeholder="Meuh" ></textarea>
	          </div>
	        </div>
	    </fieldset>
	<!-- Par rapport à la formation -->
	    <fieldset>
	        <div class="control is-horizontal">
	          <div class="control-label">
	            <label class="label" for="motivation">Ma motivation(gauche = aucune ; droite = pleine) :</label>
	          </div>
	          <p class="control">
	            <input type="range" min="0" max="100" step="10" value="0" name="motivation" id="motivation">
	          </p>
	        </div>
	        <div class="control is-horizontal">
	          <div class="control-label">
	            <label class="label" for="date_dispo">Date de disponibilité: </label>
	          </div>
	          <p class="control">
	            <input class="input" type="date" name="date_dispo" id="date_dispo">
	          </p>
	        </div>
	    </fieldset>
	<!-- Divers -->
	    <fieldset>
	        <div class="control is-horizontal">
	          <div class="control-label">
	            <label class="label" for="pref_heure_repas">Votre heure préférée pour le repas : </label>
	          </div>
	          <p class="control">
	            <input class="input" type="time" max="14:00" min="11:00" value="12:30" step="900" name="pref_heure_repas" id="pref_heure_repas">
	          </p><!-- le step est en secondes doncs 15mm = 900s -->
	        </div>
	    </fieldset>
	<!-- Validation -->
	    <fieldset>
	          <label class="checkbox" for="pref_accept_conditions">
	            <input class="checkbox" type="checkbox" name="pref_accept_conditions" id="pref_accept_conditions" value="true">
	            J'ai lu et j'accepte les conditions d'admission.
	          </label>

	        <p class="control">
	          <input class="button is-primary" type="submit" value="Envoyer">
	        </p>
	    </fieldset>
	  </form>
</div>
<div class="mdl-layout-spacer"></div>

<?php
  $main_content = ob_get_contents();
  ob_end_clean();

	//Script d'envoi de formulaire en ajax
	ob_start();
?>
	<script type="text/javascript">
		$(document).ready(function() {

			//Evenement sur le formulaire

			$("#new-user-form").on('submit', function() {

				//GO AJAX!
				$.post("modele/add_user.php", $('#new-user-form').serialize(), function(data) {
					console.log(data);
					$('#new-user-form').before(
						'<p>Votre inscription a été prise en compte.</p>' +
						'<a href="/">Se connecter</a>'
					);
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

  require "template.php";
