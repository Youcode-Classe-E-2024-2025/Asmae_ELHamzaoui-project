<?php
include_once '../models/projetModel.php';
require_once '../config/db.php';
class ProjetController {
    private $projetModel;
    // Constructor pour initialiser le modèle
    public function __construct($db) {
        $this->projetModel = new Projet($db);
    }
    // Ajouter un projet
    public function ajouterProjet($nom, $desc, $date_debut, $date_fin, $visibilite) {
        if ($this->projetModel->ajouterProjet($nom, $desc, $date_debut, $date_fin, $visibilite)) {
            echo "Projet ajouté avec succès.";
        } else {
            echo "Erreur lors de l'ajout du projet.";
        }
    }
    // Modifier un projet
    public function modifierProjet($id, $nom, $desc, $date_debut, $date_fin, $visibilite) {
        if ($this->projetModel->modifierProjet($id, $nom, $desc, $date_debut, $date_fin, $visibilite)) {
            echo "Projet modifié avec succès.";
        } else {
            echo "Erreur lors de la modification du projet.";
        }
    }
    // Supprimer un projet
    public function supprimerProjet($id) {
        if ($this->projetModel->supprimerProjet($id)) {
            echo "Projet supprimé avec succès.";
        } else {
            echo "Erreur lors de la suppression du projet.";
        }
    }
    // Afficher les projets
    public function afficherProjets() {
        return $this->projetModel->afficherProjets();
    }
  
      // Afficher les projets
      public function afficherProjetsPublic() {
        return $this->projetModel->afficherProjetsPublic();
    }

    // méthode pour récupérer un projet par son ID
    public function getProjetById($id) {
        return $this->projetModel->getProjetById($id);
    }

public function getMembres() {
    global $pdo;
    $stmt = $pdo->prepare("SELECT id_user, nom_user FROM Utilisateur WHERE role_user = 'membre'");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
// Ajouter cette méthode dans le controller
public function assignerProjet($projet_id, $utilisateurs) {
    global $pdo;
    
    // Boucle à travers les utilisateurs sélectionnés et les associer au projet
    foreach ($utilisateurs as $utilisateur_id) {
        $stmt = $pdo->prepare("INSERT INTO Projet_Utilisateur (id_projet, id_user, role_utilisateur) VALUES (?, ?, 'membre')");
        $stmt->execute([$projet_id, $utilisateur_id]);
    }
}

}
?>
