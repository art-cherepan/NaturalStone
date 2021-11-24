<?php
if (!isset($_SESSION)) {
    session_start();
}

require_once __DIR__ . '/../classes/Models/Products.php';

$products = new Products();
if (!empty($_GET['id'])) {
    $product = $products->getProduct($_GET['id']);
    if (empty($_SESSION['products'])) {
        $_SESSION['products'][$product->getId()] = 1;
        ?>
        <script>
            alert('Товар успешно добавлен в корзину');
            window.location.href = "/NaturalStone/index.php";
        </script>
        <?php
    } else {
        if (array_key_exists($product->getId(), $_SESSION['products'])) {
            ?>
            <script>
                alert('Данный товар уже есть в корзине');
                window.location.href = "/NaturalStone/index.php";
            </script>
            <?php
        } else {
            $_SESSION['products'][$product->getId()] = 1;
            ?>
            <script>
                alert('Товар успешно добавлен в корзину');
                window.location.href = "/NaturalStone/index.php";
            </script>
            <?php
        }
    }
} else {
    ?>
    <script>
        alert('Не передан идентификатор товара');
        window.location.href = "/NaturalStone/index.php";
    </script>
    <?php
}