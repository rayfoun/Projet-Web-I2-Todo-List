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

// Récupérer les paramètres GET
$libelle = isset($_GET['libelle']) ? $_GET['libelle'] : null;
$statut = isset($_GET['statut']) ? $_GET['statut'] : null;
$priorite = isset($_GET['priorite']) ? $_GET['priorite'] : null;
$idUser = isset($_GET['id_user']) ? intval($_GET['id_user']) : null;

// Instanciation du DAO
$tacheDao = new TacheDao($db, null);

// Récupération des tâches selon les critères
$taches = $tacheDao->getTasksByCriteria($libelle, $statut, $priorite, $idUser);

if (!$taches) {
    echo json_encode(["error" => "Aucune tâche trouvée"]);
    exit;
}

// Affichage des tâches en format JSON
echo json_encode($taches, JSON_PRETTY_PRINT);
?>
