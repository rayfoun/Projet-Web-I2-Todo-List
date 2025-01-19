<?php
header("Content-Type: application/json");
require_once __DIR__ . '/../Config/bdd.php';
require_once __DIR__ . '/../Modele/entite/Utilisateur.php';
require_once __DIR__ . '/../Modele/DAO/UtilisateurDao.php';

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
if (empty($data['id']) || empty($data['nom']) || empty($data['prenom']) || empty($data['email']) || empty($data['type'])) {
    echo json_encode(["error" => "Tous les champs sont obligatoires"]);
    exit;
}

// Sécurisation des données
$id = intval($data['id']);
$nom = htmlspecialchars(trim($data['nom']));
$prenom = htmlspecialchars(trim($data['prenom']));
$email = filter_var($data['email'], FILTER_SANITIZE_EMAIL);
$type = in_array($data['type'], ['Utilisateur', 'Administrateur']) ? $data['type'] : 'Utilisateur';

// Vérification de l'email valide
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(["error" => "Adresse email invalide"]);
    exit;
}

// Vérifier si l'utilisateur existe avant de le modifier
$query = $db->prepare("SELECT * FROM users WHERE id_user = :id");
$query->execute([':id' => $id]);

if (!$query->fetch()) {
    echo json_encode(["error" => "Utilisateur introuvable"]);
    exit;
}

// Création d'un objet utilisateur
$utilisateur = new Utilisateur($id, $nom, $prenom, $email, "", "", $type, "", false);

// Instanciation du DAO et mise à jour de l'utilisateur
$utilisateurDao = new UtilisateurDao($db);
$utilisateurDao->updateUser($utilisateur);

echo json_encode(["message" => "Utilisateur modifié avec succès"]);
?>
