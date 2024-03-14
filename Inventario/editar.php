<?php

require '..\config.php'; 

// Verifica si se ha enviado un ID de usuario para editar
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $Id_inventario = $conn->real_escape_string($_GET['id']);

    // Verifica si se ha enviado un formulario para actualizar el usuario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recupera los datos del formulario
        $reg_entrada = $conn->real_escape_string($_POST['reg_entrada']);
        $reg_salida= $conn->real_escape_string($_POST['reg_salida']);
        $Descripcion = $conn->real_escape_string($_POST['Descripcion']);
        $Novedades = $conn->real_escape_string($_POST['Novedades']);
        $Cantidad = $conn->real_escape_string($_POST['Cantidad']);
        // Query para actualizar el usuario
        $sql = "UPDATE tblinventario SET reg_entrada='$reg_entrada', reg_salida='$reg_salida', Descripcion='$Descripcion', Novedades='$Novedades', Cantidad='$Cantidad' WHERE id_inventario='$Id_inventario'";

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
    $sql = "SELECT * FROM tblinventario WHERE id_inventario = '$Id_inventario'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Obtener los datos del usuario
        $row = $result->fetch_assoc();
        $reg_entrada= $row['reg_entrada'];
        $reg_salida = $row['reg_salida'];
        $Descripcion = $row['Descripcion'];
        $Novedades = $row['Novedades'];
        $Cantidad = $row['Cantidad'];
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
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $Id_inventario; ?>" method="post">
        <label for="reg_entrada">Registro Entrada:</label><br>
        <input type="datetime" id="reg_entrada" name="reg_entrada" value="<?php echo $reg_entrada; ?>"><br>
        <label for="reg_salida">Registro Salida:</label><br>
        <input type="datetime" id="reg_salida" name="reg_salida" value="<?php echo $reg_salida; ?>"><br>
        <label for="Descripcion">Descripcion:</label><br>
        <input type="text" id="cDescripcion name="Descripcion" value="<?php echo $Descripcion; ?>"><br>
        <label for="Novedades">Novedades:</label><br>
        <input type="text" id="Novedades" name="Novedades" value="<?php echo $Novedades; ?>"><br>
        <label for="Cantidad">Cantidad:</label><br>
        <input type="text" id="Cantidad" name="Cantidad" value="<?php echo $Cantidad; ?>"><br><br>
        <input type="submit" value="Actualizar">
    </form>
</body>
</html>