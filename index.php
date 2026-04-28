<?php 
require_once 'config/database.php';
require_once 'includes/header.php'; 

// Récupérer tous les produits
$stmt = $pdo->query("SELECT p.*, c.nom as categorie 
                     FROM produits p 
                     LEFT JOIN categories c ON p.categorie_id = c.id 
                     ORDER BY p.id DESC");
$produits = $stmt->fetchAll();
?>

<h2 class="mb-4 text-center text-dark">Nos Bijoux Élégants</h2>

<?php if (isset($_SESSION['message'])): ?>
    <div class="alert alert-success text-center">
        <?= $_SESSION['message'] ?>
    </div>
    <?php unset($_SESSION['message']); ?>
<?php endif; ?>

<div class="row">
    <?php if (count($produits) > 0): ?>
        <?php foreach($produits as $p): ?>
        <div class="col-md-4 col-sm-6 mb-4">
            <div class="card h-100">
                <img src="assets/images/<?= htmlspecialchars($p['image'] ?? '') ?>" 
                     class="card-img-top product-img" 
                     alt="<?= htmlspecialchars($p['nom']) ?>"
                     onerror="this.src='https://via.placeholder.com/300x220/ddd/666?text=<?= urlencode($p['nom']) ?>'">
                
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title"><?= htmlspecialchars($p['nom']) ?></h5>
                    <p class="text-muted small"><?= htmlspecialchars($p['categorie'] ?? 'Bijou') ?></p>
                    <p class="card-text flex-grow-1"><?= htmlspecialchars($p['description']) ?></p>
                    
                    <div class="mt-auto">
                        <h4 class="text-success fw-bold"><?= number_format($p['prix'], 2) ?> TND</h4>
                        <a href="ajouter_panier.php?id=<?= $p['id'] ?>" 
                           class="btn btn-gold w-100 mt-2">
                            Ajouter au panier
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="col-12">
            <div class="alert alert-warning text-center">
                Aucun produit disponible pour le moment.
            </div>
        </div>
    <?php endif; ?>
</div>

<?php require_once 'includes/footer.php'; ?>