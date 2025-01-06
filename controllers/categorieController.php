<?php

require_once '../models/Tag.php';
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
            $nomTag = htmlspecialchars($_POST['nom_tag']); // Sanitize input

            $nomCategorie = htmlspecialchars($_POST['nom_categorie']);
            $descCategorie = htmlspecialchars($_POST['desc_categorie']);

            if ($this->categoryModel->createCategory($nomCategorie, $descCategorie)) {
                echo "success"; // Success message for JavaScript
            } else {
                echo "error"; // Error message for JavaScript
            }
        }
    }

// Initialize the controller and handle the POST request
$controller = new CategoryController($pdo);
$controller->handlePostRequest();
   
}


