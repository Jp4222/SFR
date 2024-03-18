<?php

require '..\config.php'; 

// Define variables e inicializa con valores vacíos
$id_menu = $cantidad = $metodo_pago = '';
$id_menu_err = $cantidad_err = $metodo_pago_err = '';

// Procesa los datos del formulario cuando se envía el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validación y procesamiento de datos
    $id_menu = $_POST["id_menu"];
    $cantidad = $_POST["cantidad"];
    $metodo_pago = $_POST["metodo_pago"];

    // Verificar si el ID del menú está vacío
    if (empty($id_menu)) {
        $id_menu_err = "Por favor ingrese el ID del menú.";
    }

    // Verificar si la cantidad está vacía o no es numérica
    if (empty($cantidad) || !is_numeric($cantidad) || $cantidad <= 0) {
        $cantidad_err = "Por favor ingrese una cantidad válida.";
    }

    // Verificar si el método de pago está vacío
    if (empty($metodo_pago)) {
        $metodo_pago_err = "Por favor ingrese el método de pago.";
    }

    // Si no hay errores de validación, agregar el menú
    if (empty($id_menu_err) && empty($cantidad_err) && empty($metodo_pago_err)) {
        // Consulta para obtener el precio del menú desde la base de datos
        $sql = "SELECT precio FROM tblmenus WHERE Id_menu = $id_menu";
        
        if ($stmt = $conn->prepare($sql)) {
            // Vincular variables a la declaración preparada como parámetros
            $stmt->bind_param("s", $id_menu);
            
            // Establecer el parámetro
            $id_menu = $_POST["id_menu"];
            
            // Ejecutar la consulta
            $stmt->execute();
            
            // Vincular variables de resultado
            $stmt->bind_result($precio_unitario);
            
            // Obtener el precio unitario
            if ($stmt->fetch()) {
                // Calcular el total para este menú
                $total = $cantidad * $precio_unitario;

                // Query para insertar la nueva venta
                $sql_insert = "INSERT INTO tblventas (fecha, id_menu, cantidad, precio_unitario, total, metodo_pago) VALUES ($fecha, $id_menu, $cantidad, $precio_unitario, $total, $metodo_pago)";
                
                if ($stmt_insert = $conn->prepare($sql_insert)) {
                    // Vincular variables a la declaración preparada como parámetros
                    $stmt_insert->bind_param("ssssss", $fecha, $id_menu, $cantidad, $precio_unitario, $total, $metodo_pago);
                    
                    // Establecer los parámetros
                    $fecha = date("Y-m-d"); // Obtener la fecha actual
                    $metodo_pago = $_POST["metodo_pago"];
                    
                    // Ejecutar la consulta de inserción
                    if ($stmt_insert->execute()) {
                        // Redirigir de vuelta a la página principal o a donde sea necesario
                        header("Location: index.php");
                        exit();
                    } else {
                        // Si hay un error, muestra un mensaje de error
                        echo "Error al agregar la venta: " . $conn->error;
                    }
                }
                
                // Cerrar la declaración de inserción
                $stmt_insert->close();
            } else {
                // Si no se encuentra el menú, mostrar un mensaje de error
                $id_menu_err = "No se encontró el ID del menú.";
            }
            
            // Cerrar la declaración de consulta
            $stmt->close();
        }
    }

    // Cierra la conexión
    $conn->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Venta</title>
</head>
<body>
    <h2>Agregar Venta</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="id_menu">ID del Menú:</label><br>
        <input type="text" id="id_menu" name="id_menu" value="<?php echo $id_menu; ?>"><br>
        <span><?php echo $id_menu_err; ?></span><br>
        <label for="cantidad">Cantidad:</label><br>
        <input type="text" id="cantidad" name="cantidad" value="<?php echo $cantidad; ?>"><br>
        <span><?php echo $cantidad_err; ?></span><br>
        <label for="metodo_pago">Método de Pago:</label><br>
        <input type="text" id="metodo_pago" name="metodo_pago" value="<?php echo $metodo_pago; ?>"><br>
        <span><?php echo $metodo_pago_err; ?></span><br>
        <input type="submit" value="Agregar">
    </form>
</body>
</html>
