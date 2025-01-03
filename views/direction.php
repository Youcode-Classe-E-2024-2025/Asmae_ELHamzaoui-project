<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Ajoutez un arrière-plan d'image pour le corps */
        body {
            background-image: url('../images/background.jpg'); /* Remplacez par le chemin de votre image */
            background-size: cover;
            background-position: center;
        }
        i{
            font-size:20px;
        }
        /* Déplacer le logo de 3px vers la gauche */
        .logo {
            transform: translateX(-20px); /* Déplace le logo de 3px vers la gauche */
        }
        .choix{
            height:300px;
            width:300px;
            border-radius:20px;
            background-color:#1C325B;
            text-align:center;
            border-top:1px solid white;
            border-left:1px solid white;
            box-shadow: 12px 12px 12px rgba(255, 255, 255, 0.3); /* Ombre */
            transition: transform 0.3s ease; /* Transition pour l'animation */
        }
        .choix i{
            margin-top:30px;
            font-size:200px;
        }
        .choix div{
            margin-top:10px;
            font-size:20px;            
        }
    </style>
</head>
<body class="font-sans bg-gray-50">

    <!-- Body -->
    <main class="py-48 bg-gradient-to-r to-indigo-600 text-white">
        <div class="flex justify-center gap-20">
            <div class="choix"><a href="registerChef.php"><i class="fa-solid fa-user"></i></a><div><a href="registerChef.php">Chef de projet</a></div></div>
            <div class="choix"><a href="register.php"><i class="fa-solid fa-user"></i></a><div><a href="register.php">Membre</a></div></div>
        </div>
    </main>


</body>
</html>