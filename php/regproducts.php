<?php
    include "../connection.php";

	$sku = $_POST['sku'];
	$categoria = $_POST['categoria'];
	$modelo = $_POST['modelo'];
	$caracteristicas = $_POST['caracteristicas'];
	$precio = $_POST['precio'];
	$unidades = $_POST['unidades'];
	$imagen = $_POST['imagen'];

    $sql = mysqli_query($con,"INSERT INTO macetas(sku, categoria, modelo, caracteristicas, precio, unidades, imagen) VALUES('$sku', '$categoria', '$modelo', '$caracteristicas', '$precio', '$unidades', '$imagen')");

    if($sql) {
        echo " -> maceta registrada";
        header("Location: products.php");
        exit;
    } else {
        echo " -> error al registrar";
    }
?>