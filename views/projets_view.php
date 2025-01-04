<?php
include_once '../controllers/projetController.php';

$projetController = new ProjetController($pdo);

// Ajouter un projet
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ajouter'])) {
    $nom = $_POST['nom_projet'];
    $desc = $_POST['desc_projet'];
    $date_debut = $_POST['date_debut'];
    $date_fin = $_POST['date_fin'];
    $visibilite = $_POST['visibilite_projet'];
    $projetController->ajouterProjet($nom, $desc, $date_debut, $date_fin, $visibilite);
}

// Affichage des projets
$projets = $projetController->afficherProjets();
?>

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
        #modal {
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
    </style>
</head>

<body class="bg-gray-50">
<header class="mx-8">
        <div class="container flex justify-between items-center">
            <!-- Logo avec taille augmentée -->
            <img src="../images/logo.png" alt="Logo" class="h-12 w-20 logo my-5 bg-gray-600 "> <!-- Ajout de la classe "logo" pour appliquer la transformation -->
            <div class="flex space-x-8 items-center"> <!-- Espacement égal entre les éléments -->
                <!-- Icône pour l'inscription -->
                <a href="views/direction.php" class="text-2xl hover:text-gray-600">
                <i class="fa-solid fa-right-from-bracket"></i>
                </a>
            </div>
        </div>
    </header>

   

    <div class="container p-6">
        
        <div class="flex justify-between items-center">
          <h2 class="text-2xl font-bold mb-4">Liste des projets</h2>
          <h2 class="text-xl font-bold mb-4  border border-gray-200 rounded-lg bg-sky-700 w-70 h-12 pt-2 px-10"><button onclick="ajouterProjet()">Ajouter projet</button></h2>
        </div>
        
        <div class="container mx-auto">
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
                      <p class="px-4 py-2"><?php echo $project['date_debut_projet']; ?></p>
                      <p class="px-4 py-2"><?php echo $project['date_fin_projet']; ?></p>
                      <p class="px-4 py-2"><?php echo $project['visibilite_projet']; ?></p>

                      <!-- <form method="POST" action="assigner_tache.php" class="inline">
                        <input type="hidden" name="projet_id" value="<?php echo $projet['id_projet']; ?>" />
                        <button type="submit" name="assigner" class="bg-blue-500 text-white py-1 px-3 rounded hover:bg-blue-600">Assigner tâche</button>
                      </form> -->
                      <form method="POST" action="modifier_projet.php" class="inline ml-2">
                        <input type="hidden" name="projet_id" value="<?php echo $projet['id_projet']; ?>" />
                        <button type="submit" name="modifier" class="bg-yellow-500 text-white py-1 px-3 rounded hover:bg-yellow-600">Modifier</button>
                      </form>
                      <form method="POST" action="../controllers/supprimer_projet.php" class="inline ml-2">
                        <input type="hidden" name="projet_id" value="<?php echo $projet['id_projet']; ?>" />
                        <button type="submit" name="supprimer" class="bg-red-500 text-white py-1 px-3 rounded hover:bg-red-600">Supprimer</button>
                     </form>
                  </div>
              </div>
              <?php endforeach; ?>
           </div>
        </div>
<!--  -->
<div class="hidden w-90 h-200 text-center bg-blue-200" id="modal">
        <form method="POST" class="bg-white p-6 ">
            <div class="mb-4">
                <label for="nom_projet" class="block text-gray-700">Nom du projet:</label>
                <input type="text" name="nom_projet" required class="w-80 px-4 py-2 border border-gray-300 rounded mt-1">
            </div>
            
            <div class="mb-4">
                <label for="desc_projet" class="block text-gray-700">Description:</label>
                <textarea name="desc_projet" class="w-80 px-4 py-2 border border-gray-300 rounded mt-1"></textarea>
            </div>
            
            <div class="mb-4">
                <label for="date_debut" class="block text-gray-700">Date de début:</label>
                <input type="date" name="date_debut" class="w-80 px-4 py-2 border border-gray-300 rounded mt-1">
            </div>
            
            <div class="mb-4">
                <label for="date_fin" class="block text-gray-700">Date de fin:</label>
                <input type="date" name="date_fin" class="w-80 px-4 py-2 border border-gray-300 rounded mt-1">
            </div>
            
            <div class="mb-4">
                <label for="visibilite_projet" class="block text-gray-700">Visibilité:</label>
                <select name="visibilite_projet" class="w-80 px-4 py-2 border border-gray-300 rounded mt-1">
                    <option value="public">Public</option>
                    <option value="privé">Privé</option>
                </select>
            </div>
            
            <button type="submit" name="ajouter" class="w-80 bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Ajouter le projet</button>
        </form>
    </div>
    </div>
    
  <script>
    const modalProjet= document.getElementById('modal');
    function ajouterProjet(){
        modalProjet.style.display = modalProjet.style.display === "flex" ? "none" : "flex"; // Toggle visibility

    }
  </script>
</body>

</html>
