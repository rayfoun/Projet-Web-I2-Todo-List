<?php
require_once __DIR__ .'/DefaultController.php';
require_once __DIR__ .'/../Modele/DAO/UtilisateurDao.php';
//require_once __DIR__ .'/../Modele/DAO/TacheDao.php';
//require_once __DIR__ .'/../Modele/entite/tache.php';
require_once __DIR__ .'/../Modele/entite/Utilisateur.php';

class ControllerUser { 

    public function getUserByAssigne($assigne){
        $parts = explode(' ', $assigne); // Divise la chaîne par les espaces
        $nom = end($parts);              // Récupère le dernier élément du tableau (nom)
        $prenom = reset($parts);         // Récupère le premier élément du tableau (prénom)
        $user=new UtilisateurDao();
        
        return $user->getUserByName($nom,$prenom);
    }

}

?>