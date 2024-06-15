<?php
session_start();

if (!isset($_SESSION['Id_usuario'])) {
    header('Location: login/index.html');
    exit();
}

require 'global/config1.php';
require 'global/conexion.php';

$usuario = $_SESSION['Id_usuario'];

$query = "SELECT u.nombres, u.apellidos, m.nombre, m.descripcion, d.fecha, d.cantidad, d.direccion, d.precio_unitario, d.total, p.desc_pago 
          FROM tblUsuarios u 
          JOIN tbldomicilios d ON d.ven_usuario = u.Id_usuario
          JOIN tblmetodo_pago p ON d.metodo_pago = p.Id_pago
          JOIN tblmenus m ON d.id_menu = m.Id_menu
          WHERE u.Id_usuario = :usuario";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':usuario', $usuario, PDO::PARAM_INT);
$stmt->execute();
$pedidos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Pedidos</title>
    <link rel="stylesheet" href="style.css"> <!-- Asegúrate de tener tu CSS aquí -->
</head>
<body>
    <h1>Mis Pedidos</h1>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Nombre del Menú</th>
                <th>Descripción</th>
                <th>Fecha</th>
                <th>Cantidad</th>
                <th>Dirección</th>
                <th>Precio Unitario</th>
                <th>Total</th>
                <th>Método de Pago</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pedidos as $pedido): ?>
            <tr>
                <td><?php echo htmlspecialchars($pedido['nombres']); ?></td>
                <td><?php echo htmlspecialchars($pedido['apellidos']); ?></td>
                <td><?php echo htmlspecialchars($pedido['nombre']); ?></td>
                <td><?php echo htmlspecialchars($pedido['descripcion']); ?></td>
                <td><?php echo htmlspecialchars($pedido['fecha']); ?></td>
                <td><?php echo htmlspecialchars($pedido['cantidad']); ?></td>
                <td><?php echo htmlspecialchars($pedido['direccion']); ?></td>
                <td><?php echo htmlspecialchars($pedido['precio_unitario']); ?></td>
                <td><?php echo htmlspecialchars($pedido['total']); ?></td>
                <td><?php echo htmlspecialchars($pedido['desc_pago']); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="..\index.php">Volver al inicio</a> 
</body>
</html>

