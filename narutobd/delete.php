<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div id="wrapper">
    <header>
        <a href="index.html"><img class="header" src="images/header.jpg" alt="альтернативный текст"></a>
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
require_once 'connection.php'; // подключаем скрипт

if(isset($_POST['id']) and isset($_POST['bd'])){
    $link = mysqli_connect($host, $user, $password, $database)
    or die("Ошибка " . mysqli_error($link));
    $id = mysqli_real_escape_string($link, $_GET['id']);
    $bd = mysqli_real_escape_string($link, $_GET['bd']);

    $query ="DELETE FROM $bd WHERE id = '$id'";
    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));

    if($result)
        echo "<span style='color:blue;'>Данные удалены</span>";

    mysqli_close($link);
    // перенаправление на скрипт index.php
    /*header('Location: index.php');*/
}

if(isset($_GET['id']))
{
    $id = htmlentities($_GET['id']);
    $bd = htmlentities($_GET['bd']);
    echo "<h2>Удалить данные?</h2>
        <form method='POST'>
        <input type='hidden' name='id' value='$id' />
        <input type='hidden' name='bd' value='$bd' />
        <input type='submit' value='Удалить'>
        </form>";
}
?>
        </main>
    </div>

</body>
</html>
