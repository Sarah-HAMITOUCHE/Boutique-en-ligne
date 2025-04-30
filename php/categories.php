<?php
require_once '../php/products.php';

class HomeController {
    private $productModel;

    public function __construct() {
        $this->productModel = new Product();
    }

    public function index() {
        $featuredProducts = $this->productModel->getFeaturedProducts();
        $categories = $this->getCategoriesWithProducts();
        
        require_once '../php/index.php';
    }

    private function getCategoriesWithProducts() {
        // Implémentez cette méthode pour récupérer les catégories avec des produits
    }
}
?>