<?php
include_once '../models/TacheModel.php';
require_once '../config/db.php';
class TacheController {
    private $tacheModel;

    // Constructor pour initialiser le modèle
    public function __construct($db) {
        $this->tacheModel = new Tache($db);
    }

 
}
?>
