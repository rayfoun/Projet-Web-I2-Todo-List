<?php
    // Exemple d'appel dans index.php
    require_once '../controlleur/AfficheAccueil.php';

    $controller = new ControllerAccueil();
    $controller->afficheAccueil();
?>