<?php
    require_once __DIR__ . '/../Config/bdd.php';

    $database = new Database();

    function hash_password($password){
        return password_hash($password, PASSWORD_DEFAULT);
    }

    // Liste des utilisateurs avec leurs mots de passe en clair
    $users = [
        ["Dupont", "Jean", "hashedpassword1", "jean.dupont@example.com", NULL, "Utilisateur", NULL, TRUE],
        ["Martin", "Sophie", "hashedpassword2", "sophie.martin@example.com", NULL, "Administrateur", NULL, TRUE],
        ["Durand", "Paul", "hashedpassword3", "paul.durand@example.com", NULL, "Utilisateur", NULL, FALSE],
        ["Lemoine", "Claire", "hashedpassword4", "claire.lemoine@example.com", NULL, "Utilisateur", NULL, TRUE],
        ["Petit", "Lucas", "hashedpassword5", "lucas.petit@example.com", NULL, "Utilisateur", NULL, TRUE],
        ["Bernard", "Emma", "hashedpassword6", "emma.bernard@example.com", NULL, "Utilisateur", NULL, FALSE],
        ["Robert", "Nicolas", "hashedpassword7", "nicolas.robert@example.com", NULL, "Administrateur", NULL, TRUE],
        ["Richard", "Julie", "hashedpassword8", "julie.richard@example.com", NULL, "Utilisateur", NULL, TRUE],
        ["Morel", "Thomas", "hashedpassword9", "thomas.morel@example.com", NULL, "Utilisateur", NULL, FALSE],
        ["Garcia", "Laura", "hashedpassword10", "laura.garcia@example.com", NULL, "Utilisateur", NULL, TRUE]
    ];

    // Préparation de la requête SQL
    $sql = "INSERT INTO users (nom_user, prenom_user, password_user, email_user, token_user, type, photo_utilisateur, verification_email_user) 
            VALUES (:nom, :prenom, :password, :email, NULL, :type, NULL, :verification)";
    
    $stmt = $database->getConnection()->prepare($sql);
    
    // Boucle pour insérer chaque utilisateur
    foreach ( $users as $user ) {
        $hashedpassword = password_hash($user[2], PASSWORD_DEFAULT);

        $stmt->execute([
            ":nom" => $user[0],
            ":prenom" => $user[1],
            ":password" => $hashedpassword,
            ":email" => $user[3],
            ":type" => $user[5],
            ":verification" => $user[7] ? 1 : 0
        ]);
        echo "✅ Utilisateur {$user[1]} {$user[0]} ajouté avec succès.<br>";
    }
    echo "🎉 Tous les utilisateurs ont été insérés avec succès !";


    // Insertion des tâches dans la base de données
    $sql2 = "INSERT INTO tache (libelle_tache, descriptif_tache, date_creation, date_echeance, heure_creation, heure_echeance, statut_tache, priorite_tache, categorie, id_user) VALUES
    ('Acheter des courses', 'Acheter du lait, du pain et des oeufs', '2025-01-17', '2025-01-18', '10:00:00', '12:00:00', 'En attente', 'Moyenne', 'A domicile', 1),
    ('Reunion projet', 'Preparer la presentation pour la reunion', '2025-01-17', '2025-01-19', '14:00:00', '16:00:00', 'Terminee', 'Haute', 'Travail', 2),
    ('Faire du sport', 'Courir 5 km au parc', '2025-01-17', '2025-01-17', '18:00:00', '19:00:00', 'En attente', 'Basse', 'Autre', 3),
    ('Reviser les cours', 'Relire les chapitres 3 et 4 de maths', '2025-01-17', '2025-01-20', '20:00:00', '22:00:00', 'Terminee', 'Haute', 'Travail', 4),
    ('Appeler le client', 'Discussion sur le projet en cours', '2025-01-17', '2025-01-18', '09:30:00', '10:00:00', 'Terminee', 'Haute', 'Travail', 5),
    ('Reserver des billets', 'Billets de train pour le week-end', '2025-01-17', '2025-01-19', '11:00:00', '11:30:00', 'En attente', 'Moyenne', 'A domicile', 6),
    ('Planifier un voyage', 'Preparer itineraire et reserver les hotels', '2025-01-17', '2025-02-01', '15:00:00', '16:30:00', 'En cours', 'Haute', 'Autre', 7),
    ('Faire du menage', 'Nettoyer la cuisine et le salon', '2025-01-17', '2025-01-17', '17:00:00', '18:00:00', 'Terminee', 'Basse', 'A domicile', 8),
    ('Repondre aux emails', 'Repondre aux emails professionnels', '2025-01-17', '2025-01-17', '08:00:00', '09:00:00', 'En attente', 'Moyenne', 'Travail', 9),
    ('Visite medicale', 'Rendez-vous chez le medecin', '2025-01-18', '2025-01-18', '10:30:00', '11:30:00', 'En attente', 'Haute', 'Autre', 10),
    ('Acheter un cadeau', 'Trouver un cadeau pour anniversaire de Sophie', '2025-01-17', '2025-01-20', '16:00:00', '18:00:00', 'En attente', 'Moyenne', 'Autre', 1),
    ('Faire des travaux', 'Peindre les murs du salon', '2025-01-17', '2025-02-10', '14:00:00', '17:00:00', 'Terminee', 'Haute', 'A domicile', 2),
    ('Aller a la banque', 'Deposer un cheque et mettre a jour le compte', '2025-01-17', '2025-01-18', '12:00:00', '12:30:00', 'En attente', 'Moyenne', 'Autre', 3),
    ('Reunions hebdomadaires', 'Preparer les slides pour la reunion', '2025-01-17', '2025-01-19', '09:00:00', '11:00:00', 'En cours', 'Haute', 'Travail', 4),
    ('Regarder un film', 'Voir un film recommande par un ami', '2025-01-17', '2025-01-19', '20:00:00', '22:30:00', 'En attente', 'Basse', 'Autre', 5);";

    $stmt2 = $database->getConnection()->prepare($sql2);
    $stmt2->execute();

    echo "🎉 Toutes les tâches ont été insérées avec succès !";
?>