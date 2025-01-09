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
    $photo_Projet = $_POST['photo_Projet'];
    $projetController->modifierProjet($id, $nom, $desc, $date_debut, $date_fin, $visibilite,$photo_Projet);

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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center">

    <div class="w-[500px] bg-white rounded shadow-lg" style="background-color:#f2f8ff; border:5px solid #24508c ; border-radius:10px;">
        <form method="POST"class="p-6" >
            <div class="p-4 text-center text-white pt-2" style="height:70px; width:70px;position:relative; left:400px;bottom:26px; border-bottom-left-radius:90px; border-top-right-radius:9px;font-size:25px; background-color:#24508c;">
                <button><i class="fas fa-times"></i></button>
            </div>
            <input type="hidden" name="id_projet" value="<?php echo $projet['id_projet']; ?>" />
            <div>
                <label for="nom_projet" class="block text-gray-700 font-semibold">URL image:</label>
                <input type="url" name="photo_Projet" value="<?php echo $projet['image_projet']; ?>" required class="w-full px-4 py-2 border border-gray-300 rounded mt-1">
            </div>
            <div>
                <label for="nom_projet" class="block text-gray-700 font-semibold">Nom du projet:</label>
                <input type="text" name="nom_projet" value="<?php echo $projet['nom_projet']; ?>" required class="w-full px-4 py-2 border border-gray-300 rounded mt-1">
            </div>

            <div>
                <label for="desc_projet" class="block text-gray-700 font-semibold">Description:</label>
                <textarea name="desc_projet" class="w-full px-4 py-2 border border-gray-300 rounded mt-1"><?php echo $projet['desc_projet']; ?></textarea>
            </div>

            <div class="flex space-x-4">
                <div class="w-1/2">
                <label for="date_debut" class="block text-gray-700 font-semibold">Date de début:</label>
                <input type="date" name="date_debut" value="<?php echo $projet['date_debut_projet']; ?>" class="w-full px-4 py-2 border border-gray-300 rounded mt-1">
                </div>
                <div class="w-1/2">
                <label for="date_fin" class="block text-gray-700 font-semibold">Date de fin:</label>
                <input type="date" name="date_fin" value="<?php echo $projet['date_fin_projet']; ?>" class="w-full px-4 py-2 border border-gray-300 rounded mt-1">
                </div>
                
                
            </div>

            <div>
                <label for="visibilite_projet" class="block text-gray-700 font-semibold">Visibilité:</label>
                <select name="visibilite_projet" class="w-full px-4 py-2 border border-gray-300 rounded mt-1">
                    <option value="public" <?php echo $projet['visibilite_projet'] == 'public' ? 'selected' : ''; ?>>Public</option>
                    <option value="privé" <?php echo $projet['visibilite_projet'] == 'privé' ? 'selected' : ''; ?>>Privé</option>
                </select>
            </div>

            <button type="submit" name="modifier_projet" class="w-full text-white py-2 px-4 rounded hover:bg-yellow-600 mt-2" style="background:#24508c;">Modifier le projet</button>
        </form>
    </div>

</body>
</html>
