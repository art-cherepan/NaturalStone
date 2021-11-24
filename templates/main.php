<?php
if (!isset($_SESSION)) {
    session_start();
}

?>

<!doctype html>
<html lang="en">
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

<body class="body-color">

<div class="wrapper">
    <header>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-4 header-username-style">
                    <?php if (!empty($_SESSION['userName'])) { ?>
                        <div class="d-flex justify-content-center">Пользователь
                            <strong>&nbsp;
                                <?php echo $_SESSION['userName']; ?>
                            </strong>
                        </div>
                    <?php } ?>
                </div>
                <div class="d-flex justify-content-center col-xl-2 col-lg-2 col-md-2">
                    <a href="/NaturalStone/contacts.php">Контакты</a>
                </div>
                <div class="d-flex justify-content-center col-xl-2 col-lg-2 col-md-2">
                    <a href="/NaturalStone/registration.php?placeAnOrder=false">Регистрация</a>
                </div>
                <div class="d-flex justify-content-center col-xl-2 col-lg-2 col-md-2">
                    <a href="/NaturalStone/authorization.php?placeAnOrder=false">Войти</a>
                </div>
                <div class="d-flex justify-content-center col-xl-2 col-lg-2 col-md-2">
                    <a href="/NaturalStone/cart.php">Корзина</a>
                </div>
            </div>
        </div>
    </header>

    <section>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="d-flex justify-content-center">
                        <h1>Товары</h1>
                    </div>
                </div>
            </div>
            <div id="carouselProducts" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row justify-content-between">
                            <?php foreach ($this->data['products'] as $product) { ?>
                                <div class="col">
                                    <div class="card w-100">
                                        <h3 class="card-header"><?php echo $product->getName(); ?> </h3>
                                        <img src="<?php echo $product->getPath(); ?>" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h4 class="card-title">Цена: <?php echo $product->getPrice(); ?> руб.</h4>
                                            <p class="card-text"><?php echo $product->getDescription(); ?></p>
                                            <a href="/NaturalStone/services/addInCart.php?id=<?php echo $product->getId(); ?>"
                                               class="btn btn-primary">Добавить в корзину</a>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="row justify-content-between">
                            <?php foreach ($this->data['products'] as $product) { ?>
                                <div class="col">
                                    <div class="card w-100">
                                        <h3 class="card-header"><?php echo $product->getName(); ?> </h3>
                                        <img src="<?php echo $product->getPath(); ?>" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h4 class="card-title">Цена: <?php echo $product->getPrice(); ?> руб.</h4>
                                            <p class="card-text"><?php echo $product->getDescription(); ?></p>
                                            <a href="/NaturalStone/services/addInCart.php?id=<?php echo $product->getId(); ?>"
                                               class="btn btn-primary">Добавить в корзину</a>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselProducts"
                        data-bs-slide="next">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselProducts"
                        data-bs-slide="prev">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

            <div class="mt-5 d-flex justify-content-center align-items-center"><h4>Также мы предлагаем следующие виды
                    услуг:</h4></div>
            <?php foreach ($this->data['services'] as $service) { ?>
                <div class="msg success alert-success">
                    <p>Наименование: <?php echo $service->getName(); ?></p>
                    <p>Единица измерения: <?php echo $service->getMeasure(); ?> </p>
                    <p>Цена: <?php echo $service->getPrice(); ?> руб. </p>
                </div>
            <?php } ?>

    </section>

    <footer>
        <div class="container">
            <div class="row text-center">
                <div class="col">
                    <img src="/NaturalStone/media/vk.png" width="30px" height="30px">
                    <img src="/NaturalStone/media/instagram.png" width="30px"
                         height="30px">
                </div>
            </div>
        </div>
    </footer>
</div>
</body>
</html>