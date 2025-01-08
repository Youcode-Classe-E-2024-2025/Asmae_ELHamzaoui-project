<?php
include_once '../controllers/projetController.php';
$projetController = new ProjetController($pdo);
$projets = $projetController->afficherProjetsPublic();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.1/gsap.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700&display=swap" rel="stylesheet">
    <style>
          body {
            background-color:#f2f8ff;
        }
        i{
            font-size:20px;
        }
        /* Déplacer le logo de 3px vers la gauche */
        .logo {
            transform: translateX(-20px); /* Déplace le logo de 3px vers la gauche */
        }
    </style>
</head>
<body>

    <!-- Header -->
    <header class="mx-4">
        <div class="container flex justify-between items-center">
            <!-- Logo avec taille augmentée -->
            <img src="../images/logo.png" alt="Logo" class="h-24 w-32"> <!-- Ajout de la classe "logo" pour appliquer la transformation -->
            <!-- Menu & Icons avec un espacement égal entre les éléments -->
            <div  class="flex space-x-8 items-center">
                <a href="../index.php" class="text-2xl font-bold hover:text-gray-400" style="color:#24508c">Home</a>
                <a href="publicProjects.php" class="text-2xl font-bold hover:text-gray-400" style="color:#24508c">Project</a>
                <a href="#" class="text-2xl font-bold hover:text-gray-400" style="color:#24508c">About</a>
            </div>
            <div class="flex space-x-6 items-center mr-8"> <!-- Espacement égal entre les éléments -->
                <!-- Icône pour l'inscription -->
                <a href="direction.php" class="text-2xl  hover:text-gray-400" style="color:#24508c;font-weight:600;">
                   Sign up
                </a>
                
                <!-- Icône pour la connexion -->
                <a href="login.php" class="text-2xl  hover:text-gray-400" style="color:#24508c ;font-weight:600;">
                    log in
                </a>
            </div>
        </div>
    </header>
    <main class="py-2 bg-gradient-to-r to-indigo-600 text-white">
        <div class="container">
            <h1 class="text-4xl font-bold text-center mb-12" style="color:#24508c">Projets Publics</h1>
        <div class="grid mx-8 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
              <?php foreach($projets as $project): ?>
              <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                  <a href="#">
                      <img class="rounded-t-lg" src="<?php echo $project['image_projet']; ?>" style="height:200px;" />
                  </a>
                  <div class="p-5">
                      <a href="#">
                          <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white" style="color:#24508c ; font-family: 'Merriweather', serif;"><?php echo $project['nom_projet']; ?></h5>
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
    <script>
  // Attendre que la page soit complètement chargée
  document.addEventListener("DOMContentLoaded", function() {

    // Animation du logo (déplacement vers la gauche)
    gsap.from(".logo", {
      duration: 1,
      x: -50,
      opacity: 0,
      ease: "power2.out"
    });

    // Animation des cartes de projet (apparaître avec un léger décalage)
    gsap.from(".max-w-sm", {
      duration: 1.5,
      opacity: 0,
      y: 100,
      stagger: 0.3, // Pour animer chaque carte avec un léger décalage
      ease: "power2.out"
    });

  });
</script>

</body>
</html>
