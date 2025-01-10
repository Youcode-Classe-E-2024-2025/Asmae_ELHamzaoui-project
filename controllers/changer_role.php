<?php
// Inclure la connexion à la base de données
require_once '../config/db.php';

// Vérifier si un utilisateur est sélectionné
if (isset($_POST['user_id'])) {
    $user_id = $_POST['user_id']; // Récupérer l'ID de l'utilisateur à mettre à jour

    // Requête pour récupérer le rôle actuel de l'utilisateur
    $stmt = $pdo->prepare("SELECT role_user FROM Utilisateur WHERE id_user = :id_user");
    $stmt->bindParam(':id_user', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérifier si l'utilisateur existe
    if ($user) {
        // Récupérer le rôle actuel de l'utilisateur
        $current_role = $user['role_user'];

        // Déterminer le nouveau rôle à attribuer
        $new_role = '';
        if ($current_role == 'chef_de_projet') {
            $new_role = 'membre'; // Si l'utilisateur est chef de projet, il devient membre
        } elseif ($current_role == 'membre') {
            $new_role = 'chef_de_projet'; // Si l'utilisateur est membre, il devient chef de projet
        }

        // Si un nouveau rôle est déterminé, procéder à la mise à jour
        if ($new_role) {
            // Mise à jour du rôle dans la base de données
            $stmt = $pdo->prepare("UPDATE Utilisateur SET role_user = :new_role WHERE id_user = :id_user");
            $stmt->bindParam(':new_role', $new_role, PDO::PARAM_STR);
            $stmt->bindParam(':id_user', $user_id, PDO::PARAM_INT);
            $stmt->execute();

            // Message de succès
            header("Location: ../views/users.php"); 
        } else {
            echo "Aucun changement de rôle nécessaire.";
        }
    } else {
        echo "Utilisateur non trouvé.";
    }
} else {
    echo "Aucun utilisateur sélectionné.";
}
?>
