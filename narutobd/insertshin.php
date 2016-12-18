<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
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
        require_once 'connection.php'; // подключаем скрипт

        if(isset($_POST['namesh']) && isset($_POST['surname'])
            && isset($_POST['idvillage'])&& isset($_POST['idbidju'])
            && isset($_POST['description'])){

            // подключаемся к серверу
            $link = mysqli_connect($host, $user, $password, $database)
            or die("Ошибка " . mysqli_error($link));
            $link->query( "SET CHARSET utf8" );
            // экранирования символов для mysql
            $namesh = htmlentities(mysqli_real_escape_string($link, $_POST['namesh']));
            $surname = htmlentities(mysqli_real_escape_string($link, $_POST['surname']));
            $idvillage = htmlentities(mysqli_real_escape_string($link, $_POST['idvillage']));
            $idbidju = htmlentities(mysqli_real_escape_string($link, $_POST['idbidju']));
            $description = htmlentities(mysqli_real_escape_string($link, $_POST['description']));

            // создание строки запроса
            $query ="INSERT INTO naruto.shinobi (ID, NAME, SURNAME, VILLAGE, BIDJU, DESCRIPTION )
                            VALUES(NULL,'$namesh','$surname',$idvillage,$idbidju,'$description')";

            // выполняем запрос
            $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
            if($result)
            {
                echo "<span style='color:blue;'>Данные добавлены</span>";
            }
            // закрываем подключение
            mysqli_close($link);
        }
        ?>
<h2>Добавить нового джичуурики</h2>
<form method="POST">
    <p>Имя:<br>
        <input type="text" name="namesh" value="NULL"></p>
    <p>Фамилия: <br>
        <input type="text" name="surname" value="NULL"></p>
    <p>Деревня: <br><?php
        require_once 'connection.php';
        $link = mysqli_connect($host, $user, $password, $database)
        or die("Error " . mysqli_error($link));
        $link->query( "SET CHARSET utf8" );
        $query ="SELECT ID,NAME FROM village";
        $result=mysqli_query($link,$query) or die("Error " . mysqli_error($link));
        if($result){
            while($row=mysqli_fetch_assoc($result)) {
                $idv=$row['ID'];
                echo "<input type='radio' name='idvillage' value='$idv'>".$row['NAME'] . " ";
            }

        }
        mysqli_close($link);
        ?>
        <input type='radio' name='idvillage' value="NULL">NULL
        </p>
    <p>Биджу: <br>
        <?php
        require_once 'connection.php';
        $link = mysqli_connect($host, $user, $password, $database)
        or die("Error " . mysqli_error($link));
        $link->query( "SET CHARSET utf8" );
        $query ="SELECT ID,NAME FROM bidju";
        $result=mysqli_query($link,$query) or die("Error " . mysqli_error($link));
        if($result){
            while($row=mysqli_fetch_assoc($result)) {
                $idb=$row['ID'];
                echo "<input type='radio' name='idbidju' value='$idb'>".$row['NAME'] . " ";
            }

        }
        mysqli_close($link);
        ?>
        <input type='radio' name='idbidju' value="NULL">NULL</p>
    <p>Описание: <br>
        <textarea name="description" cols="40" rows="3">NULL</textarea></p>
    <input type="submit" value="Добавить"><input type="reset" value="Очистить"></p>
</form>
</main>
    </div>

</body>
</html>