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
            // Connexion réussie, démarrer la session
            session_start();  // Démarre la session
            
            // Stocker les informations de l'utilisateur dans la session
            $_SESSION['user'] = [
                'id_user' => $utilisateur->getIdUser(),  // Ajout de l'ID utilisateur
                'nom_user' => $utilisateur->getNomUser(),
                'email_user' => $utilisateur->getEmailUser(),
                'role_user' => $utilisateur->getRoleUser()
            ];

            // Vérification du rôle de l'utilisateur
            if ($utilisateur->getRoleUser() === 'chef_de_projet') {
                // Si le rôle est chef de projet, rediriger vers dashboard.php
                
               
                header("Location: ../views/projets_view.php");
                exit;  // Assurez-vous que le script s'arrête après la redirection
            } else if ($utilisateur->getRoleUser() === 'membre') {
                // Si le rôle est membre, rediriger vers projets.php
                
                header("Location: ../views/UserInterfaceProjects.php");
                exit;  // Assurez-vous que le script s'arrête après la redirection
            } else {
                // Si le rôle n'est ni chef de projet ni membre, rediriger vers une page par défaut (facultatif)
                header("Location: home.php");
                exit;  // Assurez-vous que le script s'arrête après la redirection
            }
        } else {
            echo "Email ou mot de passe incorrect.";
        }
    }
}

?>
