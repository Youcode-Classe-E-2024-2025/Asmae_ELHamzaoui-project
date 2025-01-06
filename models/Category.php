<?php

class Category
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function createCategory($nomCategorie, $descCategorie)
    {
        $query = "INSERT INTO Categorie (nom_categorie, desc_categorie) VALUES (:nom_categorie, :desc_categorie)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nom_categorie', $nomCategorie);
        $stmt->bindParam(':desc_categorie', $descCategorie);
        
        return $stmt->execute();
    }
}
