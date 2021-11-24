<?php
if (!isset($_SESSION)) {
    session_start();
 //    var_dump($_SESSION);
//    die;
}

require_once __DIR__ . '/classes/View.php';
require_once __DIR__ . '/classes/Models/Products.php';
require_once __DIR__ . '/classes/Models/Services.php';

$view = new View();
if (!empty($_SESSION['products'])) {
    $productIdDelete = null;
    if (!empty($_GET['productInCartDelete'])) {
        $productIdDelete = $_GET['productInCartDelete'];
        unset($_SESSION['products'][$productIdDelete]);
    }
    $products = new Products();
    $productsInCart = [];
    foreach ($_SESSION['products'] as $key => $value) {
        $product = $products->getProduct($key);
        $productInCart = ['price' => $product->getPrice(), 'description' => $product->getDescription(), 'path' => $product->getPath(), 'id' => $product->getId()];
        $productsInCart[] = $productInCart;
    }
    $view->assign('products', json_encode($productsInCart));
}
$view->display(__DIR__ . '/templates/cart.php');

