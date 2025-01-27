<?php

require_once '../config/db.php';  // Inclure la connexion à la base de données
require_once '../models/userModel.php';  // Inclure la classe Utilisateur

$errors = [];  // Tableau pour stocker les erreurs de validation
$success = '';  // Message de succès de l'inscription

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirmPassword'] ?? '';

    // Validation des données
    if (empty($username)) {
        $errors['username'] = "Le nom d'utilisateur est requis.";
    }

    if (empty($email)) {
        $errors['email'] = "L'email est requis.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "L'email est invalide.";
    }

    if (empty($password)) {
        $errors['password'] = "Le mot de passe est requis.";
    } elseif (strlen($password) < 6) {
        $errors['password'] = "Le mot de passe doit contenir au moins 6 caractères.";
    }

    if ($password !== $confirmPassword) {
        $errors['confirmPassword'] = "Les mots de passe ne correspondent pas.";
    }

    // Si aucune erreur, procéder à l'inscription
    if (empty($errors)) {
        // Créer un nouvel objet Utilisateur (sans l'id_user, il sera généré automatiquement)
        $utilisateur = new Utilisateur(null, $username, $email, $password);  // L'id_user sera null car il est auto-incrémenté

        // Inscrire l'utilisateur dans la base de données
        if ($utilisateur->inscrire()) {
            $success = "Inscription réussie ! Vous pouvez maintenant vous connecter.";
            session_start();  // Démarre la session
            
            // Stocker les informations de l'utilisateur dans la session
            $_SESSION['user'] = [
                'id_user' => $utilisateur->getIdUser(),  // Ajout de l'ID utilisateur
                'nom_user' => $utilisateur->getNomUser(),
                'email_user' => $utilisateur->getEmailUser(),
                'role_user' => $utilisateur->getRoleUser()
            ];

            // Redirection vers la page de connexion ou une autre page
            header("Location: ../views/UserInterfaceProjects.php");
            exit;
        } else {
            $errors['general'] = "Une erreur est survenue. Veuillez réessayer plus tard.";
        }
    }
}
?>
