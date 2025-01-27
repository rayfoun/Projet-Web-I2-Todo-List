<html>
    <head>
   
    <script>
        //history.replaceState(null, '', 'Projetweb/To-Do List/connexion');
    </script>
     <!-- Lien vers le fichier CSS -->
    <!--<link rel="stylesheet" type="text/css" href="connexionCSS.php"> -->
    </head>
    <style>
        .container {
            display: flex;
            justify-content: center; /* Centrage horizontal */
            align-items: center;    /* Centrage vertical */
            height: 100vh;          /* Prend toute la hauteur de la page */
            background-color: #f0f0f0; /* Couleur d'arrière-plan pour visualiser */
        }

        .form-container {
            font-family: 'Roboto', sans-serif; 
            width: 320px;
            border-radius: 0.75rem;
            background-color: rgba(17, 24, 39, 1);
            padding: 2rem;
            color: rgba(243, 244, 246, 1);
            align-self: center;
        }
        
        .title {
            text-align: center;
            font-size: 1.5rem;
            line-height: 2rem;
            font-weight: 700;
        }
        
        .form {
            margin-top: 1.5rem;
        }
        
        .input-group {
            margin-top: 0.25rem;
            font-size: 0.875rem;
            line-height: 1.25rem;
        }
        
        .input-group label {
            display: block;
            color: rgba(156, 163, 175, 1);
            margin-bottom: 4px;
        }
        
        .input-group input {
            width: 100%;
            border-radius: 0.375rem;
            border: 1px solid rgba(55, 65, 81, 1);
            outline: 0;
            background-color: rgba(17, 24, 39, 1);
            padding: 0.75rem 1rem;
            color: rgba(243, 244, 246, 1);
        }
        
        .input-group input:focus {
            border-color: rgba(167, 139, 250);
        }
        
        .forgot {
            display: flex;
            justify-content: flex-end;
            font-size: 0.75rem;
            line-height: 1rem;
            color: rgba(156, 163, 175,1);
            margin: 8px 0 14px 0;
        }
        
        .forgot a,.signup a {
            color: rgba(243, 244, 246, 1);
            text-decoration: none;
            font-size: 14px;
        }
        
        .forgot a:hover, .signup a:hover {
            text-decoration: underline rgba(167, 139, 250, 1);
        }
        
        .sign {
            display: block;
            width: 100%;
            background-color: rgba(167, 139, 250, 1);
            padding: 0.75rem;
            text-align: center;
            color: rgba(17, 24, 39, 1);
            border: none;
            border-radius: 0.375rem;
            font-weight: 600;
        }
        
        .social-message {
            display: flex;
            align-items: center;
            padding-top: 1rem;
        }
        
        .line {
            height: 1px;
            flex: 1 1 0%;
            background-color: rgba(55, 65, 81, 1);
        }
        
        .social-message .message {
            padding-left: 0.75rem;
            padding-right: 0.75rem;
            font-size: 0.875rem;
            line-height: 1.25rem;
            color: rgba(156, 163, 175, 1);
        }
        
        .social-icons {
            display: flex;
            justify-content: center;
        }
        
        .social-icons .icon {
            border-radius: 0.125rem;
            padding: 0.75rem;
            border: none;
            background-color: transparent;
            margin-left: 8px;
        }
        
        .social-icons .icon svg {
            height: 1.25rem;
            width: 1.25rem;
            fill: #fff;
        }
        
        .signup {
            text-align: center;
            font-size: 0.75rem;
            line-height: 1rem;
            color: rgba(156, 163, 175, 1);
        }
    </style>
    <body>
        <div class="container">
            <div class="form-container">
                <p class="title"><h1>To-Do List</h1></p>
                <p class="title">Connexion</p>
                <form class="form" id="formlogin" action="/../Projet-Web-I2-Todo-List/Routeur/routeur.php?action=traiterAuthentification" method="POST">
                    <div class="input-group">
                        <label for="email">Identifiant</label>
                        <input type="text" name="email" id="email" placeholder="">
                    </div>
                    <div class="input-group">
                        <label for="password">Mot de passe</label>
                        <input type="password" name="password" id="password" placeholder="">
                        <div class="forgot">
                            <a rel="noopener noreferrer" href="#">Mot de passe oublié ?</a>
                        </div>
                    </div>
                    <button class="sign" type="submit" name="submit" value="Valider">se connecter</button>
                </form>
                <p class="signup">Vous n'avez pas encore de compte?
                    <a rel="noopener noreferrer" href="#" class="">Créer un compte</a>
                </p>
                <div class="social-message">
                    <div class="line"></div>
                    <p class="message">Groupe Projet Web I2 FA</p>
                    <div class="line"></div>
                </div>
            </div>
        </div>
    </body>
</html>
