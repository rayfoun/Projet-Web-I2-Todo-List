<?php
require_once __DIR__ .'/DefaultController.php';
//require_once __DIR__ .'/../Modele/DAO/UtilisateurDao.php';
//require_once __DIR__ .'/../Modele/DAO/TacheDao.php';
require_once __DIR__ .'/../Modele/entite/tache.php';
require_once __DIR__ .'/../Modele/entite/Utilisateur.php';
require_once __DIR__ .'/../controlleur/ControllerUser.php';
require_once __DIR__ .'/../controlleur/ControllerTask.php';

class ControllerAccueil extends DefaultController { 

    //controlleurs
    public $controlUser;
    public $controlTask;


    /*******************************************************************************************************************************************************************/
    // PAGE
    public function afficheAccueil($type) {

        // Gestion du thème (CSS)
        $themeProjet =$this->renderComponent(__DIR__."/../Vue/css/themeProjet.php");

        // Gestion du javascript(js)
        $jsProjet =$this->renderComponent(__DIR__."/../Vue/js/javascript.php");

        //navbar
        $navbar=$this->renderComponent(__DIR__."/../Vue/composant/navbar.php");
    
        //nom utilisateur
        $user=new UtilisateurDao();
        $nomUser=$user->getUserById( $_SESSION["id_user"]);
        $nomUser=(string)$nomUser->getPrenom();
      
        //recuper la liste de tache
        if(!$this->controlTask){
            $this->controlTask=new ControllerTask();
        }
        $listeTache=$this->formatedListTask($this->controlTask->getListTask("accueil", $_SESSION["id_user"]));

        if($type=="Utilisateur"){
            // Rendu de la vue
            $this->renderView(
                __DIR__ . '/../Vue/page/AcceuilUtil.php', // Correction du chemin
                [
                    'listeUser' => $this->getListUser(),//list de user pour les input Assigne
                    'listeTache'=> $listeTache,//liste de taches en mode acccueil
                    'loader'=> "",//loader vide pour l'instant
                    'idTask'=>"",//id de la tache du formulaire vide pour l'instant
                    'themeProjet' => $themeProjet,
                    'nomUser'=>$nomUser,
                    'jsProjet'=> $jsProjet,
                    'navbar'=>$navbar
                ]
            );
        }elseif($type=="Administrateur"){
            // Rendu de la vue
            $this->renderView(
                __DIR__ . '/../Vue/page/AcceuilAdmin.php', // Correction du chemin
                [
                    'listeUser' => $this->getListUser(),//list de user pour les input Assigne
                    'listeTache'=> $listeTache,//liste de taches en mode acccueil
                    'loader'=> "",//loader vide pour l'instant
                    'idTask'=>"",//id de la tache du formulaire vide pour l'instant
                    'themeProjet' => $themeProjet,
                    'nomUser'=>$nomUser,
                    'jsProjet'=> $jsProjet,
                    'navbar'=>$navbar
                ]
            );
        }else{
            echo "<script type='text/javascript'>alert('Type d'utilisateur inconnu');</script>";
        }
        
    }

    /*******************************************************************************************************************************************************************/
    // LOADER
    public function updateLoader(){//update le loader si le result de search est vide
        
        $loader="<button class='cta'>
                    <span style='font-family:'Freestyle Script''>Reinitialisation</span>
                    <svg width='15px' height='10px' viewBox='0 0 13 10'>
                        <path d='M1,5 L11,5'></path>
                        <polyline points='8 1 12 5 8 9'></polyline>
                    </svg>
                </button>";
                $response = [
                    'status' => 'success',
                    'loader' => $loader
                ];
    
                // Assurez-vous que les headers sont correctement définis pour envoyer du JSON
                header('Content-Type: application/json');
                echo json_encode($response); // Renvoi uniquement de JSON
                exit; // Assurez-vous qu'aucune autre sortie n'est envoyée après
    }

    /*******************************************************************************************************************************************************************/
    //BUTTON
    public function updateButtonForm($mode){//update les button du form en mode add ou modif
        if (isset($_GET["action"]) && $_GET["action"] === "updateButtonForm") {
            if (isset($_GET["mode"])) {
                $mode = $_GET["mode"];
                
                // Processus pour générer la réponse en fonction du mode
                if ($mode === "add") {
                    $buttonForm = "<button type='button' id='add' class='add'>Ajouter</button>";
                    $buttonForm .= "<button type='button' id='cancel' class='cancel'>Annuler</button>";
                    
                    // Créer la réponse en format JSON
                    $response = [
                        'status' => 'success',
                        'buttonForm' => $buttonForm
                    ];
        
                    // Assurez-vous que les headers sont correctement définis pour envoyer du JSON
                    header('Content-Type: application/json');
                    echo json_encode($response); // Renvoi uniquement de JSON
                    exit; // Assurez-vous qu'aucune autre sortie n'est envoyée après

                } if ($mode === "update") {
                    $buttonForm = "<button type='button' id='update' class='add'>Valider</button>
                                   <button type='button' id='delete' class='delete'>Supprimer</button>
                                   <button type='button' id='cancel' class='cancel'>Annuler</button>";
                    
                    // Créer la réponse en format JSON
                    $response = [
                        'status' => 'success',
                        'buttonForm' => $buttonForm
                    ];
        
                    // Assurez-vous que les headers sont correctement définis pour envoyer du JSON
                    header('Content-Type: application/json');
                    echo json_encode($response); // Renvoi uniquement de JSON
                    exit; // Assurez-vous qu'aucune autre sortie n'est envoyée après
                }

            }
        }
    }

    /*******************************************************************************************************************************************************************/
    // LIST
    public function formatedListTask($listeTaches){//formate la liste de tache pour l'afficher

        // Assurer que $listeTaches est toujours un tableau
        if (!is_array($listeTaches)) {
            $listeTaches = [$listeTaches];
        }
        if(!$this->controlTask){
            $this->controlTask=new ControllerTask();
        }

        $listeTachesCheck = array_map(function($tache) {
            return [
                'id'=>$tache->getId(),
                'libelle' => $tache->getLibelle(),
                'check' => $this->controlTask->check($tache)
            ];
        }, $listeTaches);

        //formater pour affiche
        $listeTache="";
        foreach($listeTachesCheck as $tache){
            $listeTache.="<div class='checkbox-wrapper'>
                                <input {$tache['check']} type='checkbox' class='check' id='{$tache['id']}'>
                                <label for='{$tache['id']}' class='label'>
                                    <svg width='45' height='45' viewBox='0 0 95 95'>
                                        <rect x='30' y='20' width='50' height='50' stroke='black' fill='none'></rect>
                                        <g transform='translate(0,-952.36222)'>
                                            <path d='m 56,963 c -102,122 6,9 7,9 17,-5 -66,69 -38,52 122,-77 -7,14 18,4 29,-11 45,-43 23,-4' stroke='black' stroke-width='3' fill='none' class='path1'></path>
                                        </g>
                                    </svg>
                                </label>
                                <button class='button_liste' id='{$tache['id']}' ><span>{$tache['libelle']}</span></button>
                            </div>";
        }
        return $listeTache; 
    }

    public function getListUser(){//retourne la liste des utilisateurs afficher pour remplir Assigne
        //recuperer une liste d'utilisateur
        $userDAO = new UtilisateurDao();
        $listeUsers = $userDAO->getAllUsers();
        
        // Transformation de la liste en une liste de noms et prénoms
        $listeNom = array_map(function($user) {
            return $user->getPrenom() .' '. $user->getNom();
        }, $listeUsers);
        //fromater pour l'affichage
        $listeUser="";
        foreach($listeNom as $nom){
            $listeUser.= "<option value='$nom'>$nom</option>";
        }
        return $listeUser;
    }

    public function updateListTask($idUser){//update la liste des taches apres un ajout, une modif un supprim
        //recuper la liste de tache
        $tacheDAO = new TacheDao(); 
        $listeTaches = $tacheDAO->getTasksByUserId($idUser);
            
        $listeTache=$this->formatedListTask($listeTaches);
        // Créer la réponse en format JSON
        $response = [
            'status' => 'success',
            'listeTache' => $listeTache
        ];
                
        // Assurez-vous que les headers sont correctement définis pour envoyer du JSON  
        header('Content-Type: application/json');
        echo json_encode($response); // Renvoi uniquement de JSON
        exit();
    }

    /*******************************************************************************************************************************************************************/
    // FORM
    public function updateFormTask($id){//affiche les informations dans le form si on clique sur une tache
        $tacheDAO = new TacheDao(); 
        $tache = $tacheDAO->getTaskById($id);

        // Si la tâche est trouvée, on renvoie les données en format JSON
        if ($tache) {
            // Assurez-vous que les propriétés sont correctement définies
            $response = [
                'status' => 'success',
                'id'=>$tache->getId(),
                'titre' => $tache->getLibelle(),
                'description' => $tache->getDescriptif()?: 'Description non fournie',
                'date' => $tache->getDateEcheance(),
                'statut' => $tache->getStatut(),
                'priorite' => $tache->getPriorite(),
                'assigne' => $tache->getUtilisateur()->getPrenom() . ' ' . $tache->getUtilisateur()->getNom(),
                'categorie' => $tache->getCategorie()
            ];
        } else {
            $response = [
                'status' => 'success',
                'titre' => null,
                'description' => null,
                'date' => null,
                'statut' => "",
                'priorite' => "",
                'assigne' => "",
                'categorie' => ""
            ];
        }
        
        // Renvoi de la réponse JSON
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }

    public function saveForm(){//ajoute un tache dans la base de donnée
        // Vérifier si la méthode de requête est POST et les champs nécessaires sont présents
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $csrf = $_POST["csrf_token"];
            // Vérification du token
            if(!isset($csrf) || $csrf !== $_SESSION['csrf_token'] ){
                die("⛔ Erreur : Token CSRF invalide !");
            }
            if (
                isset($_POST['titre'], $_POST['description'], $_POST['date'], 
                    $_POST['statut'], $_POST['priorite'], $_POST['categorie'])
            ) {
                
                // Récupérer les données du formulaire
                $titre =  $_POST['titre'];
                $description = $_POST['description'];
                $dateLimite = $_POST['date'];
                $statut = $_POST['statut'];
                $priorite = $_POST['priorite'];
                $categorie = $_POST['categorie'];

                // Créer les valeurs pour l'entité
                $dateCreation = date('Y-m-d'); // Date actuelle
                $heureCreation = date('H:i:s'); // Heure actuelle
                //recuper l'utilisateur
                if(!$this->controlUser){
                    $this->controlUser=new ControllerUser();
                }
                if( $_SESSION["type"]=="Administrateur"){
                    $assigne = $_POST['assigne'];
                    $assigne= $this->controlUser->getUserByAssigne($assigne);
                }else{
                    $UserDAO=new UtilisateurDao();
                    $assigne=$UserDAO->getUserById( $_SESSION["id_user"]);
                }
                //creér la tache a ajouter
                $newTache=new Tache(null,
                                    $titre, 
                                    $description, 
                                    $dateCreation,  
                                    $dateLimite, 
                                    $heureCreation, 
                                    $heureCreation, // Supposons que c'est l'heure de modification
                                    $statut, 
                                    $priorite, 
                                    $categorie, 
                                    $assigne);
                // var_dump($newTache);
                try {
                    $tacheDao = new TacheDao();
                    $tacheDao->addTask($newTache);
                } catch (Exception $e) {
                    $message= "Erreur : " . $e->getMessage();
                    var_dump($message);
                    echo "<script type='text/javascript'>alert('$message');</script";
                }
            } else {
                echo "<script type='text/javascript'>alert('Erreur : Tous les champs obligatoires ne sont pas remplis pour l'ajout.');</script>";
            }
        } else {
            echo "<script type='text/javascript'>alert('Méthode non autorisée.');</script>";
        }
       header('Location: /../Projet-Web-I2-Todo-List/Routeur/routeur.php?action=accueil');
        exit;
    }

    public function updateTaskForm($idTask){
        // Vérifier si la méthode de requête est POST et les champs nécessaires sont présents
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $csrf = $_POST["csrf_token"];
            // Vérification du token
            if(!isset($csrf) || $csrf !== $_SESSION['csrf_token'] ){
                die("⛔ Erreur : Token CSRF invalide !");
            }
            if (isset( $_POST['titre'], $_POST['description'], $_POST['date'], 
                    $_POST['statut'], $_POST['priorite'], $_POST['categorie'])) {
                
                // Récupérer les données du formulaire
                $id =$idTask;
                $titre = $_POST['titre'];
                $description = $_POST['description'];
                $dateLimite = $_POST['date'];
                $statut = $_POST['statut'];
                $priorite = $_POST['priorite'];
                $categorie = $_POST['categorie'];
                
                //var_dump($titre);

                // Récupérer la tâche existante
                $tacheDao = new TacheDao();
                $tache = $tacheDao->getTaskById($id);

                if ($tache) {
                    // Mettre à jour les données de la tâche
                    $tache->setLibelle($titre);
                    $tache->setDescriptif($description);
                    $tache->setDateEcheance($dateLimite);
                    $tache->setStatut($statut);
                    $tache->setPriorite($priorite);
                    $tache->setCategorie($categorie);

                    if( $_SESSION["type"]=="Administrateur"){
                        $assigne = $_POST['assigne'];
                        $assigne= $this->controlUser->getUserByAssigne($assigne);
                    }else{
                        $UserDAO=new UtilisateurDao();
                        $assigne=$UserDAO->getUserById( $_SESSION["id_user"]);
                    }
                    $tache->setUtilisateur($assigne);
                    // Sauvegarder les modifications
                    $tacheDao->updateTask($tache);
                } else {
                    echo "<script type='text/javascript'>alert('Tâche introuvable.');</script>";
                }
            } else {
                echo "<script type='text/javascript'>alert('Tous les champs obligatoires ne sont pas remplis pour la modification.');</script>";
            }
        }
        header('Location: /../Projet-Web-I2-Todo-List/Routeur/routeur.php?action=accueil');
        exit;
    }

    public function deleteTaskForm($idTask){
        // Vérifier si l'ID de la tâche à supprimer est fourni
        if ($idTask) {
            $id =$idTask; 
    
            $tacheDao = new TacheDao();
            try {
                $tacheDao->deleteTask($id);
            } catch (Exception $e) {
                echo "<script type='text/javascript'>alert('Erreur lors de la suppression : {$e->getMessage()}');</script>";
            }
        } else {
            echo "<script type='text/javascript'>alert('ID de tâche manquant.');</script>";
        }
        header('Location: /../Projet-Web-I2-Todo-List/Routeur/routeur.php?action=accueil');
        exit;
    }


    public function searchForm(){

        if (isset($_GET['action']) && $_GET['action'] === 'search') {
            // Récupérer les paramètres de recherche depuis la requête GET
            $libelle = $_POST['titre'] ?? null;
            $statut = $_POST['statut'] ?? null;
            $priorite = $_POST['priorite'] ?? null;
            $assigne = $_POST['assigne'] ?? null;
            $categorie = $_POST['categorie'] ?? null; // Nouveau paramètre catégorie
    
            // Récupérer l'utilisateur correspondant (s'il y a une recherche par assigné)
            $utilisateurId = null;
            if(!$this->controlUser){
                $this->controlUser=new ControllerUser();
            }

            if( $_SESSION["type"]=="Administrateur"){
                $assigne= $this->controlUser->getUserByAssigne($assigne);
            }else{
                $UserDAO=new UtilisateurDao();
                $assigne=$UserDAO->getUserById( $_SESSION["id_user"]);
            }
            // Effectuer la recherche
            $tacheDao = new TacheDao();
            
            $listeTaches = $tacheDao->getTasksByFilters($libelle, $statut, $priorite, $utilisateurId,$categorie);
            $listeTache=$this->formatedListTask($listeTaches);
            // Créer la réponse en format JSON
               $response = [
                   'status' => 'success',
                   'listeTache' => $listeTache
               ];
               
               // Assurez-vous que les headers sont correctement définis pour envoyer du JSON     
            header('Content-Type: application/json');
            echo json_encode($response); // Renvoi uniquement de JSON
            exit();
        }
    }
    /*******************************************************************************************************************************************************************/
}
?>