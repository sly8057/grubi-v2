<?php
	include "../connection.php";
	$sql = mysqli_query($con, "SELECT * FROM macetas");
	session_start();
	if(!isset($_SESSION['id_owner'])){
		$msg = "No se ha iniciado sesión";
		header("refresh:1; url=../html/login.html");
		echo '<div>'.$msg.'</div>';
		echo '<p>Serás redirigido al log in en 5 segundos.</p>';
	// header("Location: products.php");
	exit;
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
		<a href="../index.php" class="logo"><img src="../img/decorations/grubi-logo.jpg" alt=""></a>

		<nav class="navbar">
			<a href="../html/regproducts.html">Registrar</a>
			<a href="#">Administrador</a>
			<!-- <a href="delproducts.php">Eliminar</a> -->
			<!-- <a href="modproducts.php">Modificar</a> -->
		</nav>

		<div class="icons">
			<a href="#" class="fas fa-user"></a>
		</div>
	</header>
<!-- header section end -->

	<section class="spacing"></section>
	<section class="spacing"></section>

<!-- products section start -->
	<section class="products catalogue">
		<h1 class="heading"> catálogo de <span> productos </span></h1>
		<div class="admin products">
			<table class="table">
				<thead>
					<tr>
						<th class = "table">sku</th>
						<th class = "table">categoría</th>
						<th class = "table">modelo</th>
						<th class = "table">características</th>
						<th class = "table">precio</th>
						<th class = "table">unidades</th>
						<th class = "table">imagen</th>
						<th class = "table">editar</th>
						<th class = "table">eliminar</th>
					</tr>
				</thead>
				<tbody>
					<?php
						while($row = mysqli_fetch_array($sql)) {
					?>
					<tr>
						<td class = "table" data-label = "sku"><?php echo $row['sku']?></td>
						<td class = "table" data-label = "categoría"><?php echo $row['categoria']?></td>
						<td class = "table" data-label = "modelo"><?php echo $row['modelo']?></td>
						<td class = "table" data-label = "características"><?php echo $row['caracteristicas']?></td>
						<td class = "table" data-label = "precio"><?php echo $row['precio']?></td>
						<td class = "table" data-label = "unidades"><?php echo $row['unidades']?></td>
						<td class = "table" data-label = "imagen"><img src="../img/products/<?php echo $row['imagen']?>" alt=""></td>
						<td class = "table edit" data-label = "editar"><a href="editProductForm.php?sku=<?php echo $row['sku'];?>"  class = "fas fa-pen-to-square"></a></td>
						<td class = "table delete" data-label = "eliminar"><a href="deleteProduct.php?sku=<?php echo $row['sku'];?>"  class = "fas fa-trash"></a></td>
					</tr>
					<?php }	?>
				</tbody>
			</table>
		</div>
	</section>
<!-- products section start -->

<!-- footer section start -->
	<footer class="footer">
		<div class="credit"> created by <span> sly </span> <br> &copy; 2024 Grubi by <span> Tenko </span> | todos los derechos reservados </div>
	</footer>
<!-- footer section end -->
</body>
</html>