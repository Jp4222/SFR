<?php

require_once "../config.php"; 
// Define variables e inicializa con valores vacíos
$ven_usuario = $id_menu = $fecha = $cantidad = $direccion = $precio_unitario = $total= $metodo_pago= '';
$ven_usuario_err = $id_menu_err = $fecha_err = $cantidad_err = $direccion_err = $precio_unitario_err = $total_err = $metodo_pago_err ='';

// Procesa los datos del formulario cuando se envía el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (empty(trim($_POST["ven_usuario"]))) {
        $ven_usuario_err= "Por favor ingrese su nombre y apellido";
    } else {
        $ven_usuario = $conn->real_escape_string(trim($_POST["ven_usuario"]));
    }   


    if (empty(trim($_POST["id_menu"]))) {
        $id_menu_err= "Por favor ingrese la Menu.";
    } else {
        $id_menu = $conn->real_escape_string(trim($_POST["id_menu"]));
    }

    if (empty(trim($_POST["cantidad"]))) {
        $cantidad_err= "Por favor ingresa la referencia.";
    } else {
        $cantidad = $conn->real_escape_string(trim($_POST["cantidad"]));
    }
    
    // Valida el campo apellidos
    if (empty(trim($_POST["direccion"]))) {
        $direccion_err = "Por favor ingresa el menu.";
    } else {
        $direccion = $conn->real_escape_string(trim($_POST["direccion"]));
    }

    // Valida el campo correo
    if (empty(trim($_POST["precio_unitario"]))) {
        $dom_pago_err = "Por favor ingresa el metodo de pago.";
    } else {
        $precio_unitario = $conn->real_escape_string(trim($_POST["precio_unitario"]));
    }

    if (empty(trim($_POST["fecha"]))) {
        $fecha_err = "Por favor ingresa el fecha.";
    } else {
        $fecha = $conn->real_escape_string(trim($_POST["fecha"]));
    }

    if (empty(trim($_POST["total"]))) {
        $total_err = "Por favor ingresa el fecha.";
    } else {
        $total = $conn->real_escape_string(trim($_POST["total"]));
    }

    if (empty(trim($_POST["metodo_pago"]))) {
        $metodo_pago_err = "Por favor ingresa el fecha.";
    } else {
        $metodo_pago = $conn->real_escape_string(trim($_POST["metodo_pago"]));
    }
    // Verifica si no hay errores de entrada antes de insertar en la base de datos
    if (empty($ven_usuario_err)  && empty($id_menu_err)  && empty($fecha_err) && empty($cantidad_err) && empty($direccion_err) && empty($precio_unitario_err) && empty($total_err)&& empty($metodo_pago_err)) {
        // Query para insertar el nuevo usuario
        $sql = "INSERT INTO tbldomicilios (ven_usuario ,id_menu, fecha, cantidad, direccion, precio_unitario, total, metodo_pago ) VALUES ('$ven_usuario','$id_menu','$fecha','$cantidad', '$direccion', '$precio_unitario' , '$total' , '$metodo_pago')";

        // Ejecutar la consulta
        if ($conn->query($sql) === TRUE) {
            // Redirigir de vuelta a la página principal o a donde sea necesario
            echo "<script language='JavaScript'>alert('Su pedido fue realizado con exito.');
            location.assign('index.php');
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
        <label for="ven_usuario">Id del usuario</label><br>
        <input type="number" id="ven_usuario" name="ven_usuario" value="<?php echo $ven_usuario; ?>"><br>
        <span><?php echo $ven_usuario_err; ?></span><br>
        
        <label for="id_menu">Menu:</label><br>
            <select id="id_menu" name="id_menu">
            <option value="">Seleccione el menu</option>
            <option value='1' >Sashimi de salmón</option>
            <option value='2' >California Roll</option>
            <option value='3' >Nigiri de atún</option>
            <option value='4' >Dragon Roll</option>
            </select>
        <span><?php echo $id_menu_err; ?></span><br>

        <label for="fecha">Fecha:</label><br>
        <input type="date" id="fecha" name="fecha" value="<?php echo $fecha; ?>"><br>
        <span><?php echo $fecha_err ?> </span><br>

        <label for="cantidad">Cantidad:</label><br>
        <input type="number" id="cantidad" name="cantidad" value="<?php echo $cantidad; ?>"><br>
        <span><?php echo $cantidad_err; ?></span><br>

        <label for="direccion">Direccion:</label><br>
        <input type="text" id="direccion" name="direccion" value="<?php echo $direccion; ?>"><br>
        <span><?php echo $direccion_err; ?></span><br>

        <label for="precio_unitario">Precio por unidad:</label><br>
        <input type="number" id="precio_unitario" name="precio_unitario" value="<?php echo $precio_unitario; ?>"><br>
        <span><?php echo $precio_unitario_err; ?></span><br>

        <label for="total">Total:</label><br>
        <input type="text" id="total" name="total" value="<?php echo $total; ?>"><br>
        <span><?php echo $total_err; ?></span><br>

        <label for="metodo_pago">Metodo de pago:</label><br>
        <select id="metodo_pago" name="metodo_pago">
            <option value="">Seleccione el Metodo de pago</option>
            <option value='1' >Efectivo</option>
        </select>
    
        <input type="submit" value="Agregar">
    </form>
</body>
</html>