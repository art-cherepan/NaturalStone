<?php
if (!isset($_SESSION)) {
    session_start();
}

require_once __DIR__ . '/../classes/DB.php';
require_once __DIR__ . '/../classes/Models/User.php';

if (empty($_POST['firstName'])) {
    if (!empty($_GET['placeAnOrder'])) {
        if ('true' === $_GET['placeAnOrder']) {
            ?>
            <script>
                alert('Не заполнено имя пользователя');
                window.location.href = "/NaturalStone/registration.php?placeAnOrder=true";
            </script> <?php
        } elseif ('false' === $_GET['placeAnOrder']) {
            ?>
            <script>
                alert('Не заполнено имя пользователя');
                window.location.href = "/NaturalStone/registration.php?placeAnOrder=false";
            </script> <?php
        }
    }
} elseif (empty($_POST['secondName'])) {
    if (!empty($_GET['placeAnOrder'])) {
        if ('true' === $_GET['placeAnOrder']) {
            ?>
            <script>
                alert('Не заполнена фамилия пользователя');
                window.location.href = "/NaturalStone/registration.php?placeAnOrder=true";
            </script> <?php
        } elseif ('false' === $_GET['placeAnOrder']) {
            ?>
            <script>
                alert('Не заполнена фамилия пользователя');
                window.location.href = "/NaturalStone/registration.php?placeAnOrder=false";
            </script> <?php
        }
    }
} elseif (empty($_POST['phone'])) {
    if (!empty($_GET['placeAnOrder'])) {
        if ('true' === $_GET['placeAnOrder']) {
            ?>
            <script>
                alert('Не заполнен телефон пользователя');
                window.location.href = "/NaturalStone/registration.php?placeAnOrder=true";
            </script> <?php
        } elseif ('false' === $_GET['placeAnOrder']) {
            ?>
            <script>
                alert('Не заполнен телефон пользователя');
                window.location.href = "/NaturalStone/registration.php?placeAnOrder=false";
            </script> <?php
        }
    }
} elseif (empty($_POST['userName'])) {
    if (!empty($_GET['placeAnOrder'])) {
        if ('true' === $_GET['placeAnOrder']) {
            ?>
            <script>
                alert('Не заполнен логин');
                window.location.href = "/NaturalStone/registration.php?placeAnOrder=true";
            </script> <?php
        } elseif ('false' === $_GET['placeAnOrder']) {
            ?>
            <script>
                alert('Не заполнен логин');
                window.location.href = "/NaturalStone/registration.php?placeAnOrder=false";
            </script> <?php
        }
    }
} elseif (empty($_POST['password'])) {
    if (!empty($_GET['placeAnOrder'])) {
        if ('true' === $_GET['placeAnOrder']) {
            ?>
            <script>
                alert('Не заполнен пароль');
                window.location.href = "/NaturalStone/registration.php?placeAnOrder=true";
            </script> <?php
        } elseif ('false' === $_GET['placeAnOrder']) {
            ?>
            <script>
                alert('Не заполнен пароль');
                window.location.href = "/NaturalStone/registration.php?placeAnOrder=false";
            </script> <?php
        }
    }
} elseif (empty($_POST['passwordRepeat'])) {
    if (!empty($_GET['placeAnOrder'])) {
        if ('true' === $_GET['placeAnOrder']) {
            ?>
            <script>
                alert('Не заполнен пароль повторно');
                window.location.href = "/NaturalStone/registration.php?placeAnOrder=true";
            </script> <?php
        } elseif ('false' === $_GET['placeAnOrder']) {
            ?>
            <script>
                alert('Не заполнен пароль повторно');
                window.location.href = "/NaturalStone/registration.php?placeAnOrder=false";
            </script> <?php
        }
    }
} elseif ($_POST['password'] != $_POST['passwordRepeat']) {
    if (!empty($_GET['placeAnOrder'])) {
        if ('true' === $_GET['placeAnOrder']) {
            ?>
            <script>
                alert('Пароли не совпадают');
                window.location.href = "/NaturalStone/registration.php?placeAnOrder=true";
            </script> <?php
        } elseif ('false' === $_GET['placeAnOrder']) {
            ?>
            <script>
                alert('Пароли не совпадают');
                window.location.href = "/NaturalStone/registration.php?placeAnOrder=false";
            </script> <?php
        }
    }
} elseif (true == User::checkUserName($_POST['userName'])) {
    if (!empty($_GET['placeAnOrder'])) {
        if ('true' === $_GET['placeAnOrder']) {
            ?>
            <script>
                alert('Пользователь с таким логином уже зарегестрирован');
                window.location.href = "/NaturalStone/registration.php?placeAnOrder=true";
            </script> <?php
        } elseif ('false' === $_GET['placeAnOrder']) {
            ?>
            <script>
                alert('Пользователь с таким логином уже зарегестрирован');
                window.location.href = "/NaturalStone/registration.php?placeAnOrder=false";
            </script> <?php
        }
    }
} elseif (true == User::checkPhone($_POST['phone'])) {
    if (!empty($_GET['placeAnOrder'])) {
        if ('true' === $_GET['placeAnOrder']) {
            ?>
            <script>
                alert('Пользователь с таким телефоном уже зарегестрирован');
                window.location.href = "/NaturalStone/registration.php?placeAnOrder=true";
            </script> <?php
        } elseif ('false' === $_GET['placeAnOrder']) {
            ?>
            <script>
                alert('Пользователь с таким телефоном уже зарегестрирован');
                window.location.href = "/NaturalStone/registration.php?placeAnOrder=false";
            </script> <?php
        }
    }
} else {
    $passwordHash = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $user = new User('', $_POST['userName'], $passwordHash, $_POST['firstName'], $_POST['secondName'], $_POST['patronymic'], $_POST['email'], $_POST['phone']);
    if (true == $user->insert()) {
        $_SESSION['userName'] = $_POST['userName'];
        if (!empty($_GET['placeAnOrder'])) {
            if ('true' === $_GET['placeAnOrder']) {
                ?>
                <script>
                    alert('Вы успешно зарегестрировались!');
                    window.location.href = "/NaturalStone/makeAnOrder.php"; //пользователь успаешно вошел, до этого хотел оформить заказ
                </script> <?php
            } elseif ('false' === $_GET['placeAnOrder']) {
                ?>
                <script>
                    alert('Вы успешно зарегестрировались!');
                    window.location.href = "/NaturalStone/index.php";
                </script> <?php
            }
        }
    } else {
        if (!empty($_GET['placeAnOrder'])) {
            if ('true' === $_GET['placeAnOrder']) {
                ?>
                <script>
                    alert('При регистрации произошла ошибка!');
                    window.location.href = "/NaturalStone/registration.php?placeAnOrder=true";
                </script> <?php
            } elseif ('false' === $_GET['placeAnOrder']) {
                ?>
                <script>
                    alert('При регистрации произошла ошибка!');
                    window.location.href = "/NaturalStone/registration.php?placeAnOrder=false";
                </script> <?php
            }
        }
    }
}