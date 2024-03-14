<?php

require '..\config.php'; 

$columns = ['m.Id_menu', 'm.categoria', 'm.nombre' ,'m.descripcion' ,'m.imagen','m.precio'];
$columnsWhere = ['Id_menu', 'categoria'];
$table = "tblmenus m";

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
$num_rows = $resultado ->num_rows;
$html = '';
$html = '';

if ($num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $imagen_base64 = base64_encode($row['imagen']);
        $html .= '<tr>';
        $html .= '<td>'.$row['Id_menu'].'</td>';
        $html .= '<td>'.$row['categoria'].'</td>';
        $html .= '<td>'.$row['nombre'].'</td>';
        $html .= '<td>'.$row['descripcion'].'</td>';
        $html .= '<td><img src="data:image/jpg;base64,'.$imagen_base64.'"></td>';
        $html .= '<td>'.$row['precio'].'</td>';
        $html .= '<td><a href="editar.php?id='.$row['Id_menu'].'">Editar</a></td>';
        $html .= '<td><a href="eliminar.php?id='.$row['Id_menu'].'">Eliminar</a></td>'; 
        $html .= '</tr>';
    }
}else {
    $html .='<tr>';
    $html .= '<td colspan="" ></td>';
    $html .='</tr>';
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);