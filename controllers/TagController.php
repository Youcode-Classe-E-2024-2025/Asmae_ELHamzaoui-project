<?php
require_once '../models/Tag.php';
require_once '../config/db.php';

class TagController
{
    private $tagModel;

    public function __construct($pdo)
    {
        $this->tagModel = new Tag($pdo);
    }

    
        // Afficher toutes les tag
     public function createTag($nomTag) {
        echo'hi';
        return $this->tagModel->createTag($nomTag);
    }

     // Afficher toutes les tag
     public function afficherTag() {
        return $this->tagModel->afficherTag();
    }

    public function insertionTagTache($tache_id, $tags){
        global $pdo;
    
        foreach ($tags as $tag_id) {
            // Vérifier si la relation existe déjà
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM Tache_Tag WHERE tache_id = ? AND tag_id = ?");
            $stmt->execute([$tache_id, $tag_id]);
            $count = $stmt->fetchColumn();
            
            // Si la relation n'existe pas, on l'ajoute
            if ($count == 0) {
                $stmt = $pdo->prepare("INSERT INTO Tache_Tag (tache_id, tag_id) VALUES (?, ?)");
                $stmt->execute([$tache_id, $tag_id]);
            } else {
                echo "tag avec l'ID $tag_id est déjà assigné à la tache avec l'ID $tache_id.";
            }
        }
    }
}

// Initialize the controller and handle the POST request

?>
