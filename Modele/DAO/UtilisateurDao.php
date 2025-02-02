<?php
require_once __DIR__ . '/../../Config/bdd.php';
require_once __DIR__ . '/../entite/Utilisateur.php';
require_once __DIR__ . '/../entite/tache.php'; // Inclut la classe tache

//<?php
class UtilisateurDao {
    private $db;

    public function __construct() {
        try{
            $database= new Database();
            $this->db = $database->getConnection();
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $message="Erreur de connexion à la base de données: " . $e->getMessage();
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
    }

    // 1. Ajouter un utilisateur
    public function addUser($utilisateur) {
        try{
            $query = $this->db->prepare("
                INSERT INTO users (nom_user, prenom_user, password_utser, email_user, type)
                VALUES (:nom, :prenom, :password, :email, :type)
            ");
            $query->execute([
                ':nom' => $utilisateur->getNom(),
                ':prenom' => $utilisateur->getPrenom(),
                ':password' => password_hash($utilisateur->getPassword(), PASSWORD_BCRYPT),
                ':email' => $utilisateur->getEmail(),
                ':type' => $utilisateur->getType()
            ]);
        } catch (PDOException $e) {
           // throw new Exception("Erreur lors de l'ajout de l'utilisateur:". $e->getMessage());
            $message="Erreur lors de l'ajout de l'utilisateur: " . $e->getMessage();
            echo "<script type='text/javascript'>alert('$message');</script>";
        }   
    }

    // 2. Modifier un utilisateur
    public function updateUser($utilisateur) {
        try{
            $query = $this->db->prepare("
                UPDATE users
                SET nom_user = :nom, prenom_user = :prenom, email_user = :email, type = :type
                WHERE id_user = :id
            ");
            $query->execute([
                ':nom' => $utilisateur->getNom(),
                ':prenom' => $utilisateur->getPrenom(),
                ':email' => $utilisateur->getEmail(),
                ':type' => $utilisateur->getType(),
                ':id' => $utilisateur->getId()
            ]);
        }catch(PDOException $e) {
            $message="Erreur lors de la mise à jour de l'utilisateur: " . $e->getMessage();
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
    }

    // 3. Supprimer un utilisateur
    public function deleteUser($id) {
        try{
            $query = $this->db->prepare("DELETE FROM users WHERE id_user = :id");
            $query->execute([':id' => $id]);
        }catch(PDOException $e) {
            $message="Erreur lors de la suppression de l'utilisateur: " . $e->getMessage();
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
        
    }

    // 4. Afficher tous les utilisateurs
    public function getAllUsers() {
        try{
            $query = $this->db->prepare("SELECT * FROM users");
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC); 

            $users = [];
            foreach ($result as $row) {
                // Crée un objet Utilisateur pour chaque ligne du résultat
                $users[] = new Utilisateur(
                    $row['id_user'],
                    $row['nom_user'],
                    $row['prenom_user'],
                    $row['email_user'],
                    null, // Vous pouvez ajouter des valeurs supplémentaires si nécessaire
                    null, // Pareil ici
                    $row['type'],
                    null, // Idem
                    null // Idem
                );
            }
            return $users;
        }catch(PDOException $e) {
            $message="Erreur lors de l'affichage de l'utilisateur: " . $e->getMessage();
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
    }

    // 5. Afficher les administrateurs
    public function getAdmins() {
        $query = $this->db->prepare("SELECT * FROM users WHERE type = 'Administrateur'");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    //trouver un user
    public function getUserById($id){
        try{
            $query=$this->db->prepare("SELECT* from users where id_user=:id");
            $query->execute([':id'=>$id]);
            $result = $query->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                return new Utilisateur (
                    ['id_user'],
                    ['nom_user'],
                    ['prenom_user'],
                    ['email_user'],
                    null,
                    null,
                    $result['type'], null, null );
                }
            return null;
        }catch(PDOException $e){
            $message="Erreur lors de la récupération de l'utilisateur: " . $e->getMessage();
            echo "<script type='text/javascript'>alert('$message');</script>";
            
        }
    }

    //
    public function getUserByName(string $name,string $firstName){

        // Préparation de la requête SQL pour compter le nombre d'utilisateurs correspondants
        $query = $this->db->prepare("SELECT COUNT(*) FROM users WHERE nom_user = :nom AND prenom_user = :prenom");
        $query->execute([':nom' => $name, ':prenom' => $firstName]);

        // Récupération du nombre d'utilisateurs correspondants
        $count = $query->fetchColumn();

        // Vérification du nombre d'utilisateurs trouvés
        if ((int)$count === 1) {
            // Si un seul utilisateur est trouvé, récupération de ses informations
            $query = $this->db->prepare("SELECT * FROM users WHERE nom_user = :nom AND prenom_user = :prenom");
            $query->execute([':nom' => $name, ':prenom' => $firstName]);
            $result=$query->fetch(PDO::FETCH_ASSOC);
            //echo json_encode($result);
            
                $newUser = new Utilisateur(
                    $result['id_user'], 
                    $result['nom_user'], 
                    $result['prenom_user'], 
                    $result['email_user'], 
                    null, 
                    null, 
                    $result['type'], 
                    null, 
                    null
                );
                //var_dump($newUser);
            
                return $newUser;
        } elseif ((int)$count > 1) {
            //echo json_encode("Erreur : Plusieurs utilisateurs trouvés avec le nom");
            echo "<script type='text/javascript'>alert('Erreur : Plusieurs utilisateurs trouvés avec le nom assigne');</script>";

            // Si plusieurs utilisateurs sont trouvés, levée d'une exception
            //throw new Exception("Erreur : Plusieurs utilisateurs trouvés avec le nom '$firstName' '$name'.");
           
        }

        // Si aucun utilisateur n'est trouvé, retour de null
        //echo json_encode("Erreur : Aucun utilisateur trouve avec le nom");
        echo "<script type='text/javascript'>alert('Erreur : Aucun utilisateur trouve avec le nom assigne');</script>";
        //throw new Exception("Erreur: Aucun utilisateur trouvé avec le nom $firstName $name");
      

    }


    public function emailExists($email) {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM users WHERE email_user = :email");
        $stmt->execute([':email' => $email]);
        return $stmt->fetchColumn() > 0;
    }

    public function usernameExists($username) {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM users WHERE nom_user = :username");
        $stmt->execute([':username' => $username]);
        return $stmt->fetchColumn() > 0;
    }

    



}
?>