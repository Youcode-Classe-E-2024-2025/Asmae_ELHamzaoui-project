<?php
// Inclure les fichiers nécessaires
include_once '../controllers/TacheController.php';
$controller = new TacheController($pdo);

// Vérifier si l'ID de la tâche est passé dans l'URL
if (isset($_GET['id'])) {
    $id_tache = $_GET['id'];

    // Appeler la méthode de suppression
    if ($controller->supprimerTache($id_tache)) {
        echo "Tâche supprimée avec succès.";
    } else {
        echo "Erreur lors de la suppression de la tâche.";
    }

    // Rediriger vers la page des tâches après suppression
    header("Location: taches.php");
    exit;
} else {
    echo "ID de tâche non spécifié.";
}
?>
