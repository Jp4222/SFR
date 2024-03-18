<?php

require '..\config.php'; 

// Verifica si se ha enviado un ID de usuario para editar
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $Id_domicilio = $conn->real_escape_string($_GET['id']);

    // Verifica si se ha enviado un formulario para actualizar el usuario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recupera los datos del formulario
        $nombresapellidos = $conn->real_escape_string($_POST['nombresapellidos']);
        $direccion = $conn->real_escape_string($_POST['direccion']);
        $telefono = $conn->real_escape_string($_POST['telefono']);
        $referencia_ubicacion = $conn->real_escape_string($_POST['referencia_ubicacion']);
        $dom_menu = $conn->real_escape_string($_POST['dom_menu']);
        $dom_pago = $conn->real_escape_string($_POST['dom_pago']);

        // Query para actualizar el usuario
        $sql = "UPDATE tbldomicilios SET nombresapellidos='$nombresapellidos', direccion='$direccion', telefono='$telefono', referencia_ubicacion='$referencia_ubicacion', dom_menu='$dom_menu', dom_pago='$dom_pago' WHERE Id_domicilio='$Id_domicilio'";

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
    $sql = "SELECT * FROM tbldomicilios WHERE Id_domicilio = '$Id_domicilio'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Obtener los datos del usuario
        $row = $result->fetch_assoc();
        $nombresapellidos = $row['nombresapellidos'];
        $direccion = $row['direccion'];
        $telefono = $row['telefono'];
        $referencia_ubicacion = $row['referencia_ubicacion'];
        $dom_menu = $row['dom_menu'];
        $dom_pago = $row['dom_pago'];
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
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $Id_domicilio; ?>" method="post">
        <label for="nombresapellidos">Nombre y Apellidos:</label><br>
        <input type="text" id="nombresapellidos" name="nombresapellidos" value="<?php echo $nombresapellidos; ?>"><br>
        <label for="direccion">Direccion:</label><br>
        <input type="text" id="direccion" name="direccion" value="<?php echo $direccion; ?>"><br>
        <label for="telefono">Telefono:</label><br>
        <input type="tel" id="telefono" name="telefono" value="<?php echo $telefono; ?>"><br>
        <label for="referencia_ubicacion">Referencia Ubicacion:</label><br>
        <input type="text" id="referencia_ubicacion" name="referencia_ubicacion" value="<?php echo $referencia_ubicacion; ?>"><br>
        <label for="dom_menu">Menu:</label><br>
        <input type="text" id="dom_menu" name="dom_menu" value="<?php echo $dom_menu; ?>"><br>
        <label for="dom_pago">Metodo de pago:</label><br>
        <select id="dom_pago" name="dom_pago">
    <option value="">Seleccione el metodo de pago</option>
    <option value='1' >Efectivo</option>
    <option value='2' >Pse</option>
    </select>
    <input type="submit" value="Actualizar">
    </form>
</body>
</html>