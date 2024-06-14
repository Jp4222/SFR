<?php
require('..\fpdf\fpdf.php');

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
$pdf -> SetX (8);
$pdf -> SetTextColor(255,255,255);
$pdf -> SetFillColor(79,59,120);
$pdf -> Cell(39,9,'Nombre del menu',0,0,'C',1);
$pdf -> Cell(39,9,'Registro entrada',0,0,'C',1);
$pdf -> Cell(39,9,'Registro salida', 0,0,'C',1);
$pdf -> Cell(25,9,'Descripcion', 0,0,'C',1);
$pdf -> Cell(30,9,'Novedades', 0,0,'C',1);
$pdf -> Cell(17,9,'Cantidad', 0,1,'C',1);



Include('..\config.php');
require('..\config.php');

$consulta = "SELECT i.id_inventario, m.nombre,i.reg_entrada,i.reg_salida,i.Descripcion,i.Novedades,i.Cantidad FROM tblinventario i, tblmenus m
where i.inv_menu = m.Id_menu";
$resultado = mysqli_query($conn,$consulta);

$pdf ->SetTextColor(0,0,0);
$pdf -> SetFillColor(240,245,255);                                      

while ($row = $resultado -> fetch_assoc()){
    $pdf -> SetX(8);
    $pdf -> Cell(39,9, $row ['nombre'],0,0,'C',1);
    $pdf -> Cell(39,9, $row ['reg_entrada'], 0,0,'C',1);
    $pdf -> Cell(39,9, $row ['reg_salida'], 0,0,'C',1);
    $pdf -> Cell(25,9, $row ['Descripcion'], 0,0,'C',1);
    $pdf -> Cell(30,9, $row ['Novedades'], 0,0,'C',1);
    $pdf -> Cell(17,9, $row ['Cantidad'], 0,0,'C',1);
}

$pdf -> Output();
