<?php
if (!isset($_SESSION)) {
    session_start();
}

require_once __DIR__ . '/../classes/View.php';

if (!empty($_POST['edit_service_select'])) {
    $serviceFields = explode('&&&', $_POST['edit_service_select']);
    $view = new View();
    $view->assign('serviceFields', $serviceFields);
    $view->display(__DIR__ . '/../templates/editService.php');
} else {
    echo 'Данные об услуге не переданы';
}
?>
