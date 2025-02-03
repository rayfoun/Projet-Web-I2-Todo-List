       <!-- Partie javascript de la page d'acceuil-->
       <script>
           document.addEventListener('DOMContentLoaded', function () {
//Definition de declaration des elements*******************************************************************************************************************************************************************
                const button = document.getElementById('button_add'); // Bouton Add
                const buttonTaches = document.querySelectorAll('.button_liste');//les boutons de liste tache
                const divForm = document.getElementById('taskForm'); // div Formulaire
                const form = document.getElementById('Form'); // Formulaire
                const taskListDiv = document.querySelector('.divListeTache'); // Div de la liste des tâches
                const container_filtre = document.querySelector('.container_filtre'); // Div des filtres
                const checks = document.querySelectorAll('.check');//les checkbox des boutons de liste tache
                const filtres = document.querySelectorAll('.input_filtre');//filtre de recherche
                const searchButton = document.getElementById("button_search");//button recherche
                const SearchForm = document.getElementById('form_search'); // Formulaire de recherche
                const deconButton = document.getElementById("deconnexion");//button deconnexion
                const profButton = document.getElementById("profil");//button de profil
                const toDoButton = document.getElementById("toDoList");//button d'acceuil
            
                let lastClickedButton ='add'; // Variable pour mémoriser le dernier bouton cliqué

//fonction sans AJAX*******************************************************************************************************************************************************************

                function isFormValid() {// Fonction pour vérifier si le formulaire d'add , supp et upd est valide
                    const requiredFields = form.querySelectorAll('[required]');
                    return Array.from(requiredFields).every(field => field.value.trim() !== '');
                }
                
                function AnimationAvant() {// Fonction pour l'annimation avant du formulaire
                    if (!divForm.classList.contains('active')) {
                        divForm.style.display = 'flex'; // Rendre le formulaire visible pour la transition
                        setTimeout(() => {
                            divForm.classList.add('active');
                            taskListDiv.classList.add('active');
                            container_filtre.classList.add('active');
                        }, 10);
                    } 
                }

                function AnimationArriere() {//Fonction pour l'annimation arriere du formulaire
                    if(divForm.classList.contains('active')){
                        divForm.classList.remove('active');
                        taskListDiv.classList.remove('active');
                        container_filtre.classList.remove('active');
                        setTimeout(() => {
                            divForm.style.display = 'none'; // Masquer complètement après l'animation
                        }, 400); // Délai correspondant à la durée de la transition
                    }

                }

//fonction AJAX*******************************************************************************************************************************************************************
                
                function updateButtonForm(mode) {// Fonction pour envoyer une requête AJAX pour mettre à jour les boutons de formulaire
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
                                    if(buttonAdd){
                                        buttonAdd.addEventListener('click', function (event) {
                                            if (isFormValid()) {
                                                AnimationArriere()
                                                // Attendre la fin de l'animation (400 ms) avant de soumettre le formulaire
                                                setTimeout(function () {
                                                        form.action = '/../Projet-Web-I2-Todo-List/Routeur/routeur.php?action=saveTache';
                                                        form.submit();  // Si le formulaire existe, soumettre
                                                        updateListTask("accueil");
                                                }, 500);
                                            }else{
                                                form.reportValidity();  // Affiche les bulles de message si le formulaire n'est pas valide
                                            }
                                        });

                                    }


                                    // Ajouter l'ecouteur du button modifier
                                    const buttonUpd = document.getElementById('update');
                                    if(buttonUpd){
                                        buttonUpd.addEventListener('click', function (event) {
                                            if (isFormValid()) {
                                                event.preventDefault(); 
                                                AnimationArriere()
                                                // Attendre la fin de l'animation (400 ms) avant de soumettre le formulaire
                                                setTimeout(function () {
                                                        form.action = '/../Projet-Web-I2-Todo-List/Routeur/routeur.php?action=updateTache&id='+document.querySelector('.Task').id;
                                                        form.submit();  // Si le formulaire existe, soumettre
                                                        updateListTask("accueil");
                                                }, 500);
                                            }else{
                                                form.reportValidity();  // Affiche les bulles de message si le formulaire n'est pas valide
                                            }
                                        });

                                    }

                                    // Ajouter l'ecouteur du button supprimer
                                    const buttonDet = document.getElementById('delete');
                                    if(buttonDet){
                                        buttonDet.addEventListener('click', function (event) {
                                            if (isFormValid()) {
                                                AnimationArriere()
                                                // Attendre la fin de l'animation (400 ms) avant de soumettre le formulaire
                                                setTimeout(function () {
                                                    window.location.href = '/../Projet-Web-I2-Todo-List/Routeur/routeur.php?action=deleteTache&id=' + document.querySelector('.Task').id;
                                                    updateListTask("accueil");
                                                }, 500);
                                            }else{
                                                form.reportValidity();  // Affiche les bulles de message si le formulaire n'est pas valide
                                            }
                                        });

                                    }
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

                function updateListTask(mode) {// Fonction pour envoyer une requête AJAX pour mettre à jour la liste de taches
                    let xhr = new XMLHttpRequest();
                    xhr.open('GET', '/../Projet-Web-I2-Todo-List/Routeur/routeur.php?action=updateListTask&mode='+mode, true);

                    xhr.onload = function() {
                        if (xhr.status === 200) {
                            try {
                                let response = JSON.parse(xhr.responseText);
                                console.log('Réponse serveur :', response); // Tente de parser la réponse JSON

                                if (response.status === 'success') {
                                    // Mettre à jour la section de la liste de tache
                                    document.getElementById('container_filtre2').innerHTML = response.listeTache;
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

                function updateFromTask(id) {// Fonction pour envoyer une requête AJAX pour mettre à jour le formulaire lorsqu'on clique sur une tache
                    let xhr = new XMLHttpRequest();
                    xhr.open('GET', '/../Projet-Web-I2-Todo-List/Routeur/routeur.php?action=updateFromTask&id=' + id, true);

                    xhr.onload = function () {
                        if (xhr.status === 200) {
                            try {
                                let response = JSON.parse(xhr.responseText);
                                console.log('Réponse JSON parsée:', response);

                                if (response.status === 'success') {
                                    // Mettre à jour les champs du formulaire
                                    
                                    document.getElementById('titre').value = response.titre || '';
                                    document.getElementById('description').value = response.description || '';
                                    document.getElementById('date').value = response.date || '';
                                    document.getElementById('statut').value = response.statut || '';
                                    document.getElementById('priorite').value = response.priorite || '';
                                    document.getElementById('assigne').value = response.assigne || '';
                                    document.getElementById('categorie').value = response.categorie || '';
                                    document.querySelector('.Task').id=response.id ||'';
                                } else {
                                    console.error('Erreur :', response.message);
                                }
                            } catch (e) {
                                console.error('Erreur de parsing JSON :', e);
                            }
                        } else {
                            console.error('Erreur du serveur :', xhr.status);
                        }
                    };

                    xhr.onerror = function () {
                        console.error('Erreur de requête AJAX');
                    };

                    xhr.send();
                }

                function updateLoader() {//fonction  AJAX qui affiche le loader si la liste est vide
                    let xhr = new XMLHttpRequest();
                    xhr.open('GET', '/../Projet-Web-I2-Todo-List/Routeur/routeur.php?action=updateLoader', true);

                    xhr.onload = function() {
                        if (xhr.status === 200) {
                            try {
                                let response = JSON.parse(xhr.responseText);
                                console.log('Réponse serveur :', response); // Tente de parser la réponse JSON

                                if (response.status === 'success') {
                                    // Mettre à jour la section de la liste de tache
                                    document.getElementById('container_filtre1').innerHTML = response.loader;
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


// Gestion des clics sur les boutons de tâches**********************************************************************************************************************************************
                 //gestion des button pour caheque taches
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

                //gestion des checkbox
                checks.forEach(box=>{
                    if (box.disabled) {
                        // Si elle n'est pas désactivée, on la coche et on la désactive
                        setTimeout(function () {
                            box.checked = true;
                            }, 500);
                    }else{
                        box.disabled = true;
                    }
                });
//button de navigation*******************************************************************************************************************************************************************
                deconButton.addEventListener('click', function () {
                    window.location.href = "/../Projet-Web-I2-Todo-List/Routeur/routeur.php";
                });
                profButton.addEventListener('click', function () {
                    window.location.href = "/../Projet-Web-I2-Todo-List/Routeur/routeur.php?action=profil";
                });
                toDoButton.addEventListener('click', function () {
                    window.location.href = "/../Projet-Web-I2-Todo-List/Routeur/routeur.php?action=accueil";
                });
//Recherche et filtre de recherche*******************************************************************************************************************************************************************
                //gestion des filtres
                filtres.forEach(filtre=>{
                    filtre.addEventListener('keydown', (event) => {
                        if (event.key === 'Enter') {
                            event.preventDefault(); // Empêche le comportement par défaut du formulaire si nécessaire
                            const inputValue = filtre.value.trim(); // Récupère la valeur entrée
                            if (inputValue) {
                                console.log('Texte entré :', inputValue);
                                taskListDiv.style.removeProperty('overflow-y');
                                updateLoader();
                            } 
                        }
                    });
                });

                //button de recherche
                /*searchButton.addEventListener('click', function () {

                    if (divForm.classList.contains('active')) {//si le formulaire est visible
                        AnimationArriere(); 
                        setTimeout(function () {
                            SearchForm.submit();  // Si le formulaire existe, soumettre
                        }, 1500);
                    }else{
                            SearchForm.submit();  // Si le formulaire existe, soumettre
                    }
                    
                    //updateListTask("search");
                });*/


                //formulaire de recherche
               SearchForm.addEventListener('submit', function(event) {
                    event.preventDefault(); // Empêche le rechargement de la page

                    // Créer un objet FormData avec les données du formulaire
                    var formData = new FormData(SearchForm);

                     // Afficher les données dans la console
                     formData.forEach(function (value, key) {
                        console.log(key + ": " + value);
                    });
                    setTimeout(function () {
                        }, 500);
                    fetch(SearchForm.action, {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Erreur réseau');
                        }
                        return response.json(); // Parse la réponse JSON
                    })
                    .then(response => {
                        // Utilisation des données JSON
                        if (response.status === 'success') {
                            console.log('Liste des tâches reçues :', response.listeTache);
                            document.getElementById('container_filtre2').innerHTML = response.listeTache;
                        } else {
                            console.error('Erreur côté serveur', response);
                        }
                    })
                    .catch(error => {
                        console.error('Erreur:', error);
                    });
                });

// le bouton Ajouter vert******************************************************************************************************************************************************
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
//Fin du javaScript*******************************************************************************************************************************************************************
            });
        </script>