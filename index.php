<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-sans bg-gray-50">

    <!-- Header -->
    <header class="bg-gray-800 text-white p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <!-- Logo -->
            <div class="flex items-center">
                <img src="https://via.placeholder.com/150x50?text=Logo" alt="Logo" class="h-12">
            </div>
            
            <!-- Menu & Icons -->
            <div class="flex space-x-4 items-center">
                <a href="#register" class="text-white hover:text-gray-400">S'inscrire</a>
                <a href="#login" class="text-white hover:text-gray-400">Se connecter</a>
            </div>
        </div>
    </header>

    <!-- Body -->
    <main class="py-32 bg-gradient-to-r from-blue-500 to-indigo-600 text-white">
        <div class="container mx-auto text-center">
            <h1 class="text-4xl font-bold mb-4">Bienvenue sur notre site</h1>
            <p class="text-lg mb-8">Découvrez nos services et rejoignez notre communauté.</p>
            
            <h2 class="text-2xl font-semibold mb-4">Nos Services</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold">Service 1</h3>
                    <p>Présentation du service 1.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold">Service 2</h3>
                    <p>Présentation du service 2.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold">Service 3</h3>
                    <p>Présentation du service 3.</p>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-4">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 Tous droits réservés. Mon entreprise.</p>
        </div>
    </footer>

</body>
</html>
