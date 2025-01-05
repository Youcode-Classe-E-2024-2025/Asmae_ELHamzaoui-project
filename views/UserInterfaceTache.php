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
                        <form action="update_task_status.php" method="POST" class="inline">
                            <input type="hidden" name="taskId" value="<?php echo $tache['id_tache']; ?>">
                            <input type="hidden" name="newStatus" value="en_cours">
                            <button type="submit" class="text-blue-500">Faire</button>
                        </form>
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
                        <form action="update_task_status.php" method="POST" class="inline">
                            <input type="hidden" name="taskId" value="<?php echo $tache['id_tache']; ?>">
                            <input type="hidden" name="newStatus" value="terminee">
                            <button type="submit" class="text-green-500">Terminer</button>
                        </form>
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
</body>

</html>
