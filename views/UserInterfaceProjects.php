<?php
session_start();

$userId = $_SESSION['user']['id_user'];
var_dump($userId);
// Obtenir les projets assignés à l'utilisateur
include_once '../controllers/projetController.php';
$projetController = new ProjetController($pdo);
$projetsAssignes = $projetController->getProjetsAssignes($userId);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projets Assignés</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">
<header class="mx-8">
    <div class="container flex justify-between items-center">
        <!-- Logo avec taille augmentée -->
        <img src="../images/logo.png" alt="Logo" class="h-12 w-20 logo my-5 bg-gray-600 "> <!-- Ajout de la classe "logo" pour appliquer la transformation -->
        <div class="flex space-x-8 items-center"> <!-- Espacement égal entre les éléments -->
            <!-- Icône pour l'inscription -->
            <a href="deconnexion.php" class="text-2xl hover:text-gray-600">
                <i class="fa-solid fa-right-from-bracket"></i>
            </a>
        </div>
    </div>
</header>
<div class="container p-6">
    <h2 class="text-2xl font-bold mb-4">Mes projets assignés</h2>
    
    <?php if (count($projetsAssignes) > 0): ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            <?php foreach ($projetsAssignes as $projet): ?>
                <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <a href="#">
                        <img class="rounded-t-lg" src="../images/background.jpg" alt="" />
                    </a>
                    <div class="p-5">
                        <a href="#">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"><?php echo $projet['nom_projet']; ?></h5>
                        </a>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400"><?php echo $projet['desc_projet']; ?></p>
                        <p class="px-4 py-2"><?php echo $projet['date_debut_projet']; ?></p>
                        <p class="px-4 py-2"><?php echo $projet['date_fin_projet']; ?></p>
                        <p class="px-4 py-2"><?php echo $projet['visibilite_projet']; ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>Aucun projet assigné pour le moment.</p>
    <?php endif; ?>
</div>

</body>

</html>
