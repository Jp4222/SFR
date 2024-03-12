<?php

$db="sfr";
$user="root";
$host="localhost";
$pass="";

$conexion=mysqli_connect($host,$user,$pass,$db);

if (!$conexion) {
    echo "conexion fallida";
}


