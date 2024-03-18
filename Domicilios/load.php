<?php

require '..\config.php'; 

$columns = ['d.Id_domicilio' ,'d.nombresapellidos','d.direccion', 'd.telefono','d.referencia_ubicacion', 'm.nombre', 'p.desc_pago'];
$columnsWhere = ['Id_domicilio', 'desc_pago'];
$table = "tbldomicilios d";
$table2 = "tblmenus m";
$table3 = "tblmetodo_pago p";


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
LEFT JOIN $table2  ON d.dom_menu = m.Id_menu
LEFT JOIN $table3  ON d.dom_pago = p.Id_pago
$where ";


$resultado = $conn->query($sql);
$num_rows = $resultado ->num_rows; // Obtiene el número de filas devueltas por la consulta.
$html = '';
$html = '';

if ($num_rows > 0){
    while ($row = $resultado->fetch_assoc()){
        $html .='<tr>';
        $html .='<td>'.$row ['Id_domicilio'].'</td>';
        $html .='<td>'.$row ['nombresapellidos'].'</td>';
        $html .='<td>'.$row ['direccion'].'</td>';
        $html .='<td>'.$row ['telefono'].'</td>';
        $html .='<td>'.$row ['referencia_ubicacion'].'</td>';
        $html .='<td>'.$row ['nombre'].'</td>';
        $html .='<td>'.$row ['desc_pago'].'</td>';
        $html .='<td><a href="editar.php?id='.$row['Id_domicilio'].'">Editar</a></td>'; // Enlace para editar
        $html .='<td><a href="eliminar.php?id='.$row['Id_domicilio'].'">Eliminar</a></td>'; // Enlace para eliminar
        $html .='</tr>';
    }
}else {
    $html .='<tr>';
    $html .= '<td colspan="" ></td>';
    $html .='</tr>';
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);