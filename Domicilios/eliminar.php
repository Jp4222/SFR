<?php

require '..\config.php'; // Incluye el archivo de configuración para establecer la conexión a la base de datos.

// Verifica si se recibió un ID de usuario válido en la URL
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $Id_domicilio = $_GET['id']; // Obtiene el ID de usuario desde la URL

    // Prepara la consulta SQL para eliminar el usuario con el ID proporcionado
    $sql = "DELETE FROM tbldomicilios WHERE Id_domicilio = $Id_domicilio";

    // Ejecuta la consulta SQL
    if ($conn->query($sql) === TRUE) {
        // Si la eliminación se realizó con éxito, redirige de vuelta a la página principal o muestra un mensaje de éxito
        header("Location: index.php"); // Redirige a la página principal después de eliminar el registro
        exit(); // Termina el script para evitar que se ejecute más código
    } else {
        echo "Error al intentar eliminar el usuario: " . $conn->error; // Muestra un mensaje de error si la consulta falla
    }
} else {
    // Si no se proporcionó un ID de usuario válido en la URL, muestra un mensaje de error
    echo "ID de usuario no válido";
}
if(isset($_GET['deleted']) && $_GET['deleted'] == 'true') {
    echo '<script>alert("Usuario eliminado exitosamente.");</script>';
}
