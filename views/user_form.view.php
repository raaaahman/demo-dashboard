<?php
  ob_start();
	if (!array_key_exists('has_drawer_menu', $page) || ! $page['has_drawer_menu']) :
?>
	<div class="mdl-layout-spacer"></div>
<?php endif; ?>
<div class="mdl-cell <?php if(array_key_exists('has_drawer_menu', $page) && $page['has_drawer_menu']) { echo "mdl-cell--12-col"; } else { echo "mdl-cell--8-col"; } ?>">
	<form id="new-user-form" enctype="multipart/form-data" action="<?php echo $page['action']; ?>" method="post">
	      <div class="control is-horizontal">
	        <div class="control-label">
	            <label class="label" for="civilite">Civilité :</label>
	        </div>
	        <div class="control">
	          <span class="select is-fullwidth">
	            <select name="civilite" id="civilite">
	              <option value="1" <?php if ( getField('civilite', $page["data"]["user"]) == 'M.') { echo "selected"; } ?>>M.</option>
	              <option value="2" <?php if ( getField('civilite', $page["data"]["user"]) == 'Mlle') { echo "selected"; } ?>>Mlle</option>
	              <option value="3" <?php if ( getField('civilite', $page["data"]["user"]) == 'Mme') { echo "selected"; } ?>>Mme</option>
	              <option value="" <?php if (empty( getField('civilite', $page["data"]["user"]))) { echo "selected"; } ?> ></option>
	            </select>
	          </span>
	        </div>
	      </div>
	      <div class="control is-horizontal">
	        <div class="control-label">
	          <label class="label" for="nom">Nom *:</label>
	        </div>
	        <p class="control">
	          <input class="input" type="text" name="nom" id="nom" required aria-required="true" value="<?php echo  getField('nom', $page["data"]["user"]); ?>">
	        </p>
	      </div>
	      <div class="control is-horizontal">
	        <div class="control-label">
	          <label class="label" for="prenom">Prénom *:</label>
	        </div>
	        <p class="control">
	          <input class="input" type="text" name="prenom" id="prenom" required aria-required="true" value="<?php echo  getField('prenom', $page["data"]["user"]); ?>">
	        </p>
	      </div>
	      <div class="control is-horizontal">
	        <div class="control-label">
	          <label class="label" for="date_naissance">Date de naissance :</label>
	        </div>
	        <p class="control">
	          <input class="input" type="date" name="date_naissance" id="date_naissance" value="<?php echo  getField('date_naissance', $page["data"]["user"]); ?>">
	        </p>
	      </div>

	<!-- Vos coordonnées -->
	      <div class="control is-horizontal">
	        <div class="control-label">
	          <label class="label" for="email">e-mail *:</label>
	        </div>
	        <p class="control">
	          <input class="input" type="email" name="email" id="email" required aria-required="true" value="<?php echo  getField('email', $page["data"]["user"]); ?>">
	        </p>
	      </div>
	      <div class="control is-horizontal">
	        <div class="control-label">
	          <label class="label" for="tel">Téléphone *:</label>
	        </div>
	        <p class="control">
	          <input class="input" type="tel" name="tel" id="tel" required aria-required="true" value="<?php echo  getField('tel', $page["data"]["user"]); ?>">
	        </p>
	      </div>
	      <div class="control is-horizontal">
	        <div class="control-label">
	          <label class="label" for="mobile">Mobile :</label>
	        </div>
	        <p class="control">
	          <input class="input" type="tel" name="mobile" id="mobile" value="<?php echo  getField('mobile', $page["data"]["user"]); ?>">
	        </p>
	      </div>

	      <div class="control is-horizontal">
	        <div class="control-label">
	          <label class="label" for="adresse">Adresse :</label>
	        </div>
	        <p class="control">
	          <input class="input" type="text" name="adresse" id="adresse" value="<?php echo  getField('adresse', $page["data"]["user"]); ?>">
	        </p>
	      </div>

	      <div class="control is-horizontal">
	        <div class="control-label">
	          <label class="label" for="adresse_complement">Complément d'adresse :</label>
	        </div>
	        <p class="control">
	          <input class="input" type="text" name="adresse_complement" id="adresse_complement" value="<?php echo  getField('adresse_complement', $page["data"]["user"]); ?>"/>
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
	                foreach($page["data"]["ville"] as $show) {
										$option = "<option value=\"" . $show["code_commune_insee"] . "\"";
										if (getField("code_commune_insee_ville", $page["data"]["user"]) == $show["code_commune_insee"]) {
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
	                foreach($page["data"]["language"] as $show) {
										$option = "<option value=\"" . $show["id_langage"] . "\"";
										if (getField("id_langage_langage", $page["data"]["user"]) == $show["id_langage"]) {
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
	            foreach($page["data"]["niveau"] as $show) {
	        ?>

	        <p class="control">
	          <label class="radio" for="<?php echo $show["id_niveau"]; ?>">
	            <input class="radio" type="radio" name="id_niveau_niveau" value="<?php echo $show["id_niveau"]; ?>" id="<?php echo $show["id_niveau"]; ?>" <?php if( getField('id_niveau_niveau', $page["data"]["user"]) == $show["id_niveau"]) { echo "checked"; } ?>/>

	            <?php echo $show["description_niveau"] ?>

	          </label>
	        </p>

	        <?php } ?>
	        </div>
	<!-- Lettre d'information -->
					<div class="control is-horizontal">
	          <label class="checkbox" for="newsletter">
	            <input class="checkbox" type="checkbox" name="abonnement_newsletter" value="1" id="newsletter" <?php if( getField('pref_accept_conditions', $page["data"]["user"])) { echo "checked"; } ?>>
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
	            <textarea class="textarea" name="biographie" id="bio" cols="60" rows="8" maxlength="50" required aria-required="true" ><?php echo  getField('biographie', $page["data"]["user"]); ?></textarea>
	          </div><!--maxlength = nbr max de caracteres-->
	        </div>
	        <div class="control is-horizontal">
	          <div class="control-label">
	            <label class="label" for="philosophie">Philosophie</label>
	          </div>
	          <div class="control">
	            <textarea class="textarea" name="philosophie" id="philosophie" cols="40" rows="4" placeholder="Meuh" ><?php echo  getField('philosophie', $page["data"]["user"]); ?></textarea>
	          </div>
	        </div>
	<!-- Par rapport à la formation -->
	        <div class="control is-horizontal">
	          <div class="control-label">
	            <label class="label" for="motivation">Ma motivation (gauche = aucune ; droite = pleine) :</label>
	          </div>
	          <p class="control">
	            <input type="range" min="0" max="100" step="10" value="<?php echo  getField('motivation', $page["data"]["user"]); ?>" name="motivation" id="motivation">
	          </p>
	        </div>
	        <div class="control is-horizontal">
	          <div class="control-label">
	            <label class="label" for="date_dispo">Date de disponibilité: </label>
	          </div>
	          <p class="control">
	            <input class="input" type="date" name="date_dispo" id="date_dispo" value="<?php echo  getField('date_dispo', $page["data"]["user"]); ?>">
	          </p>
	        </div>
	<!-- Divers -->
	        <div class="control is-horizontal">
	          <div class="control-label">
	            <label class="label" for="pref_heure_repas">Votre heure préférée pour le repas : </label>
	          </div>
	          <p class="control">
	            <input class="input" type="time" max="14:00" min="11:00" step="900" name="pref_heure_repas" id="pref_heure_repas" value="<?php if (!isset($page["data"]["user"])) {
								echo '12:30';
							} else {
								echo  getField('pref_heure_repas', $page["data"]["user"]);
							} ?>">
	          </p><!-- le step est en secondes doncs 15mm = 900s -->
	        </div>
	<!-- Validation -->
	          <label class="checkbox" for="pref_accept_conditions">
	            <input class="checkbox" type="checkbox" name="pref_accept_conditions" id="pref_accept_conditions" value="1" <?php if( getField('pref_accept_conditions', $page["data"]["user"]) == true) { echo "checked"; } ?>>
	            J'ai lu et j'accepte les conditions d'admission.
	          </label>

	        <p class="control">
	          <input class="button is-primary" type="submit" value="Envoyer">
	        </p>
            <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?>"/>
            <?php if (isset($page['data']['user']['identifiant_utilisateur'])) :?>
                <input type="hidden" name="identifiant_utilisateur" value="<?php echo $page['data']['user']['identifiant_utilisateur']; ?>"/>
            <?php endif; ?>
	  </form>
</div>
<?php if(!array_key_exists('has_drawer_menu', $page) || ! $page['has_drawer_menu']) : ?>
	<div class="mdl-layout-spacer"></div>
<?php endif; ?>

<?php
  $main_content = ob_get_contents();
  ob_end_clean();

  require "template.view.php";
