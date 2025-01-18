<?php
header("Content-Type: application/json");
require_once __DIR__ . '/../Config/bdd.php';
require_once __DIR__ . '/../Modele/entite/tache.php';
require_once __DIR__ . '/../Modele/DAO/TacheDao.php';

// Connexion à la base de données
$database = new Database();
$db = $database->getConnection();

if (!$db) {
    echo json_encode(["error" => "Impossible de se connecter à la base de données"]);
    exit;
}

// Vérifier si l'ID est passé en paramètre GET
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo json_encode(["error" => "ID de la tâche requis"]);
    exit;
}

$id = intval($_GET['id']);

// Instanciation du DAO
$tacheDao = new TacheDao($db, null);

// Requête pour récupérer la tâche par ID
$query = $db->prepare("SELECT * FROM tache WHERE id_tache = :id");
$query->execute([':id' => $id]);
$tache = $query->fetch(PDO::FETCH_ASSOC);

if (!$tache) {
    echo json_encode(["error" => "Tâche introuvable"]);
    exit;
}

echo json_encode($tache, JSON_PRETTY_PRINT);
?>
