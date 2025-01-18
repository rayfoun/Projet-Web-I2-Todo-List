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

    // Getters et setters
    public function getUtilisateur() {
        return $this->utilisateur;
    }
    public function setUtilisateur($utilisateur) {
        $this->utilisateur = $utilisateur;
    }

    public function getId() { 
        return $this->id; 
    }
    public function setId($id){
        $this->id=$id;
    }

    public function getLibelle() { 
        return $this->libelle; 
    }

    public function setLibelle($libelle){
        $this->libelle=$libelle;
    }

    public function getDescriptif(){
        return $this->descriptif;
    }

    public function setDescriptif($descriptif){
        $this->descriptif= $descriptif;
    }

    public function getDateCreation(){
        return $this->$dateCreation;
    }

    public function setDateCreation($dateCreation){
        $this->dateCreation=$dateCreation;
    }

    public function getDateEcheance(){
        return $this->$dateEcheance;
    }

    public function setDateEcheance($dateEcheance){
        $this->dateEcheance=$dateEcheance;
    }

    public function getHeureCreation(){
        return $this->$heureCreation;
    }

    public function setHeureCreation($heureCreation){
        $this->heureCreation=$heureCreation;
    }

    public function getHeureEcheance(){
        return $this->$heureEcheance;
    }

    public function setHeureEcheance($heureEcheance){
        $this->heureEcheance=$heureEcheance;
    }                         

    public function getStatut(){
        return $this->$statut;
    }

    public function setStatut($statut){
        $this->statut=$statut;
    }

    public function getPriorite(){
        return $this->$priorite;
    }

    public function setPriorite($priorite){
        $this->priorite=$priorite;
    }

    public function getCategorie(){
        return $this->$categorie;
    }

    public function setCategorie($categorie){
        $this->categorie=$categorie;
    }

    // Autres getters et setters pour les champs restants...
    // Création d'un utilisateur.
// L'instance $utilisateur représente un utilisateur avec le nom "Dupont" et le prénom "Jean".
//$utilisateur = new Utilisateur("Dupont", "Jean");

// Création d'une tâche associée à l'utilisateur.
// L'instance $tache représente une tâche avec le libellé "Préparer la réunion" et l'utilisateur $utilisateur.
//$tache = new Tache("Préparer la réunion", $utilisateur);

// Affichage des informations de la tâche et de son utilisateur associé.
// Affiche le libellé de la tâche.
//echo "Tâche : " . $tache->getLibelle() . "\n";

// Affiche le nom complet de l'utilisateur qui a créé ou est assigné à cette tâche.
//echo "Créée par : " . $tache->getUtilisateur()->getNomComplet() . "\n";
}

?>