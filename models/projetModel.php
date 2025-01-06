<?php
class Projet {
    private $id_projet;
    private $nom_projet;
    private $desc_projet;
    private $date_debut_projet;
    private $date_fin_projet;
    private $visibilite_projet;
    private $chefProjet_id;
    private $photo_Projet;
    private $db;
    // Constructor pour initialiser la base de données
    public function __construct($db) {
        $this->db = $db;
    }
    // Getters et Setters
    public function getIdProjet() {
        return $this->id_projet;
    }
    public function setIdProjet($id_projet) {
        $this->id_projet = $id_projet;
    }
    public function getNomProjet() {
        return $this->nom_projet;
    }
    public function setNomProjet($nom_projet) {
        $this->nom_projet = $nom_projet;
    }
    public function getDescProjet() {
        return $this->desc_projet;
    }
    public function setDescProjet($desc_projet) {
        $this->desc_projet = $desc_projet;
    }
    public function getDateDebutProjet() {
        return $this->date_debut_projet;
    }
    public function setDateDebutProjet($date_debut_projet) {
        $this->date_debut_projet = $date_debut_projet;
    }
    public function getDateFinProjet() {
        return $this->date_fin_projet;
    }
    public function setDateFinProjet($date_fin_projet) {
        $this->date_fin_projet = $date_fin_projet;
    }
    public function getVisibiliteProjet() {
        return $this->visibilite_projet;
    }
    public function setVisibiliteProjet($visibilite_projet) {
        $this->visibilite_projet = $visibilite_projet;
    }
    public function getChefProjetId() {
        return $this->chefProjet_id;
    }
    public function setChefProjetId($chefProjet_id) {
        $this->chefProjet_id = $chefProjet_id;
    }

    public function getPhotoProjet() {
        return $this->photo_Projet;
    }
    public function setPhotoProjet($photo_Projet) {
        $this->photo_Projet = $photo_Projet;
    }
    // Ajouter un projet
    public function ajouterProjet($nom, $desc, $date_debut, $date_fin, $visibilite, $photo_Projet) {
        $sql = "INSERT INTO Projet (nom_projet, desc_projet, date_debut_projet, date_fin_projet, visibilite_projet, image_projet)
                VALUES (:nom, :desc, :date_debut, :date_fin, :visibilite, :photo_Projet)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':desc', $desc);
        $stmt->bindParam(':date_debut', $date_debut);
        $stmt->bindParam(':date_fin', $date_fin);
        $stmt->bindParam(':visibilite', $visibilite);
        $stmt->bindParam(':photo_Projet', $photo_Projet);
        return $stmt->execute();
    }
    // Modifier un projet
    public function modifierProjet($id, $nom, $desc, $date_debut, $date_fin, $visibilite, $photo_Projet) {
        $sql = "UPDATE Projet SET nom_projet = :nom, desc_projet = :desc, date_debut_projet = :date_debut,
                date_fin_projet = :date_fin, visibilite_projet = :visibilite, image_projet = :photo_Projet 
                WHERE id_projet = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':desc', $desc);
        $stmt->bindParam(':date_debut', $date_debut);
        $stmt->bindParam(':date_fin', $date_fin);
        $stmt->bindParam(':visibilite', $visibilite);
        $stmt->bindParam(':photo_Projet', $photo_Projet);
        return $stmt->execute();
    }
    // Supprimer un projet
    public function supprimerProjet($id) {
        $sql = "DELETE FROM Projet WHERE id_projet = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
    // Afficher tous les projets
    public function afficherProjets() {
        $sql = "SELECT * FROM Projet";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
   
      // Afficher tous les projets publics
      public function afficherProjetsPublic() {
        $sql = "SELECT * FROM Projet WHERE visibilite_projet = 'public' ";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

// récupérer les projets selon id du projet
public function getProjetById($id) {
    $sql = "SELECT * FROM Projet WHERE id_projet = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}


}
?>
