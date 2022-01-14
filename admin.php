<?php
if (!isset($_SESSION)) {
    session_start();
}

if (!empty($_SESSION['userName'])) {
    if ('root' != $_SESSION['userName']) { ?>
        <div class="msg alert alert-danger" role="alert"><p>У вас нет прав!</p><p><a href="/NaturalStone/index.php">На главную</a></p></div>;
        <?php die;
    }
} else { ?>
    <div class="msg alert alert-danger" role="alert"><p>У вас нет прав!</p><p><a href="/NaturalStone/index.php">На главную</a></p></div>;
<?php }

require_once __DIR__ . '/autoload.php';
use \App\Models\Product as Product;
use \App\Models\Service as Service;
use \App\View as View;

$products = Product::getProducts();
$services = Service::getServices();

if ($products !== false) {
    $view = new View();
    $view->assign('products', $products);
    $view->assign('services', $services);
    $view->display(__DIR__ . '/templates/admin.php');
} else {
    echo 'Ошибка при получении товаров';
}
?>
