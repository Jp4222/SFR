<?php

require '..\config.php'; 

// Verifica si se ha enviado un ID de usuario para editar
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $id_usuario = $conn->real_escape_string($_GET['id']);

    // Verifica si se ha enviado un formulario para actualizar el usuario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recupera los datos del formulario
       
        $categoria = $conn->real_escape_string($_POST['categoria']); 
        $nombre = $conn->real_escape_string($_POST['nombre']);
        $descripcion = $conn->real_escape_string($_POST['descripcion']);
        $precio = $conn->real_escape_string($_POST['precio']);

        // Query para actualizar el usuario
        $sql = "UPDATE tblmenus SET categoria='$categoria', nombre='$nombre', descripcion='$descripcion', precio='$precio' WHERE Id_menu='$Id_menu'";

        // Ejecutar la consulta
        if ($conn->query($sql) === TRUE) {
            // Redirigir de vuelta a la página principal o a donde sea necesario
            header("Location: index.php");
            exit();
        } else {
            // Si hay un error, muestra un mensaje de error
            echo "Error al actualizar usuario: " . $conn->error;
        }
    }

    // Query para obtener los datos del usuario
    $sql = "SELECT * FROM tblmenu WHERE Id_menu= 'Id_menu'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Obtener los datos del usuario
        $row = $result->fetch_assoc();
        $categoria = $row['categoria'];
        $nombre = $row['nombre'];
        $descripcion = $row['descripcion'];
        $precio = $row['precio'];
    } else {
        // Si no se encuentra el usuario, redirige a la página principal
        header("Location: index.php");
        exit();
    }

} else {
    // Si no se envió un ID de usuario válido, redirige a la página principal
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
    <title>Editar Usuario</title>
</head>
<body>
    <h2>Editar Usuario</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $id_usuario; ?>" method="post">
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
    </form>
</body>
</html>