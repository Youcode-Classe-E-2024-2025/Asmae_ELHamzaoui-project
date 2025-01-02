<?php

require_once '../config/db.php';  // Inclure la connexion à la base de données
require_once '../models/userModel.php';  // Inclure la classe Utilisateur

$errors = [];  // Tableau pour stocker les erreurs de validation

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Validation des données
    if (empty($email)) {
        $errors['email'] = "L'email est requis.";
    }

    if (empty($password)) {
        $errors['password'] = "Le mot de passe est requis.";
    }

    // Si aucune erreur, procéder à la connexion
    if (empty($errors)) {
        // Appeler la méthode seConnecter du modèle Utilisateur
        $utilisateur = Utilisateur::seConnecter($email, $password);

        if ($utilisateur) {
            // Connexion réussie, démarrer la session et rediriger
            session_start();
            $_SESSION['user'] = [
                'nom_user' => $utilisateur->nom_user,
                'email_user' => $utilisateur->email_user,
                'role_user' => $utilisateur->role_user
            ];

            // Vérification du rôle de l'utilisateur
            if ($utilisateur->role_user === 'chef_de_projet') {
                // Si le rôle est chef de projet, rediriger vers dashboard.php
                header("Location: dashboard.php");
            } else if ($utilisateur->role_user === 'membre') {
                // Si le rôle est membre, rediriger vers projets.php
                header("Location: projets.php");
            } else {
                // Si le rôle n'est ni chef de projet ni membre, rediriger vers une page par défaut (facultatif)
                header("Location: home.php");
            }
            exit;
        } else {
            $errors['general'] = "Email ou mot de passe incorrect.";
        }
    }
}

?>
