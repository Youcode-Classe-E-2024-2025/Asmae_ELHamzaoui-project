<?php
require_once '../config/db.php';

// Vérifier que l'ID du projet est passé dans l'URL
if (!isset($_GET['project_id']) || empty($_GET['project_id'])) {
    die("L'ID du projet est requis.");
}

$project_id = (int)$_GET['project_id'];  // Récupérer l'ID du projet

// Récupérer le contenu Markdown pour ce projet
$markdownContent = "";  // Initialise à une chaîne vide

$sql = "SELECT content FROM markdown_data WHERE id_projet = :id_projet ORDER BY created_at DESC LIMIT 1";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id_projet', $project_id, PDO::PARAM_INT);
$stmt->execute();
$row = $stmt->fetch();
if ($row) {
    $markdownContent = $row['content'];  // Contenu du dernier enregistrement pour ce projet
}

// Sauvegarder le contenu Markdown soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $content = $_POST['content'];

    // Enregistrer ou mettre à jour le fichier Markdown pour ce projet
    $sql = "INSERT INTO markdown_data (id_projet, content) VALUES (:id_projet, :content)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_projet', $project_id, PDO::PARAM_INT);
    $stmt->bindParam(':content', $content, PDO::PARAM_STR);
    $stmt->execute();

    // Rediriger après la sauvegarde
    header("Location: view_readme.php?project_id=$project_id");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Édition Markdown - Projet <?php echo htmlspecialchars($project_id); ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simplemde@1.11.2/dist/simplemde.min.css">
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0; }
        .container { width: 80%; margin: auto; padding: 20px; }
        h1 { text-align: center; }
        textarea { width: 100%; height: 300px; font-size: 16px; padding: 10px; }
        button { padding: 10px 20px; font-size: 18px; cursor: pointer; background-color: #007BFF; color: white; border: none; border-radius: 5px; }
        button:hover { background-color: #0056b3; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Modifier le fichier Markdown du projet <?php echo htmlspecialchars($project_id); ?></h1>
        <form method="post">
            <textarea id="markdown-editor" name="content"><?php echo htmlspecialchars($markdownContent); ?></textarea><br>
            <button type="submit">Sauvegarder</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/simplemde@1.11.2/dist/simplemde.min.js"></script>
    <script>
        const simplemde = new SimpleMDE({
            element: document.getElementById("markdown-editor"),
            autosave: {
                enabled: true,
                uniqueId: "markdown-editor",
                delay: 1000
            },
            status: false,
            spellChecker: false
        });
    </script>
</body>
</html>
