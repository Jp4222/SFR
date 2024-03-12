<?php

require '..\config.php'; 

$columns = ['i.id_inventario', 'i.reg_entrada', 'i.reg_salida' ,'i.Descripcion'	,'i.Novedades', 'i.Cantidad'];
$columnsWhere = ['id_inventario', 'reg_entrada', 'reg_salida'];
$table = "tblinventario i";
$table2 = "tblrol r";


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
        $html .='<td>'.$row ['id_inventario'].'</td>';
        $html .='<td>'.$row ['reg_entrada'].'</td>';
        $html .='<td>'.$row ['reg_salida'].'</td>';
        $html .='<td>'.$row ['Descripcion'].'</td>';
        $html .='<td>'.$row ['Novedades'].'</td>';
        $html .='<td>'.$row ['Cantidad'].'</td>';
        $html .='<td><a href="editar.php?id='.$row['id_inventario'].'">Editar</a></td>'; // Enlace para editar
        $html .='<td><a href="eliminar.php?id='.$row['id_inventario'].'">Eliminar</a></td>'; // Enlace para eliminar
        $html .='</tr>';
    }
}else {
    $html .='<tr>';
    $html .= '<td colspan="" ></td>';
    $html .='</tr>';
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);