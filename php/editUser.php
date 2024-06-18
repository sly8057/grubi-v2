<?php
	include "../connection.php";
	session_start();

	$id_cliente = $_POST['id_cliente'];
	$nombre = $_POST['nombre'];
	$apellido = $_POST['apellido'];
	$correo = $_POST['correo'];

	$sql = mysqli_query($con, "SELECT * FROM clientes WHERE id_cliente = '$id_cliente'");

	if($sql && mysqli_num_rows($sql) > 0) {
		$orig = mysqli_fetch_array($sql);

		if($nombre == '') {
			$nombre = $orig['nombre'];
		}

		if($apellido == '') {
			$apellido = $orig['apellido'];
		}

		if($correo == '') {
			$correo = $orig['correo'];
		}

		$sql = mysqli_query($con, "UPDATE clientes SET nombre = '$nombre', apellido = '$apellido', correo = '$correo' WHERE id_cliente = '$id_cliente'");

		if($sql) {
			header("refresh:1; url=admin.php");
		} else {
			echo "No se ha seleccionado un producto para modificar";
		}
	}
?>