<?php
header("Content-Type: application/json");

require_once __DIR__ . '/../Config/bdd.php';
require_once __DIR__ . '/../Modele/DAO/TacheDao.php';

// Vérifie si l'ID utilisateur est envoyé via GET ou POST
$userId = isset($_GET['id_user']) ? $_GET['id_user'] : null;

if (!$userId) {
    echo json_encode(["error" => "L'ID utilisateur est obligatoire"]);
    exit;
}

// Connexion à la base de données
$database = new Database();
$db = $database->getConnection();
$tacheDao = new TacheDao($db, null); // Pas besoin de l'objet utilisateurDao

// Récupération des tâches
$taches = $tacheDao->getTasksByUserId($userId);

// Retourne les résultats au format JSON
echo json_encode($taches);
