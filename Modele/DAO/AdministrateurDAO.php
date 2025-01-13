<?php

require_once 'config/Database.php';// Inclut la connexion à la base de données
require_once 'entite/Administrateur.php'; // Inclut la classe Utilisateur
require_once 'Utilisateur.php';  // Assurez-vous d'inclure la classe Utilisateur

class AdministrateurDAO {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Gestion des administrateurs
    public function getAllAdministrateurs() {
        $query = "SELECT * FROM administrateur";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addAdministrateur($nom, $email, $id_utilisateur) {
        $query = "INSERT INTO administrateur (nom_admin, email_admin, id_utilisateur) 
                  VALUES (:nom, :email, :id_utilisateur)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':id_utilisateur', $id_utilisateur);
        $stmt->execute();
    }

    public function deleteAdministrateur($id) {
        $query = "DELETE FROM administrateur WHERE id_admin = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    // Gestion des tâches des utilisateurs
    public function addTacheUtilisateur($id_utilisateur, $nom_tache, $description_tache, $date_limite) {
        $query = "INSERT INTO tache (id_utilisateur, nom_tache, description_tache, date_limite) 
                  VALUES (:id_utilisateur, :nom_tache, :description_tache, :date_limite)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_utilisateur', $id_utilisateur);
        $stmt->bindParam(':nom_tache', $nom_tache);
        $stmt->bindParam(':description_tache', $description_tache);
        $stmt->bindParam(':date_limite', $date_limite);
        $stmt->execute();
    }

    public function modifyTacheUtilisateur($id_tache, $nom_tache, $description_tache, $date_limite) {
        $query = "UPDATE tache SET nom_tache = :nom_tache, description_tache = :description_tache, date_limite = :date_limite
                  WHERE id_tache = :id_tache";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_tache', $id_tache);
        $stmt->bindParam(':nom_tache', $nom_tache);
        $stmt->bindParam(':description_tache', $description_tache);
        $stmt->bindParam(':date_limite', $date_limite);
        $stmt->execute();
    }

    public function deleteTacheUtilisateur($id_tache) {
        $query = "DELETE FROM tache WHERE id_tache = :id_tache";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_tache', $id_tache);
        $stmt->execute();
    }

    public function getAllTachesUtilisateur($id_utilisateur) {
        $query = "SELECT * FROM tache WHERE id_utilisateur = :id_utilisateur";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_utilisateur', $id_utilisateur);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Gestion des utilisateurs avec la classe Utilisateur
    public function addUtilisateur(Utilisateur $utilisateur) {
        $query = "INSERT INTO utilisateur (nom_utilisateur, prenom_utilisateur, password_utilisateur, email_utilisateur, token_utilisateur, login_utilisateur, type, photo_utilisateur, verification_email_utilisateur) 
                  VALUES (:nom, :prenom, :password, :email, :token, :login, :type, :photo, :verification_email)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nom', $utilisateur->nom_utilisateur);
        $stmt->bindParam(':prenom', $utilisateur->prenom_utilisateur);
        $stmt->bindParam(':password', $utilisateur->password_utilisateur);
        $stmt->bindParam(':email', $utilisateur->email_utilisateur);
        $stmt->bindParam(':token', $utilisateur->token_utilisateur);
        $stmt->bindParam(':login', $utilisateur->login_utilisateur);
        $stmt->bindParam(':type', $utilisateur->type);
        $stmt->bindParam(':photo', $utilisateur->photo_utilisateur);
        $stmt->bindParam(':verification_email', $utilisateur->verification_email_utilisateur);
        $stmt->execute();
    }

    public function deleteUtilisateur($id_utilisateur) {
        $query = "DELETE FROM utilisateur WHERE id_utilisateur = :id_utilisateur";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_utilisateur', $id_utilisateur);
        $stmt->execute();
    }

    public function getUtilisateurById($id_utilisateur) {
        $query = "SELECT * FROM utilisateur WHERE id_utilisateur = :id_utilisateur";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_utilisateur', $id_utilisateur);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllUtilisateurs() {
        $query = "SELECT * FROM utilisateur";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Générer un rapport de statistiques
    public function generateRapportStatistiques() {
        $query = "SELECT COUNT(*) AS total_utilisateurs, 
                          (SELECT COUNT(*) FROM tache) AS total_taches, 
                          (SELECT COUNT(*) FROM tache WHERE statut = 'complété') AS total_taches_completes
                  FROM utilisateur";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
