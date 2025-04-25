<?php
require 'includes/header.php';

$db = new Database();
$conn = $db->getConnection();

// Récupérer les produits phares
$stmt = $conn->prepare("SELECT * FROM products WHERE featured = 1 LIMIT 4");
$stmt->execute();
$featuredProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les nouveaux produits
$stmt = $conn->prepare("SELECT * FROM products ORDER BY created_at DESC LIMIT 4");
$stmt->execute();
$newProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<main>
    <section class="hero">
        <h1>Boutique de Mode</h1>
        <p>Découvrez notre nouvelle collection</p>
    </section>

    <section class="featured">
        <h2>Produits Phares</h2>
        <div class="products-grid">
            <?php foreach ($featuredProducts as $product): ?>
                <?php include 'includes/product-card.php'; ?>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="new-arrivals">
        <h2>Nouveautés</h2>
        <div class="products-grid">
            <?php foreach ($newProducts as $product): ?>
                <?php include 'includes/product-card.php'; ?>
            <?php endforeach; ?>
        </div>
    </section>
</main>

<?php require 'includes/footer.php'; ?>