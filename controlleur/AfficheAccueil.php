<?php
require_once __DIR__.'/DefaultController.php';

class ControllerAccueil extends DefaultControlller{
    
    function afficheAccueil(){
        // Récupérer le nom
        $userName = "nom"; // Exemple d'utilisateur

        // Préparer les composants à inclure
        $listeUser = $this->renderComponent(__DIR__."/../Vue/composant/filtreTache.php");
        $listeTache = $this->renderComponent(__DIR__."/../Vue/composant/listeTache.php");

        //gerer le theme
        $themeCSS = $this->renderComponent(__DIR__."/../Vue/css/themeProjet.css");

        $this->renderView(
            __DIR__."/../Vue/template/accueil.php",
            [
                'listeUser' => $listeUser,
                'listeTache' => $listeTache,
                'themeCSS' => $themeCSS,
            ]
        );
    }
}
?>