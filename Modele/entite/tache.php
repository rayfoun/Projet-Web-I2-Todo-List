<?php
class Tache {
    private $id;
    private $libelle;
    private $descriptif;
    private $dateCreation;
    private $dateEcheance;
    private $heureCreation;
    private $heureEcheance;
    private $statut;
    private $priorite;
    private $categorie;
    private $utilisateur; // Objet Utilisateur

    public function __construct(
        $id,
        $libelle,
        $descriptif,
        $dateCreation,
        $dateEcheance,
        $heureCreation,
        $heureEcheance,
        $statut,
        $priorite,
        $categorie,
        $utilisateur
    ) {
        $this->id = $id;
        $this->libelle = $libelle;
        $this->descriptif = $descriptif;
        $this->dateCreation = $dateCreation;
        $this->dateEcheance = $dateEcheance;
        $this->heureCreation = $heureCreation;
        $this->heureEcheance = $heureEcheance;
        $this->statut = $statut;
        $this->priorite = $priorite;
        $this->categorie = $categorie;
        $this->utilisateur = $utilisateur;
    }

    // Getters
    public function getId() { return $this->id; }
    public function getLibelle() { return $this->libelle; }
    public function getDescriptif() { return $this->descriptif; }
    public function getDateCreation() { return $this->dateCreation; }
    public function getDateEcheance() { return $this->dateEcheance; }
    public function getHeureCreation() { return $this->heureCreation; }
    public function getHeureEcheance() { return $this->heureEcheance; }
    public function getStatut() { return $this->statut; }
    public function getPriorite() { return $this->priorite; }
    public function getCategorie() { return $this->categorie; }
    public function getUtilisateur() { return $this->utilisateur; }

    // Setters
    public function setUtilisateur($utilisateur) { $this->utilisateur = $utilisateur; }
    public function setLibelle($libelle) { $this->libelle = $libelle; }
    public function setDescriptif($descriptif) { $this->descriptif = $descriptif; }
    public function setDateCreation($dateCreation) { $this->dateCreation = $dateCreation; }
    public function setDateEcheance($dateEcheance) { $this->dateEcheance = $dateEcheance; }
    public function setHeureCreation($heureCreation) { $this->heureCreation = $heureCreation; }
    public function setHeureEcheance($heureEcheance) { $this->heureEcheance = $heureEcheance; }
    public function setStatut($statut) { $this->statut = $statut; }
    public function setPriorite($priorite) { $this->priorite = $priorite; }
    public function setCategorie($categorie) { $this->categorie = $categorie; }
}
?>
