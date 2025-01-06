<?php

require_once '../models/Tag.php';

class TagController
{
    private $tagModel;

    public function __construct($db)
    {
        $this->tagModel = new Tag($db);
    }

    public function createTag()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nomTag = $_POST['nom_tag'];
            $descTag = $_POST['desc_tag'];

            if ($this->tagModel->createTag($nomTag, $descTag)) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false]);
            }
        }
    }
}
