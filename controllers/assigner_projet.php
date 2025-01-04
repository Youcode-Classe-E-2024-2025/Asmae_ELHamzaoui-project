<?php
include_once '../controllers/projetController.php';

$projetController = new ProjetController($pdo);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['assigner'])) {
    $projet_id = $_POST['projet_id'];
    $membres = $_POST['membres']; // Les membres sélectionnés

    // Appeler la méthode pour assigner les utilisateurs au projet
    $projetController->assignerProjet($projet_id, $membres);

    // Rediriger après l'assignation (ou vous pouvez afficher un message de succès)
    echo "projet affectée avec succés";
    exit();
}
