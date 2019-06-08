<?php

abstract class AbstractController {
    
    //Affiche la page demandée
    public function render($page) {
        include SITE_ROOT . 'views' . DIRECTORY_SEPARATOR . $page['view'] . '.view.php';
    }
}
