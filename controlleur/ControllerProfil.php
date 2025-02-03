<?php
require_once '../Config/bdd.php'; // Inclut la connexion à la base de données
require_once __DIR__ .'/../Modele/DAO/UtilisateurDao.php';
require_once __DIR__.'/DefaultController.php';
//require_once __DIR__.'/UtilisateurDAO.php';

class ControllerProfil extends DefaultController{
    private $utilisateurDAO;

    public function __construct() {
        $this->utilisateurDAO = new UtilisateurDAO();
    }
    public function afficheProfil($idUser){
        //navbar
        $navbar=$this->renderComponent(__DIR__."/../Vue/composant/navbar.php");
    
        //info compte
        $userDAO=new UtilisateurDao();
        $user=$userDAO->getUserById($idUser);
        $nom=(string)$user->getNom();
        $prenom=(string)$user->getPrenom();
        $email=(string)$user->getEmail();
        $type=(string)$user->getType();
         // Rendu de la vue
         $this->renderView(
            __DIR__ . '/../Vue/page/Profil.php', // Correction du chemin
            [
                'navbar'=>$navbar,
                'nom'=>$nom,
                'prenom'=>$prenom,
                'email'=>$email,
                'type'=>$type
                ]
            );
    }

    function supprimerCompteUtilisateur($id){
        //$this->utilisateurDAO->supprimerUtilisateur($id);
    }

    function creerCompteUtilisateur(){
        
    }

    function supprimerCompte(){
        
    }

    function modifierCompte(){
        
    }


}
?>