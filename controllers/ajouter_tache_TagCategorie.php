<?php
include_once '../controllers/TagController.php';
include_once '../controllers/categorieController.php';

$CategoryController = new CategoryController($pdo);
$TagController = new TagController($pdo);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tache_id = $_POST['id_tache'];
    $categories = $_POST['categories'] ?? [];
    $tags = $_POST['tags'] ?? [];
   

    // Appeler la méthode pour ajouter les catégories à une tache
    $CategoryController ->insertionCategorieTache($tache_id, $categories);
     // Appeler la méthode pour ajouter les tags à une tache
     $TagController->insertionTagTache($tache_id, $tags);

    // Rediriger après l'assignation (ou vous pouvez afficher un message de succès)
    echo "tag et categorie affectée avec succés";
    exit();
}



