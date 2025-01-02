<?php
include_once '../models/projetModel.php';
require_once '../config/db.php';
class ProjetController {
    private $projetModel;
    // Constructor pour initialiser le modèle
    public function __construct($db) {
        $this->projetModel = new Projet($db);
    }
    // Ajouter un projet
    public function ajouterProjet($nom, $desc, $date_debut, $date_fin, $visibilite) {
        if ($this->projetModel->ajouterProjet($nom, $desc, $date_debut, $date_fin, $visibilite)) {
            echo "Projet ajouté avec succès.";
        } else {
            echo "Erreur lors de l'ajout du projet.";
        }
    }
    // Modifier un projet
    public function modifierProjet($id, $nom, $desc, $date_debut, $date_fin, $visibilite) {
        if ($this->projetModel->modifierProjet($id, $nom, $desc, $date_debut, $date_fin, $visibilite)) {
            echo "Projet modifié avec succès.";
        } else {
            echo "Erreur lors de la modification du projet.";
        }
    }
    // Supprimer un projet
    public function supprimerProjet($id) {
        if ($this->projetModel->supprimerProjet($id)) {
            echo "Projet supprimé avec succès.";
        } else {
            echo "Erreur lors de la suppression du projet.";
        }
    }
    // Afficher les projets
    public function afficherProjets() {
        return $this->projetModel->afficherProjets();
    }
  
    // méthode pour récupérer un projet par son ID
    public function getProjetById($id) {
        return $this->projetModel->getProjetById($id);
    }
}
?>
