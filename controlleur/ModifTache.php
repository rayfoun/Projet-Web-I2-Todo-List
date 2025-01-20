<?php
require_once __DIR__.'/DefaultController.php';

class ControllerModifTache extends DefaultController{
    
    function afficheForm(){
       
        // Préparer les composants à inclure
        $navbar = $this->renderComponent(__DIR__."/../Vue/composant/navbar.php");
        $filtreTache = $this->renderComponent(__DIR__."/../Vue/composant/filtreTache.php");
        $listeTache = $this->renderComponent(__DIR__."/../Vue/composant/listeTache.php");
        $formTache = $this->renderComponent(__DIR__."/../Vue/composant/formTache.php");

        //gerer le theme
        $themeCSS = $this->renderComponent(__DIR__."/../Vue/css/themeProjet.css");

        $this->renderView(
            __DIR__."/../Vue/template/modifTache.php",
            [
               'navbar' => $navbar,
                'filtreTache' => $filtreTache,
                'listeTache' => $listeTache,
                'themeCSS' => $themeCSS,
                'formTache' => $formTache,
            ]
        );
    }
}
?>