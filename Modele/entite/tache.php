<?php

class Tache {
    public $id_tache;
    public $libelle_tache;
    public $descriptif_tache;
    public $date_creation;
    public $date_echeance;
    public $heure_creation;
    public $heure_echeance;
    public $statut_tache;
    public $priorite_tache;
    public $id_user;
    public $categorie;

    public function __construct(
        $id_tache,
        $libelle_tache,
        $descriptif_tache,
        $date_creation,
        $date_echeance,
        $heure_creation,
        $heure_echeance,
        $statut_tache,
        $priorite_tache,
        $categorie,
        $id_user
    ) {
        $this->id_tache = $id_tache;
        $this->libelle_tache = $libelle_tache;
        $this->descriptif_tache = $descriptif_tache;
        $this->date_creation = $date_creation;
        $this->date_echeance = $date_echeance;
        $this->heure_creation = $heure_creation;
        $this->heure_echeance = $heure_echeance;
        $this->statut_tache = $statut_tache;
        $this->priorite_tache = $priorite_tache;
        $this->categorie= $categorie;
        $this->id_user = $id_user;
    }
}
// creer une instance de la table user
?>