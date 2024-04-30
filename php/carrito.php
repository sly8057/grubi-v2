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
	// header("refresh:1; url=products.php");
	echo '<div>'.$msg.'</div>';
	echo '<p>Serás redirigido al catálogo en 5 segundos.</p>';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Carrito</title>

	<!-- font awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

	<!-- css file -->
	<link href="../css/style.css" rel="stylesheet">
</head>
<body>
<!-- header section start -->
	<header>
		<input type="checkbox" id="toggler">
		<label for="toggler" class="fas fa-bars"></label>

		<!-- <a href="#" class="logo">Grub<span>i</span></a> -->
		<a href="../index.php" class="logo"><img src="../img/decorations/grubi-logo.jpg" alt=""></a>

		<nav class="navbar">
			<a href="products.php">Regresar</a>
		</nav>

		<div class="icons">
			<a href="#" class="fas fa-user"></a>
		</div>
	</header>
<!-- header section end -->

	<section class="spacing"></section>
	<section class="spacing"></section>

<!-- more products section start -->
	<section class="cart">
		<h1 class="heading"> carrito de <span> compras </span></h1>
		<div class="box-container">
			<div class="box">
				<div class="content">
					<?php
					var_dump($_SESSION["carrito"]);
					if(isset($_SESSION["carrito"])){
						foreach($_SESSION["carrito"] as $indice => $arreglo) {
							echo "<h3>Producto: <span>". $indice . "</span></h3>";
							foreach($arreglo as $key => $value) {
								echo "<div class='price'>" . $key . ": " . $value . "</div>";
							}
						}
					}
					?>
				</div>
			</div>
		</div>
	</section>
<!-- more products section end -->

<?php



// if(isset($_SESSION['carrito']['sku']))


// $sku = $_SESSION['carrito']['sku'];


?>

<?php
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