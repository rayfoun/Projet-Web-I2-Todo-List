<?php
require_once __DIR__ .'/DefaultController.php';
//require_once __DIR__ .'/../Modele/DAO/UtilisateurDao.php';
require_once __DIR__ .'/../Modele/DAO/TacheDao.php';
require_once __DIR__ .'/../Modele/entite/tache.php';
//require_once __DIR__ .'/../Modele/entite/Utilisateur.php';
require_once __DIR__ .'/../controlleur/ControllerUser.php';

class ControllerTask{

       //controlleurs
       private $controlUser;

    public function getListTask($mode,$idUser){//retourne la liste des tache en fonction de si on est à l'acceuil ou si on fait une recherche
        //recuper une liste de tache
        $listeTaches=null;
        $tacheDAO = new TacheDao(); 

        if($mode=="accueil"){
            $listeTaches = $tacheDAO->getTasksByUserId($idUser);
        }
        if($mode=="search"){
              // Initialisation des variables avec des valeurs par défaut ou null
              $titre = $statut = $priorite = $assigne = $categorie = null;
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Vérifier et affecter uniquement si la propriété est disponible

                if (isset($_POST['titre'])) {
                    $titre = $_POST['titre'];
                }
      
                if (isset($_POST['statut'])) {
                    $statut = $_POST['statut'];
                }
      
                if (isset($_POST['priorite'])) {
                    $priorite = $_POST['priorite'];
                }
      
                if (isset($_POST['assigne'])) {
                      $assigne = $_POST['assigne'];
                     //recuper l'utilisateur
                    if(!$this->controlUser){
                        $this->controlUser=new ControllerUser();
                    }
                    $assigne=$this->controlUser->getUserByAssigne($assigne);
                    $assigne=$assigne->getId();

                }
      
                if (isset($_POST['categorie'])) {
                    $categorie = $_POST['categorie'];
                }
          }
         // var_dump($titre);
          //var_dump($statut);
          //var_dump($priorite);
          //var_dump($assigne);
          //var_dump($categorie);
            $listeTaches = $tacheDAO->getTasksByFilters($titre, $statut, $priorite, $assigne,$categorie);
        }
        //var_dump($listeTaches);
        return $listeTaches;
    }

    function check($tache) {
        if($tache==null)return null;
        return ($tache->getStatut() == "Terminee") ? "disabled" : "";
    }

    

}

?>