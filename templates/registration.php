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
            <form action="<?php if (!empty($_GET['placeAnOrder'])) {
                if ('true' === $_GET['placeAnOrder']) {
                    echo '/NaturalStone/services/registration.php?placeAnOrder=true';
                } else {
                    if ('false' === $_GET['placeAnOrder']) {
                        echo '/NaturalStone/services/registration.php?placeAnOrder=false';
                    }
                }
            } ?>" method="post">
                <div class="form-group pb-2">
                    <label class="pb-1" for="inputUserName">Имя</label>
                    <input type="text" name="firstName" class="form-control" id="inputUserName"
                           placeholder="Введите имя"
                           value="<?php
                           if (!empty($_POST['firstName'])) {
                               echo $_POST['firstName'];
                           } ?>"/>
                </div>
                <div class="form-group pb-2">
                    <label class="pb-1" for="inputUserSecondName">Фамилия</label>
                    <input type="text" name="secondName" class="form-control" id="inputUserSecondName"
                           placeholder="Введите фамилию"
                           value="<?php
                           if (!empty($_POST['secondName'])) {
                               echo $_POST['secondName'];
                           } ?>"/>
                </div>
                <div class="form-group pb-2">
                    <label class="pb-1" for="inputUserPatronymic">Отчество</label>
                    <input type="text" name="patronymic" class="form-control" id="inputUserPatronymic"
                           placeholder="Введите отчество"
                           value="<?php
                           if (!empty($_POST['patronymic'])) {
                               echo $_POST['patronymic'];
                           } ?>"/>
                </div>
                <div class="form-group pb-2">
                    <label class="pb-1" for="inputEmail">Адрес электронной почты</label>
                    <input type="email" name="email" class="form-control" id="inputEmail"
                           placeholder="Введите адрес электронной почты" value="<?php
                    if (!empty($_POST['email'])) {
                        echo $_POST['email'];
                    } ?>"/>
                </div>
                <div class="form-group pb-2">
                    <label class="pb-1" for="inputPhone">Номер телефона</label>
                    <input type="tel" name="phone" class="form-control" id="inputPhone"
                           placeholder="Введите номер телефона" value="<?php
                    if (!empty($_POST['phone'])) {
                        echo $_POST['phone'];
                    } ?>"/>
                </div>
                <div class="form-group pb-2">
                    <label class="pb-1" for="inputUserName">Логин</label>
                    <input type="text" name="userName" class="form-control" id="inputUserName"
                           placeholder="Введите логин" value="<?php
                    if (!empty($_POST['userName'])) {
                        echo $_POST['userName'];
                    } ?>"/>
                </div>
                <div class="form-group pb-2">
                    <label class="pb-1" for="inputPassword">Пароль</label>
                    <input type="password" name="password" class="form-control" id="inputPassword"
                           placeholder="Введите пароль" value="<?php
                    if (!empty($_POST['password'])) {
                        echo $_POST['password'];
                    } ?>"/>
                </div>
                <div class="form-group pb-2">
                    <label class="pb-1" for="inputPasswordRepeat">Повторите пароль</label>
                    <input type="password" name="passwordRepeat" class="form-control" id="inputPasswordRepeat"
                           placeholder="Введите пароль еще раз" value="<?php
                    if (!empty($_POST['passwordRepeat'])) {
                        echo $_POST['passwordRepeat'];
                    } ?>"/>
                </div>
                <div class="form-group pt-3">
                    <button class="btn btn-dark" type="submit">Регистрация</button>
                    <a class="btn btn-dark" href="/NaturalStone/index.php" role="button">На главную</a>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>