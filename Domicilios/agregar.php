<?php

require '..\config.php'; 

// Define variables e inicializa con valores vacíos
$Id_usuario = $referencia_ubicacion = $dom_menu = $dom_pago = '';
$Id_usuario_err = $referencia_ubicacion_err = $dom_menu_err = $dom_pago_err = '';

// Procesa los datos del formulario cuando se envía el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Valida el campo nombres
    if (empty(trim($_POST["Id_usuario"]))) {
        $Id_usuario_err= "Por favor ingrese el Id del usuario.";
    } else {
        $Id_usuario = $conn->real_escape_string(trim($_POST["Id_usuario"]));
    }

    if (empty(trim($_POST["referencia_ubicacion"]))) {
        $referencia_ubicacion_err= "Por favor ingresa la referencia.";
    } else {
        $$referencia_ubicacion = $conn->real_escape_string(trim($_POST["referencia_ubicacion"]));
    }
    
    // Valida el campo apellidos
    if (empty(trim($_POST["dom_menu"]))) {
        $dom_menu_err = "Por favor ingresa el menu.";
    } else {
        $dom_menu = $conn->real_escape_string(trim($_POST["dom_menu"]));
    }

    // Valida el campo correo
    if (empty(trim($_POST["dom_pago"]))) {
        $dom_pago_err = "Por favor ingresa el metodo de pago.";
    } else {
        $dom_pago = $conn->real_escape_string(trim($_POST["dom_pago"]));
    }

    // Verifica si no hay errores de entrada antes de insertar en la base de datos
    if (empty($Id_usuario_err) && empty($referencia_ubicacion_err) && empty($dom_menu_err) && empty($dom_pago_err) ) {
        // Query para insertar el nuevo usuario
        $sql = "INSERT INTO tbldomicilios (Id_usuario, referencia_ubicacion, dom_menu, dom_pago) VALUES ('$Id_usuario','$referencia_ubicacion', '$dom_menu', '$dom_pago')";

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
    <title>Agregar Domicilio</title>
</head>
<body>
    <h2>Agregar Domicilio</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="Id_usuario">Id:</label><br>
        <input type="text" id="Id_usuario" name="Id_usuario" value="<?php echo $Id_usuario; ?>"><br>
        <span><?php echo $Id_usuario_err; ?></span><br>
        <label for="apellidos">Referencia de ubicacion:</label><br>
        <input type="text" id="referencia_ubicacion" name="referencia_ubicacion" value="<?php echo $referencia_ubicacion; ?>"><br>
        <span><?php echo $referencia_ubicacion_err; ?></span><br>
        <label for="correo">Menu:</label><br>
        <input type="text" id="dom_menu" name="dom_menu" value="<?php echo $dom_menu; ?>"><br>
        <span><?php echo $dom_menu_err; ?></span><br>
        <label for="dom_pago">Rol:</label><br>
        <select id="dom_pago" name="dom_pago">
    <option value="">Seleccione el Metodo de pago</option>
    <option value='1' >Efectivo</option>
    <option value='2' >Pse</option>
</select>
        <span><?php echo $dom_pago_err; ?></span><br><br>
        <input type="submit" value="Agregar">
    </form>
</body>
</html>