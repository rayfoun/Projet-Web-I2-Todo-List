<?php

require_once __DIR__ .'/DefaultController.php';
require_once __DIR__ .'/../Modele/DAO/UtilisateurDao.php';
require_once __DIR__ .'/../Modele/entite/Utilisateur.php';

class RegisterController {
    private $userDao;

    public function __construct() {
        $this->userDao = new UtilisateurDao();
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['inscription'])) {
            try {
                $nom = trim($_POST['nom']);
                $prenom = trim($_POST['prenom']);
                $email = trim($_POST['email']);
                $password = $_POST['password'];
                $confirm_password = $_POST['confirm_password'];
                $username = trim($_POST['username']);
                $photo_profil = isset($_FILES['photo_profil']) ? $_FILES['photo_profil'] : null;

                // Génération du token
                $token = $this->generateToken(25);

                // Validation des champs
                if (empty($prenom) || !ctype_alpha($prenom)) throw new Exception("Le prénom doit être alphabétique !");
                if (empty($nom) || !ctype_alpha($nom)) throw new Exception("Le nom doit être alphabétique !");
                if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) throw new Exception("Email invalide !");
                if (empty($password) || $password !== $confirm_password) throw new Exception("Mots de passe différents !");
                if (empty($username) || !ctype_alnum($username)) throw new Exception("Nom d'utilisateur invalide !");
                if ($this->userDao->emailExists($email)) throw new Exception("Cet email est déjà utilisé !");
                if ($this->userDao->usernameExists($username)) throw new Exception("Nom d'utilisateur déjà pris !");

                // Hachage du mot de passe
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
                /*
                // Gestion de la photo de profil
                $photoPath = "avatar_defaut.png"; // Valeur par défaut
                if ($photo_profil && $photo_profil['error'] === UPLOAD_ERR_OK) {
                    $allowedExtensions = ['jpeg', 'jpg', 'png'];
                    $fileInfo = pathinfo($photo_profil['name']);
                    $extension = strtolower($fileInfo['extension']);

                    // Vérification de l'extension
                    if (!in_array($extension, $allowedExtensions)) {
                        throw new Exception("La photo de profil doit être au format jpeg, jpg ou png !");
                    }

                    // Vérification de la taille du fichier (1 Mo max)
                    if ($photo_profil['size'] > 1000000) { 
                        throw new Exception("La taille de la photo ne doit pas dépasser 1 Mo !");
                    }

                    // Enregistrement de l'image dans le dossier
                    $photoPath = "include/image/photo_profil/" . uniqid() . "_" . $fileInfo['basename'];
                    move_uploaded_file($photo_profil['tmp_name'], $photoPath);
                }
                */

                // Création de l'utilisateur avec le token et la photo de profil
                $utilisateur = new Utilisateur($nom, $prenom, $email, $hashedPassword, $token, /*$photoPath*/);
                $this->userDao->addUser($utilisateur);

               // echo json_encode(["status" => "success", "message" => "Inscription réussie avec token", "token" => $token]);

            } catch (Exception $e) {
                echo json_encode(["error" => $e->getMessage()]);
            }
        }
    }

    // Générer un token aléatoire
    private function generateToken($length = 25) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $token = '';
        for ($i = 0; $i < $length; $i++) {
            $token .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $token;
    }
}

?>
