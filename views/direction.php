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
            background-image:white;
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
            background-color:#f2f8ff;
            text-align:center;
            border-top:1px solid #24508c;
            border-left:1px solid #24508c;
            box-shadow: 12px 12px 12px rgba(72, 146, 230, 0.3); /* Ombre */
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
    <main class="py-48 bg-gradient-to-r to-indigo-600" style="color:#24508c;">
        <div class="flex justify-center gap-20">
            <div class="choix"><a href="registerChef.php"><i class="fa-solid fa-user" style="color:#24508c;"></i></a><div><a href="registerChef.php">Chef de projet</a></div></div>
            <div class="choix"><a href="register.php"><i class="fa-solid fa-user" style="color:#24508c;"></i></a><div><a href="register.php">Membre</a></div></div>
        </div>
    </main>


</body>
</html>
