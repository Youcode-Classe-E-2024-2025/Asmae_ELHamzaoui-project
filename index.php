<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        i{
            font-size:20px;
        }
        /* Déplacer le logo de 3px vers la gauche */
        .logo {
            transform: translateX(-20px); /* Déplace le logo de 3px vers la gauche */
        }
    </style>
</head>
<body class="font-sans bg-gray-50">

    <!-- Header -->
    <header class="mx-8">
        <div class="container flex justify-between items-center">
            <!-- Logo avec taille augmentée -->
            <img src="images/logo.png" alt="Logo" class="h-12 w-20 logo my-5"> <!-- Ajout de la classe "logo" pour appliquer la transformation -->
            <!-- Menu & Icons avec un espacement égal entre les éléments -->
            <div  class="flex space-x-8 items-center">
                <a href="index.php" class="text-black text-xl hover:text-gray-400">Home</a>
                <a href="views/publicProjects.php" class="text-black text-xl hover:text-gray-400">Project</a>
                <a href="#" class="text-black text-xl hover:text-gray-400">About</a>
            </div>
            <div class="flex space-x-8 items-center"> <!-- Espacement égal entre les éléments -->
                <!-- Icône pour l'inscription -->
                <a href="views/direction.php" class="text-black text-xl hover:text-gray-400">
                   Sign up
                </a>
                
                <!-- Icône pour la connexion -->
                <a href="views/login.php" class="text-black text-xl hover:text-gray-400">
                    log in
                </a>
            </div>
        </div>
    </header>

    <!-- Body -->
    <main class="py-48 bg-gradient-to-r to-indigo-600 text-black">
       <div class="flex flex-between">
       <div class="container">
            <h1 class="text-4xl font-bold mb-4 ml-10">DES TACHES CLAIRES</h1>
            <h1 class="text-4xl font-bold mb-4 ml-12">UNE EQUIPE PLUS PERfORMANTE</h1>
        </div>
        <div>
            <img src="images/projectImage.png" class="text-4xl font-bold mb-48 ml-2">
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
