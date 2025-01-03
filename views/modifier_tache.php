<?php
// Inclure les fichiers nécessaires
include_once '../controllers/TacheController.php';
$controller = new TacheController($pdo);

// Vérifier si l'ID de la tâche est passé dans l'URL
if (isset($_GET['id'])) {
    $id_tache = $_GET['id'];
    
    // Récupérer les informations de la tâche
    $tache = $controller->afficherTaches(); // récupère toutes les tâches
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
        $controller->modifierTache($id_tache, $titre, $desc, $statut, $date_limite, $priorite, $membre_assigne_id, $projet_id, $etat_id);
        header("Location: taches.php"); // Rediriger vers la liste des tâches après modification
    }
}
?>
<html>
    <head>
        <title>Modifier la tâche</title>
    </head>
    <body>
        <h1>Modifier la tâche</h1>

        <?php if ($tache_a_modifier): ?>
        <form method="POST">
            <label for="titre_tache">Titre :</label>
            <input type="text" name="titre_tache" value="<?php echo $tache_a_modifier['titre_tache']; ?>" required><br><br>
            <label for="desc_tache">Description :</label>
            <textarea name="desc_tache"><?php echo $tache_a_modifier['desc_tache']; ?></textarea><br><br>
            <label for="statut_tache">Statut :</label>
            <select name="statut_tache">
                <option value="en_cours" <?php echo $tache_a_modifier['statut_tache'] == 'en_cours' ? 'selected' : ''; ?>>En cours</option>
                <option value="terminee" <?php echo $tache_a_modifier['statut_tache'] == 'terminee' ? 'selected' : ''; ?>>Terminée</option>
                <option value="en_attente" <?php echo $tache_a_modifier['statut_tache'] == 'en_attente' ? 'selected' : ''; ?>>En attente</option>
            </select><br><br>
            <label for="date_limite">Date limite :</label>
            <input type="date" name="date_limite" value="<?php echo $tache_a_modifier['date_limite_tache']; ?>"><br><br>
            <label for="priorite_tache">Priorité :</label>
            <select name="priorite_tache">
                <option value="basse" <?php echo $tache_a_modifier['priorite_tache'] == 'basse' ? 'selected' : ''; ?>>Basse</option>
                <option value="moyenne" <?php echo $tache_a_modifier['priorite_tache'] == 'moyenne' ? 'selected' : ''; ?>>Moyenne</option>
                <option value="haute" <?php echo $tache_a_modifier['priorite_tache'] == 'haute' ? 'selected' : ''; ?>>Haute</option>
            </select><br><br>
            <label for="membre_assigne_id">Membre Assigné :</label>
            <input type="number" name="membre_assigne_id" value="<?php echo $tache_a_modifier['membre_assigne_id']; ?>" required><br><br>
            <label for="projet_id">Projet :</label>
            <input type="number" name="projet_id" value="<?php echo $tache_a_modifier['projet_id']; ?>" required><br><br>
            <label for="etat_id">État :</label>
            <input type="number" name="etat_id" value="<?php echo $tache_a_modifier['etat_id']; ?>" required><br><br>
            <button type="submit" name="modifier">Modifier</button>
        </form>
        <?php else: ?>
            <p>Tâche non trouvée !</p>
        <?php endif; ?>
    </body>
</html>
