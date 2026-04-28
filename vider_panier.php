<?php
session_start();

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int)$_GET['id'];
    if (isset($_SESSION['panier'][$id])) {
        unset($_SESSION['panier'][$id]);
        $_SESSION['message'] = "Article supprimé du panier.";
    }
}

header('Location: panier.php');
exit();
?>