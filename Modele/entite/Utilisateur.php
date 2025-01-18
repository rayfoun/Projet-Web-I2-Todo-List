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
    public function getPassword() { return $this->password; } 
    public function getToken() { return $this-> token; }
    public function getType() { return $this->type; }
    public function getPhoto() { return $this->photo; }
    public function getEmailVerifie() { return $this-> emailVerifie; }
    public function setNom($nom) { $this->nom = $nom; }
    public function setPrenom($prenom) { $this->prenom = $prenom; }
    public function setEmail($email) { $this->email=$email;}
    public function setPassword($password) { $this ->password=$password; }
    public function setToken($token) { $this->token=$token; }
    public function setType($type) { $this->type=$type; }
    public function setPhoto($photo) { $this->photo= $photo;}
    public function getEmailVerifie($emailVerifie) { $this->emailVerifie=$emailVerifie;}
   
}
