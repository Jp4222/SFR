<?php

require '..\config.php'; 

// Verifica si se ha enviado un ID de usuario para editar
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $Id_usuario = $conn->real_escape_string($_GET['id']);

    // Verifica si se ha enviado un formulario para actualizar el usuario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recupera los datos del formulario
        $nombres = $conn->real_escape_string($_POST['nombres']);
        $apellidos = $conn->real_escape_string($_POST['apellidos']);
        $correo = $conn->real_escape_string($_POST['correo']);
        $direccion = $conn->real_escape_string($_POST['direccion']);
        $contraseña = $conn->real_escape_string($_POST['contraseña']);
        $telefono = $conn->real_escape_string($_POST['telefono']);
        $rol = $conn->real_escape_string($_POST['us_rol']);

        // Query para actualizar el usuario
        $sql = "UPDATE tblusuarios SET nombres='$nombres', apellidos='$apellidos', correo='$correo', direccion='$direccion', contraseña='$contraseña',telefono='$telefono',us_rol='$rol' WHERE Id_usuario='$id_usuario'";

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
    $sql = "SELECT * FROM tblusuarios WHERE Id_usuario = '$Id_usuario'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Obtener los datos del usuario
        $row = $result->fetch_assoc();
        $nombres = $row['nombres'];
        $apellidos = $row['apellidos'];
        $correo = $row['correo'];
        $direccion = $row['direccion'];
        $contraseña = $row['contraseña'];
        $telefono = $row['telefono'];
        $rol = $row['us_rol'];
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
    <title>Editar Usuario</title>
</head>
<body>
    <h2>Editar Usuario</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $Id_usuario; ?>" method="post">
        <label for="nombres">Nombres:</label><br>
        <input type="text" id="nombres" name="nombres" value="<?php echo $nombres; ?>"><br>
        <label for="apellidos">Apellidos:</label><br>
        <input type="text" id="apellidos" name="apellidos" value="<?php echo $apellidos; ?>"><br>
        <label for="correo">Correo:</label><br>
        <input type="text" id="correo" name="correo" value="<?php echo $correo; ?>"><br>
        <label for="direccion">Dirección:</label><br>
        <input type="text" id="direccion" name="direccion" value="<?php echo $direccion; ?>"><br>
        <label for="telefono">Teléfono:</label><br>
        <input type="text" id="telefono" name="telefono" value="<?php echo $telefono; ?>"><br><br>
        
        <select id="us_rol" name="us_rol">
            <option value='1' >Administrador</option>
            <option value='2' >Usuario</option>
        </select>
        
        <input type="submit" value="Actualizar">
    </form>
</body>
</html>