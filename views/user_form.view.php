<?php
  ob_start();
	if (!$has_drawer_menu) :
?>
	<div class="mdl-layout-spacer"></div>
<?php endif; ?>
<div class="mdl-cell <?php if($has_drawer_menu) { echo "mdl-cell--12-col"; } else { echo "mdl-cell--8-col"; } ?>">
	<form id="new-user-form" enctype="multipart/form-data" action="database/add_user.php" method="post">
	      <div class="control is-horizontal">
	        <div class="control-label">
	            <label class="label" for="civilite">Civilité :</label>
	        </div>
	        <div class="control">
	          <span class="select is-fullwidth">
	            <select name="civilite" id="civilite">
	              <option value="1" <?php if ( getField('civilite', $user_details) == 1) { echo "selected"; } ?>>M.</option>
	              <option value="2" <?php if ( getField('civilite', $user_details) == 2) { echo "selected"; } ?>>Mlle</option>
	              <option value="3" <?php if ( getField('civilite', $user_details) == 3) { echo "selected"; } ?>>Mme</option>
	              <option value="" <?php if (empty( getField('civilite', $user_details))) { echo "selected"; } ?> ></option>
	            </select>
	          </span>
	        </div>
	      </div>
	      <div class="control is-horizontal">
	        <div class="control-label">
	          <label class="label" for="nom">Nom *:</label>
	        </div>
	        <p class="control">
	          <input class="input" type="text" name="nom" id="nom" required aria-required="true" value="<?php echo  getField('nom', $user_details); ?>">
	        </p>
	      </div>
	      <div class="control is-horizontal">
	        <div class="control-label">
	          <label class="label" for="prenom">Prénom *:</label>
	        </div>
	        <p class="control">
	          <input class="input" type="text" name="prenom" id="prenom" required aria-required="true" value="<?php echo  getField('prenom', $user_details); ?>">
	        </p>
	      </div>
	      <div class="control is-horizontal">
	        <div class="control-label">
	          <label class="label" for="date_naissance">Date de naissance :</label>
	        </div>
	        <p class="control">
	          <input class="input" type="date" name="date_naissance" id="date_naissance" value="<?php echo  getField('date_naissance', $user_details); ?>">
	        </p>
	      </div>

	<!-- Vos coordonnées -->
	      <div class="control is-horizontal">
	        <div class="control-label">
	          <label class="label" for="email">e-mail *:</label>
	        </div>
	        <p class="control">
	          <input class="input" type="email" name="email" id="email" required aria-required="true" value="<?php echo  getField('email', $user_details); ?>">
	        </p>
	      </div>
	      <div class="control is-horizontal">
	        <div class="control-label">
	          <label class="label" for="tel">Téléphone *:</label>
	        </div>
	        <p class="control">
	          <input class="input" type="tel" name="tel" id="tel" required aria-required="true" value="<?php echo  getField('tel', $user_details); ?>">
	        </p>
	      </div>
	      <div class="control is-horizontal">
	        <div class="control-label">
	          <label class="label" for="mobile">Mobile :</label>
	        </div>
	        <p class="control">
	          <input class="input" type="tel" name="mobile" id="mobile" value="<?php echo  getField('mobile', $user_details); ?>">
	        </p>
	      </div>

	      <div class="control is-horizontal">
	        <div class="control-label">
	          <label class="label" for="adresse">Adresse :</label>
	        </div>
	        <p class="control">
	          <input class="input" type="text" name="adresse" id="adresse" value="<?php echo  getField('adresse', $user_details); ?>">
	        </p>
	      </div>

	      <div class="control is-horizontal">
	        <div class="control-label">
	          <label class="label" for="adresse_complement">Complément d'adresse :</label>
	        </div>
	        <p class="control">
	          <input class="input" type="text" name="adresse_complement" id="adresse_complement" value="<?php echo  getField('adresse_complement', $user_details); ?>"/>
	        </p>
	      </div>

	      <div class="control is-horizontal">

	        <div class="control-label">
	          <label class="label" for="ville">Code postal / Ville *:</label>
	        </div>
	        <div class="control">
	          <span class="select is-fullwidth">
	            <select name="code_commune_insee_ville" id="ville">
	            <?PhP
	                foreach($form_fields["ville"] as $show) {
										$option = "<option value=\"" . $show["code_commune_insee"] . "\"";
										if (getField("code_commune_insee_ville", $user_details) == $show["code_commune_insee"]) {
											$option .= " selected";
										}
	                  $option .= ">" . $show["code_postal"] . " " . $show["nom_ville"] . "</option>";
										echo $option;
	                }
	            ?>
	            </select>
	          </span>
	        </div>
	      </div>

	<!-- Vos identifiants -->
	        <div class="control is-horizontal">
	          <div class="control-label">
	            <label class="label" for="mot_de_passe">Mot de passe *:</label>
	          </div>
	          <p class="control">
	            <input class="input" type="password" name="mot_de_passe" id="mot_de_passe" required aria-required="true"  autocomplete="off"/>
	          </p><!--autocomplete off pour stopper l'autocompletion-->
	        </div>

	<!-- Vos préférences -->
	      <div class="control is-horizontal">
	        <div class="control-label">
	          <label class="label" for="langage">Quel langage préférez-vous? </label>
	        </div>
	        <div class="control">
	          <span class="select is-fullwidth">
	            <select name="id_langage_langage" id="langage">
	            <?PhP
	                foreach($form_fields["langage"] as $show) {
										$option = "<option value=\"" . $show["id_langage"] . "\"";
										if (getField("id_langage_langage", $user_details) == $show["id_langage"]) {
											$option .= " selected";
										}
										$option .= ">" . $show["nom_langage"] . "</option>";
										echo $option;
	                }
	            ?>
	            </select>
	          </span>
	        </div>
	      </div>

	<!-- Votre niveau -->
	        <div class="control is-horizontal">
	        <?PhP
	            foreach($form_fields["niveau"] as $show) {
	        ?>

	        <p class="control">
	          <label class="radio" for="<?php echo $show["id_niveau"]; ?>">
	            <input class="radio" type="radio" name="id_niveau_niveau" value="<?php echo $show["id_niveau"]; ?>" id="<?php echo $show["id_niveau"]; ?>" <?php if( getField('id_niveau_niveau', $user_details) == $show["id_niveau"]) { echo "checked"; } ?>/>

	            <?php echo $show["description_niveau"] ?>

	          </label>
	        </p>

	        <?php } ?>
	        </div>
	<!-- Lettre d'information -->
					<div class="control is-horizontal">
	          <label class="checkbox" for="newsletter">
	            <input class="checkbox" type="checkbox" name="abonnement_newsletter" value="1" id="newsletter" <?php if( getField('pref_accept_conditions', $user_details)) { echo "checked"; } ?>>
	            <!--Ne pas oublier de mettre une value sinon retourne rien-->
	             Je souhaite m'inscrire à la lettre d'infromation
	          </label>
					</div>

	<!-- Un peu plus sur vous... -->
	        <div class="control is-horizontal">
	          <div class="control-label">
	            <label class="label" for="bio">Biographie</label>
	          </div>
	          <div class="control">
	            <textarea class="textarea" name="biographie" id="bio" cols="60" rows="8" maxlength="50" required aria-required="true" ><?php echo  getField('biographie', $user_details); ?></textarea>
	          </div><!--maxlength = nbr max de caracteres-->
	        </div>
	        <div class="control is-horizontal">
	          <div class="control-label">
	            <label class="label" for="philosophie">Philosophie</label>
	          </div>
	          <div class="control">
	            <textarea class="textarea" name="philosophie" id="philosophie" cols="40" rows="4" placeholder="Meuh" ><?php echo  getField('philosophie', $user_details); ?></textarea>
	          </div>
	        </div>
	<!-- Par rapport à la formation -->
	        <div class="control is-horizontal">
	          <div class="control-label">
	            <label class="label" for="motivation">Ma motivation (gauche = aucune ; droite = pleine) :</label>
	          </div>
	          <p class="control">
	            <input type="range" min="0" max="100" step="10" value="<?php echo  getField('motivation', $user_details); ?>" name="motivation" id="motivation">
	          </p>
	        </div>
	        <div class="control is-horizontal">
	          <div class="control-label">
	            <label class="label" for="date_dispo">Date de disponibilité: </label>
	          </div>
	          <p class="control">
	            <input class="input" type="date" name="date_dispo" id="date_dispo" value="<?php echo  getField('date_dispo', $user_details); ?>">
	          </p>
	        </div>
	<!-- Divers -->
	        <div class="control is-horizontal">
	          <div class="control-label">
	            <label class="label" for="pref_heure_repas">Votre heure préférée pour le repas : </label>
	          </div>
	          <p class="control">
	            <input class="input" type="time" max="14:00" min="11:00" step="900" name="pref_heure_repas" id="pref_heure_repas" value="<?php if (!isset($user_details)) {
								echo '12:30';
							} else {
								echo  getField('pref_heure_repas', $user_details);
							} ?>">
	          </p><!-- le step est en secondes doncs 15mm = 900s -->
	        </div>
	<!-- Validation -->
	          <label class="checkbox" for="pref_accept_conditions">
	            <input class="checkbox" type="checkbox" name="pref_accept_conditions" id="pref_accept_conditions" value="1" <?php if( getField('pref_accept_conditions', $user_details) == true) { echo "checked"; } ?>>
	            J'ai lu et j'accepte les conditions d'admission.
	          </label>

	        <p class="control">
	          <input class="button is-primary" type="submit" value="Envoyer">
	        </p>
					<?php if (isset($user_id)) :?>
						<input type="hidden" name="identifiant_utilisateur" value="<?php echo $user_id; ?>"/>
					<?php endif; ?>
	  </form>
</div>
<?php if(!$has_drawer_menu) : ?>
	<div class="mdl-layout-spacer"></div>
<?php endif; ?>

<?php
  $main_content = ob_get_contents();
  ob_end_clean();

	//Script d'envoi de formulaire en ajax
	ob_start();
?>
	<script type="text/javascript">
	var action = "database/add_user.php";
	var messageSuccess = '<p>Votre inscription a été prise en compte.</p>' +
	'<a href="?action=login">Se connecter</a>';
	<?php if (isset($user_id)) {
		echo "action = 'database/update_user.php';";
		echo "messageSuccess = '<p>L\'utilisateur a été mis à jour.</p>';";
		echo "messageSuccess += '<a href=\"?action=list\">Retour à la liste des utilisateurs</a>';";
	} ?>
		$(document).ready(function() {

			//Evenement sur le formulaire

			$("#new-user-form").on('submit', function() {

				//GO AJAX!
				$.post(action, $('#new-user-form').serialize(), function(data) {
					$('#new-user-form').before(
						messageSuccess
					);
					console.log(data);
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

  require "template.view.php";
