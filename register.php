<?php
session_start();
if (isset($_POST["login"], $_POST["email"], $_POST["password"], $_POST["confirm_password"])) {

    $login = $_POST["login"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    if (empty($login) || empty($email) || empty($password) || empty($confirm_password)) {
        echo "Veuillez remplir tous les champs.";
    } else {
        $loginPattern = "/^[a-zA-Z0-9]{4,}$/";

        if (!preg_match($loginPattern, $login)) {
            echo "Login invalide (Lettres et chiffres uniquement, minimum 4 caractères";
        } else {
            $emailPattern = "/^[^@\s]+@[^@\s]+\.[^@\s]+$/";

            if (!preg_match($emailPattern,$email)) {
                echo "E-Mail invalide.";
            } else {
                 $passwordPattern = "/^(?=.*[A-Z])(?=.*[0-9]).{8,}$/";

                if (!preg_match($passwordPattern, $password)) {
                    echo "Mot de passe invalide, veuillez en indiquer un avec minimum 8 caractères, 1 majuscule et 1 chiffre";
                } else {
                    if ($password != $confirm_password) {
                    echo "Les mots de passe ne correspondent pas";
                } else {
                    echo "Inscription valide !";
                } 
                }
            }
        }
    }
}
?>