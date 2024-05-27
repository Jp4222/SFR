<?php

require_once "../config.php"; 
// Define variables e inicializa con valores vacíos
$nombresapellidos = $direccion = $telefono = $referencia_ubicacion = $dom_menu = $dom_pago = '';
$nombresapellidos_err = $direccion_err = $telefono_err = $referencia_ubicacion_err = $dom_menu_err = $dom_pago_err = '';

// Procesa los datos del formulario cuando se envía el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (empty(trim($_POST["nombresapellidos"]))) {
        $nombresapellidos_err= "Por favor ingrese su nombre y apellido";
    } else {
        $nombresapellidos = $conn->real_escape_string(trim($_POST["nombresapellidos"]));
    }   


    if (empty(trim($_POST["direccion"]))) {
        $direccion_err= "Por favor ingrese la direccion.";
    } else {
        $direccion = $conn->real_escape_string(trim($_POST["direccion"]));
    }

    if (empty(trim($_POST["referencia_ubicacion"]))) {
        $referencia_ubicacion_err= "Por favor ingresa la referencia.";
    } else {
        $referencia_ubicacion = $conn->real_escape_string(trim($_POST["referencia_ubicacion"]));
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

    if (empty(trim($_POST["telefono"]))) {
        $telefono = "Por favor ingresa el telefono.";
    } else {
        $telefono = $conn->real_escape_string(trim($_POST["telefono"]));
    }

    // Verifica si no hay errores de entrada antes de insertar en la base de datos
    if (empty($nombresapellidos_err)  && empty($direccion_err)  && empty($telefono_err) && empty($referencia_ubicacion_err) && empty($dom_menu_err) && empty($dom_pago_err) ) {
        // Query para insertar el nuevo usuario
        $sql = "INSERT INTO tblDomicilios (nombresapellidos ,direccion, telefono, referencia_ubicacion, dom_menu, dom_pago) VALUES ('$nombresapellidos','$direccion','$telefono','$referencia_ubicacion', '$dom_menu', '$dom_pago')";

        // Ejecutar la consulta
        if ($conn->query($sql) === TRUE) {
            // Redirigir de vuelta a la página principal o a donde sea necesario
            echo "<script language='JavaScript'>alert('Su pedido fue realizado con exito.');
            location.assign('../index.php');
            </script>";
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
    <title>Agregar Domicilio</title>
</head>
<body>
    <h2>Agregar Domicilio</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="nombresapellidos">Nombre y Apellido:</label><br>
        <input type="text" id="nombresapellidos" name="nombresapellidos" value="<?php echo $nombresapellidos; ?>"><br>
        <span><?php echo $direccion_err; ?></span><br>
        <label for="direccion">Direccion:</label><br>
        <input type="text" id="direccion" name="direccion" value="<?php echo $direccion; ?>"><br>
        <span><?php echo $direccion_err; ?></span><br>
        <label for="telefono">Telefono:</label><br>
        <input type="tel" id="telefono" name="telefono" value="<?php echo $telefono; ?>"><br>
        <span><?php echo $telefono_err ?> </span><br>
        <label for="referencia_ubicacion">Referencia de ubicacion:</label><br>
        <input type="text" id="referencia_ubicacion" name="referencia_ubicacion" value="<?php echo $referencia_ubicacion; ?>"><br>
        <span><?php echo $referencia_ubicacion_err; ?></span><br>
            <label for="dom_menu">Menu:</label><br>
            <select id="dom_menu" name="dom_menu">
            <option value="">Seleccione el menu</option>
            <option value='1' >Sashimi de salmón</option>
            <option value='2' >California Roll</option>
            <option value='3' >Nigiri de atún</option>
            <option value='4' >Dragon Roll</option>
            </select>
        <span><?php echo $dom_menu_err; ?></span><br>
        <label for="dom_pago">Metodo de pago:</label><br>
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