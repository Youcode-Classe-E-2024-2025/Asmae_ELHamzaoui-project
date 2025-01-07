<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.1/gsap.min.js"></script>
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
     <?php
         include_once 'views/header.php';
     ?>


    <!-- Body -->
    <main class="py-20">
       <div class="flex flex-between">
       <div class="container">
            <h1 class="text-4xl font-bold mt-24 ml-10" style="color:#24508c">DES TACHES CLAIRES</h1>
            <h1 class="text-4xl font-bold mt-8 ml-16" style="color:#24508c">UNE EQUIPE PLUS PERfORMANTE</h1>
        </div>
        <div>
            <img class="img" src="images/projectImage.png" style="width:650px;height:400px; margin-bottom:400px; margin-right:100px">
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
    // Animation des titres
    gsap.from("h1", {
        y: 50,        // Les titres arrivent depuis 50px en bas
        opacity: 0,   // Opacité commence à 0
        duration: 1,  // Durée de l'animation
        stagger: 0.3, // Décalage pour animer chaque titre séparément
        delay: 1      // L'animation commence après 1 seconde
    });

    // Animation de l'image avec un mouvement élégant (translaté horizontalement et fondu)
    gsap.from(".img", {
        x: 100,       // L'image arrive depuis 100px à droite
        opacity: 0,   // Opacité commence à 0
        scale: 1.2,   // L'image commence agrandie
        duration: 1.5, // Durée de l'animation
        delay: 1.5,    // L'animation commence après 1.5 seconde
        ease: "power3.out" // Utilisation d'un easing élégant pour rendre l'animation plus fluide
    });
    // Animation du footer
    gsap.from("footer", {
        y: 50,         // Le footer vient de bas en haut
        opacity: 0,    // Opacité commence à 0
        duration: 1,   // Durée de l'animation
        delay: 2.5     // Délai avant que l'animation commence
    });
</script>

</body>
</html>
