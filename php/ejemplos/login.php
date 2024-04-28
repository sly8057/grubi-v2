<?php
    include "../../connection.php";
	session_start();

    $correo = $_POST['user-mail'];
    $contra = $_POST['user-psw'];

    $usr = mysqli_query($con,"SELECT * FROM clientes WHERE correo = '$correo' AND contra = '$contra'");

	$nrUsr = mysqli_num_rows($usr);

	// $name = mysqli_result_fetch;


    if($nrUsr == 1) {
        // echo " -> usuario ingresado -> Bienvenid@: " .$name;
        $rUsr = mysqli_fetch_array($usr);
        $nombre = $rUsr['nombre'];
		$_SESSION['id_cliente'] = $rUsr['id_cliente'];
        $msg = "Sesion iniciada con el correo: ".$correo;

        header("Location: ejemplo2.php");
        exit;
    } else {
        echo " -> error al ingresar";
    }
?>