<?php

require '..\config.php'; 

$columns = ['m.Id_menu', 'm.categoria', 'm.nombre' ,'m.descripcion'	,'m.precio'];
$columnsWhere = ['Id_menu', 'categoria'];
$table = "tblmenus m";

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
        $html .='<td>'.$row ['Id_menu'].'</td>';
        $html .='<td>'.$row ['categoria'].'</td>';
        $html .='<td>'.$row ['nombre'].'</td>';
        $html .='<td>'.$row ['descripcion'].'</td>';
        $html .='<td>'.$row ['precio'].'</td>';
        $html .='<td><a href="editar.php?id='.$row['Id_menu'].'">Editar</a></td>'; // Enlace para editar
        $html .='<td><a href="eliminar.php?id='.$row['Id_menu'].'">Eliminar</a></td>'; // Enlace para eliminar
        $html .='</tr>';
    }
}else {
    $html .='<tr>';
    $html .= '<td colspan="" ></td>';
    $html .='</tr>';
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);