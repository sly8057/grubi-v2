<?php
	include "../connection.php";
	session_start();

	if($_SERVER["REQUEST_METHOD"] == "POST") {
		$sku = $_POST['sku'];
		$categoria = $_POST['categoria'];
		$caracteristicas = $_POST['caracteristicas'];
		$precio = $_POST['precio'];
		$unidades = $_POST['unidades'];
		$modelo = $_POST['modelo'];
		$imagen = $_POST['imagen'];

		$orig = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM macetas WHERE sku = '$sku'"));
		// $orig = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM macetas WHERE sku = '$sku'"));

		$changes = 0;

		if($categoria != $orig['categoria']) {
			$changes++;
		}

		if($modelo != $orig['modelo']) {
			$changes++;
		}

		if($caracteristicas != $orig['caracteristicas']) {
			$changes++;
		}

		if($precio != $orig['precio']) {
			$changes++;
		}

		if($unidades != $orig['unidades']) {
			$changes++;
		}

		if($imagen != $orig['imagen']) {
			$changes++;
		}

		if($changes > 1) {
			echo "Advertencia: Solo se puede modificar un campo a la vez.";
		} else {
			$sql = mysqli_query($con, "UPDATE macetas SET categoria = '$categoria', modelo = '$modelo', caracteristicas = '$caracteristicas', precio = '$precio', unidades = '$unidades', imagen = '$imagen' WHERE sku = '$sku'");

			if($sql) {
				header("Location: admin.php");
			} else {
				echo "No se ha seleccionado un producto";
			}
		}
	}
?>