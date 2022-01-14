<?php
if (!isset($_SESSION)) {
    session_start();
 //    var_dump($_SESSION);
//    die;
}

require_once __DIR__ . '/autoload.php';
use \App\View as View;
use \App\Models\Product as Product;

$view = new View();
if (!empty($_SESSION['products'])) {
    $productIdDelete = null;
    if (!empty($_GET['productInCartDelete'])) {
        $productIdDelete = $_GET['productInCartDelete'];
        unset($_SESSION['products'][$productIdDelete]);
    }
    $productsInCart = [];
    foreach ($_SESSION['products'] as $key => $value) {
        $product = Product::getProduct($key);
        $productInCart = ['price' => $product->getPrice(), 'description' => $product->getDescription(), 'path' => $product->getPath(), 'id' => $product->getId()];
        $productsInCart[] = $productInCart;
    }
    $view->assign('products', json_encode($productsInCart));
}
$view->display(__DIR__ . '/templates/cart.php');

