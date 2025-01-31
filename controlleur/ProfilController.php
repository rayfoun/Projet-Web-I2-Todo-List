<?php
require_once '/Config/bdd.php'; // Inclut la connexion à la base de données
require_once '/Modele/DAO/UtilisateurDAO.php';
require_once __DIR__.'/DefaultController.php';
require_once __DIR__.'/UtilisateurDAO.php';

class ProfilController extends DefaultController {
    private $utilisateurDao;

    public function __construct() {
        $this->utilisateurDao = new UtilisateurDao();
    }

    // 1️ Afficher la liste des utilisateurs 
    public function afficherUtilisateurs() {

        $utilisateurs = $this->utilisateurDao->getAllUsers();

        $this->renderView(__DIR__ . '/../Vue/profil/afficherProfil.php', [
            'utilisateurs' => $utilisateurs
        ]);
    }

    // 2️ Afficher un utilisateur spécifique
    public function afficherProfil($id) {

        $utilisateur = $this->utilisateurDao->getUserById($id);

        $this->renderView(__DIR__ . '/../Vue/profil/detailProfil.php', [
            'utilisateur' => $utilisateur
        ]);
    }

    // 3️ Modifier un utilisateur
    public function modifierProfil() {

        if ($_SERVER["REQUEST_METHOD"] == "POST") {


            $id = intval($_POST['id']);
            $nom = htmlspecialchars($_POST['nom']);
            $prenom = htmlspecialchars($_POST['prenom']);
            $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
            $type = htmlspecialchars($_POST['type']);

            $utilisateur = new Utilisateur($id, $nom, $prenom, $email, null, null, $type, null, null);
            $this->utilisateurDao->updateUser($utilisateur);

            header("Location: /admin/utilisateurs");
            exit;
        }
    }

    // 4️ Supprimer un utilisateur
    public function supprimerProfil($id) {

        $this->utilisateurDao->deleteUser($id);
        header("Location: /admin/utilisateurs");
        exit;
    }
}
?>
