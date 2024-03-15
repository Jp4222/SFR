<?php
require('..\fpdf/fpdf.php');

class PDF extends FPDF{

    //CABECERA DE PAGINA

    function Header(){

        //Logo
        $this->Cell(-200);
        $this ->Image('..\sushi.png',0,-10,220);
        //Letra
        $this->Ln(10);
        $this->SetFont('Arial','B',10);

        $this->Cell(-200);

    }
function Footer(){

    $this -> SetFillColor(20,05,19);
    $this -> Rect(0,270,220,30,'F');
    $this -> SetY(-20);
    $this -> SetFont('Arial','',10);
    $this -> SetTextColor (255,255,255);
    $this -> SetX(90);
    $this -> Write(5, 'Ingenieria de sistemas ');
    $this -> Ln();
}
}
$pdf = new PDF ();
$pdf -> AliasNBPages();
$pdf -> AddPage();
$pdf -> SetFont ('Arial','',10);

$pdf -> SetY(70);
$pdf -> SetX (25);
$pdf -> SetTextColor(255,255,255);
$pdf -> SetFillColor(79,59,120);
$pdf -> Cell(39,9,'Categoria',0,0,'C',1);
$pdf -> Cell(35,9,'Nombres', 0,0,'C',1);
$pdf -> Cell(30,9,'Precio', 0,1,'C',1);



Include('../conexion.php');
require('../conexion.php');

$consulta = "SELECT * from tblmenus u";
$resultado = mysqli_query($conexion,$consulta);

$pdf ->SetTextColor(0,0,0);
$pdf -> SetFillColor(240,245,255);                                                //Mostramos la plata

while ($row = $resultado -> fetch_assoc()){
    $pdf -> SetX(25);
    $pdf -> Cell(39,25, $row ['categoria'],1,0,'C',1);
    $pdf -> Cell(35,25, $row ['nombre'], 1,0,'C',1);
    $pdf -> Cell(30,25, $row ['precio'], 1,1,'C',1);
}

$pdf -> Output();
