<?php
require_once  __DIR__ .'/../../Config/bdd.php'; // Inclut la connexion à la base de données
require_once  __DIR__ .'/../entite/Utilisateur.php'; // Inclut la classe Utilisateur
require_once  __DIR__ .'/../entite/tache.php'; // Inclut la classe tache


class UtilisateurDao {
    private $db;

    public function __construct() {
        $database= new Database();
        $this->db = $database->getConnection();
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
        $result = $query->fetchAll(PDO::FETCH_ASSOC); 

        $users = [];
        foreach ($result as $row) {
            // Crée un objet Utilisateur pour chaque ligne du résultat
            $users[] = new Utilisateur(
                $row['id_user'],
                $row['nom_user'],
                $row['prenom_user'],
                $row['email_user'],
                null, // Vous pouvez ajouter des valeurs supplémentaires si nécessaire
                null, // Pareil ici
                $row['type'],
                null, // Idem
                null // Idem
            );
        }
        return $users;
    }

    // 5. Afficher les administrateurs
    public function getAdmins() {
        $query = $this->db->prepare("SELECT * FROM users WHERE type = 'Administrateur'");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    //trouver un user
    public function getUserById($id){
        $query=$this->db->prepare("SELECT* from users where id_user=:id");
        $query->execute([':id'=>$id]);
        return new Utilisateur (
            ['id_user'],
            ['nom_user'],
            ['prenom_user'],
            ['email_user'],
            null,
            null,
            ['type'],
            null,
            null
        );
    }

    //
    public function getUserIdByName($name){
        $query=$this->db->prepare("SELECT id_user from users where nom_user=:nom");
        $query->execute([':nom'=>$name]);
        // Récupérer le résultat
        $result = $query->fetch(PDO::FETCH_ASSOC);

        // Vérifier si un résultat existe
        return $result ? $result['id_user'] : null;
    }
}
?>