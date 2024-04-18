<?php
    include "../connection.php";

    $name = $_POST['user-name'];
    $surname = $_POST['user-surname'];
    $mail = $_POST['user-mail'];
    $pass = $_POST['user-psw'];

    $sql = mysqli_query($con,"INSERT INTO clientes(id_cliente, nombre, apellido, correo, contra) VALUES(0, '$name', '$surname', '$mail', '$pass')");

    if($sql) {
        echo " -> usuario registrado";
        header("Location: ../index.php");
        exit;
    } else {
        echo " -> error al registrar";
    }
?>