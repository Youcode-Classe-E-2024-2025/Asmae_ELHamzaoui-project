<?php
// Démarrer la session pour pouvoir accéder à la variable $_SESSION
session_start();

// Inclure les fichiers nécessaires
include_once '../controllers/TacheController.php';
$controller = new TacheController($pdo);

// Vérifier que le formulaire a bien été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer l'ID de la tâche et le nouveau statut
    $taskId = $_POST['taskId'];
    $newStatus = $_POST['newStatus'];

    // Mettre à jour le statut de la tâche dans la base de données
    if ($controller->updateTaskStatus($taskId, $newStatus)) {
        // Rediriger vers la page principale (ou une autre page)
        header('Location: UserInterfaceTache.php');
        exit();
    } else {
        echo "Erreur lors de la mise à jour de la tâche.";
    }
}
?>
