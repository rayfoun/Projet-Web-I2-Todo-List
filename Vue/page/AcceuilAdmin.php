<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Accueil To-Do List</title>
        
         <!--Le style css-->
         <?=$themeProjet?>
        
    </head>
    <body>
        <!--La navbar-->
        <?=$navbar?>
     
        <!--Nom et Bienvenu-->
        <div class="bienvenu">
            Bienvenu <?=$nomUser?>
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
            <div>
                <form style="align-items:center; " id="form_search" method="POST" action = '/../Projet-Web-I2-Todo-List/Routeur/routeur.php?action=search'> 
                    <div style="display:inline;align-items: center; ">
                        <!-- titre -->
                        <input class="input_filtre"  name="titre" placeholder="Titre..." type="search" autocomplete="off">
                       
                        <!-- statut -->
                        <input class="input_filtre" list="statut-list" name="statut" placeholder="statut..." type="search" autocomplete="off">
                        <datalist id="statut-list">
                            <option value="En cours">En cours</option>
                            <option value="En attente">En attente</option>
                            <option value="Terminee">Terminee</option>
                        </datalist>
                        <!-- priorite -->
                        <input class="input_filtre" list="priorite-list" name="priorite" placeholder="Priorite..." type="search" autocomplete="off">
                        <datalist id="priorite-list">
                            <option value="Moyenne">Moyenne</option>
                            <option value="Haute">Haute</option>
                            <option value="Basse">Basse</option>
                        </datalist>
                        <!-- categorie -->
                        <input class="input_filtre" list="categorie-list" name="categorie" placeholder="Categorie..." type="search" autocomplete="off">
                        <datalist id="categorie-list">
                            <option value="A domicile">A domicile</option>
                            <option value="Travail">Travail</option>
                            <option value="Autre">Autre</option>
                        </datalist>
                    </div>
                    <div style="display:inline;align-items:center; ">
                        <!-- assigne -->
                        <input class="input_filtre"  type="search" name="assigne" list="assigne-list" placeholder="Assigne..." autocomplete="off">
                        <datalist id="assigne-list">
                            <?=$listeUser?>
                        </datalist>
                        
                        <!-- Bouton de recherche -->
                        <button class="button_search" id="button_search" type="submit">
                            <span class="top-key"></span>
                            <span class="text">Recherche</span>
                            <span class="bottom-key-1"></span>
                            <span class="bottom-key-2"></span>
                        </button> 
                    </div>
                </form>
            </div>
        </div>

        <!--La liste de tâche-->
        <div class=divListeTache id="divListeTache">
            <div  id="container_filtre1" style=" display: flex;align-items: center;" ><?=$loader?></div>
            <div  id="container_filtre2"><?=$listeTache?></div> 
        </div>

        <!--Le formulaire-->
        <div class="information" id="taskForm">
            <h1 class="Task">Informations</h1>
            <form id="Form"  method="POST">
                <label for="titre">Titre :</label>
                <input id="titre" required type="text" name="titre" value="<?= htmlspecialchars($titre ?? '') ?>">

                <label for="description">Description :</label>
                <textarea id="description" required name="description" placeholder="Écrivez votre description ici..."><?= htmlspecialchars($description ??'') ?></textarea>

                <label for="date">Date limite :</label>
                <input id="date" required type="date" name="date" value="<?= htmlspecialchars($date ?? '') ?>">

                <label for="statut">Statut :</label>
                <select id="statut" name="statut" required>
                    <option value="" <?=($statut ?? '') == 'En cours' || 'En attente' || 'Terminee' ? 'disabled' : 'disabled selected' ?>>-- Sélectionnez une option --</option>
                    <option value="En cours" <?= ($statut ?? '') == 'En cours' ? 'selected' : '' ?>>En cours</option>
                    <option value="En attente" <?= ($statut ?? '')  == 'En attente' ? 'selected' : '' ?>>En attente</option>
                    <option value="Terminee" <?= ($statut ?? '') == 'Terminee' ? 'selected' : '' ?>>Terminée</option>
                </select>

                <label for="priorite">Priorité :</label>
                <select id="priorite" name="priorite" required>
                    <option value="" <?=($priorite ?? '') == 'Haute' || 'Moyenne' || 'Basse' ? 'disabled' : 'disabled selected' ?>>-- Sélectionnez une option --</option>
                    <option value="Haute" <?= ($priorite ?? '') == 'Haute' ? 'selected' : '' ?>>Haute</option>
                    <option value="Moyenne" <?= ($priorite ?? '') == 'Moyenne' ? 'selected' : '' ?>>Moyenne</option>
                    <option value="Basse" <?= ($priorite ?? '') == 'Basse' ? 'selected' : '' ?>>Basse</option>
                </select>
                </select>

                <label >Assigné :</label>
                <input  required id="assigne" type="search" name="assigne" list="assigne-list" placeholder="Entrez un nom..." autocomplete="off" value="<?= htmlspecialchars($assigne ?? '') ?>  ">
                <datalist id="assigne-list">
                    <!-- Ces options sont générées dynamiquement par le serveur -->
                    <?=$listeUser?>
                </datalist>

                <label >Categorie :</label>
                <input  required id="categorie" type="search" name="categorie" list="categorie-list" placeholder="Entrez une categorie..." autocomplete="off" value="<?= htmlspecialchars($categorie ?? '') ?>" >
                <datalist id="categorie-list">
                    <!-- Ces options sont générées dynamiquement par le serveur -->
                    <option value="A domicile" >A domicile</option>
                    <option value="Travail" >Travail</option>
                    <option value="Autre" >Autre</option>
                </datalist>

                <div class="buttons_form" id="buttons_form">
                    <?=$buttonForm?>
                </div>
            </form>
        </div>

        <!-- Partie javascript de la page d'acceuil-->
        <?=$jsProjet?>

    </body>
</html>


           
