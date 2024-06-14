<?php
$correo = $_POST['correo'];
$contraseña = $_POST['contraseña'];

session_start();
$_SESSION['correo'] = $correo;

require '..\config.php'; 

$consulta = "SELECT * FROM tblUsuarios WHERE correo='$correo' AND contraseña='$contraseña'";
$resultado = mysqli_query($conn, $consulta);

$filas = mysqli_fetch_array($resultado);

if ($filas['us_rol'] == 1) { //administrador
    header("location:..\../Usuarios/index.php");
    $_SESSION['Id_usuario'] = $filas['Id_usuario'] ;
    $_SESSION['nombres'] = $filas['nombres'];                                                ; // Guardar el nombre del cliente en la sesión
    header("location:../Usuarios/index.php");
} elseif ($filas['us_rol'] == 2) { //cliente
    $_SESSION['Id_usuario'] = $filas['Id_usuario'];
    $_SESSION['nombres'] = $filas['nombres']; // Guardar el nombre del cliente en la sesión
    header("location:../index.php");
} elseif ($filas['us_rol'] == 3) { //Empleado
    header("location:/Ventas/agregar.php");
} else {
    include("index.html");
    echo "<h1 class='bad'>ERROR EN LA AUTENTIFICACION</h1>";
}

// Verificar si el usuario no ha iniciado sesión para mostrar el botón de inicio de sesión
if (!isset($_SESSION['Id_usuario'])) {
    echo '<a href="login.php">Iniciar sesión</a>';
}



mysqli_free_result($resultado);
mysqli_close($conn);

