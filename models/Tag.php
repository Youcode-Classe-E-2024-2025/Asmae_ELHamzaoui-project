<?php

class Tag
{
    private $db;

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
}
