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
        <?php
        session_start();
        if($_SESSION['name']=='admin') {
            echo "<form method = 'get' action = 'insertkage.php' >
            <input style = 'float:left' type = 'submit' name = 'insertkage' value = 'Вставить' >
        </form >";
        }
        ?>

        <form action="kage.php" method="get">
            <?php
            require_once 'connection.php';
            $link = mysqli_connect($host, $user, $password, $database)
            or die("Error " . mysqli_error($link));
            $link->query( "SET CHARSET utf8" );
            $query ="SELECT ID, NAME FROM kage";
            $result=mysqli_query($link,$query) or die("Error " . mysqli_error($link));
            if($result){
                while($row=mysqli_fetch_assoc($result)) {
                    $id=$row['ID'];
                    echo "<input type='radio' name='name' value='$id'>".$row['NAME'] . " ";
                }

            }
            mysqli_close($link);
            ?>
            <input type="submit" value="Получить"><br/><br/>
        </form>
        <?php
        if(isset($_GET['name'])) {
            $id = $_GET['name'];


            require_once 'connection.php'; // подключаем скрипт

// подключаемся к серверу
            $link = mysqli_connect($host, $user, $password, $database)
            or die("Error " . mysqli_error($link));


            $link->query("SET CHARSET utf8");

// выполняем операции с базой данных
            $query = "select kage.NAME, kage.NUMBER, RANK, village.SECOND_NAME, kage.DESCRIPTION
from kage, village
where kage.ID=$id and kage.VILLAGE=village.ID
union
select kage.NAME, kage.NUMBER, RANK, 'NULL', kage.DESCRIPTION
from kage, village
where kage.ID=$id and kage.VILLAGE IS NULL";
            $result = mysqli_query($link, $query) or die("Error " . mysqli_error($link));

            if ($result) {
                if($_SESSION['name']=='admin') {
                    echo "<div class='edit'>
                     <form method='get' action='updatekage.php'>
                        <input type='hidden' name='id' value='$id'>
                        <input type='submit' name='updatekage' value='Обновить'>
                     </form>
                     <form method='get' action='delete.php'>
                        <input type='hidden' name='id' value='$id'>
                        <input type='hidden' name='bd' value='kage'>
                        <input type='submit' name='delete' value='Удалить'>
                     </form>
                 </div><br>";
                }
                while ($row = $result->fetch_assoc()) {
                    // Оператором echo выводим на экран поля таблицы name_blog и text_blog
                    $image=$row['NAME'];
                    echo "<div class='imgblock'><img class='getimg' src='images/$image.jpg'></div>";
                    echo "Имя Каге: ".$row['NAME'] . " "."<br><br>";
                    echo "Звание: ".$row['NUMBER']."-й ".$row['RANK'] . " <br/><br/>";
                    echo "Деревня: ".$row['SECOND_NAME'] . "<br/><br/>";
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
