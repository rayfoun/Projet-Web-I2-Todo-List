<?php
    // Exemple d'appel dans index.php
    require_once '../controlleur/controllerAccueil.php';

     $controller = new ControllerAccueil();
    if(!isset($_GET["action"])){
        require '../controlleur/ConnexionController.php';
        $controller = new ControllerConnexion();
        $controller->affichePageConnexion();
        exit(); 
        //$controller->afficheAccueil();
    }else{

        // Authentification
        if ($_GET["action"]=="traiterAuthentification"){
            require_once '../controlleur/ConnexionController.php';
            $controller = new ControllerConnexion();
            $controller->login();
            exit(); // inutile ici puisque le login redirige, mais plus tranquilisant à la relecture de ce fichier seul
        }

        //Affichage de l'accueil
        if ($_GET["action"]=="accueil"){
            require '../controlleur/AccueilController.php';
            $controller = new ControllerAccueil();
            $controller->afficheAccueil();
            exit();
        }

         // save , delete update une tache
        if ( $_GET["action"] === "saveTache") {
            $controller->saveForm();
        }if ( $_GET["action"] === "updateTache") {
            $controller->updateForm();
        }if ( $_GET["action"] === "deleteTache") {
            $controller->deleteForm();
        }

        //Recherche
        if ( $_GET["action"] === "updateLoader") {
            $controller->updateLoader();
        }if ( $_GET["action"] === "searchList") {
            $controller->searchList();
        }
        
        // Mettre à jour les boutons du formulaire
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
    #require_once '../controlleur/AfficheAccueil.php';
    #require_once '../controlleur/ConnexionController.php';

    #$controller = new ControllerAccueil();
    #$controller->afficheAccueil();

    #$controller = new ControllerConnexion();
    #$controller->affichePageConnexion();

    //session_start();

    // page de connextion : routeur sans action

    //     echo "<pre>";
    // echo "GET : ";
    // print_r($_GET);
    // echo "POST : ";
    // print_r($_POST);
    // echo "</pre>";

    // if (!isset($_GET["action"])){
    //     // => accueil;
    //     require '../controlleur/ConnexionController.php';
    //     $controller = new ControllerConnexion();
    //     $controller->affichePageConnexion();
    //     exit();
    // } 

    // if ($_GET["action"]=="traiterAuthentification"){
    //     echo "hellooo nice to meet you";
    //     require_once '../controlleur/ConnexionController.php';
    //     echo "hellooo";
    //     $controller = new ControllerConnexion();
    //     $controller->login();
    //     exit(); // inutile ici puisque le login redirige, mais plus tranquilisant à la relecture de ce fichier seul
    // }

    // if ($_GET["action"]=="accueil"){
    //     require '../controlleur/AccueilController.php';
    //     $controller = new ControllerAccueil();
    //     $controller->afficheAccueil();
    //     exit();
    // }

    /*session_start();
    require_once "utils_inc/inc_pdo.php";
    require_once "utils_inc/inc_verifsDroits.php";


    // syntaxe attendue : router.php?action=monAction&param1=valeurA&param2=valeurB...

    // page de connextion : routeur sans action
    if (!isset($_GET["action"])){
        // => accueil;
        require "vues/formCo.php";
        exit();
    } 


    if ($_GET["action"]=="accueil"){
        require "vues/accueil.php";
        exit();
    }


    if ($_GET["action"]=="traiterAuthentification"){
        require_once "controleurs/controleurLogin.php";
        login();
        exit(); // inutile ici puisque le login redirige, mais plus tranquilisant à la relecture de ce fichier seul
    }


    if ($_GET["action"]=="toutesContribs"){
        require_once "controleurs/controleurContribs.php";

        if (!estConnecte()){
            header("location:routeur.php"); // => connection
            exit();
        }

        if (!aDroit("admin")) {
            header("location:vues/accueil.php");
            exit();
        }else{
            listerToutesContribs(); // fonction située dans le controleur, c'est elle qui apelle (inclut) la vue
        }

        exit();
    }*/
?>