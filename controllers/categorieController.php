<?php

require_once '../models/Category.php';
require_once '../config/db.php';

class CategoryController
{
    private $categoryModel;

    public function __construct($pdo)
    {
        $this->categoryModel = new Category($pdo);
    }


    public function handlePostRequest()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nomCategorie = htmlspecialchars($_POST['nom_categorie']);
            $descCategorie = htmlspecialchars($_POST['desc_categorie']);
            $id_projet = $_GET['id_projet'];
            if ($this->categoryModel->createCategory($nomCategorie, $descCategorie)) {
                header("Location: ../views/taches_view.php?id_projet=" . $id_projet);
            } else {
                echo "error"; // Error message for JavaScript
            }
        }
    }


    
     // Afficher toutes les tags
     public function afficherCategorie() {
        return $this->categoryModel->afficherCategorie();
    }
   
}

// Initialize the controller and handle the POST request
$Category = new CategoryController($pdo);
$Category->handlePostRequest();
