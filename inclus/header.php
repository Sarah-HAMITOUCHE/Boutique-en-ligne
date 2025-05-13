<?php
require_once '../php/session.php';
$session = new Session();
$user = $session->getUser();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boutique en Ligne - Livres, Mangas & Comics</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- CSS personnalisé -->
    <link rel="stylesheet" href="/assets/style.css">
</head>
<body>
    <!-- Barre de navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/">
                <i class="fas fa-book-open me-2"></i>Boutique Livres
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="../php/index.php">Accueil</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="categoriesDropdown" role="button" data-bs-toggle="dropdown">
                            Catégories
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="php/categories.php/manga">Mangas</a></li>
                            <li><a class="dropdown-item" href="/category/comics">Comics</a></li>
                            <li><a class="dropdown-item" href="/category/litterature">Littérature</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="/products">Tous les produits</a></li>
                        </ul>
                    </li>
                    <?php if ($session->isAdmin()): ?>
                    <li class="nav-item">
                        <a class="nav-link text-warning" href="/admin">
                            <i class="fas fa-cog"></i> Administration
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
                
                <!-- Barre de recherche -->
                <form class="d-flex me-3" action="/search" method="GET">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Rechercher..." name="q" id="searchInput">
                        <button class="btn btn-outline-light" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
                
                <!-- Panier et compte utilisateur -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/cart">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="badge bg-danger cart-count">0</span>
                        </a>
                    </li>
                    
                    <?php if ($session->isLoggedIn()): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle"></i> <?= htmlspecialchars($user['first_name']) ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="/account"><i class="fas fa-user me-2"></i>Mon compte</a></li>
                            <li><a class="dropdown-item" href="/orders"><i class="fas fa-box-open me-2"></i>Mes commandes</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="/logout"><i class="fas fa-sign-out-alt me-2"></i>Déconnexion</a></li>
                        </ul>
                    </li>
                    <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="../connection/login.php">
                            <i class="fas fa-sign-in-alt"></i> Connexion
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../connection/register.php">
                            <i class="fas fa-user-plus"></i> Inscription
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Conteneur principal -->
    <main class="container my-4">
        <!-- Affichage des messages flash -->
        <?php if ($session->get('success')): ?>
            <div class="alert alert-success alert-dismissible fade show">
                <?= $session->get('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php $session->remove('success'); ?>
        <?php endif; ?>
        
        <?php if ($session->get('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <?= $session->get('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php $session->remove('error'); ?>
        <?php endif; ?>