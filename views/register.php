<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <script src="assets/script.js"></script>
    <!-- Ajouter le CDN de Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">
    <div class="flex justify-center items-center min-h-screen bg-gray-200">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full sm:w-96">
            <h1 class="text-2xl font-bold text-center text-gray-800 mb-6">Inscription</h1>

            <form id="registerForm" action="index.php" method="POST" onsubmit="return validateForm()">
                
                <div class="mb-4">
                    <label for="username" class="block text-gray-700">Nom d'utilisateur:</label>
                    <input type="text" id="username" name="username" value="<?= $_POST['username'] ?? '' ?>" 
                           class="w-full p-3 mt-1 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                           placeholder="Nom d'utilisateur">
                    <span id="usernameError" class="text-red-500 text-sm"><?= $errors['username'] ?? '' ?></span>
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Email:</label>
                    <input type="email" id="email" name="email" value="<?= $_POST['email'] ?? '' ?>" 
                           class="w-full p-3 mt-1 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                           placeholder="Email">
                    <span id="emailError" class="text-red-500 text-sm"><?= $errors['email'] ?? '' ?></span>
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-gray-700">Mot de passe:</label>
                    <input type="password" id="password" name="password" 
                           class="w-full p-3 mt-1 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                           placeholder="Mot de passe">
                    <span id="passwordError" class="text-red-500 text-sm"><?= $errors['password'] ?? '' ?></span>
                </div>

                <div class="mb-4">
                    <label for="confirmPassword" class="block text-gray-700">Confirmer le mot de passe:</label>
                    <input type="password" id="confirmPassword" name="confirmPassword" 
                           class="w-full p-3 mt-1 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                           placeholder="Confirmer le mot de passe">
                    <span id="confirmPasswordError" class="text-red-500 text-sm"><?= $errors['confirmPassword'] ?? '' ?></span>
                </div>

                <div class="mt-6">
                    <button type="submit" class="w-full py-3 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        S'inscrire
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
