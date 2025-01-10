<?php

class Tag
{
    private $db;
    private $nomTag;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function createTag($nomTag)
    {
        $query = "INSERT INTO Tag (nom_tag) VALUES (:nom_tag)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nom_tag', $nomTag);
        
        return $stmt->execute();
    }


      // Afficher toutes les tags
      public function afficherTag(){
        $sql = "SELECT * FROM Tag ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
