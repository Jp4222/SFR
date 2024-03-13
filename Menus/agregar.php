<?php

require '..\config.php'; 

// Define variables e inicializa con valores vacíos
$categoria = $nombre = $descripcion = $precio = '';
$categoria_err = $nombre_err = $descripcion_err = $precio_err = '';

// Procesa los datos del formulario cuando se envía el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Valida el campo nombres
    if (empty(trim($_POST["categoria"]))) {
        $categoria_err = "Por favor ingresa la categoria.";
    } else {
        $categoria = $conn->real_escape_string(trim($_POST["categoria"]));
    }
    
    // Valida el campo apellidos
    if (empty(trim($_POST["nombre"]))) {
        $nombre_err = "Por favor ingresa los nombres.";
    } else {
        $nombre = $conn->real_escape_string(trim($_POST["nombre"]));
    }

    // Valida el campo correo
    if (empty(trim($_POST["descripcion"]))) {
        $descripcion_err = "Por favor ingresa la descripcion.";
    } else {
        $descripcion = $conn->real_escape_string(trim($_POST["descripcion"]));
    }

    // Valida el campo precio
    if (empty(trim($_POST["precio"]))) {
        $precio_err = "Por favor ingresa la precio.";
    } else {
        $precio = $conn->real_escape_string(trim($_POST["precio"]));
    }
    
    // Verifica si no hay errores de entrada antes de insertar en la base de datos
    if (empty($categoria_err) && empty($nombre_err) && empty($descripcion_err) && empty($precio_err) ) {
        // Query para insertar el nuevo usuario
        $sql = "INSERT INTO tblmenus (categoria, nombre, descripcion, precio) VALUES ('$categoria', '$nombre', '$descripcion', '$precio')";

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
    <center><h2>Agregar Usuario</h2></center>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="categoria">Categoria:</label><br>
        <input type="text" id="categoria" name="categoria" value="<?php echo $categoria; ?>"><br>
        <span><?php echo $categoria_err; ?></span><br>
        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>"><br>
        <span><?php echo $nombre_err; ?></span><br>
        <label for="descripcion">Descripcion:</label><br>
        <input type="text" id="descripcion" name="descripcion" value="<?php echo $descripcion; ?>"><br>
        <span><?php echo $descripcion_err; ?></span><br>
        <label for="precio">Precio:</label><br>
        <input type="text" id="precio" name="precio" value="<?php echo $precio; ?>"><br>
        <span><?php echo $precio_err; ?></span><br>
        <input type="submit" value="Agregar">
    </form>
</body>
</html>