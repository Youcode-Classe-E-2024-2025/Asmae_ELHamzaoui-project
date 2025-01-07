<?php
// Inclure les fichiers nécessaires
include_once '../controllers/projetController.php';
include_once '../controllers/TacheController.php';
$controller = new TacheController($pdo);
$projetController = new ProjetController($pdo);
$id_projet = $_GET['id_projet'];
// Ajouter une tâche via formulaire
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ajouter'])) {
    $titre = $_POST['titre_tache'];
    $desc = $_POST['desc_tache'];
    $statut = $_POST['statut_tache'];
    $date_limite = $_POST['date_limite'];
    $priorite = $_POST['priorite_tache'];
    $membre_assigne_id = 0;
    $controller->ajouterTache($id_projet,$titre, $desc, $statut, $date_limite, $priorite, $membre_assigne_id);
}


// Afficher toutes les tâches
$taches = $controller->afficherTaches($id_projet);
$projets = $projetController->afficherProjets();
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
        #modalTache, #modalAssigner, #modalUserTache {
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
       <img src="../images/logo.png" alt="Logo" class="h-12 w-20 logo my-5 bg-gray-600 " />
       <div class="flex space-x-8 items-center">
           <a href="views/direction.php" class="text-2xl hover:text-gray-600">
               <i class="fa-solid fa-right-from-bracket"></i>
           </a>
       </div>
   </div>
</header>

<div class="flex justify-center gap-4">
    <div class="w-64 h-screen border rounded-lg p-6">
        <div class="w-48 h-10 border rounded-lg p-2 bg-gray-200">Taches</div><br>
        <div class="w-48 h-10 border rounded-lg p-2 bg-gray-200">Assignements</div>
    </div>

    <div class="container mx-auto p-8 border rounded-lg">
        <div class="flex justify-between gap-4">
            <h1 class="text-3xl font-bold mb-8">Liste des Tâches</h1>
            <div class="flex flex-center gap-2">
                <button id="openModalButton" class="w-40 h-10 border rounded-lg p-2 bg-gray-200">Ajouter tache</button>
                <button id="openModalTacheUser" class="w-40 h-10 border rounded-lg p-2 bg-gray-200">Assigner tâche</button>
            </div>
        </div>

        <!-- Affichage des tâches selon le projet -->
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
                            <a href="modifier_tache.php?id=<?php echo $tache['id_tache']; ?>&id_projet=<?php echo $id_projet; ?>" class="text-blue-600 hover:text-blue-800">Modifier</a> | 
                            <a href="../controllers/supprimer_tache.php?id=<?php echo urlencode($tache['id_tache']); ?>&id_projet=<?php echo urlencode($id_projet); ?>" class="text-red-600 hover:text-red-800" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette tâche ?')">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div id="modalOverlay"></div>

        <!-- Formulaire d'ajout de tâche -->
        <div id="modalTache">
            <h2 class="text-2xl font-semibold mt-10 mb-4">Ajouter une nouvelle tâche</h2>
            <form method="POST" class="modal-form space-y-4">
                <div>
                    <label for="titre_tache" class="block text-lg">Titre :</label>
                    <input type="text" name="titre_tache" required class="focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>
                <div>
                    <label for="desc_tache" class="block text-lg">Description :</label>
                    <textarea name="desc_tache" class="focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                </div>
                <div>
                    <label for="statut_tache" class="block text-lg">Statut :</label>
                    <select name="statut_tache" class="focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="en_cours">En cours</option>
                    </select>
                </div>
                <div>
                    <label for="date_limite" class="block text-lg">Date limite :</label>
                    <input type="date" name="date_limite" class="focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>
                <div>
                    <label for="priorite_tache" class="block text-lg">Priorité :</label>
                    <select name="priorite_tache" class="focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="basse">Basse</option>
                        <option value="moyenne">Moyenne</option>
                        <option value="haute">Haute</option>
                    </select>
                </div>
                <button type="submit" name="ajouter">Ajouter</button>
            </form>
        </div>

        <!-- Modal pour Assignation de tâche pour des membres-->
        <div id="modalUserTache">
            <form method="POST" action="../controllers/assigner_tache_user.php">
                <label for="taches">Sélectionner des tâches :</label>
                <br>
                 <!-- Affichage des cases à cocher pour chaque tâche -->
                <?php       
                 foreach ($taches as $tache) {
                    echo "<input type=\"checkbox\" name=\"taches[]\" value=\"" . $tache['id_tache'] . "\"> " . $tache['titre_tache'] . "<br>";
                }
                ?>
                <br>
                <label for="user_id">Sélectionner un utilisateur :</label>
                <select name="user_id" id="user_id">
                    <?php
                    // Récupérer les membres assigné pour le projet
                    $stmt = $pdo->prepare("SELECT u.id_user, u.nom_user FROM Utilisateur u JOIN Projet_Utilisateur pu ON u.id_user = pu.id_user WHERE pu.id_projet = :id_projet;");
                    $stmt->bindParam(':id_projet', $id_projet);
                    $stmt->execute();
                    $utilisateurs = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    // Affichage des utilisateurs dans le menu déroulant
                    foreach ($utilisateurs as $utilisateur) {
                        echo "<option value=\"" . $utilisateur['id_user'] . "\">" . $utilisateur['nom_user'] . "</option>";
                    }
                    ?>
                </select>
                <br><br>

                <button type="submit" name="assigner_tache_user" class="w-40 h-10 border rounded-lg p-2 bg-blue-200">Assigner</button>
                <button type="button" id="closeUserTacheModal" class="w-40 h-10 border rounded-lg p-2 bg-red-200">Annuler</button>
            </form>
        </div>

        <script>
            // Fonction pour ouvrir un modal
            function openModal(modalId, overlayId) {
                document.getElementById(modalId).style.display = 'block';
                document.getElementById(overlayId).style.display = 'block';
            }

            // Fonction pour fermer un modal
            function closeModal(modalId, overlayId) {
                document.getElementById(modalId).style.display = 'none';
                document.getElementById(overlayId).style.display = 'none';
            }

            // Lorsque le bouton est cliqué, affiche le modal d'ajout de tâche
            document.getElementById('openModalButton').addEventListener('click', function() {
                openModal('modalTache', 'modalOverlay');
            });

            // Lors du clic sur le bouton "Assigner tâche"
            document.getElementById('openModalTacheUser').addEventListener('click', function() {
                openModal('modalUserTache', 'modalOverlay');
            });

            // Fermer le modal d'ajout lorsque l'on clique sur l'overlay
            document.getElementById('modalOverlay').addEventListener('click', function() {
                closeModal('modalTache', 'modalOverlay');
                closeModal('modalUserTache', 'modalOverlay');  // Ajout pour fermer le modal User
            });

            // Fermer le modal d'assignation
            document.getElementById('closeUserTacheModal').addEventListener('click', function() {
                closeModal('modalUserTache', 'modalOverlay');
            });

        </script>
    </div>
</div>
</body>
</html>
