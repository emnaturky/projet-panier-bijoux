<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bijoux Élégance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="../index.php">💎 Bijoux Élégance</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="../index.php">Accueil</a>
                <a class="nav-link position-relative" href="../panier.php">
                    Panier 
                    <?php if(!empty($_SESSION['panier'])): ?>
                        <span class="badge bg-danger">
                            <?= array_sum(array_column($_SESSION['panier'], 'quantite')) ?? 0 ?>
                        </span>
                    <?php endif; ?>
                </a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">