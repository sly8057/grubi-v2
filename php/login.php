<?php
    include "../connection.php";

    $mail = $_POST['user-mail'];
    $pass = $_POST['user-psw'];

    $sql = mysqli_query($con,"SELECT * FROM users WHERE mail = '$mail' AND pass = '$pass'");

	$nr = mysqli_num_rows($sql);

	// $name = mysqli_result_fetch;

    if($nr == 1) {
        // echo " -> usuario ingresado -> Bienvenid@: " .$name;
        header("Location: ../index.html");
        exit;
    } else if($nr == 0) {
        echo " -> error al ingresar";
    }
?>