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
    public function ajouterTache($titre, $desc, $statut, $date_limite, $priorite, $membre_assigne_id) {
        if ($this->tacheModel->ajouterTache($titre, $desc, $statut, $date_limite, $priorite, $membre_assigne_id)) {
            echo "Tâche ajoutée avec succès.";
        } else {
            echo "Erreur lors de l'ajout de la tâche.";
        }
    }

    // Modifier une tâche
    public function modifierTache($id, $titre, $desc, $statut, $date_limite, $priorite, $membre_assigne_id) {
        if ($this->tacheModel->modifierTache($id, $titre, $desc, $statut, $date_limite, $priorite, $membre_assigne_id)) {
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

    public function assignertache($projet_id, $taches) {
        global $pdo;
        
        foreach ($taches as $tache_id) {
            // Vérifier si la relation existe déjà
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM Projet_Tache WHERE id_projet = ? AND id_tache = ?");
            $stmt->execute([$projet_id, $tache_id]);
            $count = $stmt->fetchColumn();
            
            // Si la relation n'existe pas, on l'ajoute
            if ($count == 0) {
                $stmt = $pdo->prepare("INSERT INTO Projet_Tache (id_projet, id_tache) VALUES (?, ?)");
                $stmt->execute([$projet_id, $tache_id]);
            } else {
                echo "L'utilisateur avec l'ID $tache_id est déjà assigné au projet avec l'ID $projet_id.";
            }
        }
    }

    public function assignerTacheAUtilisateur($userId, $tacheId) {
        global $pdo;
        
        // Étape 1 : Vérifier si la tâche existe
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM Tache WHERE id_tache = ?");
        $stmt->execute([$tacheId]);
        $count = $stmt->fetchColumn();
        
        if ($count == 0) {
            echo "La tâche avec l'ID $tacheId n'existe pas.";
            return;
        }
        
        // Étape 2 : Vérifier si la tâche est associée à un projet dans Projet_Tache
        $stmt = $pdo->prepare("SELECT id_projet FROM Projet_Tache WHERE id_tache = ?");
        $stmt->execute([$tacheId]);
        $projetId = $stmt->fetchColumn();
        
        if (!$projetId) {
            echo "La tâche avec l'ID $tacheId n'est associée à aucun projet.";
            return;
        }
        
        // Étape 3 : Vérifier si l'utilisateur fait partie du projet
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM Projet_Utilisateur WHERE id_projet = ? AND id_user = ?");
        $stmt->execute([$projetId, $userId]);
        $count = $stmt->fetchColumn();
        
        if ($count == 0) {
            echo "L'utilisateur avec l'ID $userId n'est pas associé au projet avec l'ID $projetId.";
            return;
        }
        
        // Étape 4 : Vérifier si la tâche est déjà assignée à l'utilisateur
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM Tache WHERE id_tache = ? AND membre_assigne_id = ?");
        $stmt->execute([$tacheId, $userId]);
        $count = $stmt->fetchColumn();
        
        if ($count > 0) {
            echo "La tâche avec l'ID $tacheId est déjà assignée à l'utilisateur avec l'ID $userId.";
            return;
        }
        
        // Étape 5 : Assigner la tâche à l'utilisateur
        $stmt = $pdo->prepare("UPDATE Tache SET membre_assigne_id = ? WHERE id_tache = ?");
        $stmt->execute([$userId, $tacheId]);
        
        echo "La tâche avec l'ID $tacheId a été assignée à l'utilisateur avec l'ID $userId avec succès.";
    }
    
      // Méthode pour récupérer les tâches assignées à un utilisateur
      public function getTachesAssignées($userId) {
        global $pdo;
        // Requête pour récupérer toutes les tâches de l'utilisateur
        $stmt = $pdo->prepare("SELECT * FROM Tache WHERE membre_assigne_id = :membre_assigne_id");
        $stmt->execute(['membre_assigne_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

         // Fonction pour mettre à jour le statut d'une tâche
    public function updateTaskStatus($taskId, $newStatus) {
        global $pdo;
        // Préparer la requête SQL pour mettre à jour le statut de la tâche
        $sql = "UPDATE Tache SET statut_tache = :statut WHERE id_tache = :id_tache";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':statut', $newStatus);
        $stmt->bindParam(':id_tache', $taskId);

        // Exécuter la requête et retourner le résultat
        return $stmt->execute();
    }
}
?>
