<?php
require_once __DIR__ .'/DefaultController.php';
require_once __DIR__ .'/../Modele/DAO/UtilisateurDao.php';
require_once __DIR__ .'/../Modele/DAO/TacheDao.php';
require_once __DIR__ .'/../Modele/entite/tache.php';
require_once __DIR__ .'/../Modele/entite/Utilisateur.php';

class ControllerAccueil extends DefaultController { 
    
    public function updateButtonForm($mode){
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
                    $buttonForm = "<button type='button' id='add' class='add'>Valider</button>
                                   <button type='button' class='delete' onclick='deleteTache();'>Supprimer</button>
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
    public function updateListTask(){
        if (isset($_GET["action"]) && $_GET["action"] === "updateListTask") {
       
            //recuper une liste de tache
        $tacheDAO = new TacheDao(); 
        $listeTaches = $tacheDAO->getAllTask();
        //transformer la liste en liste de titre
        // Créer une nouvelle liste contenant uniquement les titres
         //cocher ou pas cocher
         function check($tache) {
            return ($tache->getStatut() == "Terminee") ? "checked=''" : "";
        }
        $listeTachesCheck = array_map(function($tache) {
            return [
                'libelle' => $tache->getLibelle(),
                'check' => check($tache)
            ];
        }, $listeTaches);

        //formater pour affiche
        $listeTache="";
        $id=1;
        foreach($listeTachesCheck as $tache){
             $listeTache.="<div class='checkbox-wrapper'>
                                <input {$tache['check']} type='checkbox' class='check' id='check$id-61'>
                                <label for='check$id-61' class='label'>
                                    <svg width='45' height='45' viewBox='0 0 95 95'>
                                        <rect x='30' y='20' width='50' height='50' stroke='black' fill='none'></rect>
                                        <g transform='translate(0,-952.36222)'>
                                            <path d='m 56,963 c -102,122 6,9 7,9 17,-5 -66,69 -38,52 122,-77 -7,14 18,4 29,-11 45,-43 23,-4' stroke='black' stroke-width='3' fill='none' class='path1'></path>
                                        </g>
                                    </svg>
                                </label>
                                <button class='button_liste'><span>{$tache['libelle']}</span></button>
                            </div>";
            $id=$id+1;
        }           
            // Créer la réponse en format JSON
             $response = [
                'status' => 'success',
                'listeTache' => $listeTache
            ];
        
            // Assurez-vous que les headers sont correctement définis pour envoyer du JSON
            header('Content-Type: application/json');
            echo json_encode($response); // Renvoi uniquement de JSON
            return $listeTache;
        }
    }

    public function afficheAccueil() {
        //recuperer une liste d'utilisateur
        $userDAO = new UtilisateurDao();
        $listeUsers = $userDAO->getAllUsers();
        
        // Transformation de la liste en une liste de noms et prénoms
        $listeNom = array_map(function($user) {
            return $user->getPrenom() . ' ' . $user->getNom();
        }, $listeUsers);
        //fromater pour l'affichage
        $listeUser="";
        foreach($listeNom as $nom){
            $listeUser.= "<option value='$nom'>$nom</option>";
        }

        //recuper une liste de tache
        $tacheDAO = new TacheDao(); 
        $listeTaches = $tacheDAO->getAllTask();
        //transformer la liste en liste de titre
        // Créer une nouvelle liste contenant uniquement les titres
         //cocher ou pas cocher
         function check($tache) {
            return ($tache->getStatut() == "Terminee") ? "checked=''" : "";
        }
        $listeTachesCheck = array_map(function($tache) {
            return [
                'libelle' => $tache->getLibelle(),
                'check' => check($tache)
            ];
        }, $listeTaches);

        //formater pour affiche
        $listeTache="";
        $id=1;
       
        foreach($listeTachesCheck as $tache){
             $listeTache.="<div class='checkbox-wrapper'>
                                <input {$tache['check']} type='checkbox' class='check' id='check$id-61'>
                                <label for='check$id-61' class='label'>
                                    <svg width='45' height='45' viewBox='0 0 95 95'>
                                        <rect x='30' y='20' width='50' height='50' stroke='black' fill='none'></rect>
                                        <g transform='translate(0,-952.36222)'>
                                            <path d='m 56,963 c -102,122 6,9 7,9 17,-5 -66,69 -38,52 122,-77 -7,14 18,4 29,-11 45,-43 23,-4' stroke='black' stroke-width='3' fill='none' class='path1'></path>
                                        </g>
                                    </svg>
                                </label>
                                <button class='button_liste'><span>{$tache['libelle']}</span></button>
                            </div>";
            $id=$id+1;
        }

        // Gestion du thème (CSS)
        $themeProjet = "/path/to/css/themeProjet.php"; // Mettez ici le chemin public du fichier CSS

        // Rendu de la vue
        $this->renderView(
            __DIR__ . '/../Vue/page/Acceuil.php', // Correction du chemin
            [
                'listeUser' => $listeUser,
                'listeTache'=>$listeTache,
                'themeProjet' => $themeProjet,
            ]
        );
    }

    public function ajouterForm(){
        // Vérifier si la méthode de requête est POST et les champs nécessaires sont présents
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (
                isset($_POST['titre'], $_POST['description'], $_POST['date'], 
                    $_POST['statut'], $_POST['priorite'], $_POST['assigne'], $_POST['categorie'])
            ) {
                // Récupérer les données du formulaire
                $titre =  $_POST['titre'];
                $description = $_POST['description'];
                $dateLimite = $_POST['date'];
                $statut = $_POST['statut'];
                $priorite = $_POST['priorite'];
                $assigne = $_POST['assigne'];
                $categorie = $_POST['categorie'];

                // Créer les valeurs pour l'entité
                $dateCreation = date('Y-m-d'); // Date actuelle
                $heureCreation = date('H:i:s'); // Heure actuelle
                //recuper l'id user
                $parts = explode(' ', $assigne); // Divise la chaîne par les espaces
                $nom = end($parts);              // Récupère le dernier élément du tableau (nom)
                $prenom = reset($parts);         // Récupère le premier élément du tableau (prénom)
                $user=new UtilisateurDao();
                $id_user=$user->getUserByName($nom,$prenom);

                //creér la tache a ajouter
                $newTache=new tache(null,
                                    $titre, 
                                    $description, 
                                    $dateCreation,  
                                    $dateLimite, 
                                    $heureCreation, 
                                    $heureCreation, // Supposons que c'est l'heure de modification
                                    $statut, 
                                    $priorite, 
                                    $categorie, 
                                    $id_user);

                try {
                    // Créer une instance du DAO pour insérer les données
                    $tacheDao = new TacheDao();
                    $tacheDao->addTask($newTache);
                } catch (Exception $e) {
                    $message= "Erreur : " . $e->getMessage();
                    echo "<script type='text/javascript'>alert('$message');</script";
                }
            } else {
                echo "<script type='text/javascript'>alert('Erreur : Tous les champs obligatoires ne sont pas remplis.');</script>";
            }
        } else {
            echo "<script type='text/javascript'>alert('Méthode non autorisée.');</script>";
        }
        
        header('Location: /../Projet-Web-I2-Todo-List/Routeur/routeur.php');
        exit;
    }
    public function modifierForm(){

    }
}
?>
