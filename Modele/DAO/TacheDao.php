<?php
require_once __DIR__ . '/../../Config/bdd.php';
require_once __DIR__ . '/../entite/Utilisateur.php';
require_once __DIR__ . '/../entite/tache.php'; // Inclut la classe tache

class TacheDao {
    private $db;
    private $utilisateurDao;

    public function __construct() {
        $database= new Database();
        $this->db = $database->getConnection();
        $this->utilisateurDao = new UtilisateurDao();
    }

    // 1. Ajouter une tâche
    public function addTask($tache) {
        $query = $this->db->prepare("
            INSERT INTO tache (libelle_tache, descriptif_tache, date_creation, date_echeance, heure_creation, heure_echeance, statut_tache, priorite_tache, categorie, id_user)
            VALUES (:libelle, :descriptif, :dateCreation, :dateEcheance, :heureCreation, :heureEcheance, :statut, :priorite, :categorie, :idUser)
        ");

        $idUser = $tache->getUtilisateur() ? $tache->getUtilisateur()->getId() : null;

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

            ':idUser' => $idUser // Évite une erreur fatale si l'utilisateur est null
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


    // 7. Récuperer toutes les tâches d'un utilisateur à partir de son id
    public function getTasksByUserId($userId) {
        $query = $this->db->prepare("
            SELECT t.*
            FROM tache t
            WHERE t.id_user = :userId
        ");
        
        $query->execute([':userId' => $userId]);
        $rows = $query->fetchAll(PDO::FETCH_ASSOC); // Récupère toutes les tâches

        if (!$rows) {
            return []; // Aucune tâche trouvée
        }

        // Tableau pour stocker les tâches
        $taches = [];

        // Parcours chaque ligne et transforme en un tableau associatif
        foreach ($rows as $row) {
            $taches[] = [
                'id_tache' => $row['id_tache'],
                'libelle_tache' => $row['libelle_tache'],
                'descriptif_tache' => $row['descriptif_tache'],
                'date_creation' => $row['date_creation'],
                'date_echeance' => $row['date_echeance'],
                'heure_creation' => $row['heure_creation'],
                'heure_echeance' => $row['heure_echeance'],
                'statut_tache' => $row['statut_tache'],
                'priorite_tache' => $row['priorite_tache'],
                'categorie' => $row['categorie'],
                'id_user' => $row['id_user'],
            ];
        }
        return $taches;
    }


    //8. Rechercher des tâches en fonction de plusieurs paramètres
    public function getTasksByFilters($libelle = null, $statut = null, $priorite = null, $utilisateur = null) {
        // Début de la requête SQL
        $query = "SELECT t.* FROM tache t WHERE 1=1";

        // Tableau pour stocker les paramètres
        $params = [];

        // Ajout des conditions dynamiques
        if ($libelle !== null) {
            $query .= " AND t.libelle_tache LIKE :libelle";
            $params[':libelle'] = '%' . $libelle . '%'; // Recherche partielle
        }
        if ($statut !== null) {
            $query .= " AND t.statut_tache = :statut";
            $params[':statut'] = $statut;
        }
        if ($priorite !== null) {
            $query .= " AND t.priorite_tache = :priorite";
            $params[':priorite'] = $priorite;
        }
        if ($utilisateur !== null) {
            $query .= " AND t.id_user = :utilisateur";
            $params[':utilisateur'] = $utilisateur;
        }

        // Préparation et exécution de la requête
        $stmt = $this->db->prepare($query);
        $stmt->execute($params);

        // Récupération des résultats
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Transformation des résultats en objets Tache si nécessaire
        $taches = [];
        foreach ($rows as $row) {
            $taches[] = new Tache(
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
                $row['id_user'] ? $this->utilisateurDao->getUserById($row['id_user']) : null
            );
        }

        return $taches;
    }

    // recuperer toutes les tâches
    public function getAllTask(){
        $query = $this->db->prepare("SELECT * From tache");
        $query->execute();

        $result = $query->fetchAll(PDO::FETCH_ASSOC); // Récupération des données sous forme de tableau associatif
        $tasks = [];
        foreach ($result as $row) {
            // Remplacez ci-dessous par la logique correcte pour initialiser un utilisateur (hypothèse : vous avez une méthode `getUtilisateurById` dans une autre classe)
            $utilisateur = $this->utilisateurDao->getUserById($row['id_user']); 
    
            // Création de l'objet Tache
            $tasks[] = new Tache(
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
    
        return $tasks; // Retourne un tableau d'objets Tache
    }
    
}
