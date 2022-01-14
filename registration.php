<?php
if (!isset($_SESSION)) {
    session_start();
}

require_once __DIR__ . '/autoload.php';
use \App\View as View;

$view = new View();
$view->display(__DIR__ . '/templates/registration.php');

