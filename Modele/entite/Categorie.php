<?php

class Categorie {
    public $id_categorie;
    public $nom_categorie;
    public $description_categorie;

    public function __construct($id_categorie, $nom_categorie, $description_categorie){
        $this->id_categorie= $id_categorie;
        $this->nom_categorie=$nom_categorie;
        $this->descriptioon_categorie=$description_categorie;
    }
}