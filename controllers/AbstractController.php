<?php

abstract class AbstractController {
    
    //Affiche la page demandée
    public function render($view) {
        return SITE_ROOT . 'views' . DIRECTORY_SEPARATOR . $view . '.view.php';
    }
}
