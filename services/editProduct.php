<?php
if (!isset($_SESSION)) {
    session_start();
}

require_once __DIR__ . '/../autoload.php';
use \App\View as View;

if (!empty($_POST['edit_product_select'])) {
    $productFields = explode('&&&', $_POST['edit_product_select']);
    $view = new View();
    $view->assign('productFields', $productFields);
    $view->display(__DIR__ . '/../templates/editProduct.php');
} else {
    echo 'Данные о товаре не переданы';
}
