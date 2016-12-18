<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <title></title>
</head>
<body>
<form class="enter" method="get" action="enter.php">
    Вход для админа:
    <label>Логин: <input name="login"></label>
    <label>Пароль: <input type="password" name="pass"></label>
    <input type="submit">
</form>
<form class="enter" method="get" action="index.php">
    <input type="submit" name ='destroy' value="Выйти">
</form>

<div id="wrapper">
    <header>
        <img class="header" src="images/header.jpg" alt="альтернативный текст">
    </header>

    <menu>
        <ul>
            <li><a href="shinobi.php">Джинчуурики</a> </li><li>|</li>
            <li><a href="bidju.php">Биджу</a> </li><li>|</li>
            <li><a href="villages.php">Деревни</a> </li><li>|</li>
            <li><a href="kage.php">Каге</a> </li>
        </ul>
    </menu>
    <main>
<?php
if(isset($_GET['login']) and isset($_GET['pass'])) {
    $login = $_GET['login'];
    $pass = $_GET['pass'];
    if ($login=='admin' && $pass=='123') {
            echo 'Правильно, <br>';
            session_start();
        $_SESSION['name'] = 'admin';
        echo "Добро пожаловать, " . $_SESSION['name'];
        } else {
            echo 'Неверный логин или пароль';
        }
}
?>
        </main>
    <footer>
        some text
    </footer>
    </div>

</body>
</html>

