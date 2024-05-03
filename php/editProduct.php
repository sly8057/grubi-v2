<?php
	include "../connection.php";
	session_start();

	if($_SERVER["REQUEST_METHOD"] == "POST") {
		$sku = $_POST['sku'];
		$categoria = $_POST['categoria'];
		$modelo = $_POST['modelo'];
		$caracteristicas = $_POST['caracteristicas'];
		$precio = $_POST['precio'];
		$unidades = $_POST['unidades'];
		$imagen = $_POST['imagen'];

		$orig = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM macetas WHERE sku = '$sku'"));

		$changes = 0;

		if($categoria != $orig['categoria'])
			$changes++;

		if($modelo != $orig['modelo'])
			$changes++;

		if($caracteristicas != $orig['caracteristicas'])
			$changes++;

		if($precio != $orig['precio'])
			$changes++;

		if($unidades != $orig['unidades'])
			$changes++;

		if($imagen != $orig['imagen'])
			$changes++;

		if($changes > 1)
			echo "Advertencia: Solo se puede modificar un campo a la vez";
		else {
			$sql = "UPDATE macetas SET categoria = '$categoria', modelo = '$modelo', caracteristicas = '$caracteristicas', precio = '$precio', unidades = '$unidades', imagen = '$imagen' WHERE sku = '$sku'";
			$result = mysqli_query($con, $sql);

			if($sql)
				header(Location: "admin.php");
			else
				echo "No se ha seleccionado un producto";
		}
	}
?>