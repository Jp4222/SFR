<?php

require '..\config.php'; 

// Define variables e inicializa con valores vacíos
$categoria = $nombre = $descripcion = $imagen = $precio = '';
$categoria_err = $nombre_err = $descripcion_err = $imagen_err = $precio_err = '';

// Procesa los datos del formulario cuando se envía el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Valida el campo categoría
    if (empty(trim($_POST["categoria"]))) {
        $categoria_err = "Por favor ingresa la categoría.";
    } else {
        $categoria = $conn->real_escape_string(trim($_POST["categoria"]));
    }
    
    // Valida el campo nombre
    if (empty(trim($_POST["nombre"]))) {
        $nombre_err = "Por favor ingresa el nombre.";
    } else {
        $nombre = $conn->real_escape_string(trim($_POST["nombre"]));
    }

    // Valida el campo descripción
    if (empty(trim($_POST["descripcion"]))) {
        $descripcion_err = "Por favor ingresa la descripción.";
    } else {
        $descripcion = $conn->real_escape_string(trim($_POST["descripcion"]));
    }

    // Verifica si se ha cargado una imagen
    if (!empty($_FILES["imagen"]["name"])) {
        $file_info = getimagesize($_FILES["imagen"]["tmp_name"]);
        $allowed_types = array(IMAGETYPE_JPEG);
        
        // Verifica si la imagen es de tipo JPEG
        if (in_array($file_info[2], $allowed_types)) {
            // Calcula el tamaño de la imagen en KB
            $image_size_kb = round($_FILES["imagen"]["size"] / 1024, 2);
            
            // Guarda el tamaño de la imagen en KB en la variable
            $imagen_size = $image_size_kb . " KB";
            
            // Guarda la imagen en la base de datos
            $imagen = $conn->real_escape_string(file_get_contents($_FILES["imagen"]["tmp_name"]));
        } else {
            $imagen_err = "Por favor sube una imagen en formato JPG.";
        }
    } else {
        $imagen_err = "Por favor selecciona una imagen.";
    }

    // Valida el campo precio
    if (empty(trim($_POST["precio"]))) {
        $precio_err = "Por favor ingresa el precio.";
    } else {
        $precio = $conn->real_escape_string(trim($_POST["precio"]));
    }
    
    // Verifica si no hay errores de entrada antes de insertar en la base de datos
    if (empty($categoria_err) && empty($nombre_err) && empty($descripcion_err) && empty($imagen_err) && empty($precio_err)) {
        // Query para insertar el nuevo usuario
        $sql = "INSERT INTO tblmenus (categoria, nombre, descripcion, imagen, precio) VALUES ('$categoria', '$nombre', '$descripcion', '$imagen', '$precio')";

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
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        <label for="categoria">Categoría:</label><br>
        <input type="text" id="categoria" name="categoria" value="<?php echo $categoria; ?>"><br>
        <span><?php echo $categoria_err; ?></span><br>
        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>"><br>
        <span><?php echo $nombre_err; ?></span><br>
        <label for="descripcion">Descripción:</label><br>
        <input type="text" id="descripcion" name="descripcion" value="<?php echo $descripcion; ?>"><br>
        <span><?php echo $descripcion_err; ?></span><br>
        <label for="imagen">Imagen:</label><br>
        <input type="file" id="imagen" name="imagen">
        <span><?php echo $imagen_err; ?></span><br>
        <label for="precio">Precio:</label><br>
        <input type="text" id="precio" name="precio" value="<?php echo $precio; ?>"><br>
        <span><?php echo $precio_err; ?></span><br>
        <input type="submit" value="Agregar">
    </form>
</body>
</html>
