<?php

require '../config.php';  // Verifica la ruta del archivo config.php

$columns = ['d.Id_venta', 'u.nombres', 'u.apellidos', 'u.telefono', 'd.direccion', 'd.fecha','d.cantidad', 'm.nombre', 'm.precio', 'd.total', 'p.desc_pago'];
$columnsWhere = ['d.Id_venta', 'u.nombres', 'u.apellidos', 'u.telefono', 'd.direccion', 'd.fecha', 'd.cantidad', 'm.nombre', 'm.precio', 'd.total', 'p.desc_pago']; // Añadir columnas para búsqueda
$table = "tbldomicilios d";
$table2 = "tblusuarios u";
$table3 = "tblmenus m";
$table4 = "tblmetodo_pago p";

//$campo = $conn->real_escape_string($_POST ['campo']) ?? null ;
$campo = isset($_POST['campo']) ? $conn->real_escape_string($_POST['campo']) : null;

$where = '';

if ($campo != null) {
    $where = "WHERE (";

    $cont = count($columnsWhere);
    for ($i = 0; $i < $cont; $i++) {
        $where .= $columnsWhere[$i] . " LIKE '%" . $campo . "%' OR ";
    }
    $where = substr_replace($where, "", -4); // Eliminar el último ' OR '
    $where .= ")";
}

$sql = "SELECT " . implode(", ", $columns) . "
FROM $table
LEFT JOIN $table2 ON d.ven_usuario = u.Id_usuario
LEFT JOIN $table3 ON d.id_menu = m.Id_menu
LEFT JOIN $table4 ON d.metodo_pago = p.Id_pago
$where";

$resultado = $conn->query($sql);
$num_rows = $resultado->num_rows; // Obtiene el número de filas devueltas por la consulta.
$html = '';

if ($num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $html .= '<tr>';
        $html .= '<td>' . $row['Id_venta'] . '</td>';
        $html .= '<td>' . $row['nombres'] . '</td>';
        $html .= '<td>' . $row['apellidos'] . '</td>';
        $html .= '<td>' . $row['telefono'] . '</td>';
        $html .= '<td>' . $row['direccion'] . '</td>';
        $html .= '<td>' . $row['fecha'] . '</td>';
        $html .= '<td>' . $row['cantidad'] . '</td>';
        $html .= '<td>' . $row['nombre'] . '</td>';
        $html .= '<td>' . $row['precio'] . '</td>';
        $html .= '<td>' . $row['total'] . '</td>';
        $html .= '<td>' . $row['desc_pago'] . '</td>';
        $html .= '<td><a href="editar.php?id=' . $row['Id_venta'] . '">Editar</a></td>'; // Enlace para editar
        $html .= '<td><a href="eliminar.php?id=' . $row['Id_venta'] . '">Eliminar</a></td>'; // Enlace para eliminar
        $html .= '</tr>';
    }
} else {
    $html .= '<tr>';
    $html .= '<td colspan="12">No se encontraron resultados</td>'; // Corrige el colspan de acuerdo con el número de columnas
    $html .= '</tr>';
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);
?>
