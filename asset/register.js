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