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
            $controller->updateForm();
        }if ( $_GET["action"] === "deleteTache") {
            $controller->deleteForm();
        }
        //Recherche, et affichage
        if ( $_GET["action"] === "updateLoader") {
            $controller->updateLoader();
        }if ( $_GET["action"] === "searchList") {
            $controller->searchList();
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
            }if ( $_GET["action"] === "updateListTask") {
                $controller->updateListTask();
            }if ( $_GET["action"] === "updateFromTask") {
                if (isset($_GET["id"])) {
                    $controller->updateFromTask($_GET["id"]);
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

   
    session_start();  // Assurez-vous que la session est démarrée

    // Vérifiez si l'utilisateur est connecté et s'il existe un rôle dans la session
    if (isset($_SESSION['user'])) {
        // Récupérer le rôle de l'utilisateur depuis la session
        $role = $_SESSION['user']['role'];  // Exemple : 'admin' ou 'utilisateur'

        // Rediriger en fonction du rôle
        if ($role === 'admin') {
            // Rediriger vers la page spécifique pour l'admin
            header('Location: /../Projet-Web-I2-Todo-List/Routeur/routeur.php');
            exit;  // Terminer le script pour éviter toute exécution après la redirection
        } elseif ($role === 'utilisateur') {
            // Rediriger vers la page spécifique pour un utilisateur normal
            header('Location: /../Projet-Web-I2-Todo-List/Routeur/routeur.php');
            exit;  // Terminer le script pour éviter toute exécution après la redirection
        } else {
            // Si le rôle n'est ni admin ni utilisateur, rediriger vers une page d'erreur ou une page de connexion
            header('Location: /../Projet-Web-I2-Todo-List/Routeur/routeur.php');
            exit;
        }
    } else {
        // Si l'utilisateur n'est pas connecté, rediriger vers la page de connexion
        header('Location: /../Projet-Web-I2-Todo-List/Routeur/routeur.php');
        exit;
    }


?>