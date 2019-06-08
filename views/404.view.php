<?php
    $page['title'] = "Erreur 404";
    $page['has_drawer_menu'] = false;
    ob_start();
    ?>

<p>Désolé, nous n'avons pas pu trouver la page demandée.</p>
<a href="<?php echo SITE_URL; ?>">Retour à l'accueil</a>

<?php
    $main_content = ob_get_clean();
    require SITE_ROOT . 'views/template.view.php';