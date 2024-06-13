<?php
session_start();
$correo = $_POST['correo'];
$contraseña = $_POST['contraseña'];

require '..\config.php'; // Asegúrate de que este archivo contenga la configuración de la base de datos y la conexión

$consulta = "SELECT * FROM tblUsuarios WHERE correo='$correo' AND contraseña='$contraseña'";
$resultado = mysqli_query($conn, $consulta);
$filas = mysqli_fetch_array($resultado);

if ($filas) { // Si se encontró un usuario con el correo y contraseña proporcionados
    $_SESSION['Id_usuario'] = $filas['Id_usuario']; // Guarda el ID del usuario en sesión
    $_SESSION['nombres'] = $filas['nombres']; // Guarda el nombre del usuario en sesión
    // Resto de tu código de redireccionamiento y manejo de roles
} else {
    echo "<h1 class='bad'>ERROR EN LA AUTENTICACIÓN</h1>";
    include("index.html");
}

mysqli_free_result($resultado);
mysqli_close($conn);


