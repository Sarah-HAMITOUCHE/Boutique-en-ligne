<?php
header('Content-Type: application/json');
require_once '../../config/Database.php';
require_once '../../models/Product.php';

$database = new Database();
$db = $database->connect();

$productModel = new Product($db);

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if (isset($_GET['id'])) {
            // Détail d'un produit
            $product = $productModel->getById($_GET['id']);
            echo json_encode($product);
        } else {
            // Liste des produits avec filtres
            $filters = [
                'category' => $_GET['category'] ?? null,
                'search' => $_GET['search'] ?? null,
                'min_price' => $_GET['min_price'] ?? null,
                'max_price' => $_GET['max_price'] ?? null,
                'page' => $_GET['page'] ?? 1,
                'limit' => $_GET['limit'] ?? 12
            ];
            
            $result = $productModel->getFilteredProducts($filters);
            echo json_encode($result);
        }
        break;
        
    case 'POST':
        // Création d'un produit (admin)
        break;
        
    case 'PUT':
        // Mise à jour d'un produit (admin)
        break;
        
    case 'DELETE':
        // Suppression d'un produit (admin)
        break;
        
    default:
        http_response_code(405);
        echo json_encode(['message' => 'Méthode non autorisée']);
}
?>