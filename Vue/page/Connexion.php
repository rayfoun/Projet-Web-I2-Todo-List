<html>
    <head>
        <style>
             .container {
                width: 100%;
                height: 100%;
                background: #f1f1f1;
                background-image: linear-gradient(
                    90deg,
                    transparent 50px,
                    #ffb4b8 50px,
                    #ffb4b8 52px,
                    transparent 52px
                    ),
                    linear-gradient(#e1e1e1 0.1em, transparent 0.1em);
                background-size: 100% 30px;
            }
            .container_form{
                position: absolute;
                left:38%;
                top:25%;
            }

            .form {
            background-color: #fff;
            font-family: 'Freestyle Script';
            font-size: 20px;
            display: block;
            padding: 1rem;
            max-width: 350px;
            border-radius: 0.5rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            }

            .form-title {
            font-weight: 600;
            text-align: center;
            color: #000;
            }

            .input-container {
            position: relative;
            font-size: 20px;
            }

            .input-container input, .form button {
            outline: none;
            border: 1px solid #e5e7eb;
            margin: 8px 0;
            }

            .input-container input {
            background-color: #fff;
            padding: 1rem;
            padding-right: 3rem;
            font-size: 0.875rem;
            line-height: 1.25rem;
            width: 300px;
            border-radius: 0.5rem;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            }

            .submit {
            display: block;
            padding-top: 0.75rem;
            padding-bottom: 0.75rem;
            padding-left: 1.25rem;
            padding-right: 1.25rem;
            background-color: #4F46E5;
            color: #ffffff;
            font-size: 0.875rem;
            line-height: 1.25rem;
            font-weight: 500;
            width: 100%;
            border-radius: 0.5rem;
            text-transform: uppercase;
            }

            .signup-link {
            color: #c063b7;
            font-size: 0.875rem;
            line-height: 1.25rem;
            text-align: center;
            }

            .signup-link a {
            text-decoration: underline;
            }

             /* ====== Style pour la popup ====== */
             .error-popup {
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                background: #ffdddd;
                color: #d8000c;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
                display: none; /* Caché par défaut */
                width: 300px;
                text-align: center;
            }

            .error-popup button {
                background: #d8000c;
                color: white;
                border: none;
                padding: 8px 12px;
                margin-top: 10px;
                cursor: pointer;
                border-radius: 5px;
            }

            .error-popup button:hover {
                background: #a60008;
            }

        </style>
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
         <!-- Script pour afficher le message d'erreur -->
        <!-- Popup d'erreur -->
        <div id="errorPopup" class="error-popup">
            <p id="errorMessage"></p>
            <button onclick="closePopup()">OK</button>
        </div>

        <!-- Script pour afficher le message d'erreur -->
        <script>
            window.onload = function() {
                <?php if(isset($_SESSION['error'])): ?>
                    document.getElementById("errorMessage").textContent = "<?= $_SESSION['error']; ?>";
                    document.getElementById("errorPopup").style.display = "block"; // Afficher la popup
                    <?php unset($_SESSION['error']); ?> // Supprimer l'erreur après affichage
                <?php endif; ?>
            }

            function closePopup() {
                document.getElementById("errorPopup").style.display = "none";
            }
        </script>
    </body>
</html>