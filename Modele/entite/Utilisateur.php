<?php
class Utilisateur {
    private $id;
    private $nom;
    private $prenom;
    private $email;
    private $password;
    private $token;
    private $type;
    private $photo;
    private $emailVerifie;

    // Constructor
    public function __construct($id, $nom, $prenom, $email, $password, $token, $type, $photo, $emailVerifie) {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->password = $password;
        $this->token = $token;
        $this->type = $type;
        $this->photo = $photo;
        $this->emailVerifie = $emailVerifie;
    }

    // Getters and setters
    public function getId() { return $this->id; }
    public function getNom() { return $this->nom; }
    public function getPrenom() { return $this->prenom; }
    public function getEmail() { return $this->email; }
    public function getType() { return $this->type; }
    public function setNom($nom) { $this->nom = $nom; }
    public function setPrenom($prenom) { $this->prenom = $prenom; }
    // Add remaining getters and setters...
}
