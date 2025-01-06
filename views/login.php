<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <!-- Ajouter le CDN de Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
         /* Ajoutez un arrière-plan d'image pour le corps */
         body {
            background-image: url('../images/background.jpg'); /* Remplacez par le chemin de votre image */
            background-size: cover;
            background-position: center;
        }
        .logo {
            transform: translateX(110px); /* Déplace le logo de 3px vers la gauche */
        }
    </style>
</head>
<body>
    <div class="flex justify-center items-center min-h-screen">
        <div class="bg-indigo-950 p-8 rounded-lg shadow-lg w-full sm:w-96">
            <h1 class="text-2xl font-bold text-center text-gray-800 mb-6"><img src="../images/logo.png" alt="Logo" class="h-12 w-20 logo my-0"></h1>

            <form id="loginForm" action="../controllers/loginController.php" method="POST" onsubmit="return validateLoginForm()">
                <div class="mb-4">
                    <label for="email" class="block text-white">Email:</label>
                    <input type="email" id="email" name="email" class="w-full p-3 mt-1 border rounded-md focus:outline-none focus:ring-2 focus:bg-sky-700" placeholder="Email" required>
                    <span id="emailError" class="text-red-500 text-sm"><?= $errors['email'] ?? '' ?></span>
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-white">Mot de passe:</label>
                    <input type="password" id="password" name="password" class="w-full p-3 mt-1 border rounded-md focus:outline-none focus:ring-2 focus:bg-sky-700" placeholder="Mot de passe" required>
                    <span id="passwordError" class="text-red-500 text-sm"><?= $errors['password'] ?? '' ?></span>
                </div>

                <div class="mt-6">
                    <button type="submit" class="w-full py-3 bg-sky-700 text-white rounded-md hover:bg-sky-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Se connecter
                    </button>
                </div>
                <div class="flex felx-center text-center text-gray-100 gap-2">  
                   <p>j'ai pas un compte </p>
                   <a href="register.php"> S'inscrire</a>
                </div>
            </form>
        </div>
    </div>

<script>
    function validateLoginForm() {
        let email = document.getElementById('email').value;
        let password = document.getElementById('password').value;
        let valid = true;

        // Réinitialiser les messages d'erreur
        document.getElementById('emailError').innerText = '';
        document.getElementById('passwordError').innerText = '';

        // Vérification de l'email
        if (email === '') {
            document.getElementById('emailError').innerText = "L'email est requis.";
            valid = false;
        }

        // Vérification du mot de passe
        if (password === '') {
            document.getElementById('passwordError').innerText = "Le mot de passe est requis.";
            valid = false;
        }

        return valid;
    }
</script>
</body>
</html>
