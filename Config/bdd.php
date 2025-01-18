<?php
    class Database {
        private $conn; // Instance de connexion PDO

        // Méthode pour établir une connexion à la base de données
        public function getConnection() {
            try {
                // Création de la connexion avec PDO
                $this->conn = new PDO('mysql:host=localhost;dbname=to-do list', 'root', '');

                // Configuration des options PDO
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

                // Retourne la connexion si elle réussit
                $message ="Connexion réussie à la base de données";
                echo "<script type='text/javascript'>alert('$message');</script>";
                return $this->conn;
            } catch (PDOException $e) {
                // Gestion des erreurs de connexion
                $message="Erreur de connexion : " . $e->getMessage() ;
                echo "<script type='text/javascript'>alert('$message');</script>";
                return null;
            }
        }
    }
 $database= new Database();
 $database-> getConnection();
?>