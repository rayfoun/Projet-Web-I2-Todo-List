<?php

require_once 'Config/bdd.php'; // Inclut la connexion à la base de données
require_once 'entite/Categorie.php'; // Inclut la classe Categorie

class CategorieDAO {
    private $conn;

    public function __construct(){
        $database= new Database();
        $this->conn=$database->getConnection();
    }

    public function getAllCategories(){
        $query= "SELECT * FROM categorie";
        $stmt=$this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Categorie');
    }

    public function addCategorie($nom_categorie, $description_categorie) {
        $query = "INSERT INTO categorie (nom_categorie, description_categorie) VALUES (:nom, :description)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nom', $nom_categorie);
        $stmt->bindParam(':description', $description_categorie);
        $stmt->execute();
    }

    public function deleteCategorie($id) {
        $query = "DELETE FROM categorie WHERE id_categorie = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}