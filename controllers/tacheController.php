<?php
include_once '../models/TacheModel.php';
require_once '../config/db.php';
class TacheController {
    private $tacheModel;

    // Constructor pour initialiser le modèle
    public function __construct($db) {
        $this->tacheModel = new Tache($db);
    }

    // Ajouter une tâche
    public function ajouterTache($titre, $desc, $statut, $date_limite, $priorite, $membre_assigne_id, $projet_id, $etat_id) {
        if ($this->tacheModel->ajouterTache($titre, $desc, $statut, $date_limite, $priorite, $membre_assigne_id, $projet_id, $etat_id)) {
            echo "Tâche ajoutée avec succès.";
        } else {
            echo "Erreur lors de l'ajout de la tâche.";
        }
    }

    // Modifier une tâche
    public function modifierTache($id, $titre, $desc, $statut, $date_limite, $priorite, $membre_assigne_id, $projet_id, $etat_id) {
        if ($this->tacheModel->modifierTache($id, $titre, $desc, $statut, $date_limite, $priorite, $membre_assigne_id, $projet_id, $etat_id)) {
            echo "Tâche modifiée avec succès.";
        } else {
            echo "Erreur lors de la modification de la tâche.";
        }
    }

    // Supprimer une tâche
    public function supprimerTache($id) {
        if ($this->tacheModel->supprimerTache($id)) {
            echo "Tâche supprimée avec succès.";
        } else {
            echo "Erreur lors de la suppression de la tâche.";
        }
    }

    // Afficher toutes les tâches
    public function afficherTaches() {
        return $this->tacheModel->afficherTaches();
    }

  
}
?>
