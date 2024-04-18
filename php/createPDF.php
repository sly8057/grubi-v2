<?php

?>

<!-- https://youtu.be/TKpMDB2SYjc?si=t_qNYG9B48TETzzM -->

<?php
if(isset($_GET['nombre'])){
    $nombre = $_GET['nombre'];
    require('fpdf/fpdf.php');
    $x = 10;
    $y = 10;
    $pdf = new FPDF('P', 'mm', 'A4');

    $pdf->AddPage();
    $pdf->SetXY($x, $y);
    $pdf->Image('./img/logo.png',150,20,33,0,'PNG','index.php');
    $pdf->SetFont('Helvetica','B',20);
    $pdf->SetFillColor(255,196,102);
    $pdf->SetDrawColor(255,255,255);
    $pdf->SetTextColor(0,0,0);

    $pdf->SetXY(25,$y+5);
    $pdf->SetFontSize(35);
    $pdf->Cell(150,10,'RECIBO',0,0,'L',0);
    $pdf->SetXY(25,$y+25);
    $pdf->SetFontSize(9);
    $pdf->Cell(60,0,'DE');
    $fecha   = Date("d-m-Y");
    $pdf->Cell(0,0,'FECHA: '.$fecha.'');

    // Datos de la tienda
    $pdf->SetXY(25,38);
    $pdf->Cell(60,5,'RAGE');
    $caducidad = date("d-m-Y", strtotime($fecha.'+ 15 days'));
    $pdf->Cell(0,5,'FECHA DE CADUCIDAD: '.$caducidad.'');
    $pdf->SetXY(25,40);
    $pdf->Cell(40,10,'Calle Artesanias #44');
    $pdf->SetXY(25,43);
    $pdf->Cell(40,10,'45400 Edo.Jalisco');
    //Fin datos de la tienda

    //Datos del comprador
    $pdf->SetXY(25,50);
    $pdf->Cell(60,10,'PARA ');
    $pdf->SetXY(25,53);
    $pdf->Cell(60,10,'Email: '.$email.'');
    $pdf->SetXY(25,56);


    $y = 40;

    

    //footer
    $pdf->SetXY($x+10,200);
    $pdf->Cell(0,5,'CONDICIONES & FORMA DE PAGO',0,0,'C');
    $pdf->SetXY($x+10,205);
    $pdf->Cell(0,5,utf8_decode('El pago se realizará en un lapso de 15 días'),0,0,'C');
    $pdf->Image('./img/barras.png',70,215,80,0,'PNG','');
    //Output the document
    $pdf->Output("pdfprueba.pdf",'D');

    
}else{
    echo "No se ha seleccionado un producto";
}

?>