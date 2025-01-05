<?php

require_once '../config/db.php';

class Utilisateur {
    private $id_user;
    private $nom_user;
    private $email_user;
    private $mot_de_passe;
    private $role_user;

    public function __construct($id_user,$nom_user, $email_user, $mot_de_passe, $role_user = 'membre') {
        $this->id_user = $id_user;
        $this->nom_user = $nom_user;
        $this->email_user = $email_user;
        $this->mot_de_passe = $mot_de_passe;
        $this->role_user = $role_user;
    }

    // Getters
    public function getIdUser() {
        return $this->id_user;
    }

    public function getNomUser() {
        return $this->nom_user;
    }

    public function getEmailUser() {
        return $this->email_user;
    }

    public function getRoleUser() {
        return $this->role_user;
    }

    // Setters
    public function setNomUser($nom_user) {
        $this->nom_user = $nom_user;
    }

    public function setEmailUser($email_user) {
        $this->email_user = $email_user;
    }

    public function setMotDePasse($mot_de_passe) {
        $this->mot_de_passe = $mot_de_passe;
    }

    public function setRoleUser($role_user) {
        $this->role_user = $role_user;
    }

    public function inscrire() {
        global $pdo;
        $query = "INSERT INTO Utilisateur (nom_user, email_user, mot_de_passe, role_user) 
                  VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($query);
        return $stmt->execute([$this->nom_user, $this->email_user, password_hash($this->mot_de_passe, PASSWORD_DEFAULT), $this->role_user]);
    }

    public static function seConnecter($email_user, $mot_de_passe) {
        global $pdo;
        $query = "SELECT * FROM Utilisateur WHERE email_user = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$email_user]);
        $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($utilisateur && password_verify($mot_de_passe, $utilisateur['mot_de_passe'])) {
            return new Utilisateur($utilisateur['id_user'],$utilisateur['nom_user'], $utilisateur['email_user'], $utilisateur['mot_de_passe'], $utilisateur['role_user']);
        }

        return null;
    }
}

?>
