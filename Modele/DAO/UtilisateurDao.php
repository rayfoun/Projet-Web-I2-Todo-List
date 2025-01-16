<?php
require_once 'Config/bdd.php'; // Inclut la connexion à la base de données
require_once 'entite/Utilisateur.php'; // Inclut la classe Utilisateur
require_once 'entite/tache.php'; // Inclut la classe tache


class UtilisateurDAO {
    private $conn;

    public function __construct(){
        $database= new Database();
        $this->conn=$database->getConnection();
    }

    // Méthode pour ajouter un utilisateur
    public function creerCompteUtilisateur($nom, $prenom, $password, $email, $token,$type, $photo) {
        // Vérification des paramètres obligatoires
        if (empty($nom) || empty($prenom) || empty($password) || empty($email) || empty($type)) {
            throw new Exception('Tous les champs obligatoires doivent être remplis');
        }
    
        // Validation du format de l'email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Adresse email invalide');
        }
    
        // Vérification si l'email existe déjà dans la base de données
        $query = "SELECT COUNT(*) FROM users WHERE email_userr = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':email' => $email]);
        if ($stmt->fetchColumn() > 0) {
            throw new Exception('Cet email est déjà utilisé');
        }
    
        // Génération d'un token unique
        $token = bin2hex(random_bytes(16)); // 16 bytes = 32 caractères hexadécimaux
    
        // Préparation de la requête d'insertion
        $query = "INSERT INTO users 
                    (nom_utilisateur, prenom_utilisateur, password_utilisateur, email_utilisateur, token_utilisateur, 
                    type, photo_utilisateur) 
                    VALUES (:nom, :prenom, :password, :email, :token,:type, :photo)";
        $stmt = $this->conn->prepare($query);
    
        // Exécution de la requête avec les paramètres
        try {
            $stmt->execute([
                ':nom' => $nom,
                ':prenom' => $prenom,
                ':password' => password_hash($password, PASSWORD_BCRYPT),
                ':email' => $email,
                ':token' => $token,
                ':type' => $type,
                ':photo' => $photo
            ]);
        } catch (PDOException $e) {
            // Gestion des erreurs de la requête
            throw new Exception('Erreur lors de la création du compte utilisateur: ' . $e->getMessage());
        }
    
        return $token; // Retourne le token généré, si nécessaire (par exemple, pour la vérification de l'email)
    }
    
    // Méthode pour récupérer le nom d'un utilisateur par ID
    public function getNomUtilisateurParId($id) {
        $query = "SELECT nom_user FROM users WHERE id_user = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Méthode pour récupérer un utilisateur par email
    public function getUtilisateurParEmail($email) {
        $query = "SELECT * FROM user WHERE email_user = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Méthode pour mettre à jour un utilisateur
    public function mettreAJourUtilisateur($id, $nom, $prenom, $email, $photo) {
        $query = "UPDATE utilisateur 
                SET nom_utilisateur = :nom, prenom_utilisateur = :prenom, email_utilisateur = :email, 
                    login_utilisateur = :login, photo_utilisateur = :photo
                WHERE id_utilisateur = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            ':id' => $id,
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':email' => $email,
            ':login' => $login,
            ':photo' => $photo
        ]);
    }

    // Méthode pour supprimer un utilisateur
    public function supprimerUtilisateur($id) {
        $query = "DELETE FROM utilisateur WHERE id_utilisateur = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':id' => $id]);
    }

    // Méthode pour vérifier les informations de connexion d'un utilisateur
    public function verifierConnexion($email, $password) {
        $query = "SELECT * FROM utilisateur WHERE email_utilisateur = :email";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([':email' => $email]);
        $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($utilisateur && password_verify($password, $utilisateur['password_utilisateur'])) {
            return $utilisateur;
        } else {
            return false;
        }
    }

    // Méthode pour récupérer tous les utilisateurs 
    public function getAllUtilisateurs() {
        $query = "SELECT * FROM users";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

      // Gestion des tâches des utilisateurs
    public function addTacheUtilisateur($id_user, $nom_tache, $description_tache, $date_limite) {
        $query = "INSERT INTO tache (id_user, nom_tache, description_tache, date_limite) 
                  VALUES (:id_user, :nom_tache, :description_tache, :date_limite)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_user', $id_utilisateur);
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

    // Générer un rapport de statistiques
    public function generateRapportStatistiques() {
        $query = "SELECT COUNT(*) AS total_utilisateurs, 
                          (SELECT COUNT(*) FROM tache) AS total_taches, 
                          (SELECT COUNT(*) FROM tache WHERE statut = 'complété') AS total_taches_completes
                  FROM users";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}
// tu veux une mthode pour recuperer tous les utilisateurs, recuperer la liste des taches d'un utilisateur, recuperer un id d'utilisateur à partir de son nom
?>