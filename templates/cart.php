<?php
if (!isset($_SESSION)) {
    session_start();
}

if (!empty($this->data['products'])) {
    $products = json_decode($this->data['products'], true);
} else {
    $products = null;
    ?>
    <script>
        alert('В корзине нет товаров');
    </script> <?php
}
?>

<!doctype html>
<html lang="en">
<head>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="/NaturalStone/css/bootstrap.min.css">
        <!--собственные стили-->
        <link rel="stylesheet" href="/NaturalStone/css/styles.css">
        <!-- Bootstrap JS + Popper JS -->
        <script defer src="/NaturalStone/js/bootstrap.bundle.min.js"></script>
        <title>Главная страница</title>
    </head>
</head>
<body class="body-color">
<div class="mt-5 container alert bg-info bg-gradient">
    <div class="container">
        <div class="row">
            <div class="col-3 d-flex justify-content-left align-items-center">
                <?php if (isset($_SESSION['discount'])) {
                    ?> &nbsp;Ваша Скидка:&nbsp;<strong><?php echo $_SESSION['discount']; ?>%</strong><?php
                } ?>
            </div>
            <div class="col-6 d-flex justify-content-center align-items-center">
                <h2>Выбранные товары</h2>
            </div>
        </div>
        <form action="/NaturalStone/services/setOrderData.php" method="post">
            <?php if (null != $products) {
                foreach ($products as $product) { ?>
                    <div class="row mt-3 pt-3 alert bg-light">
                        <div class="col-xl-2 col-lg-2 col-md-6 col-sm-12 d-flex justify-content-center align-items-center">
                            <img src="<?php echo $product['path'] ?>" width="100%" height="100%">
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 d-flex justify-content-center align-items-center">
                            <h6><span><?php echo $product['description'] ?></span></h6>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 d-flex justify-content-center align-items-center">
                            <h6>Цена: <span><?php echo $product['price'] ?> руб.</span></h6>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 d-flex justify-content-center align-items-center">
                            <h6><span>Количество: <input name="count-product-id-<?php echo $product['id']; ?>"
                                                         type="number"
                                                         style="width: 50px"
                                                         value="<?php if (!empty($_SESSION['products'][$product['id']])) {
                                                             echo $_SESSION['products'][$product['id']];
                                                         } else {
                                                             echo 1;
                                                         } ?>" min="1"></span></h6>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 d-flex justify-content-center align-items-center">
                            <a class="btn btn-danger"
                               href="/NaturalStone/cart.php?productInCartDelete=<?php echo $product['id']; ?>" role="button">Удалить</a>
                        </div>
                    </div>
                <?php }
            } ?>
            <div class="d-flex justify-content-center align-items-center mt-5 mb-5">
                <h4>Также Вы можете заказать следующие виды услуг по индивидуальным заказам:</h4>
            </div>
            <?php if (!empty($_SESSION['services'])) {
                foreach ($_SESSION['services'] as $key => $value) { ?>
                    <div class="row mt-3 pt-3 alert bg-light">
                        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 d-flex justify-content-center align-items-center">
                            <h6><span><?php echo $value['name'] ?></span></h6>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 d-flex justify-content-center align-items-center">
                            <h6>Цена: <span><?php echo $value['price'] ?> руб.</span></h6>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 d-flex justify-content-center align-items-center">
                            <h6>Единица измерения: <span><?php echo $value['measure'] ?></span></h6>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 d-flex justify-content-center align-items-center">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="checked"
                                       name="service-checked-id-<?php echo $key; ?>" <?php if (true == $value['check']) {
                                    echo 'checked';
                                } ?>>
                                <label class="form-check-label" for="service-checked-id-<?php echo $key; ?>">
                                    <h6>Заказать</h6>
                                </label>
                            </div>
                        </div>
                    </div>
                <?php }
            } ?>
            <!--            <button class="btn btn-warning" type="submit" style="width: 100%">Оформить заказ</button>-->
            <div class="form-group pt-3">
                <button class="btn btn-dark" type="submit">Оформить заказ</button>
                <a class="btn btn-dark" href="/NaturalStone/index.php" role="button">На главную</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>