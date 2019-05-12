<?php
//On cherche s'il s'agit d'un nouvel utilisateur ou d'une mise à jour d'un utilisateur existant

//On affecte les variables de la page
$form_fields = [
  'ville' => $db->getList('ville'),
'langage' => $db->getList('langage'),
'niveau' => $db->getList('niveau')
];
$user_details = null;
$page_title = "Ajouter un utilisateur";
$has_drawer_menu = false;

if (isset($user_id)) {
        $user_details = $db->getEntry('utilisateur', 'identifiant_utilisateur', $user_id);
        $page_title = "Modifier les informations de " . $user_details["prenom"] . " " . $user_details["nom"];
        $has_drawer_menu = true;
}


//On appelle la vue
require SITE_ROOT . '/views/user_form.view.php';