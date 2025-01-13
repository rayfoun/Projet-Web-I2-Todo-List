-- Suppression des tables si elles existent déjà
DROP TABLE IF EXISTS tache;
DROP TABLE IF EXISTS categorie;
DROP TABLE IF EXISTS administrateur;
DROP TABLE IF EXISTS utilisateur;

-- Création de la table categorie
CREATE TABLE categorie (
    id_categorie INT AUTO_INCREMENT PRIMARY KEY,
    nom_categorie VARCHAR(100) NOT NULL,
    description_categorie TEXT
);

-- Création de la table tache
CREATE TABLE tache (
    id_tache INT AUTO_INCREMENT PRIMARY KEY,
    libelle_tache VARCHAR(255) NOT NULL,
    descriptif_tache TEXT,
    date_creation DATE NOT NULL,
    date_echeance DATE,
    heure_creation TIME NOT NULL,
    heure_echeance TIME,
    statut_tache ENUM('En attente', 'En cours', 'Terminée') NOT NULL,
    priorite_tache ENUM('Basse', 'Moyenne', 'Haute'),
    id_categorie INT,
    FOREIGN KEY (id_categorie) REFERENCES categorie(id_categorie) ON DELETE SET NULL
);

-- Création de la table utilisateur
CREATE TABLE utilisateur (
    id_utilisateur INT AUTO_INCREMENT PRIMARY KEY,
    nom_utilisateur VARCHAR(100) NOT NULL,
    prenom_utilisateur VARCHAR(100) NOT NULL,
    password_utilisateur VARCHAR(255) NOT NULL,
    email_utilisateur VARCHAR(255) UNIQUE NOT NULL,
    token_utilisateur TEXT,
    login_utilisateur VARCHAR(50) UNIQUE,
    type ENUM('Utilisateur', 'Administrateur'),
    photo_utilisateur TEXT,
    verification_email_utilisateur BOOLEAN NOT NULL
);

-- Création de la table administrateur
CREATE TABLE administrateur (
    id_admin INT AUTO_INCREMENT PRIMARY KEY,
    nom_admin VARCHAR(100) NOT NULL,
    email_admin VARCHAR(255) UNIQUE NOT NULL,
    id_utilisateur INT,
    FOREIGN KEY (id_utilisateur) REFERENCES utilisateur(id_utilisateur) ON DELETE CASCADE
);
