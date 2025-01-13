<?php

class Administrateur {
    public $id_admin;
    public $nom_admin;
    public $email_admin;
    public $id_utilisateur;

    public function __construct($id_admin, $nom_admin, $email_admin, $id_utilisateur) {
        $this->id_admin = $id_admin;
        $this->nom_admin = $nom_admin;
        $this->email_admin = $email_admin;
        $this->id_utilisateur = $id_utilisateur;
    }
}
