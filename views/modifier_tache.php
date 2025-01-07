<?php
// Inclure les fichiers nécessaires
include_once '../controllers/TacheController.php';
$controller = new TacheController($pdo);

// Vérifier si l'ID de la tâche est passé dans l'URL
if (isset($_GET['id'])) {
    $id_tache = $_GET['id'];
    $id_projet= $_GET['id_projet'];
    // Récupérer les informations de la tâche
    $tache = $controller->afficherTaches($id_projet); // récupère toutes les tâches
    $tache_a_modifier = null;

    foreach ($tache as $t) {
        if ($t['id_tache'] == $id_tache) {
            $tache_a_modifier = $t;
            break;
        }
    }

    // Modifier une tâche via formulaire
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['modifier'])) {
        $titre = $_POST['titre_tache'];
        $desc = $_POST['desc_tache'];
        $statut = $_POST['statut_tache'];
        $date_limite = $_POST['date_limite'];
        $priorite = $_POST['priorite_tache'];
        $membre_assigne_id = $_POST['membre_assigne_id'];
        $projet_id = $_POST['projet_id'];
        $etat_id = $_POST['etat_id'];

        // Appeler la méthode de modification
        $controller->modifierTache($id_tache, $titre, $desc, $statut, $date_limite, $priorite);

        $url = "../views/taches_view.php?id_projet=" . $id_projet;
        header("Location: " . $url);
    }
}
?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier la tâche</title>
    <!-- Ajouter le CDN de Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

    <div class="container mx-auto my-8 p-6 bg-white rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold text-center mb-6">Modifier la tâche</h1>

        <?php if ($tache_a_modifier): ?>
        <form method="POST">
            <div class="mb-4">
                <label for="titre_tache" class="block text-lg font-medium text-gray-700">Titre :</label>
                <input type="text" name="titre_tache" value="<?php echo $tache_a_modifier['titre_tache']; ?>" required 
                       class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <div class="mb-4">
                <label for="desc_tache" class="block text-lg font-medium text-gray-700">Description :</label>
                <textarea name="desc_tache" 
                          class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500"><?php echo $tache_a_modifier['desc_tache']; ?></textarea>
            </div>

            <div class="mb-4">
                <label for="statut_tache" class="block text-lg font-medium text-gray-700">Statut :</label>
                <select name="statut_tache" 
                        class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="en_cours" <?php echo $tache_a_modifier['statut_tache'] == 'en_cours' ? 'selected' : ''; ?>>En cours</option>
                    <option value="terminee" <?php echo $tache_a_modifier['statut_tache'] == 'terminee' ? 'selected' : ''; ?>>Terminée</option>
                    <option value="en_attente" <?php echo $tache_a_modifier['statut_tache'] == 'en_attente' ? 'selected' : ''; ?>>En attente</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="date_limite" class="block text-lg font-medium text-gray-700">Date limite :</label>
                <input type="date" name="date_limite" value="<?php echo $tache_a_modifier['date_limite_tache']; ?>" 
                       class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <div class="mb-4">
                <label for="priorite_tache" class="block text-lg font-medium text-gray-700">Priorité :</label>
                <select name="priorite_tache" 
                        class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="basse" <?php echo $tache_a_modifier['priorite_tache'] == 'basse' ? 'selected' : ''; ?>>Basse</option>
                    <option value="moyenne" <?php echo $tache_a_modifier['priorite_tache'] == 'moyenne' ? 'selected' : ''; ?>>Moyenne</option>
                    <option value="haute" <?php echo $tache_a_modifier['priorite_tache'] == 'haute' ? 'selected' : ''; ?>>Haute</option>
                </select>
            </div>
            <div class="flex justify-center">
                <button type="submit" name="modifier" 
                        class="px-6 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    Modifier
                </button>
            </div>
        </form>
        <?php else: ?>
            <p class="text-center text-red-500">Tâche non trouvée !</p>
        <?php endif; ?>
    </div>
</body>
</html>
