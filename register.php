<?php
session_start();
include 'db.php';

if (isset($_POST["login"], $_POST["email"], $_POST["password"], $_POST["confirm_password"])) {

    $login            = $_POST["login"];
    $email            = $_POST["email"];
    $password         = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    if (empty($login) || empty($email) || empty($password) || empty($confirm_password)) {
        echo "Veuillez remplir tous les champs.";
    } else {

        if (!preg_match("/^[a-zA-Z0-9]{4,}$/", $login)) {
            echo "Login invalide (lettres et chiffres uniquement, minimum 4 caractères).";

        } elseif (!preg_match("/^[^@\s]+@[^@\s]+\.[^@\s]+$/", $email)) {
            echo "E-Mail invalide.";

        } elseif (!preg_match("/^(?=.*[A-Z])(?=.*[0-9]).{8,}$/", $password)) {
            echo "Mot de passe invalide (minimum 8 caractères, 1 majuscule et 1 chiffre).";

        } elseif ($password !== $confirm_password) {
            echo "Les mots de passe ne correspondent pas.";

        } else {
            // Vérifier que le login et l'email sont uniques
            $stmt = $pdo->prepare("SELECT id FROM users WHERE login = ? OR email = ?");
            $stmt->execute([$login, $email]);

            if ($stmt->fetch()) {
                echo "Ce login ou cet email est déjà utilisé.";
            } else {
                // Hacher le mot de passe et insérer en base
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                $stmt = $pdo->prepare("INSERT INTO users (login, email, password) VALUES (?, ?, ?)");
                $stmt->execute([$login, $email, $hashedPassword]);

                $_SESSION['user'] = $login;
                header("Location: index.php");
                exit();
            }
        }
    }
}
?>