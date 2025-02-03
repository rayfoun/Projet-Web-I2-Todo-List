<?php
require_once '../Config/bdd.php'; // Inclut la connexion à la base de données
require_once __DIR__ .'/../Modele/DAO/UtilisateurDao.php';
require_once __DIR__.'/DefaultController.php';
//require_once __DIR__.'/UtilisateurDAO.php';

class ControllerProfil extends DefaultController{
    private $utilisateurDAO;
    
    public function afficheProfil($idUser){
        //navbar
        $navbar=$this->renderComponent(__DIR__."/../Vue/composant/navbar.php");
    
        //info compte
        $userDAO=new UtilisateurDao();
        $user=$userDAO->getUserById($idUser);
        $nom=(string)$user->getNom();
        $prenom=(string)$user->getPrenom();
        $email=(string)$user->getEmail();
        $type=(string)$user->getType();
         // Rendu de la vue
         $this->renderView(
            __DIR__ . '/../Vue/page/Profil.php', // Correction du chemin
            [
                'navbar'=>$navbar,
                'nom'=>$nom,
                'prenom'=>$prenom,
                'email'=>$email,
                'type'=>$type
                ]
            );
    }

    function supprimerCompteUtilisateur($id){
        //$this->utilisateurDAO->supprimerUtilisateur($id);
    }

    function creerCompteUtilisateur(){
        
    }

    function supprimerCompte(){
        
    }

    function modifierCompte(){
        
    }
     // 3️ Modifier un utilisateur
     public function modifierProfil() {
        $this->userDao = new UtilisateurDao();
        
        if(!$this->utilisateurDAO){
            $this->utilisateurDAO=new UtilisateurDao();
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST") {


            $id = intval($_POST['id']);
            $nom = htmlspecialchars($_POST['nom']);
            $prenom = htmlspecialchars($_POST['prenom']);
            $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
            $type = htmlspecialchars($_POST['type']);

            $utilisateur = new Utilisateur($id, $nom, $prenom, $email, null, null, $type, null, null);
            $this->utilisateurDAO->updateUser($utilisateur);

            header("Location: /admin/utilisateurs");
            exit;
        }
    }

    // 4️ Supprimer un utilisateur
    public function supprimerProfil($id) {

        if(!$this->utilisateurDAO){
            $this->utilisateurDAO=new UtilisateurDao();
        }
        $this->utilisateurDAO->deleteUser($id);
        header("Location: /admin/utilisateurs");
        exit;
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
                $userDao = new UtilisateurDao();

                // Validation des champs
                if (empty($prenom) || !ctype_alpha($prenom)) throw new Exception("Le prénom doit être alphabétique !");
                if (empty($nom) || !ctype_alpha($nom)) throw new Exception("Le nom doit être alphabétique !");
                if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) throw new Exception("Email invalide !");
                if (empty($password) || $password !== $confirm_password) throw new Exception("Mots de passe différents !");
                if (empty($username) || !ctype_alnum($username)) throw new Exception("Nom d'utilisateur invalide !");
                if ($userDao->emailExists($email)) throw new Exception("Cet email est déjà utilisé !");
                if ($userDao->usernameExists($username)) throw new Exception("Nom d'utilisateur déjà pris !");

                // Hachage du mot de passe
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
               
                // Création de l'utilisateur avec le token et la photo de profil
                $utilisateur = new Utilisateur($nom, $prenom, $email, $hashedPassword, $token, /*$photoPath*/);
                $userDao->addUser($utilisateur);

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