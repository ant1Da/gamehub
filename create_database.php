<?php
$host = 'localhost';
$user = 'root';
$password = '';

$conn = new mysqli($host, $user, $password);

if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

// Création de la base de données
$sql = "CREATE DATABASE IF NOT EXISTS gamehub";
$conn->query($sql);

$conn->select_db('gamehub');

// Création de la table users
$sql = "CREATE TABLE IF NOT EXISTS users (
    id       INT AUTO_INCREMENT PRIMARY KEY,
    login    VARCHAR(50)  NOT NULL UNIQUE,
    email    VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
)";
$conn->query($sql);

// Création de la table games
$sql = "CREATE TABLE IF NOT EXISTS games (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    title       VARCHAR(100) NOT NULL,
    genre       VARCHAR(50),
    description TEXT,
    image       VARCHAR(255),
    user_id     INT,
    FOREIGN KEY (user_id) REFERENCES users(id)
)";
$conn->query($sql);

echo "Base de données et tables créées avec succès.";
$conn->close();
?>