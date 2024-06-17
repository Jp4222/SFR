<?php
require('..\fpdf\fpdf.php');

class PDF extends FPDF{

    // CABECERA DE PÁGINA
    function Header(){
        // Logo
        $this->Image('..\sushi.png',0,0,220);
        // Letra
        $this->Ln(10);
        $this->SetFont('Arial','B',10);
        $this->Cell(0,10,'',0,1,'C');
    }

    // PIE DE PÁGINA
    function Footer(){
        $this->SetFillColor(20,05,19);
        $this->Rect(0,270,220,30,'F');
        $this->SetY(-20);
        $this->SetFont('Arial','',10);
        $this->SetTextColor(255,255,255);
        $this->SetX(90);
        $this->Write(5, 'Ingenieria de sistemas ');
        $this->Ln();
    }
}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',10);

$pdf->SetY(70);
$pdf->SetX(2);
$pdf->SetTextColor(255,255,255);
$pdf->SetFillColor(79,59,120);
$pdf->Cell(5,9,'ID',1,0,'C',1);
$pdf->Cell(25,9,'Nombres',1,0,'C',1);
$pdf->Cell(25,9,'Telefono',1,0,'C',1);
$pdf->Cell(25,9,'Direccion',1,0,'C',1);
$pdf->Cell(30,9,'Fecha',1,0,'C',1);
$pdf->Cell(5,9,'Cantidad',1,0,'C',1);
$pdf->Cell(35,9,'Menu',1,0,'C',1);
$pdf->Cell(15,9,'Precio',1,0,'C',1);
$pdf->Cell(15,9,'Total',1,0,'C',1);
$pdf->Cell(25,9,'Pago',1,1,'C',1);

require('..\config.php'); // Verifica que la ruta es correcta

$consulta = "SELECT d.Id_venta, u.nombres, u.telefono, d.direccion, d.fecha, d.cantidad, m.nombre, m.precio, d.total, p.desc_pago
FROM tbldomicilios d
LEFT JOIN tblusuarios u ON d.ven_usuario = u.Id_usuario
LEFT JOIN tblmenus m ON d.id_menu = m.Id_menu
LEFT JOIN tblmetodo_pago p ON d.metodo_pago = p.Id_pago";
$resultado = mysqli_query($conn, $consulta);

$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(240,245,255);

while ($row = $resultado->fetch_assoc()){
    $pdf->SetX(2);
    $pdf->Cell(5,9, $row['Id_venta'],1,0,'C',1);
    $pdf->Cell(25,9, $row['nombres'],1,0,'C',1);
    $pdf->Cell(25,9, $row['telefono'], 1,0,'C',1);
    $pdf->Cell(25,9, $row['direccion'], 1,0,'C',1);
    $pdf->Cell(30,9, $row['fecha'], 1,0,'C',1);
    $pdf->Cell(5,9, $row['cantidad'], 1,0,'C',1);
    $pdf->Cell(35,9, $row['nombre'], 1,0,'C',1);
    $pdf->Cell(15,9, $row['precio'], 1,0,'C',1);
    $pdf->Cell(15,9, $row['total'], 1,0,'C',1);
    $pdf->Cell(25,9, $row['desc_pago'], 1,1,'C',1);
}

$pdf->Output();
?>
