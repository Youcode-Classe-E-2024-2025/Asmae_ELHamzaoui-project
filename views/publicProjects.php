<?php
include_once '../controllers/projetController.php';
$projetController = new ProjetController($pdo);
$projets = $projetController->afficherProjets();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-sans bg-gray-500">

    <!-- Header -->
    <header class="mx-8">
        <div class="container flex justify-between items-center">
            <!-- Logo avec taille augmentée -->
            <img src="images/logo.png" alt="Logo" class="h-12 w-20 logo my-5"> <!-- Ajout de la classe "logo" pour appliquer la transformation -->
            <!-- Menu & Icons avec un espacement égal entre les éléments -->
            <div  class="flex space-x-8 items-center">
                <a href="#" class="text-white text-xl hover:text-gray-400">Home</a>
                <a href="#" class="text-white text-xl hover:text-gray-400">Project</a>
                <a href="#" class="text-white text-xl hover:text-gray-400">About</a>
            </div>
            <div class="flex space-x-8 items-center"> <!-- Espacement égal entre les éléments -->
                <!-- Icône pour l'inscription -->
                <a href="views/direction.php" class="text-white text-xl hover:text-gray-400">
                   Sign up
                </a>
                
                <!-- Icône pour la connexion -->
                <a href="views/login.php" class="text-white text-xl hover:text-gray-400">
                    log in
                </a>
            </div>
        </div>
    </header>
    <main class="py-32 bg-gradient-to-r to-indigo-600 text-white">
        <div class="container mx-auto">
            <h1 class="text-4xl font-bold text-center mb-12">Projets Publics</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
              <?php foreach($projets as $project): ?>
              <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                  <a href="#">
                      <img class="rounded-t-lg" src="../images/background.jpg" alt="" />
                  </a>
                  <div class="p-5">
                      <a href="#">
                          <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"><?php echo $project['nom_projet']; ?></h5>
                      </a>
                      <p class="mb-3 font-normal text-gray-700 dark:text-gray-400"><?php echo $project['desc_projet']; ?></p>
                  </div>
              </div>
              <?php endforeach; ?>
           </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-black text-white py-6">
        <div class="container mx-auto text-center">
            <h3>&copy; 2024 Tous droits réservés. Mon entreprise.</h3>
        </div>
    </footer>

</body>
</html>
