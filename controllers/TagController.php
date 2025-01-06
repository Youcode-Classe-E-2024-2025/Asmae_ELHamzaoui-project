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

            if ($this->tagModel->createTag($nomTag)) {
                echo "success"; // Success message for JavaScript
            } else {
                echo "error"; // Error message for JavaScript
            }
        }
    }
}

// Initialize the controller and handle the POST request
$controller = new TagController($pdo);
$controller->handlePostRequest();
?>
