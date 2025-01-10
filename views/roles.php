<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des projets</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Le modal sera placé au-dessus du contenu avec un fond semi-transparent */
        #modal, #modal-assigner {
            display: none; /* Initialement caché */
            position: fixed; /* Pour qu'il soit fixé en haut de la page */
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5); /* Fond semi-transparent */
            z-index: 50; /* Placer le modal au-dessus du contenu */
            justify-content: center;
            align-items: center;
            overflow-y: auto;
        }

        /* Contenu du modal */
        .modal-content {
            margin: auto;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            width: 80%;
            max-width: 600px;
        }
        body {
            background-color:#f2f8ff;
        }
       
         /* Icône du gear */
    .gear-icon {
      font-size: 30px;
      cursor: pointer;
      position: relative; 

    }

    /* Style du menu */
    .menu {
      display: none; /* Initialement caché */
      position: absolute;
      top: 60px; /* Place le menu juste en dessous de l'icône */
      right:65px;
      background-color: #f9f9f9;
      border: 1px solid #ccc;
      padding: 5px;
      width:150px;
      border-radius: 5px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      z-index: 10; /* Assure que le menu est au-dessus des autres éléments */
    }

    /* Style des éléments de menu */
    .menu a {
      display: block;
      background-color:#f2f8ff;
      margin-top:2px;
      color: #333;
      text-decoration: none;
    }

    .menu a:hover {
        background-color:rgb(185, 212, 243);
        cursor: pointer;
    }

    </style>
</head>

<body>

<header class="mx-4">
    <div class="container flex justify-between items-center">
        <!-- Logo avec taille augmentée -->
        <img src="../images/logo.png" alt="Logo" class="h-24 w-32"> <!-- Ajout de la classe "logo" pour appliquer la transformation -->
        <div class="space-x-6 items-center mr-8"> <!-- Espacement égal entre les éléments --> 
            <i class="fa-duotone fa-solid fa-gear gear-icon"style="color:#24508c;" onclick="toggleMenu()">
            </i> 
            <div class="menu" id="menu">
              <a onclick="ajouterProjet()" class="text-center" style="color:#24508c">ajouter projet</a>
              <a onclick="assignerProjet()" class="text-center" style="color:#24508c">assigner projet</a>
              <a href="deconnexion.php"  class="text-center hover:text-gray-400" style="color:#24508c">log out</a>
            </div>
        </div>
    </div>               
</header>





</body>

</html>
