<?php
require_once __DIR__ . '/../../Config/bdd.php';
require_once __DIR__ . '/../entite/Utilisateur.php';
require_once __DIR__ . '/../entite/tache.php'; // Inclut la classe tache

//<?php
class UtilisateurDao {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // 1. Ajouter un utilisateur
    public function addUser($utilisateur) {
        $query = $this->db->prepare("
            INSERT INTO users (nom_user, prenom_user, password_utser, email_user, type)
            VALUES (:nom, :prenom, :password, :email, :type)
        ");
        $query->execute([
            ':nom' => $utilisateur->getNom(),
            ':prenom' => $utilisateur->getPrenom(),
            ':password' => password_hash($utilisateur->getPassword(), PASSWORD_BCRYPT),
            ':email' => $utilisateur->getEmail(),
            ':type' => $utilisateur->getType()
        ]);
    }

    // 2. Modifier un utilisateur
    public function updateUser($utilisateur) {
        $query = $this->db->prepare("
            UPDATE users
            SET nom_user = :nom, prenom_user = :prenom, email_user = :email, type = :type
            WHERE id_user = :id
        ");
        $query->execute([
            ':nom' => $utilisateur->getNom(),
            ':prenom' => $utilisateur->getPrenom(),
            ':email' => $utilisateur->getEmail(),
            ':type' => $utilisateur->getType(),
            ':id' => $utilisateur->getId()
        ]);
    }

    // 3. Supprimer un utilisateur
    public function deleteUser($id) {
        $query = $this->db->prepare("DELETE FROM users WHERE id_user = :id");
        $query->execute([':id' => $id]);
    }

    // 4. Afficher tous les utilisateurs
    public function getAllUsers() {
        $query = $this->db->prepare("SELECT * FROM users");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // 5. Afficher les administrateurs
    public function getAdmins() {
        $query = $this->db->prepare("SELECT * FROM users WHERE type = 'Administrateur'");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
