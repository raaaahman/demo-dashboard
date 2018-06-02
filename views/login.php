<?php
	$page_title = "Authentification";

	ob_start();
?>
	<div class="mdl-card">
		<div class="mdl-card__title">
			<h4 class="mdl-card__title-text">Vérification des identifiants</h3>
		</div>
		
<?php if (isset($log_message)) {
	echo "<div class='mdl-card__supporting-text'><p>" . $log_message . "</p></div>";
} ?>
		<div class="mdl-card__actions">
			<form method="post" action="index.php">
				<label for="email">E-mail : </label>
				<input type="email" name="email" id="email" />
				<label for="password">Mot de passe : </label>
				<input type="password" name="password" id="password" />
				<input type="submit" vlaue="Envoyer"/>
			</form>
		</div>
	</div>

<?php
	$main_content = ob_get_contents();
	ob_end_clean();

	require "template.php";