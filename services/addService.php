<?php
if (!isset($_SESSION)) {
    session_start();
}

require_once __DIR__ . '/../autoload.php';
use \App\Uploader as Uploader;
use \App\Models\Service as Service;

if (empty($_POST['name_service'])) {
    echo 'Укажите наименование услуги';
} elseif (empty($_POST['description_service'])) {
    echo 'Укажите описание услуги';
} elseif (empty($_POST['price_service'])) {
    echo 'Укажите цену услуги';
} elseif (empty($_POST['measure_service'])) {
    echo 'Укажите единицу измерения для услуги';
} else {
    $uploader = new Uploader('img_service');
    if ($uploader->upload()) {
        $service = new Service('', $_POST['name_service'], $_POST['price_service'], $_POST['measure_service']);
        if (true == $service->insert()) {
            echo 'Услуга добавлена успешно';
        } else {
            echo 'Произошла ошибка';
        }
    } else {
        echo 'Ошибка при загрузке файла';
    }
}