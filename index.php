<?php
session_start();

include("connection.php");

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
	<title> Grubi | Inicio </title>

	<!-- font awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

	<!-- css file -->
	<link href="css/style.css" rel="stylesheet">
</head>
<body>
<!-- header section start -->
	<header>
		<input type="checkbox" id="toggler">
		<label for="toggler" class="fas fa-bars"></label>

		<!-- <a href="#" class="logo">Grub<span>i</span></a> -->
		<a href="#" class="logo"><img src="img/decorations/grubi-logo.jpg" alt=""></a>

		<nav class="navbar">
			<a href="#">Inicio</a>
			<a href="php/products.php">Productos</a>
			<?php if(!isset($_SESSION['id_cliente'])): ?>
				<a href="html/login.html">Log in</a>
				<a href="html/signup.html">Sign up</a>
				<?php endif; ?>
		</nav>

		<div class="icons">
			<?php if(isset($_SESSION['id_cliente'])): ?>
				<a href="#" class="fas fa-music"></a>
				<a href="php/carrito.php" class="fas fa-shopping-cart"></a>
				<a href="php/perfil.php" class="fas fa-user"></a>
				<a href="php/logout.php" class="fas fa-right-from-bracket"></a>
				<?php endif; ?>
		</div>
	</header>
<!-- header section end -->

<!-- banner section start -->
	<section class="banner-container" id="banner">
		<div class="banner"></div>
		<div class="line">
			<h3>presentamos grubi</h3>
			<span>ritmo, estilo y compañia en un sólo lugar</span>
		</div>
	</section>
<!-- banner section end -->

<!-- about section start -->
	<section class="about" id="about">
		<h1 class="heading"> sobre <span> grubi </span> </h1>
		<div class="row">
			<div class="column-left">
				<h3>¿Sabías qué..?</h3>
				<div class="info">
					<p>Nuestra maceta inteligente se llama "Grubi" en honor al bot de Discord "Groovy", pues fue eliminado permanentemente, y lo queríamos mucho.</p>
				</div>
				<div class="info">
					<p>El juego Undertale -creado por Toby Fox- fue de inspiración para nombrar a distintos modelos Grubi.</p>
				</div>
				<div class="info">
					<p>Contamos con <span> 31 </span> miembros en nuestro equipo.</p>
				</div>
			</div>

			<div class="column-right">
				<h3>Misión</h3>
				<p>Lograr que nuestros clientes, sin importar dónde se encuentren en el mundo, tengan acceso a productos de calidad con la más alta tecnología para decorar su hogar a precios accesibles.</p>
				<h3>Visión</h3>
				<p>Ser el proveedor de productos tecnológicos de decoración más rentable, querido y respetado de nuestro mercado, contribuyendo al progreso de las compañías.</p>
				<div class="image">
					<img src="img/decorations/decoration-1.webp" alt="">
				</div>
			</div>
		</div>
	</section>
<!-- about section end -->

<!-- founders section start -->
	<section class="founders" id="founders">
		<h1 class="heading"> conoce a las <span> fundadoras </span> </h1>
		<div class="frame-container">
			<div class="frame-slider">
				<ul>
					<li><img src="img/founders/brenda.webp" alt=""></li>
					<li><img src="img/founders/dani.webp" alt=""></li>
					<li><img src="img/founders/diana.webp" alt=""></li>
					<li><img src="img/founders/estef.webp" alt=""></li>
					<li><img src="img/founders/fany.webp" alt=""></li>
				</ul>
			</div>
		</div>
	</section>
<!-- founders section end -->

<!-- products section start -->
	<section class="products" id="products">
		<h1 class="heading"> <span> productos </span> más populares </h1>
		<p>Hemos creado tu nueva maceta inteligente, la cual te acompañará todos los días con tu música favorita.</p>
		<div class="box-container">
			<?php
				include("connection.php");
				$sql = mysqli_query($con,"SELECT * FROM macetas WHERE modelo = 'Cyrus' OR modelo = 'Risk' OR modelo = 'Snas'");
				// $sql = mysqli_query($con,"SELECT * FROM users WHERE mail = '$mail' AND pass = '$pass'");
				while($row = mysqli_fetch_array($sql)) {
			?>
			<div class="box">
				<div class="image">
					<img src="img/products/<?php echo $row['imagen']?>" alt="">
				</div>
				<div class="content">
					<h3><?php echo $row['modelo']?></h3>
					<div class="price"> <?php echo $row['precio']?></div>
				</div>
			</div>
			<?php }	?>
		</div>
		<div class="box-container">
			<a href="php/products.php" class="btn">más productos</a>
		</div>
	</section>
<!-- products section end -->

<!-- footer section start -->
	<footer class="footer">
		<div class="box-container">
			<div class="box">
				<h3>Menú</h3>
				<a href="#">inicio</a>
				<a href="#about">sobre nosotros</a>
				<a href="#founders">fundadoras</a>
				<a href="php/products.php">productos</a>
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
				<img src="img/decorations/payments.png" alt="">
			</div>
		</div>
		<div class="credit"> created by <span> sly </span> <br> &copy; 2024 Grubi by <span> Tenko </span> | todos los derechos reservados </div>
	</footer>
<!-- footer section end -->
</body>
</html>