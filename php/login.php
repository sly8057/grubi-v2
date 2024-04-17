<?php
    include "../connection.php";

    $correo = $_POST['user-mail'];
    $contra = $_POST['user-psw'];

    $usr = mysqli_query($con,"SELECT * FROM clientes WHERE correo = '$correo' AND contra = '$contra'");
    $adm = mysqli_query($con,"SELECT * FROM propietarios WHERE correo = '$correo' AND contra = '$contra'");

	$nrUsr = mysqli_num_rows($usr);
	$nrAdm = mysqli_num_rows($adm);

	// $name = mysqli_result_fetch;

    if($nrUsr == 1) {
        // echo " -> usuario ingresado -> Bienvenid@: " .$name;
        header("Location: products.php");
        exit;
    } else if($nrAdm == 1) {
        header("Location: admin.php");
        exit;
    } else if($nrUsr == 0 || $nrAdm == 0) {
        echo " -> error al ingresar";
    }
?>