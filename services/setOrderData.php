<?php
if (!isset($_SESSION)) {
    session_start();
//    var_dump($_SESSION);
//	var_dump($_POST);
//	die;
}

require_once __DIR__ . '/../autoload.php';
use \App\Models\Product as Product;
use \App\Models\User as User;
use \App\View as View;

$products = [];
$services = [];
$totalPrice = 0;

if (!empty($_POST)) {
    if (!empty($_SESSION['services'])) {
        foreach ($_SESSION['services'] as $serviceId => $serviceValue) {
            foreach ($serviceValue as $key => $value) {
                if ('check' == $key) {
                    $_SESSION['services'][$serviceId][$key] = false;
                } elseif ('price' == $key) {
                    $totalPrice += $value;
                }
            }
        }
        foreach ($_POST as $key => $value) {
            if (false !== stripos($key, 'service-checked-id-') && 'checked' == $value) {
                $keyExplode = explode('-', $key);
                $id = $keyExplode[3];
                $_SESSION['services'][$id]['check'] = true;
            } elseif (false !== strripos($key, 'count-product-id-')) {
                $keyExplode = explode('-', $key);
                $id = $keyExplode[3];
                $_SESSION['products'][$id] = $value;
            }
        }
    }
}

//    var_dump($_SESSION);
//echo '<br/>';
//echo '<br/>';echo '<br/>';echo '<br/>';
//	var_dump($_POST);
//	die;

if (!empty($_SESSION['products'])) {
    if (count($_SESSION['products']) > 0) {
        $products = Product::getProducts();
        foreach ($_SESSION['products'] as $key => $value) {
            $product = Product::getProduct($key);
            $totalPrice += $product->getPrice() * $value;
        }
    }
}

$viewOrderInfo = new View();
if (!empty($_SESSION['services'])) {
	$viewServices = [];
	foreach ($_SESSION['services'] as $service) {
		if (true == $service['check']) {
            $viewServices[] = $service['name'];
        }
    }
    $viewOrderInfo->assign('services', $viewServices);
}

if (!empty($_SESSION['products'])) {
	$products = Product::getProducts();
	$viewProducts = [];
	foreach ($_SESSION['products'] as $key => $value) {
		$product = Product::getProduct($key);
		$viewProducts[$product->getName()] = $value;
	}
    $viewOrderInfo->assign('products', $viewProducts);
}

if (empty($_SESSION['userName'])) {
    if (empty($_GET['unregisteredUser'])) { ?>
		<script> unregisteredUser = confirm('Продолжить как незарегестрированный пользователь ? В этом случае сумма покупки не прибавится к вашей общей сумме. В конечном итоге, это влияет на скидку.');
            window.location.href = "/NaturalStone/services/setOrderData.php?unregisteredUser=" + unregisteredUser;</script> <?php
    } else {
        if ('true' === $_GET['unregisteredUser']) { //пользователь захотел оформить заказ как незареганный пользователь
            if ($totalPrice > 0) {
                $_SESSION['totalPrice'] = $totalPrice;
                $_SESSION['unregisteredUser'] = true;
                $viewOrderInfo->assign('totalPrice', $totalPrice);
                $viewOrderInfo->display(__DIR__ . '/../templates/orderInfo.php');
                $viewUserForm = new View();
                $viewUserForm->display(__DIR__ . '/../templates/unregisteredUserForm.php');
            } else { ?>
				<script> alert('Сумма заказа составляет 0 рублей');
                    window.location.href = "/NaturalStone/index.php; </script><?php
            }
        } elseif ('false' === $_GET['unregisteredUser']) { //пользователь захотел оформить заказ как зареганный пользователь
            //пока не знаем скидку, ее будем получать позже
            $viewOrderInfo->display(__DIR__ . '/../templates/regOrAuth.php');
        }
    }
} else { //если пользователь зарегался ранее
	$_SESSION['unregisteredUser'] = false;
    $id = User::getIdByUserName($_SESSION['userName']);
    $user = User::getUser($id);
    if ($totalPrice > 0) {
        $user->setAmountOfPurchases($totalPrice * $user->calculateDiscount()); //в общую сумму заказов добавляется заказ со старой скидкой
        $_SESSION['totalPrice'] = $totalPrice * $user->calculateDiscount();
		$_SESSION['unregisteredUser'] = false;
        $viewOrderInfo->assign('totalPrice', $totalPrice * $user->calculateDiscount());
		$viewOrderInfo->assign('discount', $user->getDiscount());
		$viewOrderInfo->display(__DIR__ . '/../templates/orderInfo.php');
		$viewOrderInfo->display(__DIR__ . '/../templates/orderInfoFooter.php');
	} else { ?>
		<script> alert('Сумма заказа составляет 0 рублей');
            window.location.href = "/NaturalStone/index.php; </script> <?php
    }
   // var_dump($_SESSION);
}