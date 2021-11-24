<?php
if (!isset($_SESSION)) {
    session_start();
    //var_dump($_POST);
}
require_once __DIR__ . '/classes/View.php';

$view = new View();
$view->display(__DIR__ . '/templates/authorization.php');

?>
