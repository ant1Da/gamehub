<?php
session_start();
require __DIR__ . '/db.php';

// Vérifier que l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title       = $_POST['title']       ?? '';
    $genre       = $_POST['genre']       ?? '';
    $description = $_POST['description'] ?? '';
    $image       = $_POST['image']       ?? '';

    // Récupérer user_id depuis la session
    $user_id = $_SESSION['user_id'];

    if (empty($title) || empty($genre) || empty($description) || empty($image)) {
        echo "Veuillez remplir tous les champs.";
    } else {
        // Insérer en base
        $stmt = $pdo->prepare("INSERT INTO games (title, genre, description, image, user_id) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$title, $genre, $description, $image, $user_id]);

        header("Location: index.php");
        exit();
    }
} else {
    echo "Accès non autorisé.";
}