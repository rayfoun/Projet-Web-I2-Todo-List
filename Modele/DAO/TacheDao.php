<?php

require_once 'config/bdd.php'; // Inclut la connexion à la base de données
require_once 'entite/tache.php'; // Inclut la classe Tache

class TacheDao {
    private $db;
    private $utilisateurDao;

    public function __construct($db, $utilisateurDao) {
        $this->db = $db;
        $this->utilisateurDao = $utilisateurDao;
    }

    // 1. Ajouter une tâche
    public function addTask($tache) {
        $query = $this->db->prepare("
            INSERT INTO tache (libelle_tache, descriptif_tache, date_creation, date_echeance, heure_creation, heure_echeance, statut_tache, priorite_tache, categorie, id_user)
            VALUES (:libelle, :descriptif, :dateCreation, :dateEcheance, :heureCreation, :heureEcheance, :statut, :priorite, :categorie, :idUser)
        ");
        $query->execute([
            ':libelle' => $tache->getLibelle(),
            ':descriptif' => $tache->getDescriptif(),
            ':dateCreation' => $tache->getDateCreation(),
            ':dateEcheance' => $tache->getDateEcheance(),
            ':heureCreation' => $tache->getHeureCreation(),
            ':heureEcheance' => $tache->getHeureEcheance(),
            ':statut' => $tache->getStatut(),
            ':priorite' => $tache->getPriorite(),
            ':categorie' => $tache->getCategorie(),
            ':idUser' => $tache->getUtilisateur()->getId() // Utilise l'ID de l'utilisateur
        ]);
    }

    // 2. Modifier une tâche
    public function updateTask($tache) {
        $query = $this->db->prepare("
            UPDATE tache
            SET libelle_tache = :libelle, descriptif_tache = :descriptif, date_echeance = :dateEcheance, 
                heure_echeance = :heureEcheance, statut_tache = :statut, priorite_tache = :priorite, categorie = :categorie
            WHERE id_tache = :id
        ");
        $query->execute([
            ':libelle' => $tache->getLibelle(),
            ':descriptif' => $tache->getDescriptif(),
            ':dateEcheance' => $tache->getDateEcheance(),
            ':heureEcheance' => $tache->getHeureEcheance(),
            ':statut' => $tache->getStatut(),
            ':priorite' => $tache->getPriorite(),
            ':categorie' => $tache->getCategorie(),
            ':id' => $tache->getId()
        ]);
    }

    // 3. Supprimer une tâche
    public function deleteTask($id) {
        $query = $this->db->prepare("DELETE FROM tache WHERE id_tache = :id");
        $query->execute([':id' => $id]);
    }

    // 4. Consulter une tâche par ID
    public function getTaskById($id) {
        $query = $this->db->prepare("
            SELECT t.*, u.id_user, u.nom_user, u.prenom_user, u.email_user, u.type
            FROM tache t
            JOIN users u ON t.id_user = u.id_user
            WHERE t.id_tache = :id
        ");
        $query->execute([':id' => $id]);
        $row = $query->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $utilisateur = new Utilisateur(
                $row['id_user'],
                $row['nom_user'],
                $row['prenom_user'],
                $row['email_user'],
                null,
                null,
                $row['type'],
                null,
                null
            );

            return new Tache(
                $row['id_tache'],
                $row['libelle_tache'],
                $row['descriptif_tache'],
                $row['date_creation'],
                $row['date_echeance'],
                $row['heure_creation'],
                $row['heure_echeance'],
                $row['statut_tache'],
                $row['priorite_tache'],
                $row['categorie'],
                $utilisateur
            );
        }
        return null;
    }

    // 5. Assigner une tâche à un utilisateur
    public function assignTaskToUser($taskId, $userId) {
        $query = $this->db->prepare("UPDATE tache SET id_user = :userId WHERE id_tache = :taskId");
        $query->execute([
            ':userId' => $userId,
            ':taskId' => $taskId
        ]);
    }

    // 6. Modifier le statut d'une tâche
    public function updateTaskStatus($taskId, $status) {
        $query = $this->db->prepare("UPDATE tache SET statut_tache = :status WHERE id_tache = :taskId");
        $query->execute([
            ':status' => $status,
            ':taskId' => $taskId
        ]);
    }

    // Rayan
    // Récupération de la liste des tâches d'un utilisateur
    public function getAllTasks() {
        $query = $this->db->prepare("SELECT * FROM tache");
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);

        $tasks = [];

        foreach ($results as $row){
            $tasks[] = new Task(
                $row['id'],
                $row['libelle'],
                $row['descriptif'],
                $row['dateCreation']
        }
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
