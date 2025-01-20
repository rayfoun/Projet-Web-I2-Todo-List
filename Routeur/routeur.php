<?php
    // Exemple d'appel dans index.php
    #require_once '../controlleur/AfficheAccueil.php';
    #require_once '../controlleur/ConnexionController.php';

    #$controller = new ControllerAccueil();
    #$controller->afficheAccueil();

    #$controller = new ControllerConnexion();
    #$controller->affichePageConnexion();

    //session_start();

    // page de connextion : routeur sans action

        echo "<pre>";
    echo "GET : ";
    print_r($_GET);
    echo "POST : ";
    print_r($_POST);
    echo "</pre>";

    if (!isset($_GET["action"])){
        // => accueil;
        require '../controlleur/ConnexionController.php';
        $controller = new ControllerConnexion();
        $controller->affichePageConnexion();
        exit();
    } 

    if ($_GET["action"]=="traiterAuthentification"){
        echo "hellooo nice to meet you";
        require_once '../controlleur/ConnexionController.php';
        echo "hellooo";
        $controller = new ControllerConnexion();
        $controller->login();
        exit(); // inutile ici puisque le login redirige, mais plus tranquilisant à la relecture de ce fichier seul
    }

    if ($_GET["action"]=="accueil"){
        require '../controlleur/AccueilController.php';
        $controller = new ControllerAccueil();
        $controller->afficheAccueil();
        exit();
    }

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