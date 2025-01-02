<?php
include_once '../controllers/projetController.php';
require_once '../config/db.php';

$projetController = new ProjetController($pdo);

// Vérifier si un projet est sélectionné
if (isset($_POST['supprimer']) && isset($_POST['projet_id'])) {
    $projet_id = $_POST['projet_id'];
    // Supprimer le projet
    $projetController->supprimerProjet($projet_id);
    header("Location: ../views/projets_view.php"); // Rediriger après suppression
    exit();
}
?>
