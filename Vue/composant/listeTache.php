<?php
$liste=array("tache1","tache2","tache3");

$rendu="<div class=divListeTache>";
foreach($liste as $tache){
    $rendu.="<div><button><span>$tache</span></button></div>";
}
$rendu.="</div>";
echo $rendu;
?>