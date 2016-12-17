<?php
if(isset($_GET['login']) and isset($_GET['pass'])) {
    $login = $_GET['login'];
    $pass = $_GET['pass'];
    if ($login=="admin") {
        if ($pass == "123") {
            echo 'Правильно';
        } else {
            echo 'неправильно';
        }
    }else{
        echo "неправ";
    }
}
?>