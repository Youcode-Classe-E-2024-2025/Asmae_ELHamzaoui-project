<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <script src="../asset/script.js"></script>
    <!-- Ajouter le CDN de Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">
    <div class="flex justify-center items-center min-h-screen bg-gray-200">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full sm:w-96">
            <h1 class="text-2xl font-bold text-center text-gray-800 mb-6">Connexion</h1>

            <form id="loginForm" action="loginController.php" method="POST" onsubmit="return validateLoginForm()">
                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Email:</label>
                    <input type="email" id="email" name="email" class="w-full p-3 mt-1 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Email">
                    <span id="emailError" class="text-red-500 text-sm"><?= $errors['email'] ?? '' ?></span>
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-gray-700">Mot de passe:</label>
                    <input type="password" id="password" name="password" class="w-full p-3 mt-1 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Mot de passe">
                    <span id="passwordError" class="text-red-500 text-sm"><?= $errors['password'] ?? '' ?></span>
                </div>

                <div class="mt-6">
                    <button type="submit" class="w-full py-3 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Se connecter
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
