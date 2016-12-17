<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <title></title>
</head>
<body>
<form class="enter" method="get" action="shinobi.php">
    Вход для админа:
    <label>Логин: <input name="login"></label>
    <label>Пароль: <input type="password" name="pass"></label>
    <input type="submit">
</form>
<div id="wrapper">
    <header>
        <a href="index.html"><img class="header" src="images/header.jpg" alt="альтернативный текст"></a>
    </header>

    <menu>
        <ul>
            <li><a href="shinobi.php">Джинчуурики</a></li>
            <li><a href="bidju.php">Биджу</a></li>
            <li><a href="villages.php">Деревни</a></li>
            <li><a href="kage.php">Каге</a></li>
        </ul>
    </menu>
    <main>
        <form action="shinobi.php" method="get">
        <?php
        require_once 'connection.php';
        $link = mysqli_connect($host, $user, $password, $database)
        or die("Error " . mysqli_error($link));
        $link->query( "SET CHARSET utf8" );
        $query ="SELECT ID, NAME FROM shinobi";
        $result=mysqli_query($link,$query) or die("Error " . mysqli_error($link));
        if($result){
            while($row=mysqli_fetch_assoc($result)) {
                $id=$row['ID'];
                echo "<input type='radio' name='name' value='$id'>".$row['NAME'] . " ";
            }

        }
        mysqli_close($link);

        ?>
            <input type="submit" value="Получить">
        </form>
        <form method='get' action='insertshin.php'>
            <input type='submit' name='insertshin' value='Вставить'>
        </form>
        <br/><br/>

<?php
if(isset($_GET['name'])) {
    $id = $_GET['name'];

    require_once 'connection.php'; // подключаем скрипт

// подключаемся к серверу
    $link = mysqli_connect($host, $user, $password, $database)
    or die("Error " . mysqli_error($link));


    $link->query("SET CHARSET utf8");


// выполняем операции с базой данных
    $query = "SELECT shinobi.NAME, SURNAME, village.NAME AS VILLAGE, bidju.NAME AS BIDJU, shinobi.DESCRIPTION
FROM shinobi, village, bidju
where shinobi.ID = $id and village.ID= shinobi.VILLAGE and bidju.ID=shinobi.BIDJU";
    $result = mysqli_query($link, $query) or die("Error " . mysqli_error($link));

    if ($result) {
        echo "<div class='edit'>
                     <form method='get' action='updateshin.php'>
                        <input type='hidden' name='id' value='$id'>
                        <input type='submit' name='updateshin' value='Обновить'>
                     </form>
                     <form method='get' action='delete.php'>
                        <input type='hidden' name='id' value='$id'>
                        <input type='hidden' name='bd' value='shinobi'>
                        <input type='submit' name='delete' value='Удалить'>
                     </form>
                 </div>";
        while ($row = $result->fetch_assoc()) {
            // Оператором echo выводим на экран поля таблицы name_blog и text_blog
            $image=$row['NAME'];

            echo "<div class='imgblock'><img class=getimg src='images/$image.jpg'></div>";
            echo "Имя Джинчуурики: ".$row['NAME'] . " ";
            echo $row['SURNAME'] . " <br/><br/>";
            echo "Деревня: ".$row['VILLAGE'] . "<br/><br/>";
            echo "Заточенный демон: ".$row['BIDJU']."<br/<br/>";
            echo "<br>";
            echo $row['DESCRIPTION'] . "<br/>";


        }

    }

// закрываем подключение
    mysqli_close($link);
}

?>
    </main>
    <footer>
        some text
    </footer>
</div>
</body>
</html>
