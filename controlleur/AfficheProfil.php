<?php
require_once '/Config/bdd.php'; // Inclut la connexion à la base de données
require_once '/Modele/DAO/UtilisateurDAO.php';
require_once __DIR__.'/DefaultController.php';
require_once __DIR__.'/UtilisateurDAO.php';

class ControllerProfil extends DefaultController{
    private $utilisateurDAO;

    public function __construct($pdo) {
        $this->utilisateurDAO = new UtilisateurDAO($pdo);
    }
    
    function afficheAccueil(){
        // Préparer les composants à inclure
        $navbar = $this->renderComponent(__DIR__."/../Vue/composant/navbar.php");
        $filtreTache = $this->renderComponent(__DIR__."/../Vue/composant/filtreTache.php");
        $listeTache = $this->renderComponent(__DIR__."/../Vue/composant/listeTache.php");

        //gerer le theme
        $themeCSS = $this->renderComponent(__DIR__."/../Vue/css/themeProjet.css");

        $this->renderView(
            __DIR__."/../Vue/template/accueil.php",
            [
               'navbar' => $navbar,
                'filtreTache' => $filtreTache,
                'listeTache' => $listeTache,
                'themeCSS' => $themeCSS,
            ]
        );
    }

    function afficheProfil(){

        // Préparation des composants à inclure
        $navbar = $this->renderComponent(__DIR__."/../Vue/composant/navbar.php");
        $infoUtilisateur = $this->renderComponent(__DIR__."/../Vue/composant/infoUtilisateur.php");

        //gerer le theme
        $themeCSS = $this->renderComponent(__DIR__."/../Vue/css/themeProjet.css");

        $this->renderView(
            __DIR__."/../Vue/template/profil.php",
            [
               'navbar' => $navbar,
                'infoUtilisateur' => $infoUtilisateur,
            ]
        );
    }

    function supprimerCompteUtilisateur($id){
        $this->utilisateurDAO->supprimerUtilisateur($id);
    }

    function creerCompteUtilisateur(){
        
    }

    function supprimerCompte(){
        
    }

    function modifierCompte(){
        
    }


}
?>