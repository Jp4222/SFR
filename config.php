<?php

$conn = new mysqli ("127.0.0.1", "root", "Meraki22222", "sfr");

if ($conn -> connect_error){
    die('Error de conexion '. $conn-> connect_error);
}