<?php
session_start();
require __DIR__ . '/db.php';

// Récupérer tous les jeux
$stmt = $pdo->query("SELECT * FROM games");
$games = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>GameHub - Accueil</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="bg-dark text-light">

        <nav class="navbar navbar-expand-lg navbar-dark bg-black border-bottom border-secondary">
            <div class="container">
                <a class="navbar-brand fw-bold" href="index.php">GameHub</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="menuNavbar">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="index.php">Accueil</a>
                        </li>
                        <?php if (isset($_SESSION['login'])) : ?>
                            <li class="nav-item">
                                <a class="nav-link" href="add_game.html">Ajouter un jeu</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="favorites.php">Mes jeux</a>
                            </li>
                            <li class="nav-item">
                                <span class="nav-link">Bonjour <?php echo htmlspecialchars($_SESSION['login']); ?></span>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-danger" href="logout.php">Se déconnecter</a>
                            </li>
                        <?php else : ?>
                            <li class="nav-item">
                                <a class="nav-link" href="register.html">S'inscrire</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="login.html">Se connecter</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>

        <header class="py-5 bg-secondary-subtle text-dark">
            <div class="container text-center">
                <h1 class="display-4 fw-bold">Bienvenue sur GameHub</h1>
                <p class="lead mt-3">
                    Découvrez une sélection de jeux vidéo et créez votre compte pour accéder à votre futur espace personnel.
                </p>
                <div class="mt-4">
                    <?php if (isset($_SESSION['login'])) : ?>
                        <p>Bonjour <?php echo htmlspecialchars($_SESSION['login']); ?> !</p>
                        <a href="add_game.html" class="btn btn-primary">Ajouter un jeu</a>
                    <?php else : ?>
                        <a href="register.html" class="btn btn-primary me-2">S'inscrire</a>
                        <a href="login.html" class="btn btn-outline-dark">Se connecter</a>
                    <?php endif; ?>
                </div>
            </div>
        </header>

        <main class="container py-5">
            <section>
                <h2 class="mb-4">Jeux disponibles</h2>
                <div class="row g-4">
                    <?php if (empty($games)) : ?>
                        <p class="text-muted">Aucun jeu enregistré pour le moment.</p>
                    <?php else : ?>
                        <?php foreach ($games as $game) : ?>
                            <div class="col-md-6 col-lg-3">
                                <div class="card h-100 shadow-sm">
                                    <img src="images/<?php echo htmlspecialchars($game['image']); ?>"
                                         class="card-img-top"
                                         alt="Image du jeu <?php echo htmlspecialchars($game['title']); ?>">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo htmlspecialchars($game['title']); ?></h5>
                                        <p class="card-text"><?php echo htmlspecialchars($game['description']); ?></p>
                                    </div>
                                    <div class="card-footer">
                                        <small class="text-muted">Genre : <?php echo htmlspecialchars($game['genre']); ?></small>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </section>
        </main>

        <footer class="bg-black text-center py-3 border-top border-secondary">
            <p class="mb-0">GameHub - Projet fil rouge BTS SIO SLAM</p>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>