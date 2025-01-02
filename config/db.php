<?php

// Paramètres de connexion à la base de données
$host = 'localhost';        // L'hôte de la base de données (souvent 'localhost' en développement local)
$dbname = 'gestion_projet'; // Nom de la base de données
$username = 'root';         // Nom d'utilisateur pour la connexion à la base de données (par défaut 'root' sur XAMPP/MAMP)
$password = '';             // Mot de passe pour l'utilisateur (par défaut vide sur XAMPP/MAMP)

try {
    // Créer une connexion PDO à la base de données
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    
    // Définir le mode d'erreur PDO pour lancer des exceptions en cas d'erreur
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Optionnel : définir le mode de récupération des données
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // Si la connexion réussit, aucun message nécessaire ici.
    // echo "Connexion réussie à la base de données";
} catch (PDOException $e) {
    // En cas d'erreur de connexion, afficher l'erreur
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

?>
