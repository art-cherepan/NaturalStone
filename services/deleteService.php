<?php

if (!isset($_SESSION)) {
    session_start();
}

require_once __DIR__ . '/../classes/DB.php';

if (!empty($_POST['delete_service_select'])) {
    $DB = new DB('localhost', 'natural_stone', 'root', 'root');
    $deleteService = 'DELETE FROM services WHERE id = ' . $_POST['delete_service_select'];
    if (true == $DB->execute($deleteService)) {
        echo 'Услуга успешно удалена';
    } else {
        echo 'Произошла ошибка';
    }
}
