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
                <!-- Exemple de tâche -->
                <!-- <li class="flex justify-between items-center bg-gray-200 p-3 rounded-md">
                    <span>Exemple de tâche</span>
                    <button onclick="moveTaskToDoing(this)" class="text-blue-500">Faire</button>
                </li> -->
            </ul>
        </div>

        <!-- Doing -->
        <div class="flex-1 bg-yellow-100 p-6 rounded-lg shadow-xl">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Doing</h2>
            <ul id="doingList" class="space-y-4">
                <!-- Exemple de tâche -->
                <!-- <li class="flex justify-between items-center bg-gray-200 p-3 rounded-md">
                    <span>En cours de tâche</span>
                    <button onclick="moveTaskToDone(this)" class="text-green-500">Terminer</button>
                </li> -->
            </ul>
        </div>

        <!-- Done -->
        <div class="flex-1 bg-green-100 p-6 rounded-lg shadow-xl">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Done</h2>
            <ul id="doneList" class="space-y-4">
                <!-- Exemple de tâche -->
                <!-- <li class="flex justify-between items-center bg-gray-200 p-3 rounded-md">
                    <span>Tâche terminée</span>
                </li> -->
            </ul>
        </div>
    </div>
</body>

</html>
