<?php
require_once '../config/db.php';

$project_id = (int)$_GET['project_id'];

// Récupérer le contenu Markdown pour ce projet
$markdownContent = "";
$sql = "SELECT content FROM markdown_data WHERE id_projet = :id_projet ORDER BY created_at DESC LIMIT 1";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id_projet', $project_id, PDO::PARAM_INT);
$stmt->execute();
$row = $stmt->fetch();
if ($row) {
    $markdownContent = $row['content'];
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lire le README - Projet <?php echo htmlspecialchars($project_id); ?></title>
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
        }
        h1 {
            text-align: center;
        }
        .markdown-content {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            white-space: pre-line; /* Garder les retours à la ligne */
        }
        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            font-size: 16px;
            color: #007BFF;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }

        /* Style personnalisé pour des éléments markdown */
        .markdown-content h1 {
            color: #2c3e50; /* Exemple de couleur de titre */
        }
        .markdown-content h2 {
            color: #34495e; /* Autre couleur pour un sous-titre */
        }
        .markdown-content .green {
            color: green;
        }
        .markdown-content .yellow {
            color: yellow;
        }
        .markdown-content p {
            font-size: 16px;
            line-height: 1.6;
        }
        .markdown-content code {
            background-color: #f4f4f4;
            padding: 5px;
            border-radius: 5px;
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Contenu du README pour le projet</h1>
    <div class="markdown-content" id="markdown-content">
        <!-- Le contenu Markdown sera affiché ici -->
        <?php echo '<pre>' . htmlspecialchars($markdownContent) . '</pre>'; ?>
    </div>
    <a href="edit_markdown.php?project_id=<?php echo $project_id; ?>">Retour à l'édition</a>
</div>

<script>
    // Récupérer le contenu Markdown de l'élément HTML
    const markdownContent = `<?php echo addslashes($markdownContent); ?>`;

    // Convertir le contenu Markdown en HTML en utilisant marked.js
    const htmlContent = marked(markdownContent);

    // Remplacer le contenu Markdown par le contenu HTML
    document.getElementById('markdown-content').innerHTML = htmlContent;
</script>

</body>
</html>
