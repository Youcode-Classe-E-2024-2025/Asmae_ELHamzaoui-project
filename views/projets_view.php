<?php
include_once '../controllers/projetController.php';

$projetController = new ProjetController($pdo);

// Ajouter un projet
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ajouter'])) {
    $nom = $_POST['nom_projet'];
    $desc = $_POST['desc_projet'];
    $date_debut = $_POST['date_debut'];
    $date_fin = $_POST['date_fin'];
    $visibilite = $_POST['visibilite_projet'];
    $projetController->ajouterProjet($nom, $desc, $date_debut, $date_fin, $visibilite);
}

// Affichage des projets
$projets = $projetController->afficherProjets();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des projets</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">

    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-bold mb-4">Liste des projets</h2>

        <table class="table-auto w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 border border-gray-300 text-left">Nom</th>
                    <th class="px-4 py-2 border border-gray-300 text-left">Description</th>
                    <th class="px-4 py-2 border border-gray-300 text-left">Date de début</th>
                    <th class="px-4 py-2 border border-gray-300 text-left">Date de fin</th>
                    <th class="px-4 py-2 border border-gray-300 text-left">Visibilité</th>
                    <th class="px-4 py-2 border border-gray-300 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($projets as $projet): ?>
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 border border-gray-300"><?php echo $projet['nom_projet']; ?></td>
                    <td class="px-4 py-2 border border-gray-300"><?php echo $projet['desc_projet']; ?></td>
                    <td class="px-4 py-2 border border-gray-300"><?php echo $projet['date_debut_projet']; ?></td>
                    <td class="px-4 py-2 border border-gray-300"><?php echo $projet['date_fin_projet']; ?></td>
                    <td class="px-4 py-2 border border-gray-300"><?php echo $projet['visibilite_projet']; ?></td>
                    <td class="px-4 py-2 border border-gray-300">
                        <form method="POST" action="assigner_tache.php" class="inline">
                            <input type="hidden" name="projet_id" value="<?php echo $projet['id_projet']; ?>" />
                            <button type="submit" name="assigner" class="bg-blue-500 text-white py-1 px-3 rounded hover:bg-blue-600">Assigner tâche</button>
                        </form>
                        <form method="POST" action="modifier_projet.php" class="inline ml-2">
                            <input type="hidden" name="projet_id" value="<?php echo $projet['id_projet']; ?>" />
                            <button type="submit" name="modifier" class="bg-yellow-500 text-white py-1 px-3 rounded hover:bg-yellow-600">Modifier</button>
                        </form>
                        <form method="POST" action="../controllers/supprimer_projet.php" class="inline ml-2">
                            <input type="hidden" name="projet_id" value="<?php echo $projet['id_projet']; ?>" />
                            <button type="submit" name="supprimer" class="bg-red-500 text-white py-1 px-3 rounded hover:bg-red-600">Supprimer</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h2 class="text-2xl font-bold mt-8 mb-4">Ajouter un nouveau projet</h2>
        <form method="POST" class="bg-white p-6 rounded-lg shadow-md">
            <div class="mb-4">
                <label for="nom_projet" class="block text-gray-700">Nom du projet:</label>
                <input type="text" name="nom_projet" required class="w-full px-4 py-2 border border-gray-300 rounded mt-1">
            </div>
            
            <div class="mb-4">
                <label for="desc_projet" class="block text-gray-700">Description:</label>
                <textarea name="desc_projet" class="w-full px-4 py-2 border border-gray-300 rounded mt-1"></textarea>
            </div>
            
            <div class="mb-4">
                <label for="date_debut" class="block text-gray-700">Date de début:</label>
                <input type="date" name="date_debut" class="w-full px-4 py-2 border border-gray-300 rounded mt-1">
            </div>
            
            <div class="mb-4">
                <label for="date_fin" class="block text-gray-700">Date de fin:</label>
                <input type="date" name="date_fin" class="w-full px-4 py-2 border border-gray-300 rounded mt-1">
            </div>
            
            <div class="mb-4">
                <label for="visibilite_projet" class="block text-gray-700">Visibilité:</label>
                <select name="visibilite_projet" class="w-full px-4 py-2 border border-gray-300 rounded mt-1">
                    <option value="public">Public</option>
                    <option value="privé">Privé</option>
                </select>
            </div>
            
            <button type="submit" name="ajouter" class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Ajouter le projet</button>
        </form>
    </div>

</body>

</html>
