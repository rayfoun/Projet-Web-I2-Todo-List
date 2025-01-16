-- Suppression des tables si elles existent déjà
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS tache;

-- Création de la table utilisateur
CREATE TABLE users (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    nom_user VARCHAR(100) NOT NULL,
    prenom_user VARCHAR(100) NOT NULL,
    password_utser VARCHAR(255) NOT NULL,
    email_user VARCHAR(255) UNIQUE NOT NULL,
    token_user TEXT,
    type ENUM('Utilisateur', 'Administrateur'),
    photo_utilisateur TEXT,
    verification_email_user BOOLEAN NOT NULL
);


-- Création de la table tache
CREATE TABLE tache (
    id_tache INT AUTO_INCREMENT PRIMARY KEY,
    libelle_tache VARCHAR(255) NOT NULL,
    descriptif_tache TEXT,
    date_creation DATE NOT NULL,
    date_echeance DATE,
    heure_creation TIME ,
    heure_echeance TIME ,
    statut_tache ENUM('En attente', 'En cours', 'Terminee') NOT NULL,
    priorite_tache ENUM('Basse', 'Moyenne', 'Haute') NOT  NULL,
    categorie ENUM('A domicile', 'Travail','Autre') NOT NULL,
    id_user INT,
    FOREIGN KEY (id_user) REFERENCES users(id_user) ON DELETE SET NULL
);



