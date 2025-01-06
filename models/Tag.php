<?php

class Tag
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function createTag($nomTag, $descTag)
    {
        $query = "INSERT INTO Tag (nom_tag, desc_tag) VALUES (:nom_tag, :desc_tag)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nom_tag', $nomTag);
        $stmt->bindParam(':desc_tag', $descTag);
        
        return $stmt->execute();
    }
}
