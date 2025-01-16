<?php

require_once 'config/bdd.php'; // Inclut la connexion à la base de données
require_once 'entite/tache.php'; // Inclut la classe Tache

class TacheDAO {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Méthode pour créer une tâche
    public function creerTache($libelle, $descriptif, $dateCreation, $dateEcheance, $heureCreation, $heureEcheance,$categorie, $statut, $priorite, $iduser) {
        $query = "INSERT INTO tache (libelle_tache, descriptif_tache, date_creation, date_echeance, heure_creation, heure_echeance, categorie, statut_tache, priorite_tache, id_user) 
                  VALUES (:libelle, :descriptif, :dateCreation, :dateEcheance, :heureCreation, :heureEcheance,:categorie, :statut, :priorite, :iduser)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            ':libelle' => $libelle,
            ':descriptif' => $descriptif,
            ':dateCreation' => $dateCreation,
            ':dateEcheance' => $dateEcheance,
            ':heureCreation' => $heureCreation,
            ':heureEcheance' => $heureEcheance,
            ':statut' => $statut,
            ':priorite' => $priorite,
            ':id_user' => $iduser
        ]);
    }

    // Méthode pour modifier une tâche
    public function modifierTache($id, $libelle, $descriptif, $dateEcheance, $heureEcheance, $statut, $priorite, $idCategorie) {
        $query = "UPDATE tache 
                  SET libelle_tache = :libelle, descriptif_tache = :descriptif, date_echeance = :dateEcheance, 
                      heure_echeance = :heureEcheance, statut_tache = :statut, priorite_tache = :priorite, id_categorie = :idCategorie 
                  WHERE id_tache = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            ':id' => $id,
            ':libelle' => $libelle,
            ':descriptif' => $descriptif,
            ':dateEcheance' => $dateEcheance,
            ':heureEcheance' => $heureEcheance,
            ':statut' => $statut,
            ':priorite' => $priorite,
            ':idCategorie' => $idCategorie
        ]);
    }

    // Méthode pour supprimer une tâche
    public function supprimerTache($id) {
        $query = "DELETE FROM tache WHERE id_tache = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':id' => $id]);
    }

    // Méthode pour changer le statut d'une tâche
    public function changerStatutTache($id, $nouveauStatut) {
        $query = "UPDATE tache SET statut_tache = :statut WHERE id_tache = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            ':id' => $id,
            ':statut' => $nouveauStatut
        ]);
    }

    // Méthode pour assigner une tâche à une catégorie (ou utilisateur)
    public function assignerTache($idTache, $idCategorie) {
        $query = "UPDATE tache SET id_categorie = :idCategorie WHERE id_tache = :idTache";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            ':idTache' => $idTache,
            ':idCategorie' => $idCategorie
        ]);
    }

    // Méthode pour consulter une tâche par ID
    public function consulterTache($id) {
        $query = "SELECT * FROM tache WHERE id_tache = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':id' => $id]);
        return $stmt->fetchObject('Tache');
    }
}

?>