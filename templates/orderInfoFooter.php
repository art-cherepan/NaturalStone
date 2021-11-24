<?php
if (!isset($_SESSION)) {
    session_start();
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
<body>

<div class="container">
    <div class="row pt-3">
        <div class="col-6 offset-3 alert alert-dark">
            <div class="form-group">
                <a class="btn btn-dark" href="/NaturalStone/services/makeAnOrder.php" role="button">Оформить заказ</a>
                <a class="btn btn-dark" href="/NaturalStone/index.php" role="button">На главную</a>
            </div>
        </div>
    </div>
</div>

</body>
</html>
