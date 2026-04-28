<?php
session_start();
require_once 'config/database.php';

if (!isset($_SESSION['panier']) || empty($_SESSION['panier'])) {
    header('Location: panier.php');
    exit();
}

$total = 0;
foreach ($_SESSION['panier'] as $item) {
    $total += $item['prix'] * $item['quantite'];
}

// Enregistrer la commande principale
$stmt = $pdo->prepare("INSERT INTO commandes (total) VALUES (?) RETURNING id");
$stmt->execute([$total]);
$commande_id = $stmt->fetchColumn();

// Enregistrer les détails de la commande
$stmt = $pdo->prepare("INSERT INTO commande_details (commande_id, produit_id, quantite, prix_unitaire) 
                       VALUES (?, ?, ?, ?)");

foreach ($_SESSION['panier'] as $id => $item) {
    $stmt->execute([$commande_id, $id, $item['quantite'], $item['prix']]);
}

// Vider le panier après validation
unset($_SESSION['panier']);

$_SESSION['message'] = "✅ Commande n° <strong>$commande_id</strong> validée avec succès !<br>Merci pour votre achat 💎";

header('Location: index.php');
exit();
?>