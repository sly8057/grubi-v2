<?php
	include "../connection.php";
	session_start();
	$sql = mysqli_query($con, 'SELECT * FROM clientes');
	if(!isset($_SESSION['id_owner'])){
		$msg = "No se ha iniciado sesión";
		session_destroy();
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

	<!-- js files -->
    <script type="text/Javascript" src="../js/mysql.js"> </script>
</head>
<body>
<!-- header section start -->
	<header>
		<input type="checkbox" id="toggler">
		<label for="toggler" class="fas fa-bars"></label>

		<!-- <a href="#" class="logo">Grub<span>i</span></a> -->
		<a href="#" class="logo"><img src="../img/decorations/grubi-logo.jpg" alt=""></a>

		<nav class="navbar">
			<a href="admin.php">Volver</a>
			<a href="bitacora.php">Bitácora</a>
			<!-- <a href="#">Administrador</a> -->
			<!-- <a href="delproducts.php">Eliminar</a> -->
			<!-- <a href="modproducts.php">Modificar</a> -->
		</nav>

		<div class="icons">
			<a href="perfil.php" class="fas fa-user"></a>
			<a href="logout.php" class="fas fa-right-from-bracket"></a>
		</div>
	</header>
<!-- header section end -->

	<section class="spacing"></section>
	<section class="spacing"></section>

<!-- products section start -->
	<section class="products catalogue">
		<h1 class="heading"><span> Gestión </span>de Clientes</h1>
		<div class="admin products">
			<table class="table">
				<thead>
					<tr>
						<th class = "table">nombre</th>
						<th class = "table">apellido</th>
						<th class = "table">correo</th>
						<th class = "table">editar</th>
						<th class = "table">eliminar</th>
					</tr>
				</thead>
				<tbody>
					<?php
						while($row = mysqli_fetch_array($sql)) {
					?>
					<tr>
						<td class = "table" data-label = "nombre"><?php echo $row['nombre']?></td>
						<td class = "table" data-label = "apellido"><?php echo $row['apellido']?></td>
						<td class = "table" data-label = "correo"><?php echo $row['correo']?></td>
						<td class = "table edit" data-label = "editar"><a href="editUserForm.php?id_cliente=<?php echo $row['id_cliente'];?>"  class = "fas fa-pen-to-square"></a></td>
						<td class = "table delete" data-label = "eliminar"><a href="deleteUser.php?id_cliente=<?php echo $row['id_cliente'];?>"  class = "fas fa-trash"></a></td>
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