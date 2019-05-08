<?php
	ob_start();
?>
	<div class="mdl-layout-spacer"></div>
	<div class="mdl-cell mdl-cell--4-col demo-card-wide mdl-card mdl-shadow--2dp">
		<div class="mdl-card__title">
			<h4 class="mdl-card__title-text">Vérification des identifiants</h4>
		</div>
			<form method="get" action="">
				<div class="mdl-card__supporting-text">
					<?php if (isset($log_message)) {
						echo "<p>" . $log_message . "</p>";
					} ?>
					<div class="mdl-textfield mdl-js-textfield">
						<label class="mdl-textfield__label" for="email">E-mail : </label>
						<input class="mdl-textfield__input" type="email" name="email" id="email" />
					</div>
					<div class="mdl-textfield mdl-js-textfield">
						<label class="mdl-textfield__label" for="password">Mot de passe : </label>
						<input class="mdl-textfield__input" type="password" name="password" id="password" />
					</div>
					<div>
						<input class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" type="submit" value="Connexion"/>
					</div>
				</div>
				<div class="mdl-card__actions mdl-card--border">
						<span>Vous n'êtes pas membre?</span>
						<a href="sign-up">Inscrivez-vous</a>
				</div>
			</form>
	</div>
	<div class="mdl-layout-spacer"></div>

<?php
	$main_content = ob_get_contents();
	ob_end_clean();

	require "template.view.php";
