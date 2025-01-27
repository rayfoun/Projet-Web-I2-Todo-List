<?php
    // Exemple d'appel dans index.php
    require_once '../controlleur/controllerAccueil.php';

    $controller = new ControllerAccueil();
    if(!isset($_GET["action"])){
        $controller->afficheAccueil();
    }else{
         // save , delete update une tache
        if ( $_GET["action"] === "saveTache") {
            $controller->saveForm();
        }if ( $_GET["action"] === "updateTache") {
            $controller->modifForm();
        }if ( $_GET["action"] === "deleteTache") {
            $controller->deleteForm();
        }
        //Recherche
        if ( $_GET["action"] === "updateLoader") {
            $controller->updateLoader();
        }if ( $_GET["action"] === "search") {
            $controller->searchForm();
        }
        
        // Mettre à jour les buttons du formulaire
        if ( $_GET["action"] === "updateButtonForm") {
            // Vérifiez que le paramètre 'mode' est passé dans la requête GET
            if (isset($_GET["mode"])) {
                $controller->updateButtonForm($_GET["mode"]);
            } else {
                // Si 'mode' n'est pas défini dans la requête GET, renvoyer une erreur JSON
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Le paramètre mode est manquant.'
                ]);
                exit;
            }  
        //update la liste de taches apres un add, modif ou supprim
        }if ( $_GET["action"] === "updateListTask") {
            $controller->updateListTask("accueil");

        //update le form avec des donne si on clique sur une tache
        }if ( $_GET["action"] === "updateFromTask") {
            if (isset($_GET["id"])) {
                $controller->updateFormTask($_GET["id"]);
            } else {
                // Si 'id' n'est pas défini dans la requête GET, renvoyer une erreur JSON
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Le paramètre mode est manquant.'
                ]);
                exit;
            }  
        }
        // Si 'action' n'est pas définie dans la requête GET, renvoyer une erreur JSON
        echo json_encode([
            'status' => 'error',
            'message' => 'Action non définie.'
        ]);
        exit;

    }
?>