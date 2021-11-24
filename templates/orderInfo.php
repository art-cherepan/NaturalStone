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
		<div class="col-6 offset-3 alert alert-success">
			<center><h4 class="mb-3">Ваш заказ</h4></center>
            <?php
            if (!empty($this->data['products'])) {
                foreach ($this->data['products'] as $key => $value) {
                    ?>
					<div class="alert alert-light">
						<center><strong><?php
                                echo $key; ?></strong> Количество:
							<strong><?php
                                echo $value; ?></strong></center>
					</div>
                    <?php
                }
            } ?>
            <?php
            if (!empty($this->data['services'])) {
            ?>
			<center><h5 class="mb-3">Выбранные услуги</h5>
				<center>
                    <?php
                    foreach ($this->data['services'] as $service) {
                        ?>
						<div class="alert alert-light"><strong><?php
                                echo $service; ?></strong></div>
                        <?php
                    }
                    } ?>
		</div>
	</div>
</div>

<?php
if (isset($this->data['discount'])) {
    ?>
	<div class="container">
		<div class="row pt-3">
			<div class="col-6 offset-3 alert alert-info d-flex justify-content-center align-items-center fs-4 fw-bold">
				<span>Ваша скидка: <?php
                    echo $this->data['discount']; ?> %.</span>
			</div>
		</div>
	</div>
    <?php
}

if (!empty($this->data['totalPrice'])) {
    ?>
	<div class="container">
		<div class="row pt-3">
			<div class="col-6 offset-3 alert alert-info d-flex justify-content-center align-items-center fs-4 fw-bold">
				<span>Итоговая сумма: <?php
                    echo $this->data['totalPrice']; ?> рублей.</span>
			</div>
		</div>
	</div>
    <?php
} ?>

</body>
</html>

