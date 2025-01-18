<?php
    // Exemple d'appel dans index.php
    require_once '../controlleur/ModifTache.php';

    $controller = new ControllerModifTache();
    $controller->afficheForm();
?>