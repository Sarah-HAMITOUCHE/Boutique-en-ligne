<?php include '../inclus/header.php'; ?>

<main class="container py-5">
    <!-- Hero Section -->
    <section class="hero-section mb-5">
        <div class="row align-items-center bg-light p-5 rounded">
            <div class="col-md-6">
                <h1 class="display-4 fw-bold">Découvrez notre collection exclusive</h1>
                <p class="lead">Livraison gratuite à partir de 30€ d'achat</p>
                <a href="/products" class="btn btn-primary btn-lg">Voir tous les produits</a>
            </div>
            <div class="col-md-6">
                <img src="/assets/images/hero-banner.jpg" alt="Collection de livres" class="img-fluid rounded">
            </div>
        </div>
    </section>

    <!-- Produits phares -->
    <section class="featured-products mb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Nos produits phares</h2>
            <a href="/products?filter=featured" class="btn btn-outline-primary">Voir plus</a>
        </div>

        <div class="row g-4">
            <?php foreach ($featuredProducts as $product): ?>
            <div class="col-md-4 col-lg-3">
                <div class="card h-100 product-card">
                    <!-- Badge "phare" -->
                    <span class="badge bg-warning position-absolute top-0 end-0 m-2">PHARE</span>
                    
                    <!-- Image du produit -->
                    <a href="/product/<?= $product['product_id'] ?>">
                        <img src="/assets/images/products/<?= htmlspecialchars($product['cover_image']) ?>" 
                             class="card-img-top" 
                             alt="<?= htmlspecialchars($product['title']) ?>">
                    </a>
                    
                    <div class="card-body d-flex flex-column">
                        <!-- Catégorie -->
                        <small class="text-muted mb-1"><?= htmlspecialchars($product['category_name']) ?></small>
                        
                        <!-- Titre -->
                        <h5 class="card-title">
                            <a href="/product/<?= $product['product_id'] ?>" class="text-decoration-none text-dark">
                                <?= htmlspecialchars($product['title']) ?>
                            </a>
                        </h5>
                        
                        <!-- Auteur -->
                        <p class="text-muted"><?= htmlspecialchars($product['author']) ?></p>
                        
                        <!-- Prix et bouton -->
                        <div class="mt-auto d-flex justify-content-between align-items-center">
                            <span class="fw-bold text-primary"><?= number_format($product['price'], 2) ?> €</span>
                            <form action="/cart/add" method="POST" class="add-to-cart-form">
                                <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
                                <button type="submit" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-cart-plus"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Catégories -->
    <section class="categories mb-5">
        <h2 class="fw-bold mb-4">Explorer par catégorie</h2>
        <div class="row g-4">
            <?php foreach ($categories as $category): ?>
            <div class="col-sm-6 col-md-3">
                <a href="/category/<?= $category['slug'] ?>" class="text-decoration-none">
                    <div class="card category-card h-100">
                        <div class="card-body text-center">
                            <h3 class="h5"><?= htmlspecialchars($category['name']) ?></h3>
                            <small class="text-muted"><?= count($category['subcategories']) ?> sous-catégories</small>
                        </div>
                    </div>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </section>
</main>

<?php include 'inc/footer.php'; ?>