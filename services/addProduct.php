<?php
if (!isset($_SESSION)) {
    session_start();
}

require_once __DIR__ . '/../classes/Uploader.php';
require_once __DIR__ . '/../classes/Models/Product.php';

if (empty($_POST['name_product'])) {
    echo 'Укажите наименование товара';
} elseif (empty($_POST['description_product'])) {
    echo 'Укажите описание товара';
} elseif (empty($_POST['price_product'])) {
    echo 'Укажите цену товара';
} else {
    $uploader = new Uploader('img_product');
    if ($uploader->upload()) {
        $product = new Product('',$_POST['name_product'], $_POST['price_product'], $_POST['description_product'], str_replace('\\', '/',
            $uploader->getPath()));
        if (true == $product->insert()) {
            echo 'Товар добавлен успешно';
        } else {
            echo 'Произошла ошибка';
        }
    } else {
        echo 'Ошибка при загрузке файла';
    }
}