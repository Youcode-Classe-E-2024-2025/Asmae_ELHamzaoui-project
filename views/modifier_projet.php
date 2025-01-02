<?php
include_once '../controllers/projetController.php';
require_once '../config/db.php';

$projetController = new ProjetController($pdo);

// Vérifier si le projet existe
if (isset($_POST['modifier']) && isset($_POST['projet_id'])) {
    $projet_id = $_POST['projet_id'];
    $projet = $projetController->getProjetById($projet_id);
}

// Modifier un projet
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['modifier_projet'])) {
    $id = $_POST['id_projet'];
    $nom = $_POST['nom_projet'];
    $desc = $_POST['desc_projet'];
    $date_debut = $_POST['date_debut'];
    $date_fin = $_POST['date_fin'];
    $visibilite = $_POST['visibilite_projet'];
    $projetController->modifierProjet($id, $nom, $desc, $date_debut, $date_fin, $visibilite);

    // Après la modification, rediriger vers la page d'affichage des projets
    header('Location: ../views/projets_view.php'); // Remplacez 'liste_projets.php' par la page qui affiche les projets
    exit; // Assurez-vous d'appeler exit après header pour éviter que le reste du script soit exécuté
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le projet</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">

    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-bold mb-4">Modifier le projet</h2>

        <form method="POST" class="bg-white p-6 rounded-lg shadow-md">
            <input type="hidden" name="id_projet" value="<?php echo $projet['id_projet']; ?>" />

            <div class="mb-4">
                <label for="nom_projet" class="block text-gray-700">Nom du projet:</label>
                <input type="text" name="nom_projet" value="<?php echo $projet['nom_projet']; ?>" required class="w-full px-4 py-2 border border-gray-300 rounded mt-1">
            </div>

            <div class="mb-4">
                <label for="desc_projet" class="block text-gray-700">Description:</label>
                <textarea name="desc_projet" class="w-full px-4 py-2 border border-gray-300 rounded mt-1"><?php echo $projet['desc_projet']; ?></textarea>
            </div>

            <div class="mb-4">
                <label for="date_debut" class="block text-gray-700">Date de début:</label>
                <input type="date" name="date_debut" value="<?php echo $projet['date_debut_projet']; ?>" class="w-full px-4 py-2 border border-gray-300 rounded mt-1">
            </div>

            <div class="mb-4">
                <label for="date_fin" class="block text-gray-700">Date de fin:</label>
                <input type="date" name="date_fin" value="<?php echo $projet['date_fin_projet']; ?>" class="w-full px-4 py-2 border border-gray-300 rounded mt-1">
            </div>

            <div class="mb-4">
                <label for="visibilite_projet" class="block text-gray-700">Visibilité:</label>
                <select name="visibilite_projet" class="w-full px-4 py-2 border border-gray-300 rounded mt-1">
                    <option value="public" <?php echo $projet['visibilite_projet'] == 'public' ? 'selected' : ''; ?>>Public</option>
                    <option value="privé" <?php echo $projet['visibilite_projet'] == 'privé' ? 'selected' : ''; ?>>Privé</option>
                </select>
            </div>

            <button type="submit" name="modifier_projet" class="w-full bg-yellow-500 text-white py-2 px-4 rounded hover:bg-yellow-600">Modifier le projet</button>
        </form>
    </div>

</body>
</html>
