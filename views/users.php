<?php
require_once '../config/db.php'; 

  function afficherUsers() {
    global $pdo;
    $query = "SELECT * FROM Utilisateur";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $stmt->fetch(PDO::FETCH_ASSOC);
    return $stmt;
}

$users=afficherUsers();

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
            background-color:#f2f8ff;
        }
    </style>
</head>

<body>

<header class="mx-4">
    <div class="container flex justify-between items-center">
        <!-- Logo avec taille augmentée -->
        <img src="../images/logo.png" alt="Logo" class="h-24 w-32"> <!-- Ajout de la classe "logo" pour appliquer la transformation -->
        <div class="space-x-6 items-center mr-8"> <!-- Espacement égal entre les éléments --> 
              <a href="deconnexion.php"  class="text-center hover:text-gray-400" style="color:#24508c">retour aux projets</a>
        </div>
    </div>               
</header>


<body>

  <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
      <div class="px-4 py-5 sm:px-6">
        <h3 class="text-lg leading-6 font-medium text-gray-900">Tableau des données</h3>
        <p class="mt-1 max-w-2xl text-sm text-gray-500">Vue détaillée des performances actuelles.</p>
      </div>
      
      <div class="overflow-x-auto">
        <table class="min-w-full table-auto">
          <thead class="bg-gray-50">
            <tr>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Nom utilisateur
              </th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Email utilisateur
              </th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                role utilisateur
              </th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
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
                <button type="submit" name="supprimer" style="background-color:rgb(185, 212, 243);"  class="text-white py-2 px-3 rounded hover:bg-red-600"><i class="fa-solid fa-trash" style="color: #ff0000;"></i></button>
               </form>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>



</body>

</html>
