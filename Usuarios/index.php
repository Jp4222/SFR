<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="..\style.css">
    <link rel="icon" type="image/png" href="../logo meraki sushi (1).png">
    <title>Meraki sushi Usuarios</title>
</head>

<body>
    <header id="titulo">
      <h2>Usuarios</h2>
    </header>
    <style>
.cerrar {
    width: 180px;
    color: black;
    position: fixed;
    top: 70px; /* Ajusta la distancia desde la parte superior */
    right: 80px; /* Ajusta la distancia desde la derecha */
    background-color: #fff; /* Ajusta el color de fondo según tu preferencia */
    border: 1px solid black; /* Ajusta el estilo del borde según tu preferencia */
    padding: 10px; /* Ajusta el relleno según tu preferencia */
    border-radius: 5px; /* Ajusta el radio de borde según tu preferencia */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Añade sombra según tu preferencia */
}
#nombreUsuario {
        position: absolute;
        top: 20px;
        right: 50px;
        color: black;
        background-color: white;
        padding: 10px;
        border-radius: 5px;
    }
</style>  
<body>
<?php
    session_start();
    if (isset($_SESSION['nombres'])) {
        echo "<div id='nombreUsuario'>Bienvenido Administrador, " . $_SESSION['nombres'] . "</div>";
    }
    ?>
          <section>
                <li><a class="cerrar" href="..\index.php" id="cerrarSesion">Cerrar Sesion</a></li>
                </ul>
                <script>
document.getElementById("cerrarSesion").addEventListener("click", function() {
    alert("Se cerró la sesión con éxito");
});      
</script>
        <nav id="navega">
            <ul class="menu">
                 <li><a href="..\Usuarios/index.php">Usuarios</a></li>
                <li><a href="..\Menus/index.php">Menus</a></li>
                <li><a href="..\Inventario/index.php">Inventario</a></li>
                <li><a href="..\Domicilios/index.php">Domicilios</a></li>
                <li><a href="..\Metododepago/index.php">Metodos de pago</a></li>
                <li><a href="..\Roles/index.php">Rol</a></li>
            </ul>
        </nav>
    </section>
<body>
<form action="" method="post"></form>
    <label for="campo">Buscar</label>
    <input type="text" name="campo" id="campo">
</form>
<br><br><br><br>

<table>
        <thead>
            <th>Id Usuario</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Correo</th>
            <th>Contraseña</th>
            <th>Telefono</th>
            <th>Rol</th>
            <th colspan="2" class="opciones" >Opciones</th>
        </thead>  
        
        <tbody id="content">

        </tbody>

</table>
<br><br><br>
<script>

    getData()

    document.getElementById("campo").addEventListener("keyup", getData)

    function getData(){
        let input =document.getElementById("campo").value
        let content =document.getElementById("content")
        let url = "load.php";
        let formData = new FormData()
        formData.append('campo', input)

        fetch(url,{
            method: "POST",
            body: formData
        }).then(response => response.json())
        .then(data => {
            content.innerHTML = data
        }).catch(err => console.log(err))
    }
</script>      
<center>
<div class="reportes"> 
            <a class="btn btn-warning" href="reportes.php">Imprimir Reportes</a>
        </div>
        <br>
        <a class="boton" href="agregar.php">Agregar</a><br><br></center>
</div>
</body>
</html>

