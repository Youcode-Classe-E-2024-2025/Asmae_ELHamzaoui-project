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
$couleurs = ["#89cdff", "#426ba8" , "#68a0ed", "#a36357" , "#bf9289", "#edbea4"];
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

.sticky-note {
    width: 250px; /* Largeur de la note */
    height: 250px; /* Hauteur de la note */
    border-radius: 10px; /* Coins arrondis */
    box-shadow: 6px 6px 15px rgba(0, 0, 0, 0.54); /* Ombre légère */
    padding: 15px; /* Espacement interne */
    font-family: Arial, sans-serif; /* Police de caractères */
    position: relative; /* Pour ajouter des éléments positionnés à l'intérieur */
    align-items: center;
    text-align: center;
    color: #333; /* Couleur du texte */
    
}
</style>
</head>
<body>
<header class="mx-4">
    <div class="container flex justify-between items-center">
        <!-- Logo avec taille augmentée -->
        <img src="../images/logo.png" alt="Logo" class="h-24 w-32"> <!-- Ajout de la classe "logo" pour appliquer la transformation -->
        <div class="space-x-6 items-center mr-8"> <!-- Espacement égal entre les éléments --> 
            <i class="fa-duotone fa-solid fa-gear gear-icon" style="color:#24508c;" onclick="toggleMenu()">
            </i> 
            <div class="menu" id="menu">
              <a onclick="ajouterProjet()"  id="openModalButton" class="text-center" style="color:#24508c">Ajouter tache</a>
              <a onclick="assignerProjet()" id="openModalTacheUser" class="text-center" style="color:#24508c">Assigner tâche</a>
              <a href="deconnexion.php"  class="text-center hover:text-gray-400" style="color:#24508c">log out</a>
            </div>
        </div>
    </div>               
</header>

<div class="flex justify-center gap-4 mx-4">
    <div class="w-64 h-screen border border-2 rounded-lg p-6" style="background-color:#f2f8ff;">
        <div class="w-48 h-10 border rounded-lg p-2 text-white font-bold" style="background-color:#24508c;">Taches</div><br>
        <div class="w-48 h-10 border rounded-lg p-2 text-white font-bold" style="background-color:#24508c;">Assignements</div>
    </div>

    <div class="container mx-auto p-8 border border-2 rounded-lg" style="background-color:#f2f8ff;">
        <div class="flex justify-between gap-4">
            <h1 class="text-3xl font-bold mb-8" style="color:#24508c;">Liste des Tâches</h1>
        </div>

        <!-- Affichage des tâches selon le projet -->
        <div class="grid grid-cols-3 gap-5">
        <?php foreach ($taches as $index => $tache): ?>
           <?php $couleur = $couleurs[$index % count($couleurs)]; // Assigner une couleur différente ?>
                <div class="sticky-note mb-8"style="background-color: <?php echo $couleur; ?>;">
                <img src="../images/msak.png" alt="Logo" class="h-12 w-24" style="position:relative;bottom:40px;left:50px"> <!-- Ajout de la classe "logo" pour appliquer la transformation -->
                  <h1 class="font-bold text-xl" style="position:relative;bottom:30px; color:#f2f8ff;"><?php echo $tache['titre_tache']; ?></h1>
                  <p><?php echo $tache['desc_tache']; ?></p>
                  <p><?php echo $tache['statut_tache']; ?></p>
                  <div class="pt-16 px-4">
                    <a style="color: rgb(185, 212, 243) ;background-color:#24508c;"  class="text-white py-2 px-3 rounded hover:bg-red-600" href="modifier_tache.php?id=<?php echo $tache['id_tache']; ?>&id_projet=<?php echo $id_projet; ?>" ><i class="fa-solid fa-pen-to-square"></i></a> | 
                    <a style="color: rgb(185, 212, 243) ;background-color:#24508c;"  class="text-white py-2 px-3 rounded hover:bg-red-600" href="../controllers/supprimer_tache.php?id=<?php echo urlencode($tache['id_tache']); ?>&id_projet=<?php echo urlencode($id_projet); ?>" class="text-red-600 hover:text-red-800" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette tâche ?')"><i class="fa-solid fa-trash"></i></a>
                  </div>
                </div>
            <?php endforeach; ?>
        </div>
           

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

            function toggleMenu() {
               const menu = document.getElementById("menu");
              if (menu.style.display === "none") {
                  menu.style.display = "block"; // Si le menu est visible, on le cache
              } else {
                 menu.style.display = "none"; // Sinon on l'affiche
              }
            };
        </script>
    </div>
</div>
</body>
</html>
