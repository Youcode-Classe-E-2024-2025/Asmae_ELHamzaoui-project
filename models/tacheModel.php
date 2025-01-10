<?php
class Tache {
    private $id_tache;
    private $titre_tache;
    private $desc_tache;
    private $statut_tache;
    private $date_limite_tache;
    private $priorite_tache;
    private $date_creation_tache;
    private $membre_assigne_id;
    private $projet_id;
    private $etat_id;
    private $db;

    // Constructor pour initialiser la base de données
    public function __construct($db) {
        $this->db = $db;
    }

    // Getters et Setters
    public function getIdTache() {
        return $this->id_tache;
    }

    public function setIdTache($id_tache) {
        $this->id_tache = $id_tache;
    }

    public function getTitreTache() {
        return $this->titre_tache;
    }

    public function setTitreTache($titre_tache) {
        $this->titre_tache = $titre_tache;
    }

    public function getDescTache() {
        return $this->desc_tache;
    }

    public function setDescTache($desc_tache) {
        $this->desc_tache = $desc_tache;
    }

    public function getStatutTache() {
        return $this->statut_tache;
    }

    public function setStatutTache($statut_tache) {
        $this->statut_tache = $statut_tache;
    }

    public function getDateLimiteTache() {
        return $this->date_limite_tache;
    }

    public function setDateLimiteTache($date_limite_tache) {
        $this->date_limite_tache = $date_limite_tache;
    }

    public function getPrioriteTache() {
        return $this->priorite_tache;
    }

    public function setPrioriteTache($priorite_tache) {
        $this->priorite_tache = $priorite_tache;
    }

    public function getDateCreationTache() {
        return $this->date_creation_tache;
    }

    public function setDateCreationTache($date_creation_tache) {
        $this->date_creation_tache = $date_creation_tache;
    }

    public function getMembreAssigneId() {
        return $this->membre_assigne_id;
    }

    public function setMembreAssigneId($membre_assigne_id) {
        $this->membre_assigne_id = $membre_assigne_id;
    }

    public function getProjetId() {
        return $this->projet_id;
    }

    public function setProjetId($projet_id) {
        $this->projet_id = $projet_id;
    }

    public function getEtatId() {
        return $this->etat_id;
    }

    public function setEtatId($etat_id) {
        $this->etat_id = $etat_id;
    }

    // Ajouter une tâche
    public function ajouterTache($id_projet, $titre, $desc, $statut, $date_limite, $priorite) { 
     // 1. Ajouter la tâche à la table Tache
         $sql = "INSERT INTO Tache (titre_tache, desc_tache, statut_tache, date_limite_tache, priorite_tache)
                 VALUES (:titre, :desc, :statut, :date_limite, :priorite)";
         $stmt = $this->db->prepare($sql);
         $stmt->bindParam(':titre', $titre);
         $stmt->bindParam(':desc', $desc);
         $stmt->bindParam(':statut', $statut);
         $stmt->bindParam(':date_limite', $date_limite);
         $stmt->bindParam(':priorite', $priorite);
         $stmt->execute(); // Ajout de la tâche
         
         // 2. Ajouter la tâche au projet
         // Si l'ajout de la tâche échoue mais cette étape réussit, il y a une incohérence
         $tache_id = $this->db->lastInsertId();  // ID de la tâche ajoutée
         
         $stmt = $this->db->prepare("INSERT INTO Projet_Tache (id_projet, id_tache) VALUES (:id_projet, :id_tache)");
         $stmt->bindParam(':id_projet', $id_projet);
         $stmt->bindParam(':id_tache', $tache_id);
         $stmt->execute(); // Assignation de la tâche au projet
         
         echo "Tâche ajoutée et assignée au projet!";
  
    }

    
    // Modifier une tâche
    public function modifierTache($id, $titre, $desc, $statut, $date_limite, $priorite) {
        $sql = "UPDATE Tache SET titre_tache = :titre, desc_tache = :desc, statut_tache = :statut, 
                date_limite_tache = :date_limite, priorite_tache = :priorite WHERE id_tache = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':titre', $titre);
        $stmt->bindParam(':desc', $desc);
        $stmt->bindParam(':statut', $statut);
        $stmt->bindParam(':date_limite', $date_limite);
        $stmt->bindParam(':priorite', $priorite);
        return $stmt->execute();
    }

    // Supprimer une tâche
     public function supprimerTache($id) {
        // Supprimer les lignes associées dans projet_tache
        $sqlDeleteProjetTache = "DELETE FROM projet_tache WHERE id_tache = :id";
        $stmt = $this->db->prepare($sqlDeleteProjetTache);
        $stmt->bindParam(':id', $id);
        $stmt->execute(); // Exécute la suppression dans projet_tache
    
        // Ensuite, supprimer la tâche dans la table tache
        $sqlDeleteTache = "DELETE FROM Tache WHERE id_tache = :id";
        $stmt = $this->db->prepare($sqlDeleteTache);
        $stmt->bindParam(':id', $id);
        return $stmt->execute(); // Exécute la suppression dans tache
    }
    
     // Afficher toutes les tâches
     public function afficherTache(){
        $sql = "SELECT * FROM Tache ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // Afficher toutes les tâches
    public function afficherTaches($id_projet){
        $sql = "SELECT t.* FROM Tache t JOIN Projet_Tache pt ON t.id_tache = pt.id_tache WHERE pt.id_projet = :id_projet";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_projet', $id_projet);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


      // Récupérer les tâches par projet
      public function getTachesByProjet($projet_id) {
        $query = "SELECT * FROM Tache WHERE projet_id = :projet_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':projet_id', $projet_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);  // Retourne toutes les tâches sous forme de tableau associatif
    }
}
?>
