<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once __DIR__ . '/classes/View.php';

$view = new View();
$view->display(__DIR__ . '/templates/registration.php');
?>
