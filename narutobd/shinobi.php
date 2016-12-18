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
            <li><a href="shinobi.php">Джинчуурики</a> </li><li>|</li>
            <li><a href="bidju.php">Биджу</a> </li><li>|</li>
            <li><a href="villages.php">Деревни</a> </li><li>|</li>
            <li><a href="kage.php">Каге</a> </li>
        </ul>
    </menu>
    <main>

        <form method='get' action='insertshin.php'>
            <input style='float:left' type='submit' name='insertshin' value='Вставить'>
        </form>

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
where shinobi.ID = $id and shinobi.VILLAGE= village.ID and shinobi.BIDJU=bidju.ID

union
SELECT shinobi.NAME, SURNAME, 'NULL', bidju.NAME AS BIDJU, shinobi.DESCRIPTION
FROM shinobi, village, bidju
where shinobi.ID = $id and shinobi.VILLAGE is null and shinobi.BIDJU=bidju.ID

UNION
SELECT shinobi.NAME, SURNAME, village.NAME AS VILLAGE, 'NULL', shinobi.DESCRIPTION
FROM shinobi, village, bidju
where shinobi.ID = $id and shinobi.VILLAGE= village.ID and shinobi.BIDJU is NULL

UNION
SELECT shinobi.NAME, SURNAME, 'NULL', 'NULL', shinobi.DESCRIPTION
FROM shinobi, village, bidju
where shinobi.ID = $id and shinobi.VILLAGE is NULL and shinobi.BIDJU is NULL";
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
                 </div><br>";
        while ($row = $result->fetch_assoc()) {

            $image=$row['NAME'];
            echo "<div class='imgblock'><img class=getimg src='images/$image.jpg'></div>";
            echo "Имя Джинчуурики: ".$row['NAME'] . " ";
            echo $row['SURNAME'] . " <br/><br/>";
            if($row['VILLAGE']=='NULL'){
                echo "Деревня: ".'NULL' . "<br/><br/>";
            }else {
                echo "Деревня: " . $row['VILLAGE'] . "<br/><br/>";
            }
            if ($row['BIDJU']=='NULL'){
                echo "Заточенный демон: ".'NULL'."<br/<br/>";
            }else {
                echo "Заточенный демон: " . $row['BIDJU'] . "<br/<br/>";
            }
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
