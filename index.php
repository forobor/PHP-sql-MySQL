<?php
session_start();
$_SESSION['name']='user';
?>
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
            <a href="index.php"><img class="header" src="images/header.jpg" alt="альтернативный текст"></a>
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
            <h1 class="zag">
                <p class="hellotext">Добро пожаловать на сайт!<br>
                Здесь вы можете найти интересную информацию по манге "Наруто"</p>
            </h1>
        </main>
        <footer>
            some text
        </footer>
    </div>

</body>
</html>