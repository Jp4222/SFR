<?php
session_start();
include 'global/config1.php';
include 'global/conexion.php'; // Asegúrate de que este archivo contiene la conexión a la base de datos

if (isset($_POST['btnAccion']) && $_POST['btnAccion'] == 'Pagar') {
    if (!empty($_SESSION['CARRITO2'])) {
        foreach ($_SESSION['CARRITO2'] as $producto) {
            $ID = $producto['ID'];
            $NOMBRE = $producto['NOMBRE'];
            $CANTIDAD = $producto['CANTIDAD'];
            $PRECIO = $producto['PRECIO'];
            
            // Inserta los datos del carrito en la base de datos
            $sql = "INSERT INTO ventas (id_producto, nombre, cantidad, precio) VALUES (:ID, :NOMBRE, :CANTIDAD, :PRECIO)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':ID', $ID);
            $stmt->bindParam(':NOMBRE', $NOMBRE);
            $stmt->bindParam(':CANTIDAD', $CANTIDAD);
            $stmt->bindParam(':PRECIO', $PRECIO);
            $stmt->execute();
        }
        
        // Vaciar el carrito después de realizar el pago
        unset($_SESSION['CARRITO2']);
        echo "<script>alert('Compra realizada con éxito.'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('No hay productos en el carrito.'); window.location.href='index.php';</script>";
    }
}

