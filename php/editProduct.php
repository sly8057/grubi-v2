<?php
	include "../connection.php";
	session_start();

	$sku = $_POST['sku'];
	$categoria = $_POST['categoria'];
	$caracteristicas = $_POST['caracteristicas'];
	$precio = $_POST['precio'];
	$unidades = $_POST['unidades'];
	$modelo = $_POST['modelo'];
	$imagen = $_POST['imagen'];

	$sql = mysqli_query($con, "SELECT * FROM macetas WHERE sku = '$sku'");

	if($sql && mysqli_num_rows($sql) > 0) {
		$orig = mysqli_fetch_array($sql);

		if($categoria == '') {
			$categoria = $orig['categoria'];
		}

		if($caracteristicas == '') {
			$caracteristicas = $orig['caracteristicas'];
		}

		if($precio == '') {
			$precio = $orig['precio'];
		}

		if($unidades == '') {
			$unidades = $orig['unidades'];
		}

		if($modelo == '') {
			$modelo = $orig['modelo'];
		}

		if($imagen == '') {
			$imagen = $orig['imagen'];
		}

		$sql = mysqli_query($con, "UPDATE macetas SET categoria = '$categoria', modelo = '$modelo', caracteristicas = '$caracteristicas', precio = '$precio', unidades = '$unidades', imagen = '$imagen' WHERE sku = '$sku'");

		if($sql) {
			header("refresh:1; url=admin.php");
		} else {
			echo "No se ha seleccionado un producto para modificar";
		}
	}
?>