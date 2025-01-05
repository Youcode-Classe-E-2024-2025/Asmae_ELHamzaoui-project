<?php
// Inclure les fichiers nécessaires
include_once '../controllers/TacheController.php';
$controller = new TacheController($pdo);

// Ajouter une tâche via formulaire
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ajouter'])) {
    $titre = $_POST['titre_tache'];
    $desc = $_POST['desc_tache'];
    $statut = $_POST['statut_tache'];
    $date_limite = $_POST['date_limite'];
    $priorite = $_POST['priorite_tache'];
    $membre_assigne_id = $_POST['membre_assigne_id'];
    $projet_id = $_POST['projet_id'];
    $etat_id = $_POST['etat_id'];
    $controller->ajouterTache($titre, $desc, $statut, $date_limite, $priorite, $membre_assigne_id, $projet_id, $etat_id);
}

// Afficher toutes les tâches
$taches = $controller->afficherTaches();
?>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Gestion des tâches</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
        <script src="https://cdn.tailwindcss.com"></script>
        <style>
            /* Fond d'écran du modal (overlay) */
            #modalOverlay {
                display: none; /* Caché par défaut */
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5); /* Fond semi-transparent */
                z-index: 9998; /* Un peu plus bas que le modal */
            }

            /* Style du modal */
            #modalTache {
                display: none; /* Le modal est caché initialement */
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                background-color: white;
                padding: 20px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                z-index: 9999; /* Assurez-vous que le modal apparaît au-dessus du contenu */
                width: 80%;
                max-width: 600px;
                border-radius: 8px;
                overflow-y: auto; /* Pour que le contenu dépasse si nécessaire */
                max-height: 80vh; /* Limiter la hauteur du modal */
            }

            /* Pour les formulaires du modal */
            .modal-form input, .modal-form select, .modal-form textarea {
                width: 100%;
                padding: 10px;
                margin: 8px 0;
                border-radius: 8px;
                border: 1px solid #ccc;
                box-sizing: border-box;
            }

            .modal-form button {
                background-color: #1D4ED8; /* Couleur de fond du bouton */
                color: white;
                padding: 10px 20px;
                border-radius: 8px;
                border: none;
                cursor: pointer;
                width: 100%;
                margin-top: 10px;
            }

            .modal-form button:hover {
                background-color: #2563EB;
            }
        </style>
    </head>
    <body class="bg-gray-100 text-gray-900">
    <header class="mx-8">
       <div class="container flex justify-between items-center">
           <img src="../images/logo.png" alt="Logo" class="h-12 w-20 logo my-5 bg-gray-600 ">
           <div class="flex space-x-8 items-center">
               <a href="views/direction.php" class="text-2xl hover:text-gray-600">
                   <i class="fa-solid fa-right-from-bracket"></i>
               </a>
           </div>
       </div>
    </header>
        <div class="flex justify-center gap-4">
        <div class="w-64 h-screen  border rounded-lg p-6">
            <div class="w-48 h-10 border rounded-lg p-2 bg-gray-200">Taches</div><br>
            <div class="w-48 h-10 border rounded-lg p-2 bg-gray-200">Assignements</div>
        </div>
        <div class="container mx-auto p-8  border rounded-lg">
            <div class="flex justify-between gap-4">
             <h1 class="text-3xl font-bold mb-8">Liste des Tâches</h1>
             <div class="flex flex-center gap-2">   
               <button id="assignerTacheButton" class="w-40 h-10 border rounded-lg p-2 bg-gray-200">Assigner Tâche</button>
               <button id="openModalButton" class="w-40 h-10 border rounded-lg p-2 bg-gray-200">Ajouter tache</button>
             </div>
            </div>
           
            <!-- Table des tâches -->
            <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="py-2 px-4 text-left">ID</th>
                        <th class="py-2 px-4 text-left">Titre</th>
                        <th class="py-2 px-4 text-left">Description</th>
                        <th class="py-2 px-4 text-left">Statut</th>
                        <th class="py-2 px-4 text-left">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($taches as $tache): ?>
                        <tr class="border-b">
                            <td class="py-2 px-4"><?php echo $tache['id_tache']; ?></td>
                            <td class="py-2 px-4"><?php echo $tache['titre_tache']; ?></td>
                            <td class="py-2 px-4"><?php echo $tache['desc_tache']; ?></td>
                            <td class="py-2 px-4"><?php echo $tache['statut_tache']; ?></td>
                            <td class="py-2 px-4">
                                <a href="modifier_tache.php?id=<?php echo $tache['id_tache']; ?>" class="text-blue-600 hover:text-blue-800">Modifier</a> | 
                                <a href="../controllers/supprimer_tache.php?id=<?php echo $tache['id_tache']; ?>" class="text-red-600 hover:text-red-800">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <!-- Formulaire d'ajout de tâche -->
            <div id="modalOverlay"></div>
            <div id="modalTache">
                <h2 class="text-2xl font-semibold mt-10 mb-4">Ajouter une nouvelle tâche</h2>
               <form method="POST" class="modal-form space-y-4">
                   <div>
                       <label for="titre_tache" class="block text-lg">Titre :</label>
                       <input type="text" name="titre_tache" required class="focus:outline-none focus:ring-2 focus:ring-blue-500">
                   </div>
                   <div>
                       <label for="desc_tache" class="block text-lg">Description :</label>
                       <textarea name="desc_tache" class="focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                   </div>
                   <div>
                       <label for="statut_tache" class="block text-lg">Statut :</label>
                       <select name="statut_tache" class="focus:outline-none focus:ring-2 focus:ring-blue-500">
                           <option value="en_cours">En cours</option>
                           <option value="terminee">Terminée</option>
                           <option value="en_attente">En attente</option>
                       </select>
                   </div>
                   <div>
                       <label for="date_limite" class="block text-lg">Date limite :</label>
                       <input type="date" name="date_limite" class="focus:outline-none focus:ring-2 focus:ring-blue-500">
                   </div>
                   <div>
                       <label for="priorite_tache" class="block text-lg">Priorité :</label>
                       <select name="priorite_tache" class="focus:outline-none focus:ring-2 focus:ring-blue-500">
                           <option value="basse">Basse</option>
                           <option value="moyenne">Moyenne</option>
                           <option value="haute">Haute</option>
                       </select>
                   </div>
                   <div>
                       <label for="membre_assigne_id" class="block text-lg">Membre Assigné :</label>
                       <input type="number" name="membre_assigne_id" required class="focus:outline-none focus:ring-2 focus:ring-blue-500">
                   </div>
                   <div>
                       <label for="projet_id" class="block text-lg">Projet :</label>
                       <input type="number" name="projet_id" required class="focus:outline-none focus:ring-2 focus:ring-blue-500">
                   </div>
                   <div>
                       <label for="etat_id" class="block text-lg">État :</label>
                       <input type="number" name="etat_id" required class="focus:outline-none focus:ring-2 focus:ring-blue-500">
                   </div>
                   <button type="submit" name="ajouter">Ajouter</button>
               </form>
            </div>
            
        </div>
        </div>

        <script>
            // Lorsque le bouton est cliqué, affiche le modal
            document.getElementById('openModalButton').addEventListener('click', function() {
                document.getElementById('modalTache').style.display = 'block';
                document.getElementById('modalOverlay').style.display = 'block';
            });

            // Optionnel: Fermer le modal lorsqu'on clique sur le fond (overlay)
            document.getElementById('modalOverlay').addEventListener('click', function() {
                document.getElementById('modalTache').style.display = 'none';
                document.getElementById('modalOverlay').style.display = 'none';
            });
        </script>
    </body>
</html>
