<?php

class Utilisateur {
    public $id_utilisateur;
    public $nom_utilisateur;
    public $prenom_utilisateur;
    public $password_utilisateur;
    public $email_utilisateur;
    public $token_utilisateur;
    public $type;
    public $photo_utilisateur;
    public $verification_email_utilisateur;

    public function __construct($id_utilisateur, $nom_utilisateur, $prenom_utilisateur, $password_utilisateur, $email_utilisateur, $token_utilisateur, $type, $photo_utilisateur, $verification_email_utilisateur) {
        $this->id_utilisateur = $id_utilisateur;
        $this->nom_utilisateur = $nom_utilisateur;
        $this->prenom_utilisateur = $prenom_utilisateur;
        $this->password_utilisateur = $password_utilisateur;
        $this->email_utilisateur = $email_utilisateur;
        $this->token_utilisateur = $token_utilisateur;
        $this->type = $type;
        $this->photo_utilisateur = $photo_utilisateur;
        $this->verification_email_utilisateur = $verification_email_utilisateur;
    }
}
