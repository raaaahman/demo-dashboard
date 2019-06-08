<!DOCTYPE html>
<html lang="fr">
	<head>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="description" content="A front-end template that helps you build fast, modern mobile web apps.">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
	    <title><?= $page['title'] ?></title>

	    <!-- Add to homescreen for Chrome on Android -->
			<!--
	    <meta name="mobile-web-app-capable" content="yes">
	    <link rel="icon" sizes="192x192" href="images/android-desktop.png">
		-->

	    <!-- Add to homescreen for Safari on iOS -->
			<!--
	    <meta name="apple-mobile-web-app-capable" content="yes">
	    <meta name="apple-mobile-web-app-status-bar-style" content="black">
	    <meta name="apple-mobile-web-app-title" content="Material Design Lite">
	    <link rel="apple-touch-icon-precomposed" href="images/ios-desktop.png">
		-->

	    <!-- Tile icon for Win8 (144x144 + tile color) -->
			<!--
	    <meta name="msapplication-TileImage" content="images/touch/ms-touch-icon-144x144-precomposed.png">
	    <meta name="msapplication-TileColor" content="#3372DF">
		-->

	    <link rel="shortcut icon" href="<?php echo SITE_URL; ?>/images/favicon.png">

	    <!-- SEO: If your mobile URL is different from the desktop URL, add a canonical link to the desktop page https://developers.google.com/webmasters/smartphone-sites/feature-phones -->
	    <!--
	    <link rel="canonical" href="http://www.example.com/">
	    -->

	    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
	    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	    <link rel="stylesheet" href="https://code.getmdl.io/1.2.1/material.cyan-light_blue.min.css">
	    <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css"/>
			<link href='<?php echo SITE_URL; ?>/css/bulma.css' type='text/css' rel='stylesheet' />
	    <link rel="stylesheet" href="<?php echo SITE_URL; ?>/css/styles.css">
	    <style>
	    #view-source {
	      position: fixed;
	      display: block;
	      right: 0;
	      bottom: 0;
	      margin-right: 40px;
	      margin-bottom: 40px;
	      z-index: 900;
	    }
	    </style>

	    <?php if (isset($head_comp)) {
	    	echo $head_comp;
	    } ?>
	</head>

	<body>

		<div class="demo-layout mdl-layout mdl-js-layout <?php if(array_key_exists('has_drawer_menu', $page) && $page['has_drawer_menu'] == true) { echo 'mdl-layout--fixed-drawer'; } ?> mdl-layout--fixed-header">
<!--=========================================================================================
 _
| |                  | |
| |__   ___  __ _  __| | ___ _ __
| '_ \ / _ \/ _` |/ _` |/ _ \ '__|
| | | |  __/ (_| | (_| |  __/ |
|_| |_|\___|\__,_|\__,_|\___|_|

==========================================================================================-->
			<header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
			  <div class="mdl-layout__header-row">
			    <span class="mdl-layout-title"><?= $page['title']; ?></span>
			    <!--<div class="mdl-layout-spacer"></div>
			    <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
			      <label class="mdl-button mdl-js-button mdl-button--icon" for="search">
			        <i class="material-icons">search</i>
			      </label>
			      <div class="mdl-textfield__expandable-holder">
			        <input class="mdl-textfield__input" type="text" id="search">
			        <label class="mdl-textfield__label" for="search">Enter your query...</label>
			      </div>
			    </div>
			    <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon" id="hdrbtn">
			      <i class="material-icons">more_vert</i>
			    </button>
			    <ul class="mdl-menu mdl-js-menu mdl-js-ripple-effect mdl-menu--bottom-right" for="hdrbtn">
			      <li class="mdl-menu__item">About</li>
			      <li class="mdl-menu__item">Contact</li>
			      <li class="mdl-menu__item">Legal information</li>
			    </ul>-->
			  </div>
			</header>
<!--=========================================================================================
     _
    | |
  __| |_ __ __ ___      _____ _ __   _ __ ___   ___ _ __  _   _
 / _` | '__/ _` \ \ /\ / / _ \ '__| | '_ ` _ \ / _ \ '_ \| | | |
| (_| | | | (_| |\ V  V /  __/ |    | | | | | |  __/ | | | |_| |
 \__,_|_|  \__,_| \_/\_/ \___|_|    |_| |_| |_|\___|_| |_|\__,_|

==========================================================================================-->
			<?php if(array_key_exists('has_drawer_menu', $page) && $page['has_drawer_menu'] == true) : ?>
				<aside class="demo-drawer mdl-layout__drawer mdl-color--blue-grey-900 mdl-color-text--blue-grey-50">
				  <nav class="demo-navigation mdl-navigation mdl-color--blue-grey-800">
				    <a class="mdl-navigation__link" href="users-list"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">account_box</i>Afficher les utilisateurs</a>
						<!--
				    <a class="mdl-navigation__link" href="?action=create"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">note_add</i>Ajouter un utilisateur</a>
					-->
				    <a class="mdl-navigation__link" href="users-stats"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">assessment</i>Statistisques</a>
				    <div class="mdl-layout-spacer"></div>
				    <a class="mdl-navigation__link" href="logout"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">highlight_off</i>Log out</a>
				  </nav>
				</aside>
			<?php endif; ?>
<!--=========================================================================================
___  ___  ___  _____ _   _
|  \/  | / _ \|_   _| \ | |
| .  . |/ /_\ \ | | |  \| |
| |\/| ||  _  | | | | . ` |
| |  | || | | |_| |_| |\  |
\_|  |_/\_| |_/\___/\_| \_/

==========================================================================================-->
			<main class="mdl-layout__content mdl-color--grey-100">
				<div class="mdl-grid">
					<?php echo $main_content; ?>
				</div>
			</main>
		</div>

		<script src="https://code.getmdl.io/1.2.1/material.min.js"></script>
		<!--jQuery-->
		<script   src="js/jquery-3.1.1.min.js"></script>
		<script   src="http://code.jquery.com/ui/1.12.0/jquery-ui.min.js"   integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E="   crossorigin="anonymous"></script>

		<?php if (array_key_exists( 'scripts',  $page)) {
		    foreach($page['scripts'] as $script) {?>
                <script src="js/<?php echo $script; ?>.js" type="text/javascript"></script>
		<?php
		    }
        }?>
	</body>
</html>
