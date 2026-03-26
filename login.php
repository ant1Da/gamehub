<?php
session_start();
 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $identifier = $_POST['identifier'] ?? '';
    $password   = $_POST['password']   ?? '';
 
    $errors = [];
 
    // 1. Vérifier que les champs sont remplis
    if (empty($identifier)) {
        $errors[] = "Veuillez entrer votre login ou email.";
    }
    if (empty($password)) {
        $errors[] = "Veuillez entrer votre mot de passe.";
    }
 
    // 2. Valider le format de l'identifiant
    if (!empty($identifier)) {
        $isLogin = preg_match("/^[a-zA-Z0-9]{4,}$/", $identifier);
        $isEmail = preg_match("/^[^@\s]+@[^@\s]+\.[^@\s]+$/", $identifier);
 
        if (!$isLogin && !$isEmail) {
            $errors[] = "Identifiant invalide. Utilisez un login (lettres et chiffres, minimum 4 caractères) ou un email valide.";
        }
    }
 
    // 3. Valider le format du mot de passe
    if (!empty($password) && !preg_match("/^(?=.*[A-Z])(?=.*[0-9]).{8,}$/", $password)) {
        $errors[] = "Mot de passe invalide (minimum 8 caractères, 1 majuscule et 1 chiffre).";
    }
 
    // 4. Si aucune erreur : enregistrer la session et rediriger
    if (empty($errors)) {
        $_SESSION['user'] = $identifier;
        header("Location: index.php");
        exit();
    } else {
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }
} else {
    echo "Accès non autorisé.";
}
?>
 