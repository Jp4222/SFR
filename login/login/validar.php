<?php
$correo=$_POST['correo'];
$contraseña=$_POST['contraseña'];
session_start();
$_SESSION['correo'] = $correo;

$conexion=mysqli_connect("localhost","root","","sfr");

$consulta="SELECT*FROM tblusuarios where correo='$correo' and contraseña='$contraseña'";
$resultado=mysqli_query($conexion,$consulta);

$filas=mysqli_fetch_array($resultado);

if($filas['us_rol']==1){ //administrador
    header("location:../Usuarios/index.php");

}else
if($filas['us_rol']==2){ //cliente
header("location:../../Vistacliente/Principal/pagina_principal.php");
}
else{
    ?>
    <?php
    include("index.html");
    ?>
    <h1 class="bad">ERROR EN LA AUTENTIFICACION</h1>
    <?php
}
mysqli_free_result($resultado);
mysqli_close($conexion);
