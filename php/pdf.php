<?php
	include "../connection.php";

	if(!isset($_GET['nombre'])){
		echo "No se ha seleccionado un producto";
	}

	$nombre = $_GET['nombre'];
	$usr = mysqli_query($con,"SELECT * FROM clientes WHERE nombre = '$nombre'");
	$rUsr = mysqli_fetch_array($usr);

    $prod = mysqli_query($con,"SELECT * FROM macetas WHERE modelo = 'Risk'");
    $rprod = mysqli_fetch_array($prod);

    require('../fpdf/fpdf.php');
    $x = 10;
    $y = 10;
    $pdf = new FPDF('P', 'mm', 'A4');

    $pdf->AddPage();
    $pdf->SetXY($x, $y);
    $pdf->Image('../img/decorations/grubi-logo.png',150,20,33,0,'PNG','index.php');
    $pdf->SetFont('Courier','B',16);
    $pdf->SetFillColor(255,196,102);
    $pdf->SetDrawColor(255,255,255);

    // green: rgb(131,164,102);
    // black: rgb(0, 0, 0);
    $pdf->SetTextColor(131,164,102);

    $pdf->SetXY(25,$y+5);
    $pdf->SetFontSize(35);
    $pdf->Cell(150,10,'RECIBO',0,0,'L',0);
    $pdf->SetXY(25,$y+25);
    $pdf->SetFontSize(9);
    $pdf->SetTextColor(0,0,0);

    // Datos genéricos
    $pdf->Cell(60,0,'DE: GRUBI');
    $fecha = Date("d-m-Y");
    $pdf->Cell(0,0,'FECHA DE EXPEDICION: '.$fecha.'');
    $pdf->SetXY(25,38);
    $pdf->Cell(60,5,'TELEFONO: 33542983');
    $pdf->Cell(60,5,'CORREO: tenko_grubimex@gmail.com');
    //Fin datos genéricos

    //Datos del comprador
    $pdf->SetXY(25,50);
    $pdf->Cell(60,10,'PARA:');
    $pdf->Cell(60,10,'Email:');
    $pdf->SetXY(25,53);
    $pdf->SetTextColor(131,164,102);
    $pdf->Cell(60,15,$rUsr['nombre'].' '.$rUsr['apellido']);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(60,15,$rUsr['correo']);
    $pdf->SetXY(25,56);


    $y = 40;


    //footer
    $pdf->SetXY($x+10,200);
    $pdf->Cell(0,5,'GRACIAS POR SU COMPRA',0,0,'C');
    $pdf->SetXY($x+10,205);
    $pdf->Image('../img/products/' .$rprod['imagen'],70,215,80,0,'PNG','');
    //Output the document
    $pdf->Output('I',$rUsr['nombre'].".pdf");
?>