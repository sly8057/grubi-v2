<?php
include "../connection.php";
session_start();


if(!isset($_SESSION['id_cliente'])){
	$msg = "No se ha iniciado sesión";
	header("refresh:1; url=../html/login.html");
	echo '<div>'.$msg.'</div>';
	echo '<p>Serás redirigido al log in en 5 segundos.</p>';
// header("Location: products.php");
	exit;
} else if(!isset($_SESSION['carrito'])) {
	$msg = "El carrito está vacío";
	header("refresh:1; url=products.php");
	echo '<div>'.$msg.'</div>';
	echo '<p>Serás redirigido al catálogo en 5 segundos.</p>';
}

var_dump($_SESSION['carrito']);
// $carrito = array(
// 			'productos' => array(),
// 			'subtotal' => 0,
// 			'total' => 0			);

// if(!isset($_SESSION['carrito'])) {
// 	$_SESSION['carrito'] = $carrito;
// } else {
// 	++$_SESSION['carrito'];
// }

// echo $_SESSION['carrito'];



?>