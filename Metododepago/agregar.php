<?php

require '..\config.php'; 

// Define variables e inicializa con valores vacíos
$desc_pago= '';
$desc_pago_err = '';

// Procesa los datos del formulario cuando se envía el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["desc_pago"]))) {
        $desc_pago_err = "Por favor ingrese el nombre del metodo de pago";
    } else {
        $desc_pago = $conn->real_escape_string(trim($_POST["desc_pago"]));
    }
    // Verifica si no hay errores de entrada antes de insertar en la base de datos
    if (empty($desc_rol_err) ) {
        // Query para insertar el nuevo usuario
        $sql = "INSERT INTO tblmetodo_pago (desc_pago) VALUES ('$desc_pago')";

        // Ejecutar la consulta
        if ($conn->query($sql) === TRUE) {
            // Redirigir de vuelta a la página principal o a donde sea necesario
            header("Location: index.php");
            exit();
        } else {
            // Si hay un error, muestra un mensaje de error
            echo "Error al agregar metodo de pago: " . $conn->error;
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
        <label for="desc_rol">Metodo de pago:</label><br>
        <input type="text" id="desc_pago" name="desc_pago" value="<?php echo $desc_pago; ?>"><br>
        <span><?php echo $desc_pago_err; ?></span><br>
        <input type="submit" value="Agregar">
    </form>
</body>
</html>