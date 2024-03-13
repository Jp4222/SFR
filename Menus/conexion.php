<?php

$dbname="sfr";
$dbuser="root";
$dbhost="localhost";
$dbpass="";

$conexion=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname,);
if ($conexion) {
    echo "Conexión exitosa a la base de datos.";
} else {
    echo "Error de conexión: " . mysqli_connect_error();
}
?>