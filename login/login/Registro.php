<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar</title>
    <link rel="stylesheet" type="text/css" href="../Domicilios/estilos.css">
    <body>
<header id="titulo">
<h2>REGISTRO</h2>
</header>
</head>
<body>
</head>
<body>
<?php
    if(isset($_POST ['enviar'])) {
        $nombres=$_POST ['nombres'];
        $apellidos=$_POST['apellidos'];
        $correo=$_POST['correo'];
        $direccion=$_POST ["direccion"];
        $contraseña=$_POST["contraseña"];
        $telefono=$_POST ["telefono"];
        $us_rol= "2";
        include("db.php");
        $sql="insert into tblusuarios (nombres,apellidos,correo,direccion,contraseña,telefono,us_rol)
        values ('".$nombres."','".$apellidos."','".$correo."','".$direccion."','".$contraseña."','".$telefono."','".$us_rol."')";
        $resultado=mysqli_query($conexion,$sql);
        if($resultado)  {
            echo "<script language= 'JavaScript'>
                    alert('Los datos fueron ingresados correctamente a la BD');
                    location.assign('index.html');
                    </script>";
    }else{
            echo "<script language= 'JavaScript'>
            alert('ERROR: Los datos NO fueron ingresados a la BD');
            location.assign('index.html');
            </script>";
        }
    mysqli_close($conexion);
    }else {
?>
 <center> <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
        <label>Nombres</label><br><br>
        <input type="text" name="nombres"><br><br>
        <label>Apellidos</label><br><br>
        <input type="text" name="apellidos"><br><br>
        <label>Correo</label><br><br>
        <input type="text" name="correo"><br><br>
        <label>Direccion</label><br><br>
        <input type="text" name="direccion"><br><br>
        <label>Contraseña</label><br><br>
        <input type="text" name="contraseña"><br><br>
        <label>Telefono:</label><br><br>
        <input type="text" name="telefono"><br><br>
        <input type="submit" name="enviar" value="Registrarme"><br>
        <a href="index.html">Regresar</a>
    </form></center>  
    <?php
    }
    ?>
</body>
</html>