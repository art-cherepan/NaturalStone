<?php
if (!isset($_SESSION)) {
    session_start();
}

//var_dump($_SESSION);
//die;
//foreach ($_SESSION as $key => $value) {
//    unset($_SESSION[$key]);
//}

require_once __DIR__ . '/autoload.php';
use \App\Models\Product as Product;
use \App\Models\Service as Service;
use \App\View as View;

$products = Product::getProducts();
$services = Service::getServices();

if (empty($_SESSION['services'])) {
    if (count($services) > 0) {
        $sessionServices = [];
        foreach ($services as $service) {
            $serviceInfo = [];
            $serviceInfo['name'] = $service->getName();
            $serviceInfo['price'] = $service->getPrice();
            $serviceInfo['measure'] = $service->getMeasure();
            $serviceInfo['check'] = $service->getCheck();
            $sessionServices[$service->getId()] = $serviceInfo;
        }
        $_SESSION['services'] = $sessionServices;
    }
}

if (false != $products && false != $services) {
    $view = new View();
    $view->assign('products', $products);
    $view->assign('services', $services);
    $view->display(__DIR__ . '/templates/main.php');
} else {
    echo 'Ошибка при получении товаров и услуг!';
}
