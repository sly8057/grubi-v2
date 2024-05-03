<?php
session_start();

include("../connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['sku']) && isset($_POST['btn_sku'])) {
	$sku = $_POST['sku'];
	$btn_sku = $_POST['btn_sku'];

	// consultar la información del producto
	$sql = mysqli_query($con, "SELECT * FROM macetas WHERE sku = $sku");
	$maceta = mysqli_fetch_array($sql);

	// ver si el carrito ya existe
	if (!isset($_SESSION['carrito'])) {
		$_SESSION['carrito'] = array();
	}

	// ver si maceta está en carrito
	if (isset($_SESSION['carrito'][$btn_sku])) {
		// Aumentar la cantidad del producto en el carrito
		$_SESSION['carrito'][$btn_sku]['cantidad']++;
		$_SESSION['carrito'][$btn_sku]['subtotal'] = $_SESSION['carrito'][$btn_sku]['precio'] * $_SESSION['carrito'][$btn_sku]['cantidad'];
	} else {
		// agregar con cantidad inicial de 1
		$maceta_carrito = array(
			'sku' => $maceta['sku'],
			'modelo' => $maceta['modelo'],
			'precio' => $maceta['precio'],
			'cantidad' => 1,
			'subtotal' => $subtotal
		);
		$_SESSION['carrito'][$btn_sku] = $maceta_carrito;
	}
	echo "<pre>";
	print_r($_SESSION['carrito']);
	echo "</pre>";

	// Redirigir a la página del maceta o a donde desees después de agregar al carrito
	header("Location: products.php");
	exit;
}
?>