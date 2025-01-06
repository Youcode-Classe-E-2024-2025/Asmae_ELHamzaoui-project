<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
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

            <form id="registerForm" action="../controllers/registerController.php" method="POST" onsubmit="return validateForm()">
                
                <div class="mb-4">
                    <label for="username" class="block text-white">Nom d'utilisateur:</label>
                    <input type="text" id="username" name="username" value="<?= $_POST['username'] ?? '' ?>" 
                           class="w-full p-3 mt-1 border rounded-md focus:outline-none focus:ring-2 focus:ring-sky-700" 
                           placeholder="Nom d'utilisateur">
                    <span id="usernameError" class="text-red-500 text-sm"><?= $errors['username'] ?? '' ?></span>
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-white">Email:</label>
                    <input type="email" id="email" name="email" value="<?= $_POST['email'] ?? '' ?>" 
                           class="w-full p-3 mt-1 border rounded-md focus:outline-none focus:ring-2 focus:ring-sky-700" 
                           placeholder="Email">
                    <span id="emailError" class="text-red-500 text-sm"><?= $errors['email'] ?? '' ?></span>
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-white">Mot de passe:</label>
                    <input type="password" id="password" name="password" 
                           class="w-full p-3 mt-1 border rounded-md focus:outline-none focus:ring-2 focus:ring-sky-700" 
                           placeholder="Mot de passe">
                    <span id="passwordError" class="text-red-500 text-sm"><?= $errors['password'] ?? '' ?></span>
                </div>

                <div class="mb-4">
                    <label for="confirmPassword" class="block text-white">Confirmer le mot de passe:</label>
                    <input type="password" id="confirmPassword" name="confirmPassword" 
                           class="w-full p-3 mt-1 border rounded-md focus:outline-none focus:ring-2 focus:ring-sky-700" 
                           placeholder="Confirmer le mot de passe">
                    <span id="confirmPasswordError" class="text-red-500 text-sm"><?= $errors['confirmPassword'] ?? '' ?></span>
                </div>

                <div class="mt-6">
                    <button type="submit" class="w-full py-3 bg-sky-700 text-white rounded-md hover:bg-sky-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        S'inscrire
                    </button>
                </div>
                <div class="flex felx-center text-center text-gray-100 gap-2">  
                   <p>j'ai déjà un compte </p>
                   <a href="login.php">Se connecter</a>
                </div>
            </form>
        </div>
    </div>
<script>
        function validateForm() {
        let valid = true;
        let username = document.getElementById('username').value.trim();
        let email = document.getElementById('email').value.trim();
        let password = document.getElementById('password').value.trim();
        let confirmPassword = document.getElementById('confirmPassword').value.trim();
        
        // Réinitialiser les messages d'erreur
        document.getElementById('usernameError').innerHTML = '';
        document.getElementById('emailError').innerHTML = '';
        document.getElementById('passwordError').innerHTML = '';
        document.getElementById('confirmPasswordError').innerHTML = '';
    
        // Validation du nom d'utilisateur (5 caractères minimum et contient à la fois des lettres et des chiffres)
        let usernameRegex = /^(?=.*[a-zA-Z])(?=.*\d)[a-zA-Z\d]{5,}$/;
        if (username === "") {
            document.getElementById('usernameError').innerHTML = "Le nom d'utilisateur ne peut pas être vide.";
            valid = false;
        } else if (!usernameRegex.test(username)) {
            document.getElementById('usernameError').innerHTML = "Le nom d'utilisateur doit contenir au moins 5 caractères et inclure à la fois des lettres et des chiffres.";
            valid = false;
        }
    
        // Validation de l'email (format classique)
        let emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        if (email === "") {
            document.getElementById('emailError').innerHTML = "L'email ne peut pas être vide.";
            valid = false;
        } else if (!emailRegex.test(email)) {
            document.getElementById('emailError').innerHTML = "L'email n'est pas valide.";
            valid = false;
        }
    
        // Validation du mot de passe (minimum 8 caractères, au moins une majuscule, une minuscule, un chiffre et un caractère spécial)
        let passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*(),.?":{}|<>])[A-Za-z\d!@#$%^&*(),.?":{}|<>]{8,}$/;
        if (password === "") {
            document.getElementById('passwordError').innerHTML = "Le mot de passe ne peut pas être vide.";
            valid = false;
        } else if (!passwordRegex.test(password)) {
            document.getElementById('passwordError').innerHTML = "Le mot de passe doit contenir au moins une lettre minuscule, une lettre majuscule, un chiffre et un caractère spécial.";
            valid = false;
        }
    
        // Validation de la confirmation du mot de passe (doit être identique au mot de passe)
        if (confirmPassword === "") {
            document.getElementById('confirmPasswordError').innerHTML = "La confirmation du mot de passe ne peut pas être vide.";
            valid = false;
        } else if (password !== confirmPassword) {
            document.getElementById('confirmPasswordError').innerHTML = "Les mots de passe ne correspondent pas.";
            valid = false;
        }
        return valid;
    }
</script>
</body>
</html>




