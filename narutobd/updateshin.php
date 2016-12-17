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
            <li><a href="shinobi.php">Джинчуурики</a></li>
            <li><a href="bidju.php">Биджу</a></li>
            <li><a href="villages.php">Деревни</a></li>
            <li><a href="kage.php">Каге</a></li>
        </ul>
    </menu>
    <main>
    <?php
    require_once 'connection.php'; // подключаем скрипт
    // подключаемся к серверу
    $link = mysqli_connect($host, $user, $password, $database)
    or die("Ошибка " . mysqli_error($link));
    $link->query( "SET CHARSET utf8" );

    // если запрос POST
    if(isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['id'])
        && isset($_POST['idvillage'])&& isset($_POST['idbidju'])&& isset($_POST['description'])){


        // экранирования символов для mysql
        $id = htmlentities(mysqli_real_escape_string($link, $_POST['id']));
        $name = htmlentities(mysqli_real_escape_string($link, $_POST['name']));
        $surname = htmlentities(mysqli_real_escape_string($link, $_POST['surname']));
        $idvillage = htmlentities(mysqli_real_escape_string($link, $_POST['idvillage']));
        $idbidju = htmlentities(mysqli_real_escape_string($link, $_POST['idbidju']));
        $description = htmlentities(mysqli_real_escape_string($link, $_POST['description']));

        $query ="UPDATE shinobi SET NAME='$name', SURNAME='$surname', VILLAGE=$idvillage, BIDJU=$idbidju, DESCRIPTION='$description'
                  WHERE ID=$id";
        $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));

        if($result)
            echo "<span style='color:blue;'>Данные обновлены</span>";
    }

    // если запрос GET
    if(isset($_GET['id']))
    {
        $id = htmlentities(mysqli_real_escape_string($link, $_GET['id']));

        // создание строки запроса
        $query ="SELECT * FROM shinobi WHERE id = '$id'";
        // выполняем запрос
        $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
        //если в запросе более нуля строк
        if($result && mysqli_num_rows($result)>0)
        {
            $row = mysqli_fetch_row($result); // получаем первую строку
            $name = $row[1];
            $surname = $row[2];
            $idvillage = $row[3];
            $idbidju = $row[4];
            $description = $row[5];

            echo "<h2>Изменить джинчуурики</h2>
                <form method='POST'>
                <input type='hidden' name='id' value='$id' />
                <p>Имя:<br>
                <input type='text' name='name' value='$name' /></p>
                <p>Фамилия: <br>
                <input type='text' name='surname' value='$surname' /></p>
                <p>Деревня: <br>
                <input type='number' name='idvillage' value=$idvillage /></p>
                <p>Биджу: <br>
                <input type='number' name='idbidju' value=$idbidju /></p>
                <p>Описание: <br>
                <textarea name='description'>$description</textarea>
                <input type='submit' value='Сохранить'>
                </form>";

            mysqli_free_result($result);
        }
    }
    // закрываем подключение
    mysqli_close($link);
    ?>
        </main>
    </div>

</body>
</html>