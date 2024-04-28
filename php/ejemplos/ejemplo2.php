<?php
	include "../../connection.php";
	session_start();

	echo session_id();
	// para saber el id de la sesión
	// para identificarla
?>

<?php
	//

	$id_cliente = $_SESSION['id_cliente'];

	$usr = mysqli_query($con,"SELECT * FROM clientes WHERE id_cliente = '$id_cliente'");

	$nrUsr = mysqli_num_rows($usr);

	$rUsr = mysqli_fetch_array($usr);

	$nombre = $rUsr['nombre'];
	$apellido = $rUsr['apellido'];

	$_SESSION['nombre'] = $nombre;
	$_SESSION['apellido'] = $apellido;

	echo '<<form action="logout.php" method="POST">
	<input type="submit"/></form>';

	echo $_SESSION['id_cliente'] . $_SESSION['nombre'] . $_SESSION['apellido'];

	// incorporar sesiones al proyecto, cerrar sesión y los productos
?>