<?php
header("Content-Type: application/json");
require_once __DIR__ . '/../Config/bdd.php';
require_once __DIR__ . '/../Modele/entite/tache.php';
require_once __DIR__ . '/../Modele/entite/Utilisateur.php';
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
if (empty($data['libelle']) || empty($data['descriptif']) || empty($data['dateCreation']) || empty($data['dateEcheance']) || empty($data['heureCreation']) || empty($data['heureEcheance']) || empty($data['statut']) || empty($data['priorite']) || empty($data['categorie']) || empty($data['idUser'])) {
    echo json_encode(["error" => "Tous les champs sont obligatoires"]);
    exit;
}

// Vérifier si l'utilisateur existe avant de lui assigner la tâche
$query = $db->prepare("SELECT * FROM users WHERE id_user = :id");
$query->execute([':id' => intval($data['idUser'])]);

if (!$query->fetch()) {
    echo json_encode(["error" => "Utilisateur introuvable"]);
    exit;
}

// Sécurisation des données
$libelle = htmlspecialchars(trim($data['libelle']));
$descriptif = htmlspecialchars(trim($data['descriptif']));
$dateCreation = $data['dateCreation'];
$dateEcheance = $data['dateEcheance'];
$heureCreation = $data['heureCreation'];
$heureEcheance = $data['heureEcheance'];
$statut = in_array($data['statut'], ['En attente', 'En cours', 'Terminee']) ? $data['statut'] : 'En attente';
$priorite = in_array($data['priorite'], ['Basse', 'Moyenne', 'Haute']) ? $data['priorite'] : 'Moyenne';
$categorie = in_array($data['categorie'], ['A domicile', 'Travail', 'Autre']) ? $data['categorie'] : 'Autre';
$idUser = intval($data['idUser']);

// Création de l'objet Tâche
$utilisateur = new Utilisateur($idUser, "", "", "", "", "", "", "", "");
$tache = new Tache(null, $libelle, $descriptif, $dateCreation, $dateEcheance, $heureCreation, $heureEcheance, $statut, $priorite, $categorie, $utilisateur);

// Instanciation du DAO et ajout de la tâche
$tacheDao = new TacheDao($db, null);
$tacheDao->addTask($tache);

echo json_encode(["message" => "Tâche ajoutée avec succès"]);
?>
