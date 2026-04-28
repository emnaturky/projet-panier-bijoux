
<?php 
require_once 'config/database.php';
require_once 'includes/header.php'; 

if (!isset($_SESSION['panier']) || empty($_SESSION['panier'])) {
    echo '<div class="alert alert-info text-center fs-4">Votre panier est vide 😕</div>';
    require_once 'includes/footer.php';
    exit();
}

$total = 0;
?>

<h2 class="mb-4 text-center">Votre Panier</h2>

<?php if (isset($_SESSION['message'])): ?>
    <div class="alert alert-success text-center">
        <?= $_SESSION['message'] ?>
    </div>
    <?php unset($_SESSION['message']); ?>
<?php endif; ?>

<table class="table table-bordered table-hover align-middle">
    <thead class="table-dark">
        <tr>
            <th>Produit</th>
            <th>Prix Unitaire</th>
            <th>Quantité</th>
            <th>Sous-total</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($_SESSION['panier'] as $id => $item): 
            $sous_total = $item['prix'] * $item['quantite'];
            $total += $sous_total;
        ?>
        <tr>
            <td><?= htmlspecialchars($item['nom']) ?></td>
            <td><?= number_format($item['prix'], 2) ?> TND</td>
            <td width="150">
                <form action="panier.php" method="POST" class="d-flex">
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <input type="number" name="quantite" value="<?= $item['quantite'] ?>" 
                           min="1" class="form-control text-center me-2" style="width: 80px;">
                    <button type="submit" name="update" class="btn btn-sm btn-primary">OK</button>
                </form>
            </td>
            <td class="fw-bold"><?= number_format($sous_total, 2) ?> TND</td>
            <td>
                <a href="vider_panier.php?id=<?= $id ?>" 
                   class="btn btn-danger btn-sm"
                   onclick="return confirm('Supprimer cet article ?')">
                    Supprimer
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot class="table-success fw-bold">
        <tr>
            <td colspan="3" class="text-end">Total à payer :</td>
            <td colspan="2"><?= number_format($total, 2) ?> TND</td>
        </tr>
    </tfoot>
</table>

<div class="text-end mt-4">
    <a href="index.php" class="btn btn-secondary btn-lg me-3">← Continuer mes achats</a>
    <a href="valider_commande.php" class="btn btn-success btn-lg">Valider la commande →</a>
</div>

<?php 
// Traitement de la mise à jour de quantité
if (isset($_POST['update'])) {
    $id = (int)$_POST['id'];
    $qte = max(1, (int)$_POST['quantite']);
    
    if (isset($_SESSION['panier'][$id])) {
        $_SESSION['panier'][$id]['quantite'] = $qte;
    }
    header('Location: panier.php');
    exit();
}

require_once 'includes/footer.php'; 
?>