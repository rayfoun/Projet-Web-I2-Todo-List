<?php
//defaut
$action="ajout";
$type="admin";

//parametre
//definir la liste des status
$status=["En cours","En attente","Terminee"];
$listeStat="";
foreach($status as $st){
    $listeStat.="<option value='$st'></option>";
}
//definir la liste des priorite
$priorite=["Haute","Moyenne","Faible"];
$listePr="";
foreach($priorite as $pr){
    $listePr.="<option value='$pr'></option>";
}
//definir la liste des  users
$users=["Marie","Jaures"];
$listeU="";
foreach($users as $u){
    $listeU.="<option value='$u'></option>";
}
//definir la liste des categorie
$categorie=["A domicile","Travail","Autre"];
$listeCat="";
foreach($categorie as $cat){
    $listeCat.="<option value='$cat'></option>";
}


//definir le type button en fonction du type d'action
switch ($action){
    case "ajout":
        $buttons=" <button type='submit' class='add'>Ajouter</button>
        <button type='button' class='cancel' onclick='window.location.href='/home';'>Annuler</button>";
        break;

    case "modif":
        $buttons=" <button type='submit' class='add'>valider</button>
        <button type='button' class='cancel' onclick='window.location.href='/home';'>Annuler</button>
        <button type='button' class='delete' onclick='deleteTache();'>Supprimer</button>";
        break;
    default: echo "<script>
            function showAlert() {
                alert('Action inconnu');
            }
            </script>";
}

//definir les elements du form en fontion du user
switch ($type){
    case "admin":
        $assigne="<label for='assigne'>Assigne :</label>
                    <input  required type='search' name='assigne' list='assigne-list' placeholder='Entrez un nom...'>
                    <datalist id='assigne-list'>
                        <!-- Ces options sont générées dynamiquement par le serveur -->
                        $listeU
                    </datalist>";
        break;
    case "utilisat":
        $assigne="";
        break;
    default: echo "<script>
            function showAlert() {
                alert('Type de User inconnu');
            }
            </script>";
}

$form="
<div class='information'>
    <h1>Information</h1>
    <form action='../../controlleur/FormTacheController.php' method='POST'>
        <label for='titre'>Titre :</label>
        <input  required type='text' name='titre'>

        <label for='description'>Description :</label>
        <textarea  required name='description' placeholder='Ecrivez votre description ici...'></textarea>

        <label for='date'>Date limite :</label>
        <input required type='date' name='date'>

        <label for='statut'>Statut :</label>
        <select name='statut' required>
            <option value='' disabled selected>-- Selectionnez une option --</option>
            $listeStat
        </select>

        <label for='priorite'>Priorite :</label>
        <select name='priorite' required>
            <option value='' disabled selected>-- Selectionnez une option --</option>
            $listePr
        </select>

         $assigne

        <label for='categorie'>Categorie :</label>
        <input  required type='search' name='categorie' list='categorie-list' placeholder='Entrez une categorie...'>
        <datalist id='categorie-list'>
            <!-- Ces options sont générées dynamiquement par le serveur -->
             $listeCat
        </datalist>

        <div class='buttons'>
            $buttons
        </div>
    </form>
</div>
";
echo $form;
?>