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
			<form action="/NaturalStone/services/makeAnOrder.php?unregisteredUser=true" method="post">
				<div class="form-group pb-2">
					<label class="pb-1" for="inputUserName">Имя</label>
					<input type="text" name="firstName" class="form-control" id="inputUserName"
						   value="<?php
                           if (!empty($_POST['firstName'])) {
                               echo $_POST['firstName'];
                           } ?>"
						   placeholder="Введите имя">
				</div>
				<div class="form-group pb-2">
					<label class="pb-1" for="inputUserSecondName">Фамилия</label>
					<input type="text" name="secondName" class="form-control" id="inputUserSecondName"
						   value="<?php
                           if (!empty($_POST['secondName'])) {
                               echo $_POST['secondName'];
                           } ?>"
						   placeholder="Введите фамилию">
				</div>
				<div class="form-group pb-2">
					<label class="pb-1" for="inputUserPatronymic">Отчество</label>
					<input type="text" name="patronymic" class="form-control" id="inputUserPatronymic"
						   value="<?php
                           if (!empty($_POST['patronymic'])) {
                               echo $_POST['patronymic'];
                           } ?>"
						   placeholder="Введите отчество">
				</div>
				<div class="form-group pb-2">
					<label class="pb-1" for="inputPhone">Номер телефона</label>
					<input type="tel" name="phone" class="form-control" id="inputPhone"
						   value="<?php
                           if (!empty($_POST['phone'])) {
                               echo $_POST['phone'];
                           } ?>"
						   placeholder="Введите номер телефона"/>
				</div>
				<p>Укажите предпочитаемый способ связи:</p>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="checked" name="sms">
					<label class="form-check-label" for="sms-checkbox">
						<h6>SMS</h6>
					</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="checked" name="viber">
					<label class="form-check-label" for="viber-checkbox">
						<h6>Viber</h6>
					</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="checked"
						   name="whatsapp">
					<label class="form-check-label" for="whatsapp">
						<h6>Whatsapp</h6>
					</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="checked"
						   name="telegram">
					<label class="form-check-label" for="telegram">
						<h6>Telegram</h6>
					</label>
				</div>
				<div class="form-group pt-3">
					<button class="btn btn-dark" type="submit">Оформить заказ</button>
					<a class="btn btn-dark" href="/NaturalStone/index.php" role="button">На главную</a>
				</div>
			</form>
		</div>
	</div>
</div>

</body>
</html>
