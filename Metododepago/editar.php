<?php

require '..\config.php'; 

// Verifica si se ha enviado un ID de usuario para editar
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $Id_pago = $conn->real_escape_string($_GET['id']);

    // Verifica si se ha enviado un formulario para actualizar el usuario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recupera los datos del formulario
        $desc_rol = $conn->real_escape_string($_POST['desc_pago']);

        // Query para actualizar el usuario
        $sql = "UPDATE tblmetodo_pago SET desc_pago ='$desc_rol' WHERE Id_rol='$Id_pago'";

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
    $sql = "SELECT * FROM tblmetodo_pago WHERE Id_pago = '$Id_pago'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Obtener los datos del usuario
        $row = $result->fetch_assoc();
        $desc_pago = $row['desc_pago'];
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
    <title>Editar Metodos de Pago</title>
</head>
<body>
    <center><h2>Editar Usuario</h2></center>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $Id_pago; ?>" method="post">
        <label for="desc_pago">Metodo de pago:</label><br>
        <input type="text" id="desc_pago" name="desc_pago" value="<?php echo $desc_pago; ?>"><br>
        <input type="submit" value="Actualizar">
    </form>
</body>
</html>