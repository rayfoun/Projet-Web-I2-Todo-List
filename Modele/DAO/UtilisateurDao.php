<?php
require_once 'Config/bdd.php'; // Inclut la connexion à la base de données
require_once 'entite/Utilisateur.php'; // Inclut la classe Utilisateur


class UtilisateurDAO {
    private $conn;

    public function __construct(){
        $database= new Database();
        $this->conn=$database->getConnection();
    }

    // Méthode pour ajouter un utilisateur
    public function creerCompteUtilisateur($nom, $prenom, $password, $email, $login, $type, $photo, $verificationEmail) {
        // Vérification des paramètres obligatoires
        if (empty($nom) || empty($prenom) || empty($password) || empty($email) || empty($login) || empty($type)) {
            throw new Exception('Tous les champs obligatoires doivent être remplis');
        }
    
        // Validation du format de l'email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Adresse email invalide');
        }
    
        // Vérification si l'email existe déjà dans la base de données
        $query = "SELECT COUNT(*) FROM utilisateur WHERE email_utilisateur = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':email' => $email]);
        if ($stmt->fetchColumn() > 0) {
            throw new Exception('Cet email est déjà utilisé');
        }
    
        // Génération d'un token unique
        $token = bin2hex(random_bytes(16)); // 16 bytes = 32 caractères hexadécimaux
    
        // Préparation de la requête d'insertion
        $query = "INSERT INTO utilisateur 
                    (nom_utilisateur, prenom_utilisateur, password_utilisateur, email_utilisateur, token_utilisateur, 
                     login_utilisateur, type, photo_utilisateur, verification_email_utilisateur) 
                    VALUES (:nom, :prenom, :password, :email, :token, :login, :type, :photo, :verificationEmail)";
        $stmt = $this->conn->prepare($query);
    
        // Exécution de la requête avec les paramètres
        try {
            $stmt->execute([
                ':nom' => $nom,
                ':prenom' => $prenom,
                ':password' => password_hash($password, PASSWORD_BCRYPT),
                ':email' => $email,
                ':token' => $token,
                ':login' => $login,
                ':type' => $type,
                ':photo' => $photo,
                ':verificationEmail' => $verificationEmail
            ]);
        } catch (PDOException $e) {
            // Gestion des erreurs de la requête
            throw new Exception('Erreur lors de la création du compte utilisateur: ' . $e->getMessage());
        }
    
        return $token; // Retourne le token généré, si nécessaire (par exemple, pour la vérification de l'email)
    }
    
    // Méthode pour récupérer un utilisateur par ID
    public function getUtilisateurParId($id) {
        $query = "SELECT * FROM utilisateur WHERE id_utilisateur = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Méthode pour récupérer un utilisateur par email
    public function getUtilisateurParEmail($email) {
        $query = "SELECT * FROM utilisateur WHERE email_utilisateur = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Méthode pour mettre à jour un utilisateur
    public function mettreAJourUtilisateur($id, $nom, $prenom, $email, $login, $photo, $verificationEmail) {
        $query = "UPDATE utilisateur 
                SET nom_utilisateur = :nom, prenom_utilisateur = :prenom, email_utilisateur = :email, 
                    login_utilisateur = :login, photo_utilisateur = :photo, 
                    verification_email_utilisateur = :verificationEmail 
                WHERE id_utilisateur = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            ':id' => $id,
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':email' => $email,
            ':login' => $login,
            ':photo' => $photo,
            ':verificationEmail' => $verificationEmail
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
}

?>