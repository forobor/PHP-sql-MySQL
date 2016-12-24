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
        // подключаемся к серверу
        $link = mysqli_connect($host, $user, $password, $database)
        or die("Ошибка " . mysqli_error($link));
        $link->query( "SET CHARSET utf8" );

        // если запрос POST
        if(isset($_POST['name']) && isset($_POST['secname']) && isset($_POST['id'])
            && isset($_POST['idkage']) && isset($_POST['description'])){


            // экранирования символов для mysql
            $id = htmlentities(mysqli_real_escape_string($link, $_POST['id']));
            $name = htmlentities(mysqli_real_escape_string($link, $_POST['name']));
            $secname = htmlentities(mysqli_real_escape_string($link, $_POST['secname']));
            $idkage = htmlentities(mysqli_real_escape_string($link, $_POST['idkage']));
            $description = htmlentities(mysqli_real_escape_string($link, $_POST['description']));

            $query ="UPDATE village SET NAME='$name', SECOND_NAME='$secname', KAGE=$idkage, DESCRIPTION='$description'
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
            $query ="SELECT * FROM village WHERE id = '$id'";
            // выполняем запрос
            $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
            //если в запросе более нуля строк
            if($result && mysqli_num_rows($result)>0)
            {
                $row = mysqli_fetch_row($result); // получаем первую строку
                $name = $row[1];
                $secname = $row[2];
                $idkage = $row[3];
                $description = $row[4];

                echo "<h2>Изменить деревню</h2>
                <form method='POST'>
                <input type='hidden' name='id' value='$id' />
                <p>Название:<br>
                <input type='text' name='name' value='$name' /></p>
                <p>Второе имя: <br>
                <input type='text' name='secname' value='$secname'></p>
                <p>Каге: <br>";
                $query ="SELECT ID,NAME FROM kage";
                $result=mysqli_query($link,$query) or die("Error " . mysqli_error($link));
                if($result){
                    while($row=mysqli_fetch_assoc($result)) {
                        $idk = $row['ID'];
                        if ($idk == $idkage) {
                            echo "<input type='radio' name='idkage' checked value='$idk'>" . $row['NAME'] . " ";
                        } else {
                            echo "<input type='radio' name='idkage' value='$idk'>" . $row['NAME'] . " ";
                        }
                    }
                }
                if ($idkage==''){
                    echo "<input type='radio' name='idkage' checked value='NULL'>NULL</p>";
                }else{
                    echo "<input type='radio' name='idkage' value='NULL'>NULL</p>";
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