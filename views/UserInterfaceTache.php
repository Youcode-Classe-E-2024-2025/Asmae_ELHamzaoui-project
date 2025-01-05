<?php
// Démarrer la session pour pouvoir accéder à la variable $_SESSION
session_start();

// Inclure les fichiers nécessaires
include_once '../controllers/TacheController.php';
$controller = new TacheController($pdo);

// Récupérer l'ID de l'utilisateur connecté (par exemple via la session)
$userId = $_SESSION['user']['id_user']; // Assurez-vous d'avoir une variable de session contenant l'ID utilisateur

// Récupérer les tâches assignées à cet utilisateur
$tachesAssignées = $controller->getTachesAssignées($userId);

// Diviser les tâches en fonction de leur statut
$tachesToDo = [];
$tachesDoing = [];
$tachesDone = [];

foreach ($tachesAssignées as $tache) {
    switch ($tache['statut_tache']) {
        case 'en_cours':
            $tachesDoing[] = $tache;
            break;
        case 'terminee':
            $tachesDone[] = $tache;
            break;
        default:
            $tachesToDo[] = $tache;
            break;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma To-Do List avec Statut</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans min-h-screen flex flex-col justify-center items-center py-6">
    <!-- Container principal de la to-do list -->
    <div class="w-full h-full flex flex-col md:flex-row p-6 gap-6">
        <!-- To Do -->
        <div class="flex-1 bg-gray-100 p-6 rounded-lg shadow-xl">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">To Do</h2>
            <ul id="toDoList" class="space-y-4">
                <?php foreach ($tachesToDo as $tache): ?>
                    <li class="flex justify-between items-center bg-gray-200 p-3 rounded-md">
                        <span><?php echo htmlspecialchars($tache['titre_tache']); ?></span>
                        <button onclick="moveTaskToDoing(<?php echo $tache['id_tache']; ?>)" class="text-blue-500">Faire</button>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <!-- Doing -->
        <div class="flex-1 bg-yellow-100 p-6 rounded-lg shadow-xl">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Doing</h2>
            <ul id="doingList" class="space-y-4">
                <?php foreach ($tachesDoing as $tache): ?>
                    <li class="flex justify-between items-center bg-gray-200 p-3 rounded-md">
                        <span><?php echo htmlspecialchars($tache['titre_tache']); ?></span>
                        <button onclick="moveTaskToDone(<?php echo $tache['id_tache']; ?>)" class="text-green-500">Terminer</button>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <!-- Done -->
        <div class="flex-1 bg-green-100 p-6 rounded-lg shadow-xl">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Done</h2>
            <ul id="doneList" class="space-y-4">
                <?php foreach ($tachesDone as $tache): ?>
                    <li class="flex justify-between items-center bg-gray-200 p-3 rounded-md">
                        <span><?php echo htmlspecialchars($tache['titre_tache']); ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

    <script>
        // Fonction pour déplacer une tâche vers "En cours"
        function moveTaskToDoing(taskId) {
            // Envoyer une requête AJAX pour changer le statut de la tâche
            fetch('update_task_status.php', {
                method: 'POST',
                body: JSON.stringify({ taskId: taskId, newStatus: 'en_cours' }),
                headers: {
                    'Content-Type': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Mettre à jour l'interface sans recharger la page
                    location.reload(); // Recharger la page pour voir la mise à jour
                } else {
                    alert("Erreur lors de la mise à jour de la tâche.");
                }
            });
        }

        // Fonction pour déplacer une tâche vers "Terminé"
        function moveTaskToDone(taskId) {
            fetch('update_task_status.php', {
                method: 'POST',
                body: JSON.stringify({ taskId: taskId, newStatus: 'terminee' }),
                headers: {
                    'Content-Type': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Mettre à jour l'interface sans recharger la page
                    location.reload(); // Recharger la page pour voir la mise à jour
                } else {
                    alert("Erreur lors de la mise à jour de la tâche.");
                }
            });
        }
    </script>
</body>

</html>
