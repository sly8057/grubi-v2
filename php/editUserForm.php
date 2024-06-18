<?php
	include "../connection.php";
	$sql = mysqli_query($con, "SELECT * FROM clientes");
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

<?php
	if(!isset($_GET['id_cliente'])){
		header("Location: admin.php");
	}

	// ubicar el id_cliente del producto a editar
	$id_cliente = $_GET['id_cliente'];
	$sql = mysqli_query($con, "SELECT * FROM clientes WHERE id_cliente = '$id_cliente'");
	while($row = mysqli_fetch_array($sql)){
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Registra macetas</title>

	<!-- font awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

	<!-- css file -->
	<link href="../css/style.css" rel="stylesheet">
</head>
<body class="signup-login">
	<!-- header section start -->
	<header>
		<input type="checkbox" id="toggler">
		<label for="toggler" class="fas fa-bars"></label>

		<a href="../index.php" class="logo"><img src="../img/decorations/grubi-logo.jpg" alt=""></a>

		<nav class="navbar">
			<a href="admin.php">Inicio de Administrador</a>
		</nav>

		<div class="icons">
			<a href="perfil.php" class="fas fa-user"></a>
			<a href="logout.php" class="fas fa-right-from-bracket"></a>
		</div>
	</header>
<!-- header section end -->


<!-- edición section start -->
<section class="form">
		<div class="container edit">
			<form action="editUser.php" method="post">
				<h1 class = "edit">ID del Cliente #<?php echo $row['id_cliente']; ?></h1>
					<input type="hidden" name="id_cliente" value="<?php echo $row['id_cliente']; ?>">
				<label>Nombre</label>
				<div class="input-box edit">
					<input type="text"  name="nombre" placeholder="<?php echo $row['nombre']; ?>">
					<i class="fas fa-user"></i>
				</div>
				<label>Apellido</label>
				<div class="input-box edit">
					<input type="text"  name="apellido" placeholder="<?php echo $row['apellido']; ?>">
					<i class="fas fa-user"></i>
				</div>
				<label>Correo</label>
				<div class="input-box edit">
					<input type="text"  name="correo" placeholder="<?php echo $row['correo']; ?>">
					<i class="fas fa-envelope"></i>
				</div>

				<input type="submit" class="btn" value="Editar datos del cliente">
			</form>
		</div>
	</section>
<!-- edición section end -->

<?php
    }
?>
</body>
</html>