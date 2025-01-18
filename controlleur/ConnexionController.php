<?php
    session_start();
    require_once __DIR__.'/DefaultController.php';
    require_once '/Config/bdd.php';

    class ControllerConnexion extends DefaultController{

        private $db;
        
        function affichePageConnexion(){
            #$cssfile = $this->renderComponent(__DIR__."/../Vue/connexion/connexionCSS.php");
            $this->renderView(
                 __DIR__."/../Vue/connexion/connexion.php"
            );
        } 
        
        function login(){
            global $pdo;
            // on devrait vérifier qu'ils sont set
            $email = $_POST["email"];
            $password = $_POST["password"];
    
            $textR = "select password, type";
            $textR.= "from users";
            $textR.= "where email_user=:email";
            $req = $pdo->prepare($textR);
            $req->bindParam(":email", $email);
            #$req->bindParam(":password", $password);
            $req->execute();
    
            //Récupération du tableau des résultats
            $tabRes = $req->fetchAll(PDO::FETCH_ASSOC);

            //Vérification de l'existence de l'utilisateur
            if (count($tabRes)!=1) {
                // pas trouvé => retour au formulaire de co
                // die("Erreur de co");
                header("Location: /Routeur/routeur.php");
                exit();
            }    
            
            //Vérification du mot de passe crypté
            if (!password_verify($password, $tabRes[0]['password'])) {
                // Mot de passe incorrect
                header("Location: /Routeur/routeur.php");
                exit();
            }

            // Authentification réussie
            //Enregistrement des informations dans la session
            $_SESSION["email"] = $email;  
            $_SESSION["type"] = $tabRes[0]["type"];
            
            // Redirection vers la page d'accueil
            header("Location: /Routeur/routeur.php?action=accueil");
        }
    }
?>