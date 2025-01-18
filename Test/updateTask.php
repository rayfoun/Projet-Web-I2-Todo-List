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

// Récupération des données envoyées en JSON
$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    echo json_encode(["error" => "Aucune donnée reçue"]);
    exit;
}

// Vérifier que tous les champs requis sont présents
if (empty($data['id']) || empty($data['libelle']) || empty($data['descriptif']) || empty($data['dateEcheance']) || empty($data['heureEcheance']) || empty($data['statut']) || empty($data['priorite']) || empty($data['categorie'])) {
    echo json_encode(["error" => "Tous les champs sont obligatoires"]);
    exit;
}

// Sécurisation des données
$id = intval($data['id']);
$libelle = htmlspecialchars(trim($data['libelle']));
$descriptif = htmlspecialchars(trim($data['descriptif']));
$dateEcheance = $data['dateEcheance'];
$heureEcheance = $data['heureEcheance'];
$statut = in_array($data['statut'], ['En attente', 'En cours', 'Terminee']) ? $data['statut'] : 'En attente';
$priorite = in_array($data['priorite'], ['Basse', 'Moyenne', 'Haute']) ? $data['priorite'] : 'Moyenne';
$categorie = in_array($data['categorie'], ['A domicile', 'Travail', 'Autre']) ? $data['categorie'] : 'Autre';

// Vérifier si la tâche existe avant de la modifier
$query = $db->prepare("SELECT * FROM tache WHERE id_tache = :id");
$query->execute([':id' => $id]);

if (!$query->fetch()) {
    echo json_encode(["error" => "Tâche introuvable"]);
    exit;
}

// Création d'un objet tâche
$tache = new Tache($id, $libelle, $descriptif, "", $dateEcheance, "", $heureEcheance, $statut, $priorite, $categorie, null);

// Instanciation du DAO et mise à jour de la tâche
$tacheDao = new TacheDao($db, null);
$tacheDao->updateTask($tache);

echo json_encode(["message" => "Tâche modifiée avec succès"]);
?>
