<?php
// Démarrer la session pour accéder à $_SESSION
session_start();

// Inclure les fichiers nécessaires
include_once '../controllers/TacheController.php';
$controller = new TacheController($pdo);

// Vérifier si les données sont envoyées via POST
$data = json_decode(file_get_contents('php://input'), true);

// Récupérer l'ID de la tâche et le nouveau statut
$taskId = $data['taskId'] ?? null;
$newStatus = $data['newStatus'] ?? null;

// Vérifier si les informations sont valides
if ($taskId && $newStatus) {
    // Mettre à jour le statut de la tâche
    $success = $controller->updateTaskStatus($taskId, $newStatus);

    // Répondre en JSON avec un message de succès ou d'échec
    if ($success) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erreur lors de la mise à jour de la tâche.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Paramètres manquants']);
}
?>
