<?php
header("Content-Type: application/json");
require_once __DIR__ . '/../../Config/bdd.php';
require_once __DIR__ . '/../entite/Utilisateur.php';
require_once __DIR__ . '/../dao/UtilisateurDao.php';

// Connexion à la base de données
$database = new Database();
$db = $database->getConnection();

if (!$db) {
    echo json_encode(["error" => "Impossible de se connecter à la base de données"]);
    exit;
}

// ===================== DEBUG =====================
// Vérifier quelles données sont reçues
/*
echo json_encode([
    "debug_post" => $_POST,
    "debug_raw" => file_get_contents("php://input")
]);
exit;
*/
// =================================================

// Récupération des données envoyées
$data = json_decode(file_get_contents("php://input"), true);

// Si JSON vide, récupérer via $_POST (cas x-www-form-urlencoded)
if (!$data) {
    $data = $_POST;
}

// Vérifier si toutes les données nécessaires sont présentes
if (empty($data['nom']) || empty($data['prenom']) || empty($data['email']) || empty($data['password']) || empty($data['type'])) {
    echo json_encode(["error" => "Tous les champs sont obligatoires"]);
    exit;
}

// Sécurisation des données reçues
$nom = htmlspecialchars(trim($data['nom']));
$prenom = htmlspecialchars(trim($data['prenom']));
$email = filter_var($data['email'], FILTER_SANITIZE_EMAIL);
$password = $data['password'];
$type = in_array($data['type'], ['Utilisateur', 'Administrateur']) ? $data['type'] : 'Utilisateur';

// Vérification de l'email valide
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(["error" => "Adresse email invalide"]);
    exit;
}

// Vérification si l'email existe déjà
$query = $db->prepare("SELECT id_user FROM users WHERE email_user = :email");
$query->execute([':email' => $email]);

if ($query->fetch()) {
    echo json_encode(["error" => "Cet email est déjà utilisé"]);
    exit;
}

// Création de l'objet utilisateur
$utilisateur = new Utilisateur(
    null,               // ID auto-incrémenté
    $nom, 
    $prenom, 
    $email, 
    password_hash($password, PASSWORD_BCRYPT), // Hash du mot de passe
    null,               // Token (non utilisé ici)
    $type, 
    null,               // Photo (optionnelle)
    false               // Email vérifié par défaut à false
);

// Instanciation du DAO et ajout de l'utilisateur
$utilisateurDao = new UtilisateurDao($db);
$utilisateurDao->addUser($utilisateur);

echo json_encode(["message" => "Utilisateur ajouté avec succès"]);
?>
