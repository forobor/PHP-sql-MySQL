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
            && isset($_POST['idvillage'])&& isset($_POST['number'])
            && isset($_POST['rank'])&& isset($_POST['description'])){


            // экранирования символов для mysql
            $id = htmlentities(mysqli_real_escape_string($link, $_POST['id']));
            $name = htmlentities(mysqli_real_escape_string($link, $_POST['name']));
            $surname = htmlentities(mysqli_real_escape_string($link, $_POST['surname']));
            $idvillage = htmlentities(mysqli_real_escape_string($link, $_POST['idvillage']));
            $number = htmlentities(mysqli_real_escape_string($link, $_POST['number']));
            if($number==''){
                $number='NULL';
            }
            $rank = htmlentities(mysqli_real_escape_string($link, $_POST['rank']));
            $description = htmlentities(mysqli_real_escape_string($link, $_POST['description']));

            $query ="UPDATE kage SET NAME='$name', SURNAME='$surname', NUMBER=$number, RANK='$rank', VILLAGE=$idvillage, DESCRIPTION='$description'
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
            $query ="SELECT * FROM kage WHERE id = '$id'";
            // выполняем запрос
            $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
            //если в запросе более нуля строк
            if($result && mysqli_num_rows($result)>0)
            {
                $row = mysqli_fetch_row($result); // получаем первую строку
                $name = $row[1];
                $surname = $row[2];
                $number =$row[3];
                $rank =$row[4];
                $idvillage = $row[5];
                $description = $row[6];

                echo "<h2>Изменить каге</h2>
                <p>Для пустого значения впишите NULL в поле</p>
                <form method='POST'>
                <input type='hidden' name='id' value='$id' />
                <p>Имя:<br>
                <input type='text' name='name' value='$name' /></p>
                <p>Фамилия: <br>
                <input type='text' name='surname' value='$surname' /></p>
                <p>Номер: <br>
                <input type='number' name='number' value='$number' /></p>
                <p>Ранг: <br>
                <input type='text' name='rank' value='$rank' /></p>
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