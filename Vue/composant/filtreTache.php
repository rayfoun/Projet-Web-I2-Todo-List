<?php
$seach="<div class=divFiltre><h3 style='text-align: center;'>Liste des tâches</h3>";
$seach.="<button id='bottone5'>+</button></div>";
$seach.="<div class=divFiltreTache>";
$seach.="<form>";
$seach.="<input type='text' name='titre' class='input_filtre'><b><label>Titre</label></b>";
$seach.="<input type='text' name='statut' class='input_filtre'><b><label>Statut</label></b>";
$seach.="<input type='text' name='priorite' class='input_filtre'><b><label>Priotite</label></b>";
$seach.="</form>";
$seach.="</div>";
echo $seach;
?>

