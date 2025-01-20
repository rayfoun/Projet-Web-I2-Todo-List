<?php
    // Exemple d'appel dans index.php
    require_once '../controlleur/controllerAccueil.php';
    require_once '../controlleur/ConnexionController.php';

    // Instanciation des controleurs
     $controllerAccueil = new ControllerAccueil();
     $controllerConnexion = new ControllerConnexion();

    if(!isset($_GET["action"])){
        $controllerConnexion->affichePageConnexion();
        exit(); 
        //$controllerAccueil->afficheAccueil();
    }else{

        // Authentification
        if ($_GET["action"]=="traiterAuthentification"){
            //require_once '../controlleur/ConnexionController.php';
            //$controllerAccueil = new ControllerConnexion();
            $controllerConnexion->login();
            exit(); // inutile ici puisque le login redirige, mais plus tranquilisant à la relecture de ce fichier seul
        }

        //Affichage de l'accueil
        if ($_GET["action"]=="accueil"){
            //require '../controlleur/controllerAccueil.php';
            //$controllerAccueil = new ControllerAccueil();
            $controllerAccueil->afficheAccueil();
            exit();
        }

         // save , delete update une tache
        if ( $_GET["action"] === "saveTache") {
            $controllerAccueil->saveForm();
        }if ( $_GET["action"] === "updateTache") {
            $controllerAccueil->updateForm();
        }if ( $_GET["action"] === "deleteTache") {
            $controllerAccueil->deleteForm();
        }

        //Recherche
        if ( $_GET["action"] === "updateLoader") {
            $controllerAccueil->updateLoader();
        }if ( $_GET["action"] === "searchList") {
            $controllerAccueil->searchList();
        }
        
        // Mettre à jour les boutons du formulaire
        if ( $_GET["action"] === "updateButtonForm") {
            // Vérifiez que le paramètre 'mode' est passé dans la requête GET
            if (isset($_GET["mode"])) {
                $controllerAccueil->updateButtonForm($_GET["mode"]);
            } else {
                // Si 'mode' n'est pas défini dans la requête GET, renvoyer une erreur JSON
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Le paramètre mode est manquant.'
                ]);
                exit;
            }  
        }if ( $_GET["action"] === "updateListTask") {
            $controllerAccueil->updateListTask();
        }if ( $_GET["action"] === "updateFromTask") {
            if (isset($_GET["id"])) {
                $controllerAccueil->updateFromTask($_GET["id"]);
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

    #$controllerAccueil = new ControllerAccueil();
    #$controllerAccueil->afficheAccueil();

    #$controllerAccueil = new ControllerConnexion();
    #$controllerAccueil->affichePageConnexion();

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
    //     $controllerAccueil = new ControllerConnexion();
    //     $controllerAccueil->affichePageConnexion();
    //     exit();
    // } 

    // if ($_GET["action"]=="traiterAuthentification"){
    //     echo "hellooo nice to meet you";
    //     require_once '../controlleur/ConnexionController.php';
    //     echo "hellooo";
    //     $controllerAccueil = new ControllerConnexion();
    //     $controllerAccueil->login();
    //     exit(); // inutile ici puisque le login redirige, mais plus tranquilisant à la relecture de ce fichier seul
    // }

    // if ($_GET["action"]=="accueil"){
    //     require '../controlleur/AccueilController.php';
    //     $controllerAccueil = new ControllerAccueil();
    //     $controllerAccueil->afficheAccueil();
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