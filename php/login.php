<?php
    include "../connection.php";

    session_start();

    $correo = $_POST['user-mail'];
    $contra = $_POST['user-psw'];

    $usr = mysqli_query($con,"SELECT * FROM clientes WHERE correo = '$correo' AND contra = '$contra'");
    $adm = mysqli_query($con,"SELECT * FROM propietarios WHERE correo = '$correo' AND contra = '$contra'");

	$nrUsr = mysqli_num_rows($usr);
	$nrAdm = mysqli_num_rows($adm);

	// $name = mysqli_result_fetch;


    if($nrUsr == 1) {
        // echo " -> usuario ingresado -> Bienvenid@: " .$name;
        $rUsr = mysqli_fetch_array($usr);
        $nombre = $rUsr['nombre'];
        $_SESSION['id_cliente'] = $rUsr['id_cliente'];
        $msg = "Sesion iniciada con el correo: ".$correo;
            header("refresh:1; url=products.php");
            echo '<div>'.$msg.'</div>';
            echo '<p>Serás redirigido a la página de productos en 5 segundos.</p>';
            // header("Location: products.php");
            exit;
    } else if($nrAdm == 1) {
        $rAdm = mysqli_fetch_array($adm);
        $nombre = $rAdm['nombre'];
        $_SESSION['id_owner'] = $rAdm['id_owner'];
        header("refresh:1; url=admin.php");
        exit;
    } else if($nrUsr == 0 || $nrAdm == 0) {
        session_destroy();
        header("refresh:1; url=../html/login.html");
        echo '<div> error al ingresar </div>';
    }
?>