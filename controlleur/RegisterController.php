<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


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
                //$photo_profil = isset($_FILES['photo_profil']) ? $_FILES['photo_profil'] : null;

                // Validation des champs
                if (empty($prenom) || !ctype_alpha($prenom)) throw new Exception("Le prénom doit être alphabétique !");
                if (empty($nom) || !ctype_alpha($nom)) throw new Exception("Le nom doit être alphabétique !");
                if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) throw new Exception("Email invalide !");
                if (empty($password) || $password !== $confirm_password) throw new Exception("Mots de passe différents !");
                if (empty($username) || !ctype_alnum($username)) throw new Exception("Nom d'utilisateur invalide !");
                if ($this->userDao->emailExists($email)) throw new Exception("Cet email est déjà utilisé !");
                if ($this->userDao->usernameExists($username)) throw new Exception("Nom d'utilisateur déjà pris !");

                // Gestion de la photo de profil
               /* $photoPath = "avatar_defaut.png";
                if ($photo_profil && $photo_profil['error'] === UPLOAD_ERR_OK) {
                    $allowedExtensions = ['jpeg', 'jpg', 'png'];
                    $fileInfo = pathinfo($photo_profil['name']);
                    $extension = strtolower($fileInfo['extension']);*/

                // Création de l'utilisateur et insertion
                $utilisateur = new Utilisateur($nom, $prenom, $email, $password, /*$photoPath*/);
                $this->userDao->addUser($utilisateur);

                header("Location: /../Projet-Web-I2-Todo-List/Routeur/routeur.php?action=connexion&success=1");
                exit();

            } catch (Exception $e) {
                echo "<script>alert('" . addslashes($e->getMessage()) . "');</script>";
            }
        }
    }
}

?>
