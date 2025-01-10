<?php
require_once '../config/db.php'; 

 
//  Vérifier si un projet est sélectionné
if (isset($_POST['supprimer']) && isset($_POST['user_id'])) {
    
    $user_id = $_POST['user_id'];
    // Supprimer le projet
    function supprimerUtilisateur($user_id) {
        global $pdo;
    
        // 1. Supprimer les associations dans la table Projet_Utilisateur
        $stmt = $pdo->prepare("DELETE FROM Projet_Utilisateur WHERE id_user = :id_user");
        $stmt->bindParam(':id_user', $user_id, PDO::PARAM_INT);
        $stmt->execute();
    
        // 2. Supprimer toutes les entrées associées dans la table Projet_Tache
        $stmt = $pdo->prepare("DELETE FROM Projet_Tache WHERE id_tache IN (SELECT id_tache FROM Tache WHERE membre_assigne_id = :id_user)");
        $stmt->bindParam(':id_user', $user_id, PDO::PARAM_INT);
        $stmt->execute();
    
        // 3. Supprimer les tâches assignées à l'utilisateur dans la table Tache
        $stmt = $pdo->prepare("DELETE FROM Tache WHERE membre_assigne_id = :id_user");
        $stmt->bindParam(':id_user', $user_id, PDO::PARAM_INT);
        $stmt->execute();
    
        // 4. Supprimer l'utilisateur dans la table Utilisateur
        $stmt = $pdo->prepare("DELETE FROM Utilisateur WHERE id_user = :id_user");
        $stmt->bindParam(':id_user', $user_id, PDO::PARAM_INT);
        $stmt->execute();
    }
    
    
    supprimerUtilisateur($user_id);
    header("Location: ../views/users.php"); // Rediriger après suppression
    exit();
}
?>