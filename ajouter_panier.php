<?php
session_start();
require_once 'config/database.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int)$_GET['id'];

    // Récupérer les infos du produit
    $stmt = $pdo->prepare("SELECT id, nom, prix FROM produits WHERE id = ?");
    $stmt->execute([$id]);
    $produit = $stmt->fetch();

    if ($produit) {
        if (!isset($_SESSION['panier'])) {
            $_SESSION['panier'] = [];
        }

        if (isset($_SESSION['panier'][$id])) {
            $_SESSION['panier'][$id]['quantite']++;
        } else {
            $_SESSION['panier'][$id] = [
                'nom'      => $produit['nom'],
                'prix'     => $produit['prix'],
                'quantite' => 1
            ];
        }

        $_SESSION['message'] = "✅ " . htmlspecialchars($produit['nom']) . " a été ajouté au panier !";
    } else {
        $_SESSION['message'] = "❌ Produit non trouvé.";
    }
} else {
    $_SESSION['message'] = "❌ ID invalide.";
}

header('Location: index.php');
exit();
?>