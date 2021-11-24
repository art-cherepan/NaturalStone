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
<div class="container-fluid">
    <div class="row pt-3">
        <div class="col-8 offset-2  d-flex justify-content-center align-items-center alert alert-success">
            <span><a class="btn btn-warning" href="/NaturalStone/registration.php?placeAnOrder=true" role="button">Зарегестрироваться</a></span>
            <span class="m-2"><a class="btn btn-warning" href="/NaturalStone/authorization.php?placeAnOrder=true" role="button">Войти</a></span>
        </div>
    </div>
</div>
</body>
</html>
