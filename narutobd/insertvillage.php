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

        if(isset($_POST['name']) && isset($_POST['second_name'])
            && isset($_POST['idkage']) && isset($_POST['description'])){

            // подключаемся к серверу
            $link = mysqli_connect($host, $user, $password, $database)
            or die("Ошибка " . mysqli_error($link));
            $link->query( "SET CHARSET utf8" );
            // экранирования символов для mysql
            $name = htmlentities(mysqli_real_escape_string($link, $_POST['name']));
            $second_name = htmlentities(mysqli_real_escape_string($link, $_POST['second_name']));
            $idkage = htmlentities(mysqli_real_escape_string($link, $_POST['idkage']));
            $description = htmlentities(mysqli_real_escape_string($link, $_POST['description']));

            // создание строки запроса
            $query ="INSERT INTO village
                            VALUES(NULL,'$name','$second_name',$idkage,'$description')";

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
        <h2>Добавить новую деревню</h2>
        <form method="POST">
            <p>Название:<br>
                <input type="text" name="name" value="NULL"></p>
            <p>Второе название: <br>
                <input type="text" name="second_name" value="NULL"></p>
            <p>Каге: <br><?php
                require_once 'connection.php';
                $link = mysqli_connect($host, $user, $password, $database)
                or die("Error " . mysqli_error($link));
                $link->query( "SET CHARSET utf8" );
                $query ="SELECT ID,NAME FROM kage";
                $result=mysqli_query($link,$query) or die("Error " . mysqli_error($link));
                if($result){
                    while($row=mysqli_fetch_assoc($result)) {
                        $idk=$row['ID'];
                        echo "<input type='radio' name='idkage' value='$idk'>".$row['NAME'] . " ";
                    }
                }
                mysqli_close($link);
                ?>
                <input type='radio' name='idkage' value="NULL">NULL</p>
            <p>Описание: <br>
                <textarea name="description" cols="40" rows="3">NULL</textarea></p>
            <input type="submit" value="Добавить"><input type="reset" value="Очистить"></p>
        </form>
    </main>
</div>

</body>
</html>