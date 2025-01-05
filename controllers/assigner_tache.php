<?php
include_once '../controllers/tacheController.php';

$TacheController = new TacheController($pdo);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['assigner'])) {
    $projet_id = $_POST['projet_id'];
    $taches = $_POST['taches']; // Les membres sélectionnés

    // Appeler la méthode pour assigner les utilisateurs au projet
    $TacheController->assignertache($projet_id, $taches);

    // Rediriger après l'assignation (ou vous pouvez afficher un message de succès)
    echo "projet affectée avec succés";
    exit();
}
