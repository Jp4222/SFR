<?php

require '..\config.php'; 

// Define variables e inicializa con valores vacíos
$reg_entrada = $reg_salida = $Descripcion = $Novedades =$Cantidad = '';
$reg_entrada_err = $reg_salida_err = $Descripcion_err = $Novedades_err = $Cantidad_err = '';

// Procesa los datos del formulario cuando se envía el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["reg_entrada"]))) {
        $reg_entrada_err = "Por favor ingresa la entrada.";
    } else {
        $reg_entrada = $conn->real_escape_string(trim($_POST["reg_entrada"]
    
    
    ));
    }
    if (empty(trim($_POST["reg_salida"]))) {
        $reg_salida_err = "Por favor ingresa la salida.";
    } else {
        $reg_salida = $conn->real_escape_string(trim($_POST["reg_salida"]));
    }
    if (empty(trim($_POST["Descripcion"]))) {
        $Descripcion_err = "Por favor ingresa la descripcion.";
    } else {
        $Descripcion = $conn->real_escape_string(trim($_POST["Descripcion"]));
    }
    if (empty(trim($_POST["Novedades"]))) {
        $Novedades_err = "Por favor ingresa la Novedades.";
    } else {
        $Novedades = $conn->real_escape_string(trim($_POST["Novedades"]));
    }
    if (empty(trim($_POST["Cantidad"]))) {
        $Cantidad_err = "Por favor ingresa el Cantidad.";
    } else {
        $Cantidad = $conn->real_escape_string(trim($_POST["Cantidad"]));
    }
    // Verifica si no hay errores de entrada antes de insertar en la base de datos
    if (empty($reg_entrada_err) && empty($reg_salida_err) && empty($Descripcion_err) && empty($Novedades_err) && empty($Cantidad_err)) {
        // Query para insertar el nuevo usuario
        $sql = "INSERT INTO tblinventario ( reg_entrada, reg_salida, Descripcion, Novedades, Cantidad) VALUES ('$reg_entrada', '$reg_salida', '$Descripcion', '$Novedades','$Cantidad')";

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
    <link rel="stylesheet" type="text/css" href="..\style2.css">
    <title>Agregar Usuario</title>
</head>
<body>
    <h2>Agregar Usuario</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="reg_entrada">Registro Entrada:</label><br>
        <input type="datetime-local" id="reg_entrada" name="reg_entrada" value="<?php echo $reg_entrada; ?>"><br>
        <span><?php echo $reg_entrada_err; ?></span><br>
        <label for="reg_salida">Registro Salida:</label><br>
        <input type="datetime-local" id="reg_salida" name="reg_salida" value="<?php echo $reg_salida; ?>"><br>
        <span><?php echo $reg_salida_err; ?></span><br>
        <label for="Descripcion">Descripcion:</label><br>
        <input type="text" id="Descripcion" name="Descripcion" value="<?php echo $Descripcion; ?>"><br>
        <span><?php echo $Descripcion_err; ?></span><br>
        <label for="Novedades">Novedades:</label><br>
        <input type="text" id="Novedades" name="Novedades" value="<?php echo $Novedades; ?>"><br>
        <span><?php echo $Novedades_err; ?></span><br>
        <label for="Cantidad">Cantidad:</label><br>
        <input type="number" id="Cantidad" name="Cantidad" value="<?php echo $Cantidad; ?>"><br>
        <span><?php echo $Cantidad_err; ?></span><br>
        <input type="submit" value="Agregar">
    </form>
</body>
</html>