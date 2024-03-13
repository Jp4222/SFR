<?php

require '..\config.php'; 

$columns = ['u.Id_usuario', 'u.nombres', 'u.apellidos' ,'u.correo'	,'u.direccion', 'u.contraseña' ,'u.telefono', 'r.desc_rol'];
$columnsWhere = ['Id_usuario', 'desc_rol'];
$table = "tblusuarios u";
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
LEFT JOIN $table2  ON u.us_rol = r.id_rol
$where ";


$resultado = $conn->query($sql);
$num_rows = $resultado ->num_rows; // Obtiene el número de filas devueltas por la consulta.
$html = '';
$html = '';

if ($num_rows > 0){
    while ($row = $resultado->fetch_assoc()){
        $html .='<tr>';
        $html .='<td>'.$row ['Id_usuario'].'</td>';
        $html .='<td>'.$row ['nombres'].'</td>';
        $html .='<td>'.$row ['apellidos'].'</td>';
        $html .='<td>'.$row ['correo'].'</td>';
        $html .='<td>'.$row ['direccion'].'</td>';
        $html .='<td>'.$row ['contraseña'].'</td>';
        $html .='<td>'.$row ['telefono'].'</td>';
        $html .='<td>'.$row ['desc_rol'].'</td>';
        $html .='<td><a href="editar.php?id='.$row['Id_usuario'].'">Editar</a></td>'; // Enlace para editar
        $html .='<td><a href="eliminar.php?id='.$row['Id_usuario'].'">Eliminar</a></td>'; // Enlace para eliminar
        $html .='</tr>';
    }
}else {
    $html .='<tr>';
    $html .= '<td colspan="" ></td>';
    $html .='</tr>';
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);