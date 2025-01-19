<?php
    // Exemple d'appel dans index.php
    require_once '../controlleur/controllerAccueil.php';

    $controller = new ControllerAccueil();
    if(!isset($_GET["action"])){
        $controller->afficheAccueil();
    }else{
    
        // Vérifiez l'action reçue dans la requête GET
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
        }if ( $_GET["action"] === "saveTache") {
            $controller->ajouterForm();
        }if ( $_GET["action"] === "updateListTask") {
            $controller->updateListTask();
        }if ( $_GET["action"] === "updateFromTask") {
            if (isset($_GET["id"])) {
                $controller->updateFromTask($_GET["id"]);
            } else {
                // Si 'mid' n'est pas défini dans la requête GET, renvoyer une erreur JSON
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