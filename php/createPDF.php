<?php
ob_start();
?>

<?php
	include "../connection.php";

	if(!isset($_GET['nombre'])){
		echo "No se ha seleccionado un producto";
	}

	$nombre = $_GET['nombre'];
	$usr = mysqli_query($con,"SELECT * FROM clientes WHERE nombre = '$nombre'");
	$row = mysqli_fetch_array($usr);
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title> Compra realizada </title>

	<!-- font awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

	<!-- css file -->
	<link href="../css/style.css" rel="stylesheet">
</head>

<body>

<!-- header section start -->
	<header>
		<!-- <a href="#" class="logo">Grub<span>i</span></a> -->
		<a href="#" class="logo"><img src="http://<?php echo $_SERVER['HTTP_HOST'];?>/grubi-v2/img/grubi-logo.jpg" alt=""></a>
		<div class="footer">
			<div class="box-container">
				<div class="box">
					<p>Tel: 33542983</p>
				</div>
			</div>
		</div>
		<div class="footer">
			<div class="box-container">
				<div class="box">
					<p class="email">tenko_grubimex@gmail.com</p>
				</div>
			</div>
		</div>
		<div class="footer">
			<div class="box-container">
				<div class="box">
					<p>Av. de la Paz 1701, Col Americana, Americana, 44160 Guadalajara, Jal.</p>
				</div>
			</div>
		</div>
	</header>
<!-- header section end -->

	<section class="spacing"></section>
	<section class="spacing"></section>

<!-- about section start -->
	<section class="about" id="about">
		<h1 class="heading"> Disfruta tu compra <span> <?php echo $row['nombre']?> </span> </h1>
		<div class="row">
			<div class="column-left">
				<h3>Productos comprados:</h3>
				<div class="info">
					<div class="box-container">
						<!-- El box-container debe ser display:flex, flex-wrap:wrap, gap:1.5rem -->
						<?php
							include("../connection.php");
							$sql = mysqli_query($con,"SELECT * FROM macetas WHERE modelo = 'Risk'");
							$row = mysqli_fetch_array($sql);
						?>
						<div class="box">
							<div class="image">
								<img src="http://<?php echo $_SERVER['HTTP_HOST'];?>/grubi-v2/img/<?php echo $row['imagen'];?>">
							</div>
						</div>
					</div>
					<h3><?php echo $row['modelo'];?></h3>
				</div>
			</div>
		</div>
		<!-- <div class="row">
			<div class="column-left">
				<h3>Total a pagar:</h3>
				<div class="info">
					<p></p>
				</div>
				<div class="info">
					<p></p>
				</div>
				<div class="info">
					<p>Contamos con <span> 31 </span> miembros en nuestro equipo.</p>
				</div>
			</div>
		</div> -->
	</section>
<!-- about section end -->

<!-- footer section start -->
	<footer class="footer">
		<div class="credit"> created by <span> sly </span> <br> &copy; 2024 Grubi by <span> Tenko </span> | todos los derechos reservados </div>
	</footer>
<!-- footer section end -->
</body>
</html>

<?php
$html = ob_get_clean();
// echo $html;

require_once '../dompdf/autoload.inc.php';

use Dompdf\Dompdf;
$dompdf = new Dompdf();

$options = $dompdf->getOptions();
// $options->setIsRemoteEnabled(true);
$options->set(array('IsRemoteEnabled' => true));
$dompdf->setOptions($options);

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');

$dompdf->render();

$dompdf->stream("recibo.pdf", array("Attachment" => false));

?>

<!-- https://youtu.be/TKpMDB2SYjc?si=t_qNYG9B48TETzzM -->