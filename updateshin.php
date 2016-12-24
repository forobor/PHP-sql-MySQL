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
    if(isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['id'])
        && isset($_POST['idvillage'])&& isset($_POST['idbidju'])&& isset($_POST['description'])){


        // экранирования символов для mysql
        $id = htmlentities(mysqli_real_escape_string($link, $_POST['id']));
        $name = htmlentities(mysqli_real_escape_string($link, $_POST['name']));
        $surname = htmlentities(mysqli_real_escape_string($link, $_POST['surname']));
        $idvillage = htmlentities(mysqli_real_escape_string($link, $_POST['idvillage']));
        if ($idvillage==''){
            $idvillage='NULL';
        }
        $idbidju = htmlentities(mysqli_real_escape_string($link, $_POST['idbidju']));
        if($idbidju==''){
            $idbidju='NULL';
        }
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
                <p>Для пустого значения впишите NULL в поле</p>
                <form method='POST'>
                <input type='hidden' name='id' value='$id' />
                <p>Имя:<br>
                <input type='text' name='name' value='$name' /></p>
                <p>Фамилия: <br>
                <input type='text' name='surname' value='$surname' /></p>
                <p>Деревня: <br>";
                $query ="SELECT ID,NAME FROM village";
                $result=mysqli_query($link,$query) or die("Error " . mysqli_error($link));
                if($result){
                    while($row=mysqli_fetch_assoc($result)) {
                        $idv = $row['ID'];
                        if ($idv == $idvillage) {
                            echo "<input type='radio' name='idvillage' checked value='$idv'>" . $row['NAME'] . " ";
                        } else {
                            echo "<input type='radio' name='idvillage' value='$idv'>" . $row['NAME'] . " ";
                        }
                    }
                }
                if ($idvillage==''){
                    echo "<input type='radio' name='idvillage' checked value='NULL'>NULL</p>";
                }else{
                    echo "<input type='radio' name='idvillage' value='NULL'>NULL</p>";
                }

               echo"
                <p>Биджу: <br>";
                $query ="SELECT ID,NAME FROM bidju";
                $result=mysqli_query($link,$query) or die("Error " . mysqli_error($link));
                if($result){
                    while($row=mysqli_fetch_assoc($result)) {
                        $idb = $row['ID'];
                        if ($idb == $idbidju) {
                            echo "<input type='radio' name='idbidju' checked value='$idb'>" . $row['NAME'] . " ";
                        } else {
                            echo "<input type='radio' name='idbidju' value='$idb'>" . $row['NAME'] . " ";
                        }
                    }
                }
                if ($idbidju==''){
                    echo "<input type='radio' name='idbidju' checked value='NULL'>NULL</p>";
                }else{
                    echo "<input type='radio' name='idbidju' value='NULL'>NULL</p>";
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