<?php
session_start();
include 'global/config1.php';
include 'global/conexion.php';

if (isset($_POST['btnAccion']) && $_POST['btnAccion'] == 'Pagar') {
    if (!empty($_SESSION['CARRITO2'])) {
        foreach ($_SESSION['CARRITO2'] as $producto) {
            $ID_usuario = $_SESSION['Id_usuario']; // Usar 'Id_usuario' en lugar de 'nombres' si este es el campo que contiene el ID del usuario en tu tabla de usuarios
            $ID_menu = $producto['ID'];
            $fecha = date('Y-m-d H:i:s');
            $cantidad = $producto['CANTIDAD'];
            $precio_unitario = $producto['PRECIO'];
            $total = $cantidad * $precio_unitario;
            $metodo_pago = 'efectivo';

            // Verificar si el usuario existe (puedes omitir esta verificación si ya tienes el ID de usuario)
            // $sql_verificar_usuario = "SELECT * FROM tblusuarios WHERE Id_usuario = :ID_usuario";
            // $stmt_verificar_usuario = $pdo->prepare($sql_verificar_usuario);
            // $stmt_verificar_usuario->bindParam(':ID_usuario', $ID_usuario);
            // $stmt_verificar_usuario->execute();

            // Insertar los datos en la tabla tbldomicilios
            $sql = "INSERT INTO tbldomicilios (ven_usuario, id_menu, fecha, cantidad, precio_unitario, total, metodo_pago)
                    VALUES (:ID_usuario, :ID_menu, :fecha, :cantidad, :precio_unitario, :total, :metodo_pago)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':ID_usuario', $ID_usuario);
            $stmt->bindParam(':ID_menu', $ID_menu);
            $stmt->bindParam(':fecha', $fecha);
            $stmt->bindParam(':cantidad', $cantidad);
            $stmt->bindParam(':precio_unitario', $precio_unitario);
            $stmt->bindParam(':total', $total);
            $stmt->bindParam(':metodo_pago', $metodo_pago);
            $stmt->execute();
        }

        // Vaciar el carrito después de realizar el pago
        unset($_SESSION['CARRITO2']);
        echo "<script>alert('Compra realizada con éxito.'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('No hay productos en el carrito.'); window.location.href='index.php';</script>";
    }
}
?>
