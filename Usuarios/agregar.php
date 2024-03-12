<?php

require '..\config.php'; 

// Define variables e inicializa con valores vacíos
$nombres = $apellidos = $correo = $direccion =$contraseña = $telefono = $rol = '';
$nombres_err = $apellidos_err = $correo_err = $direccion_err = $contraseña_err = $telefono_err = $rol_err = '';

// Procesa los datos del formulario cuando se envía el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Valida el campo nombres
    if (empty(trim($_POST["nombres"]))) {
        $nombres_err = "Por favor ingresa los nombres.";
    } else {
        $nombres = $conn->real_escape_string(trim($_POST["nombres"]));
    }
    
    // Valida el campo apellidos
    if (empty(trim($_POST["apellidos"]))) {
        $apellidos_err = "Por favor ingresa los apellidos.";
    } else {
        $apellidos = $conn->real_escape_string(trim($_POST["apellidos"]));
    }

    // Valida el campo correo
    if (empty(trim($_POST["correo"]))) {
        $correo_err = "Por favor ingresa el correo.";
    } else {
        $correo = $conn->real_escape_string(trim($_POST["correo"]));
    }

    // Valida el campo dirección
    if (empty(trim($_POST["direccion"]))) {
        $direccion_err = "Por favor ingresa la dirección.";
    } else {
        $direccion = $conn->real_escape_string(trim($_POST["direccion"]));
    }
    if (empty(trim($_POST["contraseña"]))) {
        $contraseña_err = "Por favor ingresa la ccontraseña.";
    } else {
        $contraseña = $conn->real_escape_string(trim($_POST["contraseña"]));
    }

    // Valida el campo teléfono
    if (empty(trim($_POST["telefono"]))) {
        $telefono_err = "Por favor ingresa el teléfono.";
    } else {
        $telefono = $conn->real_escape_string(trim($_POST["telefono"]));
    }

    if (empty(trim($_POST["us_rol"]))) {
        $rol_err = "Por favor ingresa el rol.";
    } else {
        $rol = $conn->real_escape_string(trim($_POST["us_rol"]));
    }

    // Verifica si no hay errores de entrada antes de insertar en la base de datos
    if (empty($nombres_err) && empty($apellidos_err) && empty($correo_err) && empty($direccion_err) && empty($contraseña_err) && empty($telefono_err) && empty($rol_err) ) {
        // Query para insertar el nuevo usuario
        $sql = "INSERT INTO tblusuarios (nombres, apellidos, correo, direccion, contraseña, telefono, us_rol) VALUES ('$nombres', '$apellidos', '$correo', '$direccion','$contraseña', '$telefono','$rol')";

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
        <label for="nombres">Nombres:</label><br>
        <input type="text" id="nombres" name="nombres" value="<?php echo $nombres; ?>"><br>
        <span><?php echo $nombres_err; ?></span><br>
        <label for="apellidos">Apellidos:</label><br>
        <input type="text" id="apellidos" name="apellidos" value="<?php echo $apellidos; ?>"><br>
        <span><?php echo $apellidos_err; ?></span><br>
        <label for="correo">Correo:</label><br>
        <input type="text" id="correo" name="correo" value="<?php echo $correo; ?>"><br>
        <span><?php echo $correo_err; ?></span><br>
        <label for="direccion">Dirección:</label><br>
        <input type="text" id="direccion" name="direccion" value="<?php echo $direccion; ?>"><br>
        <span><?php echo $direccion_err; ?></span><br>
        <label for="contraseña">Contraseña:</label><br>
        <input type="password" id="contraseña" name="contraseña" value="<?php echo $contraseña; ?>"><br>
        <span><?php echo $contraseña_err; ?></span><br>
        <label for="telefono">Teléfono:</label><br>
        <input type="text" id="telefono" name="telefono" value="<?php echo $telefono; ?>"><br>
        <span><?php echo $telefono_err; ?></span><br><br>
        <label for="us_rol">Rol:</label><br>
        <select id="us_rol" name="us_rol">
    <option value="">Seleccione el rol</option>
    <option value='1' >Administrador</option>
    <option value='2' >Usuario</option>
</select>
        <span><?php echo $rol_err; ?></span><br>
        <input type="submit" value="Agregar">
    </form>
</body>
</html>