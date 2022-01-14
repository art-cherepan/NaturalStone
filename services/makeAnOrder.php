<?php

if (!isset($_SESSION)) {
    session_start();
}

require_once __DIR__ . '/../autoload.php';
use \App\Models\Order as Order;
use \App\Models\OrderProduct as OrderProduct;
use \App\Models\OrderService as OrderService;
use \App\Models\Product as Product;
use \App\Models\User as User;
use \App\MailSender as MailSender;

$servicesId = [];
$servicesName = [];
if (!empty($_SESSION['services'])) {
    foreach ($_SESSION['services'] as $serviceId => $serviceValue) {
        foreach ($serviceValue as $key => $value) {
            if ('check' == $key) {
                if (true == $value) {
                    $servicesId[] = $serviceId;
                    $servicesName[] = $_SESSION['services'][$serviceId]['name'];
                }
            }
        }
    }
}
//var_dump($_SESSION['services']);
//var_dump($servicesId);
//var_dump($servicesName);
//die;

if (isset($_SESSION['unregisteredUser'])) {
    if (true == $_SESSION['unregisteredUser']) { //пользователь совершил заказ как незареганный пользователь
        if (empty($_POST['firstName'])) {
            ?>
            <script> alert('Не указано имя пользователя');
                window.location.href = "/NaturalStone/services/setOrderData.php?unregisteredUser=true"</script>
            <?php
        }
        if (empty($_POST['secondName'])) {
            ?>
            <script> alert('Не указана фамилия пользователя');
                window.location.href = "/NaturalStone/services/setOrderData.php?unregisteredUser=true"</script>
            <?php
        }
        if (empty($_POST['patronymic'])) {
            ?>
            <script> alert('Не указано отчество пользователя');
                window.location.href = "/NaturalStone/services/setOrderData.php?unregisteredUser=true"</script>
            <?php
        }
        if (empty($_POST['phone'])) {
            ?>
            <script> alert('Не указан номер телефона пользователя');
                window.location.href = "/NaturalStone/services/setOrderData.php?unregisteredUser=true"</script>
            <?php
        }
        if ((isset($_POST['sms']) && ('checked' == $_POST['sms'])) || (isset($_POST['whatsapp']) && ('checked' == $_POST['whatsapp'])) || (isset($_POST['viber']) && ('checked' == $_POST['viber'])) || (isset($_POST['telegram'])) && 'checked' == $_POST['telegram']) {
            $communicationMethod = '';
            if (isset($_POST['sms'])) {
                $communicationMethod .= ' sms ';
            }

            if (isset($_POST['viber'])) {
                $communicationMethod .= ' viber ';
            }

            if (isset($_POST['whatsapp'])) {
                $communicationMethod .= ' whatsapp ';
            }

            if (isset($_POST['telegram'])) {
                $communicationMethod .= ' telegram ';
            }

            $message = 'Пользователь: ' . $_POST['firstName'] . ' ' . $_POST['secondName'] . ' ' . $_POST['patronymic'] . "\nтелефон: " . $_POST['phone'] . "\nпредпочитаемый способ связи: " . $communicationMethod;

            if (!empty($_SESSION['products'])) {
                $products = Product::getProducts();
            	$message .= "\nЗаказанные товары: ";
                foreach ($_SESSION['products'] as $key => $value) {
					$product = Product::getProduct($key);
                    $message .= $product->getName() . ' в количестве: ' . $value . ' , ';
                }
                $message = substr($message, 0, -2);
            }

     //       var_dump($servicesName); die;
            if (count($servicesName) > 0) {
                $message .= "\nЗаказанные услуги: ";
                foreach ($servicesName as $serviceName) {
                    $message .= $serviceName . ', ';
                }
                $message = substr($message, 0, -2);
            }
            $message .= "\nитоговая цена: " . $_SESSION['totalPrice'] . ' руб.';
            $headers = 'From: test21@gmail.com';

            $mailSender = new MailSender('art.cherepan@gmail.com', 'Новый заказ в природный камень', $headers, $message);
            if (true === $mailSender->sendMessage()) {
              //  die;
            	?>
                <script> alert('Заказ успешно оформлен');
                    window.location.href = "/NaturalStone/services/setOrderData.php?unregisteredUser=true"</script>
                <?php
            } else {
                ?>
                <script> alert('Ошибка при отправке заказа!');
                    window.location.href = "/NaturalStone/services/setOrderData.php?unregisteredUser=true"</script>
                <?php
            }
        } else {
            ?>
            <script> alert('Не выбран способ связи');
                window.location.href = "/NaturalStone/services/setOrderData.php?unregisteredUser=true"</script>
            <?php
        }
    } elseif (false == $_SESSION['unregisteredUser']) {
        if (count($servicesId) > 0 || !empty($_SESSION['products'])) {
            $userId = User::getIdByUserName($_SESSION['userName']);
            $order = new Order('', $userId, date("Y-m-d H:i:s"), $_SESSION['totalPrice']);
            $flag = true;
            if (true == $order->insert()) {
                if (count($servicesId) > 0) { //находим услуги в заказе
                    foreach ($servicesId as $serviceId) {
                        $orderService = new OrderService('', $order->getIdAfterInsert(), $serviceId);
                        if (false == $orderService->insert()) {
                        	$flag = false;
                            ?>
							<script> alert('Произошла ошибка при оформлении заказа!');
                                window.location.href = "/NaturalStone/index.php"</script>
                            <?php
						}
                    }
                }
                if (!empty($_SESSION['products'])) {
                    foreach ($_SESSION['products'] as $productId => $count) {
                        $orderProduct = new OrderProduct('', $order->getIdAfterInsert(), $productId, $count);
                        if (false == $orderProduct->insert()) {
                        	$flag = false;
                            ?>
							<script> alert('Произошла ошибка при оформлении заказа!');
                                window.location.href = "/NaturalStone/index.php"</script>
                            <?php
                        }
                    }
                }
            } else {
                ?>
				<script> alert('Произошла ошибка при оформлении заказа!');
                    window.location.href = "/NaturalStone/index.php"</script>
                <?php
            }
            if (true == $flag) {
                ?>
				<script> alert('Заказ успешно оформлен!');
                    window.location.href = "/NaturalStone/index.php"</script>
                <?php
				//сделать отправку письма в случае успеха для зареганного юзера!
            } else {
                ?>
				<script> alert('Произошла ошибка при оформлении заказа!');
                    window.location.href = "/NaturalStone/index.php"</script>
                <?php
            }
        }
    }
} else {
    ?>
    <script> alert('Не передана информация о том, зарегестрирован ли пользователь или нет!');
        window.location.href = "/NaturalStone/index.php"</script>
    <?php
}
