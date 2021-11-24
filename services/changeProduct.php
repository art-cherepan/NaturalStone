<?php
if (!isset($_SESSION)) {
    session_start();
}

require_once __DIR__ . '/../classes/Uploader.php';
require_once __DIR__ . '/../classes/Models/Product.php';

if (empty($_POST['id'])) {
    echo 'Не передан идентификатор товара';
    die;
} elseif (empty($_POST['name'])) {
    echo 'Не передано наименование товара';
    die;
} elseif (empty($_POST['description'])) {
    echo 'Не передано описание товара';
    die;
} elseif (empty($_POST['price'])) {
    echo 'Не передана цена товара';
    die;
}
if (!empty($_FILES)) {
    if ('' != $_FILES['img']['name']) {
        $uploader = new Uploader('img');
        if ($uploader->upload()) {
            $product = new Product($_POST['id'], $_POST['name'], $_POST['price'], $_POST['description'], str_replace('\\', '/',
                $uploader->getPath()));
            if ($product->update(true)) {
                echo 'Товар успешно изменен!';
            } else {
                echo 'Произошла ошибка при изменении товара!';
            }
        } else {
            echo 'Ошибка при загрузке изображения!';
        }
    } else {
        echo 'Ошибка при передаче изображения товара!';
    }
} else {
    $product = new Product($_POST['id'], $_POST['name'], $_POST['price'], $_POST['description'], '');
    if ($product->update(false)) {
        echo 'Товар успешно изменен!';
    } else {
        echo 'Произошла ошибка при изменении товара!';
    }
}
