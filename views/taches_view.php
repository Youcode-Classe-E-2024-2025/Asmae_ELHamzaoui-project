<?php
// Inclure les fichiers nécessaires
include_once '../controllers/TacheController.php';
$controller = new TacheController($pdo);

// Ajouter une tâche via formulaire
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ajouter'])) {
    $titre = $_POST['titre_tache'];
    $desc = $_POST['desc_tache'];
    $statut = $_POST['statut_tache'];
    $date_limite = $_POST['date_limite'];
    $priorite = $_POST['priorite_tache'];
    $membre_assigne_id = $_POST['membre_assigne_id'];
    $projet_id = $_POST['projet_id'];
    $etat_id = $_POST['etat_id'];
    $controller->ajouterTache($titre, $desc, $statut, $date_limite, $priorite, $membre_assigne_id, $projet_id, $etat_id);
}

// Afficher toutes les tâches
$taches = $controller->afficherTaches();
?>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Gestion des tâches</title>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.1.2/dist/tailwind.min.css" rel="stylesheet">
    </head>
    <body class="bg-gray-100 text-gray-900">
        <div class="container mx-auto p-8">
            <h1 class="text-3xl font-bold text-center mb-8">Liste des Tâches</h1>
            
            <!-- Table des tâches -->
            <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="py-2 px-4 text-left">ID</th>
                        <th class="py-2 px-4 text-left">Titre</th>
                        <th class="py-2 px-4 text-left">Description</th>
                        <th class="py-2 px-4 text-left">Statut</th>
                        <th class="py-2 px-4 text-left">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($taches as $tache): ?>
                        <tr class="border-b">
                            <td class="py-2 px-4"><?php echo $tache['id_tache']; ?></td>
                            <td class="py-2 px-4"><?php echo $tache['titre_tache']; ?></td>
                            <td class="py-2 px-4"><?php echo $tache['desc_tache']; ?></td>
                            <td class="py-2 px-4"><?php echo $tache['statut_tache']; ?></td>
                            <td class="py-2 px-4">
                                <a href="modifier_tache.php?id=<?php echo $tache['id_tache']; ?>" class="text-blue-600 hover:text-blue-800">Modifier</a> | 
                                <a href="../controllers/supprimer_tache.php?id=<?php echo $tache['id_tache']; ?>" class="text-red-600 hover:text-red-800">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <!-- Formulaire d'ajout de tâche -->
            <h2 class="text-2xl font-semibold mt-10 mb-4">Ajouter une nouvelle tâche</h2>
            <form method="POST" class="space-y-4">
                <div>
                    <label for="titre_tache" class="block text-lg">Titre :</label>
                    <input type="text" name="titre_tache" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label for="desc_tache" class="block text-lg">Description :</label>
                    <textarea name="desc_tache" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                </div>
                <div>
                    <label for="statut_tache" class="block text-lg">Statut :</label>
                    <select name="statut_tache" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="en_cours">En cours</option>
                        <option value="terminee">Terminée</option>
                        <option value="en_attente">En attente</option>
                    </select>
                </div>
                <div>
                    <label for="date_limite" class="block text-lg">Date limite :</label>
                    <input type="date" name="date_limite" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label for="priorite_tache" class="block text-lg">Priorité :</label>
                    <select name="priorite_tache" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="basse">Basse</option>
                        <option value="moyenne">Moyenne</option>
                        <option value="haute">Haute</option>
                    </select>
                </div>
                <div>
                    <label for="membre_assigne_id" class="block text-lg">Membre Assigné :</label>
                    <input type="number" name="membre_assigne_id" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label for="projet_id" class="block text-lg">Projet :</label>
                    <input type="number" name="projet_id" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label for="etat_id" class="block text-lg">État :</label>
                    <input type="number" name="etat_id" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <button type="submit" name="ajouter" class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">Ajouter</button>
            </form>
        </div>
    </body>
</html>
