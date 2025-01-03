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
<html>
    <head>
        <title>Gestion des tâches</title>
    </head>
    <body>
        <h1>Liste des Tâches</h1>
        <table>
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Description</th>
                <th>Statut</th>
                <th>Action</th>
            </tr>
            <?php foreach ($taches as $tache): ?>
                <tr>
                    <td><?php echo $tache['id_tache']; ?></td>
                    <td><?php echo $tache['titre_tache']; ?></td>
                    <td><?php echo $tache['desc_tache']; ?></td>
                    <td><?php echo $tache['statut_tache']; ?></td>
                    <td>
                        <a href="modifier_tache.php?id=<?php echo $tache['id_tache']; ?>">Modifier</a> | 
                        <a href="supprimer_tache.php?id=<?php echo $tache['id_tache']; ?>">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

        <!-- Formulaire d'ajout de tâche -->
        <h2>Ajouter une nouvelle tâche</h2>
        <form method="POST">
            <label for="titre_tache">Titre :</label>
            <input type="text" name="titre_tache" required><br><br>
            <label for="desc_tache">Description :</label>
            <textarea name="desc_tache"></textarea><br><br>
            <label for="statut_tache">Statut :</label>
            <select name="statut_tache">
                <option value="en_cours">En cours</option>
                <option value="terminee">Terminée</option>
                <option value="en_attente">En attente</option>
            </select><br><br>
            <label for="date_limite">Date limite :</label>
            <input type="date" name="date_limite"><br><br>
            <label for="priorite_tache">Priorité :</label>
            <select name="priorite_tache">
                <option value="basse">Basse</option>
                <option value="moyenne">Moyenne</option>
                <option value="haute">Haute</option>
            </select><br><br>
            <label for="membre_assigne_id">Membre Assigné :</label>
            <input type="number" name="membre_assigne_id" required><br><br>
            <label for="projet_id">Projet :</label>
            <input type="number" name="projet_id" required><br><br>
            <label for="etat_id">État :</label>
            <input type="number" name="etat_id" required><br><br>
            <button type="submit" name="ajouter">Ajouter</button>
        </form>
    </body>
</html>
