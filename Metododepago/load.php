<?php

require '..\config.php'; 

$columns = ['Id_pago','desc_pago'];
$columnsWhere = ['Id_pago'];
$table = "tblmetodo_pago";


//$campo = $conn->real_escape_string($_POST ['campo']) ?? null ;
$campo = isset ($_POST ['campo']) ? $conn -> real_escape_string ($_POST ['campo']): null ;

$where = '';

if($campo != null){
    $where = "WHERE (";

    $cont = count($columnsWhere);
    for ($i = 0; $i < $cont; $i++){
        $where .=$columnsWhere[$i] . " LIKE '%". $campo . "%' OR ";
    }
    $where = substr_replace($where, "", -3);
    $where .= ")";
}

$sql = "SELECT  " . implode(", ", $columns) . "
FROM $table
$where ";


$resultado = $conn->query($sql);
$num_rows = $resultado ->num_rows; // Obtiene el número de filas devueltas por la consulta.
$html = '';
$html = '';

if ($num_rows > 0){
    while ($row = $resultado->fetch_assoc()){
        $html .='<tr>';
        $html .='<td>'.$row ['Id_pago'].'</td>';
        $html .='<td>'.$row ['desc_pago'].'</td>';
        $html .='<td><a href="editar.php?id='.$row['Id_pago'].'">Editar</a></td>'; // Enlace para editar
        $html .='<td><a href="eliminar.php?id='.$row['Id_pago'].'">Eliminar</a></td>'; // Enlace para eliminar
        $html .='</tr>';
    }
}else {
    $html .='<tr>';
    $html .= '<td colspan="" ></td>';
    $html .='</tr>';
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);