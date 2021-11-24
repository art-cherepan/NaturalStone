<?php

if (!isset($_SESSION)) {
    session_start();
}

require_once __DIR__ . '/../classes/Uploader.php';
require_once __DIR__ . '/../classes/Models/Service.php';

if (empty($_POST['id'])) {
    echo 'Не передан идентификатор услуги';
    die;
} elseif (empty($_POST['name'])) {
    echo 'Не передано наименование услуги';
    die;
} elseif (empty($_POST['price'])) {
    echo 'Не передана цена услуги';
    die;
} elseif (empty($_POST['measure'])) {
    echo 'Не передана единица измерения';
    die;
}

$service = new Service($_POST['id'], $_POST['name'], $_POST['price'], $_POST['measure']);
if ($service->update()) {
    echo 'Услуга успешно изменена!';
} else {
    echo 'Произошла ошибка при изменении услуги!';
}

