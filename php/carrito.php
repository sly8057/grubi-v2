<?php
include "../connection.php";
session_start();

$carrito = array(
			'productos' => array(),
			'subtotal' => 0,
			'total' => 0			);

if(!isset($_SESSION['carrito'])) {
	$_SESSION['carrito'] = $carrito;
} else {
	++$_SESSION['carrito'];
}

echo $_SESSION['carrito'];



?>