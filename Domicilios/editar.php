<?php

require '..\config.php'; 

// Verifica si se ha enviado un ID de usuario para editar
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $Id_venta = $conn->real_escape_string($_GET['id']);

    // Verifica si se ha enviado un formulario para actualizar el usuario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recupera los datos del formulario
        $ven_usuario = $conn->real_escape_string($_POST['ven_usuario']);
        $id_menu = $conn->real_escape_string($_POST['id_menu']);
        $fecha = $conn->real_escape_string($_POST['fecha']);
        $cantidad = $conn->real_escape_string($_POST['cantidad']);
        $direccion = $conn->real_escape_string($_POST['direccion']);
        $precio_unitario = $conn->real_escape_string($_POST['precio_unitario']);
        $total = $conn->real_escape_string($_POST['total']);
        $metodo_pago = $conn->real_escape_string($_POST['metodo_pago']);

        $sql = "UPDATE tbldomicilios SET ven_usuario='$ven_usuario', id_menu='$id_menu', fecha='$fecha', cantidad='$cantidad', direccion='$direccion', precio_unitario='$precio_unitario', total='$total', metodo_pago='$metodo_pago'   WHERE Id_venta='$Id_venta'";

        if ($conn->query($sql) === TRUE) {
            header("Location: index.php");
            exit();
        } else {
            // Si hay un error, muestra un mensaje de error
            echo "Error al actualizar el domicilio: " . $conn->error;
        }
    }

    $sql = "SELECT * FROM tbldomicilios WHERE Id_venta = '$Id_venta'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $ven_usuario = $row['ven_usuario'];
        $id_menu = $row['id_menu'];
        $fecha = $row['fecha'];
        $cantidad = $row['cantidad'];
        $direccion = $row['direccion'];
        $precio_unitario = $row['precio_unitario'];
        $total = $row['total'];
        $metodo_pago = $row['metodo_pago'];
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
    <title>Editar Domicilio</title>
</head>
<body>
    <h2>Editar Domicilio</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $Id_venta; ?>" method="post">
        <label for="ven_usuario">Id usuario</label><br>
        <input type="number" id="ven_usuario" name="ven_usuario" value="<?php echo $ven_usuario; ?>"><br>

        <label for="id_menu">Menu:</label><br>
            <select id="id_menu" name="id_menu">
            <option value="">Seleccione el menu</option>
            <option value='1' >Sashimi de salmón</option>
            <option value='2' >California Roll</option>
            <option value='3' >Nigiri de atún</option>
            <option value='4' >Dragon Roll</option>
            </select>

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
            <option value='1' >Efectivo</option>
        </select>

    <input type="submit" value="Actualizar">
    </form>
</body>
</html>