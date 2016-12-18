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
        // подключаемся к серверу
        $link = mysqli_connect($host, $user, $password, $database)
        or die("Ошибка " . mysqli_error($link));
        $link->query( "SET CHARSET utf8" );

        // если запрос POST
        if(isset($_POST['name']) && isset($_POST['numtails']) && isset($_POST['id'])
            && isset($_POST['idshinobi']) && isset($_POST['description'])){


            // экранирования символов для mysql
            $id = htmlentities(mysqli_real_escape_string($link, $_POST['id']));
            $name = htmlentities(mysqli_real_escape_string($link, $_POST['name']));
            $numtails = htmlentities(mysqli_real_escape_string($link, $_POST['numtails']));
            if ($numtails==''){
                $numtails='NULL';
            }
            $idshinobi = htmlentities(mysqli_real_escape_string($link, $_POST['idshinobi']));
            $description = htmlentities(mysqli_real_escape_string($link, $_POST['description']));

            $query ="UPDATE bidju SET NAME='$name', NUM_TAILS=$numtails, SHINOBI=$idshinobi, DESCRIPTION='$description'
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
            $query ="SELECT * FROM bidju WHERE id = '$id'";
            // выполняем запрос
            $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
            //если в запросе более нуля строк
            if($result && mysqli_num_rows($result)>0)
            {
                $row = mysqli_fetch_row($result); // получаем первую строку
                $name = $row[1];
                $numtails = $row[2];
                $idshinobi = $row[3];
                $description = $row[4];

                echo "<h2>Изменить биджу</h2>
                <form method='POST'>
                <input type='hidden' name='id' value='$id' />
                <p>Имя:<br>
                <input type='text' name='name' value='$name' /></p>
                <p>Количество хвостов: <br>
                <input type='text' name='numtails' value=$numtails /></p>
                <p>Джинчурики: <br>";
                $query ="SELECT ID,NAME FROM shinobi";
                $result=mysqli_query($link,$query) or die("Error " . mysqli_error($link));
                if($result){
                    while($row=mysqli_fetch_assoc($result)) {
                        $ids = $row['ID'];
                        if ($ids == $idshinobi) {
                            echo "<input type='radio' name='idshinobi' checked value='$ids'>" . $row['NAME'] . " ";
                        } else {
                            echo "<input type='radio' name='idshinobi' value='$ids'>" . $row['NAME'] . " ";
                        }
                    }
                }
                if ($idshinobi==''){
                    echo "<input type='radio' name='idshinobi' checked value='NULL'>NULL</p>";
                }else{
                    echo "<input type='radio' name='idshinobi' value='NULL'>NULL</p>";
                }

                echo "
                <p>Описание: <br>
                <textarea name='description' cols=\"40\" rows=\"3\">$description</textarea><br>
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