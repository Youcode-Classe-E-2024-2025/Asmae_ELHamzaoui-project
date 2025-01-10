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

    public function handlePostRequest()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nomTag = htmlspecialchars($_POST['nom_tag']); // Sanitize input
              
            $id_projet = $_GET['id_projet'];
            if ($this->tagModel->createTag($nomTag)) {
                header("Location: ../views/taches_view.php?id_projet=" . $id_projet);
            } else {
                echo "error"; // Error message for JavaScript
            }
        }
    }

     // Afficher toutes les tags
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
$controller = new TagController($pdo);
$controller->handlePostRequest();
?>
