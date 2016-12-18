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

        if(isset($_POST['name']) && isset($_POST['numtails'])
            && isset($_POST['idshinobi']) && isset($_POST['description'])){

            // подключаемся к серверу
            $link = mysqli_connect($host, $user, $password, $database)
            or die("Ошибка " . mysqli_error($link));
            $link->query( "SET CHARSET utf8" );
            // экранирования символов для mysql
            $name = htmlentities(mysqli_real_escape_string($link, $_POST['name']));
            $numtails = htmlentities(mysqli_real_escape_string($link, $_POST['numtails']));
            if($numtails==''){
                $numtails='NULL';
            }
            $idshinobi = htmlentities(mysqli_real_escape_string($link, $_POST['idshinobi']));
            $description = htmlentities(mysqli_real_escape_string($link, $_POST['description']));

            // создание строки запроса
            $query ="INSERT INTO naruto.bidju
                            VALUES(NULL,'$name',$numtails,$idshinobi,'$description')";

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
        <h2>Добавить нового биджу</h2>
        <form method="POST">
            <p>Имя:<br>
                <input type="text" name="name" value="NULL"></p>
            <p>Количество хвостов: <br>
                <input type="number" name="numtails" max="10" min="0" value="NULL">
            </p>
            <p>Джинчуурики: <br>
                <?php
                require_once 'connection.php';
                $link = mysqli_connect($host, $user, $password, $database)
                or die("Error " . mysqli_error($link));
                $link->query( "SET CHARSET utf8" );
                $query ="SELECT ID,NAME FROM shinobi";
                $result=mysqli_query($link,$query) or die("Error " . mysqli_error($link));
                if($result){
                    while($row=mysqli_fetch_assoc($result)) {
                        $ids=$row['ID'];
                        echo "<input type='radio' name='idshinobi' value='$ids'>".$row['NAME'] . " ";
                    }

                }
                mysqli_close($link);
                ?>
                <input type='radio' name='idshinobi' value="NULL">NULL</p>
            <p>Описание: <br>
                <textarea name="description" cols="40" rows="3">NULL</textarea></p>
            <input type="submit" value="Добавить"><input type="reset" value="Очистить"></p>
        </form>
    </main>
</div>

</body>
</html>