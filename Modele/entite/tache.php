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

    public function getLibelle() { 
        return $this->libelle; 
    }
    // Autres getters et setters pour les champs restants...
    // Création d'un utilisateur.
// L'instance $utilisateur représente un utilisateur avec le nom "Dupont" et le prénom "Jean".
$utilisateur = new Utilisateur("Dupont", "Jean");

// Création d'une tâche associée à l'utilisateur.
// L'instance $tache représente une tâche avec le libellé "Préparer la réunion" et l'utilisateur $utilisateur.
$tache = new Tache("Préparer la réunion", $utilisateur);

// Affichage des informations de la tâche et de son utilisateur associé.
// Affiche le libellé de la tâche.
echo "Tâche : " . $tache->getLibelle() . "\n";

// Affiche le nom complet de l'utilisateur qui a créé ou est assigné à cette tâche.
echo "Créée par : " . $tache->getUtilisateur()->getNomComplet() . "\n";
}
