<?php
if (!isset($_SESSION)) {
    session_start();
}

require_once __DIR__ . '/../autoload.php';
use \App\Models\Product as Product;

if (!empty($_POST['delete_product_select'])) {
    $product = new Product($_POST['delete_product_select'], '', '', '', '');
    if (true == $product->delete()) {
        echo 'Товар успешно удален!';
    } else {
        echo 'Ошибка при удалении товара!';
    }
}
