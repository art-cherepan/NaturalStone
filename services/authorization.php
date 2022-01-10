<?php
if (!isset($_SESSION)) {
    session_start();
}

require_once __DIR__ . '/../classes/Models/User.php';
require_once __DIR__ . '/../classes/DB.php';

if (empty($_POST['userName'])) {
    if (!empty($_GET['placeAnOrder'])) {
        if ('true' === $_GET['placeAnOrder']) {
            ?>
            <script>
                alert('Введите логин');
                window.location.href = "/NaturalStone/authorization.php?placeAnOrder=true";
            </script> <?php
        } elseif ('false' === $_GET['placeAnOrder']) {
            ?>
            <script>
                alert('Введите логин');
                window.location.href = "/NaturalStone/authorization.php?placeAnOrder=false";
            </script> <?php
        }
    }
} elseif (empty($_POST['password'])) {
    if (!empty($_GET['placeAnOrder'])) {
        if ('true' === $_GET['placeAnOrder']) {
            ?>
            <script>
                alert('Введите пароль');
                window.location.href = "/NaturalStone/authorization.php?placeAnOrder=true";
            </script> <?php
        } elseif ('false' === $_GET['placeAnOrder']) {
            ?>
            <script>
                alert('Введите пароль');
                window.location.href = "/NaturalStone/authorization.php?placeAnOrder=false";
            </script> <?php
        }
    }
} else {
    if (true == User::checkUserName($_POST['userName'])) {
        if (true == User::checkPassword($_POST['userName'], $_POST['password'])) {
            $_SESSION['userName'] = $_POST['userName'];
            $_SESSION['unregisteredUser'] = false;
            if (!empty($_GET['placeAnOrder'])) {
                if ('true' === $_GET['placeAnOrder']) {
                    ?>
                    <script>
                        alert('Вы успешно вошли на сайт!');
                        window.location.href = "/NaturalStone/services/makeAnOrder.php"; //пользователь успешно вошел, до этого хотел оформить заказ
                    </script> <?php
                } elseif ('false' === $_GET['placeAnOrder']) {
                    ?>
                    <script>
                        alert('Вы успешно вошли на сайт!');
                        window.location.href = "/NaturalStone/index.php"; //пользователь успешно вошел, до этого не было попыток оформить заказ
                    </script> <?php
                }
            }
        } else {
            if (!empty($_GET['placeAnOrder'])) {
                if ('true' === $_GET['placeAnOrder']) {
                    ?>
                    <script>
                        alert('Пароль неверный');
                        window.location.href = "/NaturalStone/authorization.php?placeAnOrder=true";
                    </script> <?php
                } elseif ('false' === $_GET['placeAnOrder']) {
                    ?>
                    <script>
                        alert('Пароль неверный');
                        window.location.href = "/NaturalStone/authorization.php?placeAnOrder=false";
                    </script> <?php
                }
            }
        }
    } else {
        if (!empty($_GET['placeAnOrder'])) {
            if ('true' === $_GET['placeAnOrder']) {
                ?>
                <script>
                    alert('Пользователь не найден');
                    window.location.href = "/NaturalStone/authorization.php?placeAnOrder=true";
                </script> <?php
            } elseif ('false' === $_GET['placeAnOrder']) {
                ?>
                <script>
                    alert('Пользователь не найден');
                    window.location.href = "/NaturalStone/authorization.php?placeAnOrder=false";
                </script> <?php
            }
        }
    }
}