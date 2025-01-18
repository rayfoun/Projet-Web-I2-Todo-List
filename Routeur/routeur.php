<?php
    // Exemple d'appel dans index.php
    require_once '../controlleur/controllerAccueil.php';

    $controller = new ControllerAccueil();
    $controller->afficheAccueil();

    // Vérifiez si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->ajouterForm();
}
?>