<?php

$dbname="sfr";
$dbuser="root";
$dbhost="localhost";
$dbpass="";

$conexion=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
if ($conexion) {
} else {
    echo "Error de conexión: " . mysqli_connect_error();
}
