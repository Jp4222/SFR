<?php

require '..\config.php'; 

// Define variables e inicializa con valores vacíos
$id_Venta = $fecha = $id_menu = $cantidad = $precio_unitario = $total = $metodo_pago = '';
$id_Venta_err = $fecha_err = $id_menu_err = $cantidad_err = $precio_unitario_err = $total_err = $metodo_pago_err = '';

// Procesa los datos del formulario cuando se envía el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["desc_rol"]))) {
        $desc_rol_err = "Por favor ingrese el nombre del rol.";
    } else {
        $desc_rol = $conn->real_escape_string(trim($_POST["desc_rol"]));
    }
    // Verifica si no hay errores de entrada antes de insertar en la base de datos
    if (empty($desc_rol_err) ) {
        // Query para insertar el nuevo usuario
        $sql = "INSERT INTO tblrol (desc_rol) VALUES ('$desc_rol')";

        // Ejecutar la consulta
        if ($conn->query($sql) === TRUE) {
            // Redirigir de vuelta a la página principal o a donde sea necesario
            header("Location: index.php");
            exit();
        } else {
            // Si hay un error, muestra un mensaje de error
            echo "Error al agregar usuario: " . $conn->error;
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
    <title>Agregar Usuario</title>
</head>
<body>
    <h2>Agregar Usuario</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="desc_rol">Nombre rol:</label><br>
        <input type="text" id="desc_rol" name="desc_rol" value="<?php echo $desc_rol; ?>"><br>
        <span><?php echo $desc_rol_err; ?></span><br>
        <input type="submit" value="Agregar">
    </form>
</body>
</html>