<?php
session_start();

if(isset($_SESSION['id_cliente'])){
	$id_cliente = $_SESSION['id_cliente'];
	$usr = mysqli_query($con,"SELECT nombre FROM clientes WHERE id_cliente = '$id_cliente'");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Productos</title>

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
		<a href="#" class="logo"><img src="../img/decorations/grubi-logo.jpg" alt=""></a>

		<nav class="navbar">
			<a href="../index.php">Inicio</a>
			<a href="#">Productos</a>
			<?php if(!isset($_SESSION['id_cliente'])): ?>
				<a href="../html/login.html">Log in</a>
				<a href="../html/signup.html">Sign up</a>
				<?php endif; ?>
		</nav>

		<div class="icons">
			<?php if(isset($_SESSION['id_cliente'])): ?>
				<a href="#" class="fas fa-music"></a>
				<a href="carrito.php" class="fas fa-shopping-cart"></a>
				<a href="perfil.php" class="fas fa-user"></a>
				<a href="logout.php" class="fas fa-right-from-bracket"></a>
				<?php endif; ?>
		</div>
	</header>
<!-- header section end -->

	<section class="spacing"></section>
	<section class="spacing"></section>

<!-- carrito section start -->
<section class="cart">
		<h1 class="heading"> carrito de <span> compras </span></h1>
		<div class="cart products">
			<table class="table">
				<thead>
					<tr>
						<th class = "table">modelo</th>
						<th class = "table">precio</th>
						<th class = "table">cantidad</th>
						<th class = "table">subtotal</th>
					</tr>
				</thead>
				<tbody>
					<?php
						if(isset($_SESSION['carrito'])) {
							foreach ($_SESSION['carrito'] as $btn_sku => $maceta) {
								echo "<tr>";
								echo "<td class = 'table'>{$maceta['modelo']}</td>";
                                echo "<td class = 'table'>$ {$maceta['precio']}</td>";
                                echo "<td class = 'table'>{$maceta['cantidad']}</td>";
                                echo "<td class = 'table'>$ {$maceta['subtotal']}</td>";
								echo "</tr>";
							}
						} else {
							echo "<tr><td colspan='5'>El carrito está vacío</td></tr>";
						}
					?>
				</tbody>
			</table>
			<a href="fpdf.php" target="_blank" class="btn" class="fas fa-file-pdf"></a>
		</div>
	</section>
<!-- carrito section end -->


<!-- footer section start -->
	<footer class="footer">
		<div class="box-container">
			<div class="box">
				<h3>Menú</h3>
				<a href="#banner">inicio</a>
				<a href="#about">sobre nosotros</a>
				<a href="#founders">fundadoras</a>
				<a href="#products">productos</a>
			</div>
			<div class="box">
				<h3>social</h3>
				<a href="https://discord.com">discord</a>
				<a href="https://facebook.com">facebook</a>
				<a href="https://instagram.com">instagram</a>
			</div>
			<div class="box">
				<h3>contacto</h3>
				<p>Tel: 33542983</p>
				<p class="email">tenko_grubimex@gmail.com</p>
				<p>Av. de la Paz 1701, Col Americana, Americana, 44160 Guadalajara, Jal.</p>
				<img src="images/payments.png" alt="">
			</div>
		</div>
		<div class="credit"> created by <span> sly </span> <br> &copy; 2024 Grubi by <span> Tenko </span> | todos los derechos reservados </div>
	</footer>
<!-- footer section end -->
</body>
</html>