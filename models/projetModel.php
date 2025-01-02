<?php
class Projet {
    private $id_projet;
    private $nom_projet;
    private $desc_projet;
    private $date_debut_projet;
    private $date_fin_projet;
    private $visibilite_projet;
    private $chefProjet_id;
    private $db;
    // Constructor pour initialiser la base de données
    public function __construct($db) {
        $this->db = $db;
    }
    // Getters et Setters
    public function getIdProjet() {
        return $this->id_projet;
    }
    public function setIdProjet($id_projet) {
        $this->id_projet = $id_projet;
    }
    public function getNomProjet() {
        return $this->nom_projet;
    }
    public function setNomProjet($nom_projet) {
        $this->nom_projet = $nom_projet;
    }
    public function getDescProjet() {
        return $this->desc_projet;
    }
    public function setDescProjet($desc_projet) {
        $this->desc_projet = $desc_projet;
    }
    public function getDateDebutProjet() {
        return $this->date_debut_projet;
    }
    public function setDateDebutProjet($date_debut_projet) {
        $this->date_debut_projet = $date_debut_projet;
    }
    public function getDateFinProjet() {
        return $this->date_fin_projet;
    }
    public function setDateFinProjet($date_fin_projet) {
        $this->date_fin_projet = $date_fin_projet;
    }
    public function getVisibiliteProjet() {
        return $this->visibilite_projet;
    }
    public function setVisibiliteProjet($visibilite_projet) {
        $this->visibilite_projet = $visibilite_projet;
    }
    public function getChefProjetId() {
        return $this->chefProjet_id;
    }
    public function setChefProjetId($chefProjet_id) {
        $this->chefProjet_id = $chefProjet_id;
    }
   
}
?>
