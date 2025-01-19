<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Formulaire Aligné à Droite</title>
        <style>
            /*body*/
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                display: flex;
                align-items: center;
                min-height: 100vh;
                background-color: #f9f9f9;
            }
            form {
                display: flex;
                flex-direction: column;
                gap: 8px;
                width: 100%;
            }
            label {
                font-weight: bold;
            }
            input, textarea, select {
                width: 100%;
                padding: 8px;
                font-size: 14px;
                border: 1px solid #ccc;
                border-radius: 5px;
            }
            textarea {
                resize: vertical;
            }
            
            /*la navbar*/
            .outline {
                position: absolute;
                inset: 0;
                pointer-events: none;
            }
            .rect {
                stroke-dashoffset: 5;
                stroke-dasharray: 0 0 10 40 10 40;
                transition: 0.5s;
                stroke: #333;
            }
            .nav {
                position: fixed;
                width: 400px;
                height: 60px;
                top:1%;
                left: 1%;
            }
            .container_nav:hover .outline .rect {
                transition: 999999s;
                /* Must specify these values here as something *different* just so that the transition works properly */
                stroke-dashoffset: 1;
                stroke-dasharray: 0;
            }
            .container_nav {
                position: absolute;
                inset: 0;
                background: #f0f0f0;
                display: flex;
                flex-direction: row;
                justify-content: space-around;
                align-items: center;
                padding: 0.5em;
            }
            .btn {
                padding: 0.5em 1.5em;
                color: #333;
                cursor: pointer;
                transition: 0.1s;
            }
            .btn:hover {
                background:  #e2e2e2;
            }

             /*Filtre de recherche*/
             .container_filtre {
                display: flex;
                flex-direction: column;
                align-items: center; /* Aligne tous les éléments au centre */
                margin-top: 20px;
                position:fixed;
                top:20%;
                left:3%;
                transform: translateX(25%);  /* Pas de décalage initial */
                opacity: 1; /* Transparent au départ */
                transition: transform 0.4s ease; /* Transition fluide */
            }
            .container_filtre.active{
                transform: translateX(0); /* Position finale */
                opacity: 1; /* Complètement opaque */
            }
            .container_filtre h2 {
                display: inline-block; /* Pour garder le titre à côté du bouton */
                margin-right: 10px; /* Espace entre le titre et le bouton */
            }
            .input_filtre {
                max-width: 190px;
                background-color: #f5f5f5;
                color: #242424;
                padding: .15rem .5rem;
                min-height: 40px;
                border-radius: 4px;
                outline: none;
                border: none;
                line-height: 1.15;
                box-shadow: 0px 10px 20px -18px;
            }
            .input_filtre:focus {
                border-bottom: 2px solid #5b5fc7;
                border-radius: 4px 4px 2px 2px;
            }
            .input_filtre:hover {
                outline: 1px solid lightgrey;
            }

             /*button ajouter*/ 
             .button_add {
                position: relative;
                width: 150px;
                height: 40px;
                cursor: pointer;
                display: flex;
                align-items: center;
                border: 1px solid #34974d;
                background-color: #3aa856;
                margin-left: 10px;
                }
            .button_add, .button__icon, .button__text {
                transition: all 0.3s;
            }
            .button_add .button__text {
                transform: translateX(30px);
                color: #fff;
                font-weight: 600;
            }
            .button_add .button__icon {
                position: absolute;
                transform: translateX(109px);
                height: 100%;
                width: 39px;
                background-color: #34974d;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .button_add .svg {
                width: 30px;
                stroke: #fff;
            }
            .button_add:hover {
                background: #34974d;
            }
            .button_add:hover .button__text {
                color: transparent;
            }
            .button_add:hover .button__icon {
                width: 148px;
                transform: translateX(0);
            }
            .button_add:active .button__icon {
            background-color: #2e8644;
            }
            .button_add:active {
                border: 1px solid #2e8644;
            }

            /*Liste de tâche*/
            .divListeTache{
                position: fixed;
                top: 45%;
                left: 15%;
                /*transform: translate(10%, 0%);  Déplace le div pour le centrer */
                height:50% ;
                bottom:3% ;
                width: 450px;
                display: block;
                box-sizing: border-box;/*ajoute le padding au elements du scroll*/ 
                justify-content: center;
                flex-direction: column;
                transform: translateX(48%);  /* Pas de décalage initial */
                opacity: 1; /* Transparent au départ */
                transition: transform 0.4s ease; /* Transition fluide */
                overflow-y:auto; /* Permet de faire défiler le contenu verticalement */
                background: #f1f1f1;
                background-image: linear-gradient(90deg,transparent 50px,#ffb4b8 50px, #ffb4b8 52px,transparent 52px),linear-gradient(#e1e1e1 0.1em, transparent 0.1em);
                background-size: 100% 30px;
                border-radius: 15px;
                /*padding-bottom:500px;
                padding-top: 410px;   Ajoutez un padding-top pour décaler un peu le contenu */
            }
            .divListeTache.active{
                transform: translateX(0); /* Position finale */
                opacity: 1; /* Complètement opaque */
            }
            .button_liste {
                display: inline-block;
                border-radius: 7px;
                font-family: 'Freestyle Script';
                background-color: transparent;
                border: none;
                color: black;
                text-align: left;
                font-size: 17px;
                padding: 12px;
                width:95%;
                transition: all 0.5s;
                cursor: pointer;
                margin: 5px;
            }
            .button_liste span {
                cursor: pointer;
                display: inline-block;
                position: relative;
                transition: 0.5s;
                font-size: 30px;
            }
            .button_liste span:after {
                content: '»';
                position: absolute;
                opacity: 0;
                top: 0;
                right: -15px;
                transition: 0.5s;
            }
            .button_liste:hover span {
                padding-right: 15px;
            }
            .button_liste:hover span:after {
                opacity: 1;
                right: 0;
            }

            /*checkbox*/
            .checkbox-wrapper input[type="checkbox"] {
                visibility: hidden;
                display: none;
            }
            .checkbox-wrapper *,.checkbox-wrapper ::after,.checkbox-wrapper ::before {
                box-sizing: border-box;
                user-select: none;
            }
            .checkbox-wrapper {
                position: relative;
                overflow: hidden;
                display: flex;
                align-items: center;
            }
            .checkbox-wrapper .label {
                cursor: pointer;
            }
            .checkbox-wrapper .check {
                width: 50px;
                height: 50px;
                position: absolute;
                opacity: 0;
            }
            .checkbox-wrapper .label svg {
                vertical-align: middle;
            }
            .checkbox-wrapper .path1 {
                stroke-dasharray: 400;
                stroke-dashoffset: 400;
                transition: .5s stroke-dashoffset;
                opacity: 0;
            }
            .checkbox-wrapper .check:checked + label svg g path {
                stroke-dashoffset: 0;
                opacity: 1;
            }

            /*form*/
            .information {
                width: 30%;
                background: #fff;
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
                display: none; /* Masque le formulaire par défaut */
                position: fixed;
                left: 66%;
                width: 30%;
                /*right: -100%;  Position initiale hors écran à droite */
                flex-direction: column;
                align-items: center; /* Centre les éléments à l'intérieur */
                transform: translateX(30%);  /* Pas de décalage initial */
                opacity: 0; /* Transparent au départ */
                transition: transform 0.4s ease, opacity 0.4s ease; /* Transition fluide */
            }
            .information.active{
                transform: translateX(0); /* Position finale */
                opacity: 1; /* Complètement opaque */
            }
            .information h1 {
                text-align: center;
                margin-bottom: 10px;
            }
            .buttons_form {
                display: flex;
                justify-content: space-between; /* Aligne les boutons horizontalement */
                margin-top: 20px;
            }
            .buttons_form button {
                padding: 10px 20px;
                font-size: 14px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
            }
            .buttons_form .add {
                background-color: #007BFF;
                color: white;
            }
            .buttons_form .add:hover {
                background-color: #0056b3;
            }
            .buttons_form .cancel {
                background-color: #6c757d;
                color: white;
            }
            .buttons_form .cancel:hover {
                background-color: #5a6268;
            }
            .buttons_form .delete {
                background-color: #dc3545;
                color: white;
            }
            .buttons_form .delete:hover {
                background-color: #c82333;
            }
        </style>
    </head>
    <body>
        <!--La navbar-->
        <div class="nav">
            <div class="container_nav">
            <div class="btn">To-Do List</div>
            <div class="btn">Profil</div>
            <svg class="outline" overflow="visible" width="400" height="60" viewBox="0 0 400 60" xmlns="http://www.w3.org/2000/svg">
                <rect class="rect" pathLength="100" x="0" y="0" width="400" height="60" fill="transparent" stroke-width="5"></rect>
            </svg>
            </div>
        </div>

        <!--Le filtre de recherche-->
        <div class="container_filtre">
            <div style=" display: flex;align-items: center;">
                <h2 style="text-align: center">Liste de tâche</h2>
                
                <button class="button_add" id="button_add" type="button">
                    <span class="button__text">Tâche</span>
                    <span class="button__icon"><svg class="svg" fill="none" height="24" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><line x1="12" x2="12" y1="5" y2="19"></line><line x1="5" x2="19" y1="12" y2="12"></line></svg></span>
                </button>
            </div>
            <div style=" display: flex;align-items: center;">
                <input class="input_filtre" name="text" placeholder="Titre..." type="search">
                <input class="input_filtre" name="text" placeholder="statut..." type="search">
                <input class="input_filtre" name="text" placeholder="Priorite..." type="search">
                <input class="input_filtre" name="text" placeholder="Assigne..." type="search">
            </div>
        </div>

        <!--La liste de tâche-->
        <div class=divListeTache id="divListeTache">
            <?=$listeTache?> 
        </div>

        <!--Le formulaire-->
        <div class="information" id="taskForm">
            <h1>Information</h1>
            <form id="Form"action="/../Projet-Web-I2-Todo-List/Routeur/routeur.php?action=saveTache" method="POST">
                <label for="titre">Titre :</label>
                <input id="titre" required type="text" name="titre" value="<?= htmlspecialchars($titre) ?>">

                <label for="description">Description :</label>
                <textarea id="description" required name="description" placeholder="Écrivez votre description ici..."><?= htmlspecialchars($description) ?></textarea>

                <label for="date">Date limite :</label>
                <input id="date" required type="date" name="date" value="<?= htmlspecialchars($date) ?>">

                <label for="statut">Statut :</label>
                <select id="statut" name="statut" required>
                    <option value="" disabled selected>-- Sélectionnez une option --</option>
                    <option value="En cours" <?= $statut == 'En cours' ? 'selected' : null ?>>En cours</option>
                    <option value="En Attente" <?= $statut == 'En Attente' ? 'selected' : null ?>>En Attente</option>
                    <option value="Termine" <?= $statut == 'Termine' ? 'selected' : null ?>>Terminé</option>
                </select>

                <label for="priorite">Priorité :</label>
                <select id="priorite" name="priorite" required>
                    <option value="" disabled selected>-- Sélectionnez une option --</option>
                    <option value="Important" <?= $priorite == 'Important' ? 'selected' : '' ?>>Important</option>
                    <option value="Moyenne" <?= $priorite == 'Moyenne' ? 'selected' : '' ?>>Moyenne</option>
                    <option value="Faible" <?= $priorite == 'Faible' ? 'selected' : '' ?>>Faible</option>
                </select>
                </select>

                <label >Assigné :</label>
                <input  required type="search" name="assigne" list="assigne-list" placeholder="Entrez un nom..." value="<?= htmlspecialchars($assigne) ?>">
                <datalist id="assigne-list">
                    <!-- Ces options sont générées dynamiquement par le serveur -->
                    <?=$listeUser?>
                </datalist>

                <label >Categorie :</label>
                <input  required type="search" name="categorie" list="categorie-list" placeholder="Entrez une categorie...">
                <datalist id="categorie-list">
                    <!-- Ces options sont générées dynamiquement par le serveur -->
                    <option value="personnel" <?= $categorie == 'personnel' ? 'selected' : '' ?>></option>
                    <option value="Au travail" <?= $categorie == 'Au travail' ? 'selected' : '' ?>></option>
                </datalist>

                <div class="buttons_form" id="buttons_form">
                    <?=$buttonForm?>
                </div>
            </form>
        </div>

        <script>
            function deleteTache() {
                // Exemple de requête fetch pour appeler un contrôleur
                fetch('/delete', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ id: '12345' }) // Exemple de données envoyées
                })
                .then(response => {
                    if (response.ok) {
                        alert('Élément supprimé avec succès !');
                        window.location.href = '/home'; // Redirection après suppression
                    } else {
                        alert('Erreur lors de la suppression.');
                    }
                })
                .catch(error => {
                    console.error('Erreur:', error);
                    alert('Une erreur est survenue.');
                });
            }
        </script>
        <!-- javaScript lorsqu'on appui su button_add le formulaire apparait-->
        <script>
           document.addEventListener('DOMContentLoaded', function () {
                const button = document.getElementById('button_add'); // Bouton Add
                const buttonTaches = document.querySelectorAll('.button_liste');//les boutons de liste tache
                const divForm = document.getElementById('taskForm'); // div Formulaire
                const form = document.getElementById('Form'); // div Formulaire
                const taskListDiv = document.querySelector('.divListeTache'); // Div de la liste des tâches
                const container_filtre = document.querySelector('.container_filtre'); // Div des filtres
                
                let lastClickedButton ='add'; // Variable pour mémoriser le dernier bouton cliqué

                // Fonction pour envoyer une requête AJAX pour mettre à jour les boutons de formulaire
                function updateButtonForm(mode) {
                    let xhr = new XMLHttpRequest();
                    xhr.open('GET', '/../Projet-Web-I2-Todo-List/Routeur/routeur.php?action=updateButtonForm&mode=' + mode, true);

                    xhr.onload = function() {
                        if (xhr.status === 200) {
                            try {
                                let response = JSON.parse(xhr.responseText);
                                console.log('Réponse serveur :', response); // Tente de parser la réponse JSON

                                if (response.status === 'success') {
                                    // Mettre à jour la section des boutons avec le nouveau bouton
                                    document.getElementById('buttons_form').innerHTML = response.buttonForm;

                                     // Réaffecter l'événement au bouton "cancel"
                                    const buttonCancel = document.getElementById('cancel');
                                    if (buttonCancel) {
                                        buttonCancel.addEventListener('click', AnimationArriere);
                                    }

                                    // Ajouter l'écouteur d'événements au bouton ajouter
                                    const buttonAdd = document.getElementById('add');
                                    buttonAdd.addEventListener('click', function (event) {
                                        if (isFormValid()) {
                                            AnimationArriere()
                                            // Attendre la fin de l'animation (400 ms) avant de soumettre le formulaire
                                            setTimeout(function () {
                                                    form.submit();  // Si le formulaire existe, soumettre
                                                updateListTask();
                                            }, 500);
                                        }else{
                                            form.reportValidity();  // Affiche les bulles de message si le formulaire n'est pas valide
                                        }
                                    });

                                } else {
                                    console.error('Erreur : ' + response.message);
                                }
                            } catch (e) {
                                console.error('Erreur de parsing JSON :', e);
                            }
                        } else {
                            console.error('Erreur de serveur :', xhr.status);
                        }
                    };

                    xhr.send(); // Envoi de la requête
                }

                function updateListTask() {
                    let xhr = new XMLHttpRequest();
                    xhr.open('GET', '/../Projet-Web-I2-Todo-List/Routeur/routeur.php?action=updateListTask', true);

                    xhr.onload = function() {
                        if (xhr.status === 200) {
                            try {
                                let response = JSON.parse(xhr.responseText);
                                console.log('Réponse serveur :', response); // Tente de parser la réponse JSON

                                if (response.status === 'success') {
                                    // Mettre à jour la section de la liste de tache
                                    document.getElementById('divListeTache').innerHTML = response.listeTache;
                                } else {
                                    console.error('Erreur : ' + response.message);
                                }
                            } catch (e) {
                                console.error('Erreur de parsing JSON :', e);
                            }
                        } else {
                            console.error('Erreur de serveur :', xhr.status);
                        }
                    };

                    xhr.send(); // Envoi de la requête
                }

                function updateFromTask(id) {
                    let xhr = new XMLHttpRequest();
                    xhr.open('GET', '/../Projet-Web-I2-Todo-List/Routeur/routeur.php?action=updateFromTask&id='+id, true);

                    xhr.onload = function() {
                        if (xhr.status === 200) {
                            console.log('Réponse brute du serveur:', xhr.responseText); // Affiche la réponse brute avant le parsing

                            try {
                                let response = JSON.parse(xhr.responseText);
                                console.log('Réponse JSON parsée:', response);

                                if (response.status === 'success') {
                                    // Mettre à jour le formulaire avec les données de la tâche
                                    divForm.innerHTML = response.form;
                                } else {
                                    console.error('Erreur : ' + response.message);
                                }
                            } catch (e) {
                                console.error('Erreur de parsing JSON :', e);
                            }
                        } else {
                            console.error('Erreur du serveur :', xhr.status);
                        }
                    };

                    xhr.onerror = function() {
                        console.error('Erreur de requête AJAX');
                    };

                    xhr.send();  // Envoi de la requête
                }

                function isFormValid() {
                    const requiredFields = form.querySelectorAll('[required]');
                    return Array.from(requiredFields).every(field => field.value.trim() !== '');
                }
                
                function AnimationAvant() {
                    if (!divForm.classList.contains('active')) {
                        divForm.style.display = 'flex'; // Rendre le formulaire visible pour la transition
                        setTimeout(() => {
                            divForm.classList.add('active');
                            taskListDiv.classList.add('active');
                            container_filtre.classList.add('active');
                        }, 10);
                    } 
                }function AnimationArriere() {
                    if(divForm.classList.contains('active')){
                        divForm.classList.remove('active');
                        taskListDiv.classList.remove('active');
                        container_filtre.classList.remove('active');
                        setTimeout(() => {
                            divForm.style.display = 'none'; // Masquer complètement après l'animation
                        }, 400); // Délai correspondant à la durée de la transition
                    }

                }

                // Gestion des clics sur les boutons de tâches
                buttonTaches.forEach(tache => {
                    tache.addEventListener('click', function () {
                        if (lastClickedButton !== 'tache') {
                            lastClickedButton = 'tache'; // Met à jour le dernier bouton cliqué
                        }
                        if (divForm.classList.contains('active')) {
                            AnimationArriere();
                            setTimeout(function () {
                                updateButtonForm('update');
                                updateFromTask(tache.getAttribute('id'));
                                AnimationAvant();
                            }, 500);
                        } else {
                            updateButtonForm('update');
                            updateFromTask(tache.getAttribute('id'));
                            AnimationAvant();
                        }
                    });
                });

                // Gestion des clics sur le bouton Ajouter
                button.addEventListener('click', function () {
                    if (lastClickedButton !== 'add') {
                        lastClickedButton = 'add'; // Met à jour le dernier bouton cliqué
                        if (divForm.classList.contains('active')) {
                                AnimationArriere();
                                setTimeout(function () {
                                    updateButtonForm('add');
                                    updateFromTask(null);
                                    AnimationAvant();
                                }, 500);
                            } else {
                                updateButtonForm('add');
                                updateFromTask(null);
                                AnimationAvant();
                            }
                    }else{
                        updateButtonForm('add');
                        updateFromTask(null);
                        if (divForm.classList.contains('active')) {
                            AnimationArriere();
                        } else {
                            AnimationAvant();
                        }
                    }
                });
                
            });
        </script>

    </body>
</html>


           
