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

        if(isset($_POST['name']) && isset($_POST['surname'])
            && isset($_POST['number']) && isset($_POST['rank'])
            && isset($_POST['idvillage']) && isset($_POST['description'])){

            // подключаемся к серверу
            $link = mysqli_connect($host, $user, $password, $database)
            or die("Ошибка " . mysqli_error($link));
            $link->query( "SET CHARSET utf8" );
            // экранирования символов для mysql
            $name = htmlentities(mysqli_real_escape_string($link, $_POST['name']));
            $surname = htmlentities(mysqli_real_escape_string($link, $_POST['surname']));
            $number = htmlentities(mysqli_real_escape_string($link, $_POST['number']));
            $rank = htmlentities(mysqli_real_escape_string($link, $_POST['rank']));
            $idvillage = htmlentities(mysqli_real_escape_string($link, $_POST['idvillage']));
            $description = htmlentities(mysqli_real_escape_string($link, $_POST['description']));

            // создание строки запроса
            $query ="INSERT INTO kage
                            VALUES(NULL,'$name','$surname',$number,'$rank',$idvillage,'$description')";

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
            <p>Имя:<br>
                <input type="text" name="name" value="NULL"></p>
            <p>Фамилия: <br>
                <input type="text" name="surname" value="NULL"></p>
            <p>Номер: <br>
                <input type="number" name="number" min="0"></p>
            <p>Ранг: <br>
                <input type="text" name="rank" value="NULL"></p>
            <p>Деревня: <br><?php
                require_once 'connection.php';
                $link = mysqli_connect($host, $user, $password, $database)
                or die("Error " . mysqli_error($link));
                $link->query( "SET CHARSET utf8" );
                $query ="SELECT ID,NAME FROM  village";
                $result=mysqli_query($link,$query) or die("Error " . mysqli_error($link));
                if($result){
                    while($row=mysqli_fetch_assoc($result)) {
                        $idv=$row['ID'];
                        echo "<input type='radio' name='idvillage' value='$idv'>".$row['NAME'] . " ";
                    }
                }
                mysqli_close($link);
                ?>
                <input type='radio' name='idvillage' value="NULL">NULL</p>
            <p>Описание: <br>
                <textarea name="description" cols="40" rows="3">NULL</textarea></p>
            <input type="submit" value="Добавить"><input type="reset" value="Очистить"></p>
        </form>
    </main>
</div>

</body>
</html>