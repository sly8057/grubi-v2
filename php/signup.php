<?php
    include "../connection.php";

    $name = $_POST['user-name'];
    $surname = $_POST['user-surname'];
    $mail = $_POST['user-mail'];
    $pass = $_POST['user-psw'];

    $sql = mysqli_query($con,"INSERT INTO users(id, name, surname, mail, pass) VALUES(0, '$name', '$surname', '$mail', '$pass')");

    if($sql) {
        echo " -> usuario registrado";
        header("Location: ../index.html");
        exit;
    } else {
        echo " -> error al registrar";
    }
?>