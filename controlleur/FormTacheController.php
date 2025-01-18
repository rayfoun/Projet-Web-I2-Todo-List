<?php

// Inclure la classe DAO pour accéder à la base de données
require_once __DIR__ . '/../Modele/DAO/TacheDao.php';

// Vérifier si la méthode de requête est POST et les champs nécessaires sont présents
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        isset($_POST['titre'], $_POST['description'], $_POST['date'], 
              $_POST['statut'], $_POST['priorite'], $_POST['assigne'], $_POST['categorie'])
    ) {
        // Récupérer les données du formulaire
        $titre =  $_POST['titre'];
        $description = $_POST['description'];
        $dateLimite = $_POST['date'];
        $statut = $_POST['statut'];
        $priorite = $_POST['priorite'];
        $assigne = $_POST['assigne'];
        $categorie = $_POST['categorie'];

        // Créer les valeurs pour l'entité
        $dateCreation = date('Y-m-d'); // Date actuelle
        $heureCreation = date('H:i:s'); // Heure actuelle

        try {
            // Créer une instance du DAO pour insérer les données
            $tacheDao = new TacheDao();
            $result = $tacheDao->creerTache(
                $titre, 
                $description, 
                $dateCreation,  
                $dateLimite, 
                $heureCreation, 
                $heureCreation, // Supposons que c'est l'heure de modification
                $statut, 
                $priorite, 
                $categorie, 
                $assigne
            );

            if ($result) {
                // Rediriger vers une autre page après la soumission
                header('Location: ../index.php?status=success');
                exit;
            } else {
                echo "Erreur : Impossible d'ajouter la tâche.";
            }
        } catch (Exception $e) {
            echo "Erreur : " . $e->getMessage();
        }
    } else {
        echo "Erreur : Tous les champs obligatoires ne sont pas remplis.";
    }
} else {
    echo "Méthode non autorisée.";
}
