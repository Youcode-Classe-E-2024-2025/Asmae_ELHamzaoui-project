<?php
// Inclure les fichiers nécessaires
include_once '../controllers/tacheController.php';
$controllerTache = new TacheController($pdo);

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['assigner_tache_user'])) {
    // Récupérer les tâches sélectionnées et l'utilisateur
    $taches = $_POST['taches'] ?? [];  // Si aucune tâche n'est sélectionnée, $taches sera un tableau vide
    $userId = $_POST['user_id'];

    // Assigner les tâches à l'utilisateur
    if (!empty($taches) && !empty($userId)) {
        foreach ($taches as $tacheId) {
            $controllerTache->assignerTacheAUtilisateur($userId, $tacheId);
        }
        echo "Les tâches ont été assignées avec succès à l'utilisateur.";
    } else {
        echo "Veuillez sélectionner des tâches et un utilisateur.";
    }
}

// Récupérer les tâches disponibles

?>
