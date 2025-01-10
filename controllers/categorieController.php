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



     // Afficher toutes les tags
     public function createCategory($nomCategorie, $descCategorie) {
        return $this->categoryModel->createCategory($nomCategorie, $descCategorie);
    }
    
     // Afficher toutes les tags
     public function afficherCategorie() {
        return $this->categoryModel->afficherCategorie();
    }
   
    public function insertionCategorieTache($tache_id,  $categories){
        global $pdo;
    
        foreach ( $categories as  $categorie_id) {
            // Vérifier si la relation existe déjà
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM Tache_Categorie WHERE tache_id = ? AND categorie_id = ?");
            $stmt->execute([$tache_id,  $categorie_id]);
            $count = $stmt->fetchColumn();
            
            // Si la relation n'existe pas, on l'ajoute
            if ($count == 0) {
                $stmt = $pdo->prepare("INSERT INTO Tache_Categorie (tache_id, categorie_id) VALUES (?, ?)");
                $stmt->execute([$tache_id,  $categorie_id]);
            } else {
                echo "tag avec l'ID  $categorie_id est déjà assigné à la tache avec l'ID $tache_id.";
            }
        }
    }
}


