<?php
require_once '../php/database.php';

class Product {
    private $db;
    private $table = 'products';

    public function __construct() {
        $this->db = new Database();
        $this->db = $this->db->connect();
    }

    // Récupérer tous les produits
    public function getAllProducts() {
        $stmt = $this->db->prepare("SELECT * FROM $this->table");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer les produits par catégorie
    public function getProductsByCategory($category_id) {
        $stmt = $this->db->prepare("
            SELECT p.* FROM products p
            JOIN subcategories sc ON p.subcategory_id = sc.subcategory_id
            WHERE sc.category_id = :category_id
        ");
        $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer un produit par son ID
    public function getProductById($product_id) {
        $stmt = $this->db->prepare("
            SELECT p.*, sc.name as subcategory_name, c.name as category_name 
            FROM products p
            JOIN subcategories sc ON p.subcategory_id = sc.subcategory_id
            JOIN categories c ON sc.category_id = c.category_id
            WHERE p.product_id = :product_id
        ");
        $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Récupérer les produits en vedette
    public function getFeaturedProducts($limit = 3) {
        $stmt = $this->db->prepare("
            SELECT * FROM $this->table 
            WHERE is_featured = 1 
            LIMIT :limit
        ");
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>