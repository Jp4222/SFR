<?php

require '..\config.php'; 

// Verifica si se ha enviado un ID de usuario para editar
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $Id_menu = $conn->real_escape_string($_GET['id']);

    // Verifica si se ha enviado un formulario para actualizar el usuario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recupera los datos del formulario
        $categoria = $conn->real_escape_string($_POST['categoria']); 
        $nombre = $conn->real_escape_string($_POST['nombre']);
        $descripcion = $conn->real_escape_string($_POST['descripcion']);
        $precio = $conn->real_escape_string($_POST['precio']);

        // Validar y procesar la imagen si se ha cargado
        if (!empty($_FILES["imagen"]["name"])) {
            $file_info = $_FILES["imagen"];
            
            // Verifica si no hubo errores al cargar la imagen
            if ($file_info["error"] == UPLOAD_ERR_OK) {
                // Calcula el tamaño de la imagen en KB
                $image_size_kb = round($file_info["size"] / 1024, 2);

                // Define el tamaño máximo permitido en KB
                $max_image_size_kb = 200; // Cambia este valor según tus necesidades

                // Verifica si el tamaño de la imagen es menor o igual al tamaño máximo permitido
                if ($image_size_kb <= $max_image_size_kb) {
                    // Procesa y guarda la imagen
                    $imagen = $conn->real_escape_string(file_get_contents($file_info["tmp_name"]));
                } else {
                    $imagen_err = "La imagen es demasiado grande. Por favor, sube una imagen de tamaño máximo $max_image_size_kb KB.";
                }
            } else {
                $imagen_err = "Error al cargar la imagen. Por favor, inténtalo de nuevo.";
            }
        }

        // Query para actualizar el usuario
        $sql = "UPDATE tblmenus SET categoria='$categoria', nombre='$nombre', descripcion='$descripcion', precio='$precio' WHERE Id_menu='$Id_menu'";

        if ($conn->query($sql) === TRUE) {
            header("Location: index.php");
            exit();
        } else {
            echo "Error al actualizar usuario: " . $conn->error;
        }
    }

    $sql = "SELECT * FROM tblmenus WHERE Id_menu = '$Id_menu'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $categoria = $row['categoria'];
        $nombre = $row['nombre'];
        $descripcion = $row['descripcion'];
        $imagen = $row['imagen'];
        $precio = $row['precio'];
    } else {
        header("Location: index.php");
        exit();
    }

} else {
    header("Location: index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="..\style2.css">
    <title>Editar Menu</title>
</head>
<body>
    <h2>Editar Usuario</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) .'?id=' . $Id_menu; ?>" method="post" enctype="multipart/form-data">
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
        <label for="imagen">Imagen:</label><br>
        <input type="file" id="imagen" name="imagen">
        <span><?php echo $imagen_err; ?></span><br>
        <input type="submit" value="Actualizar">
    </form>
</body>
</html>