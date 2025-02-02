<?php
 
    require_once __DIR__.'/DefaultController.php';
    require_once '../Config/bdd.php';

    class ControllerConnexion extends DefaultController{

        private $db;
        
        function affichePageConnexion(){
            $this->renderView(
                 __DIR__."/../Vue/page/Connexion.php"
            );
        } 
        
        function login(){
            global $pdo;
            $database = new Database();
            $pdo = $database->getConnection();
            // on devrait vérifier qu'ils sont set
            $email = $_POST["email"];
            $password = $_POST["password"];
    
            $textR = "select password_user, type, id_user ";
            $textR.= "from users ";
            $textR.= "where email_user=:email";
            $req = $pdo->prepare($textR);
            $req->bindParam(":email", $email);
            #$req->bindParam(":password", $password);
            $req->execute();
    
            //Récupération du tableau des résultats
            $tabRes = $req->fetchAll(PDO::FETCH_ASSOC);
            $var=count($tabRes);
            echo $var;

            $hashedPassword = $tabRes[0]['password_user'];
            
            //Vérification de l'existence de l'utilisateur
            if (count($tabRes)!=1) {
                // pas trouvé => retour au formulaire de co
                // die("Erreur de co");
                header("Location: /../Projet-Web-I2-Todo-List/Routeur/routeur.php");
                echo "Nom d'utilisateur incorrect";
                exit();
            }    
            
            //Vérification du mot de passe crypté
            if (!password_verify($password, $hashedPassword)) {
                // Mot de passe incorrect
                header("Location: /../Projet-Web-I2-Todo-List/Routeur/routeur.php");
                echo "Mot de passe incorrect";
                exit();
            }
            echo "Tres bonne connexion amigo";

            // Authentification réussie
            //Enregistrement des informations dans la session
            $_SESSION["id_user"] = $tabRes[0]["id_user"];  
            $_SESSION["type"] = $tabRes[0]["type"];

            // Redirection vers la page d'accueil
            header("Location:/../Projet-Web-I2-Todo-List/Routeur/routeur.php?action=accueil");
        }

        function logout(){
            // Déconnexion et suppression de la session
            session_destroy();

            // Redirection vers la page de connexion
            header("Location:/../Projet-Web-I2-Todo-List/Routeur/routeur.php");

        }
    }
?>