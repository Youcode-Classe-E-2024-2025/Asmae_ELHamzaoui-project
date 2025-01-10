<?php
require_once '../config/db.php';

function afficherUsers() {
    global $pdo;
    $query = "SELECT * FROM Utilisateur";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);  // Correction pour récupérer tous les utilisateurs
}

$users = afficherUsers();
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
        body {
            background-color: #f2f8ff;
        }
    </style>
</head>
<body>

<header class="mx-4">
    <div class="container flex justify-between items-center">
        <img src="../images/logo.png" alt="Logo" class="h-24 w-32">
        <div class="space-x-6 items-center mr-8">
              <a href="projets_view.php" class="text-center hover:text-gray-400" style="color:#24508c">retour aux projets</a>
        </div>
    </div>               
</header>

<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Tableau des données</h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">Gestion des utilisateurs et des rôles</p>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nom utilisateur
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Email utilisateur
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Role utilisateur
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php foreach($users as $user): ?>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo $user['nom_user']; ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-green-500"><?php echo $user['email_user']; ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo $user['role_user']; ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-indigo-600 hover:text-indigo-900 cursor-pointer">
                            <form method="POST" action="../controllers/supprimer_user.php" class="inline ml-2">
                                <input type="hidden" name="user_id" value="<?php echo $user['id_user']; ?>" />
                                <button type="submit" name="supprimer" style="background-color:rgb(185, 212, 243);"
                                class="text-white py-2 px-3 rounded hover:bg-red-600"><i class="fa-solid fa-trash" style="color: #ff0000;"></i></button>
                            </form>
                            <form method="POST" action="../controllers/changer_role.php" class="inline ml-2">
                                <input type="hidden" name="user_id" value="<?php echo $user['id_user']; ?>" />
                                <button type="submit" name="changer" style="background-color:rgb(185, 212, 243);"
                                class="text-white font-bold py-2 px-3 rounded hover:bg-red-600">Changer role</button>
                            </form>

                            <button type="button" onclick="openPermissionsModal(<?php echo $user['id_user']; ?>)" style="background-color:rgb(185, 212, 243);"
                            class="text-white font-bold py-2 px-3 rounded hover:bg-red-600">Permission</button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Permissions -->
<div id="permissionsModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 z-50 hidden justify-center items-center">
    <div class="bg-white p-6 rounded-lg shadow-xl w-96">
        <h3 class="text-lg font-semibold text-gray-700">Gestion des Permissions</h3>
        <form method="POST" action="path/to/your/permission-handler.php">
            <input type="hidden" id="user_id" name="user_id" />
            <div class="mt-4">
                <label for="permissions" class="block text-sm font-medium text-gray-700">Sélectionner les permissions</label>
                <select id="permissions" name="permissions[]" multiple class="mt-2 w-full border-gray-300 rounded-md">
                    <!-- Les options seront chargées ici via JavaScript -->
                </select>
            </div>
            <div class="mt-4 text-right">
                <button type="button" onclick="closeModal()" class="text-sm text-gray-600">Fermer</button>
                <button type="submit" class="ml-2 bg-blue-500 text-white px-4 py-2 rounded">Enregistrer</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Fonction pour afficher le modal et remplir les données utilisateur
    function openPermissionsModal(userId) {
        document.getElementById('user_id').value = userId;
        document.getElementById('permissionsModal').classList.remove('hidden');
        fetchPermissions(userId);
    }

    // Fonction pour fermer le modal
    function closeModal() {
        document.getElementById('permissionsModal').classList.add('hidden');
    }

    // Fonction pour charger les permissions depuis la base de données via PHP
    function fetchPermissions(userId) {
        fetch('permissions.php?user_id=' + userId)
            .then(response => response.json())
            .then(data => {
                const select = document.getElementById('permissions');
                select.innerHTML = '';
                data.permissions.forEach(permission => {
                    const option = document.createElement('option');
                    option.value = permission.id;
                    option.textContent = permission.name;
                    select.appendChild(option);
                });
            })
            .catch(error => console.error('Error fetching permissions:', error));
    }
</script>

</body>
</html>
