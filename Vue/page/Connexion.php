<html>
    <head>
        <!--css de la page connexion-->
        <?=$themeConnex?>
    </head>
    <body>
        <div class="container">
            <div class="container_form">
                <form class="form" id="formlogin" action="/../Projet-Web-I2-Todo-List/Routeur/routeur.php?action=traiterAuthentification" method="POST" autocomplete="off">
                    <h2>To-Do List</h2>
                    
                    <div class="input-container">
                        <input type="email" name="email" id="email" placeholder="Enter email" autocomplete="email">
                        <span>
                        </span>
                    </div>
                    <div class="input-container">
                        <input type="password" name="password" id="password" placeholder="Enter password" autocomplete="password">
                    </div>
                    <button type="submit" class="submit" name="submit" value="Valider">Connexion</button>
                    <p class="signup-link">
                        __________ProjetWebI2___________
                    </p>
                </form>
            </div>
        </div>
    </body>
</html>