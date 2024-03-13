<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="..\style.css">
    <link rel="icon" type="image/png" href="logo meraki sushi (1).png">
    <title>Meraki sushi ♛ Usuarios</title>
</head>
<body>

    <div class="container">
        <div></div>
        <div class="boton-container"> <!-- Movido a la derecha -->
            <a class="btn btn-blanco me-2" href="#">Login</a>
            <a class="btn btn-blanco" href="#">Domicilios</a>
            <a class="btn btn-blanco me-2" href="#">Inventario</a>
            <a class="btn btn-blanco" href="#">Menus</a>
            <a class="btn btn-blanco me-2" href="#">Ventas</a>
            <a class="btn btn-blanco" href="#">Usuario</a>
            <a class="btn btn-blanco me-2" href="#">Roles</a>
        </div>
    </div>

<center>
<h1>Usuarios 👤</h1>

<form action="" method="post"></form>
    <label for="campo">Buscar</label>
    <input type="text" name="campo" id="campo">
</form>
</center>

<p></p>

   <br><br><br><br><br>

<table>
        <thead>
            <th>Id Usuario</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Correo</th>
            <th>Direccion</th>
            <th>Contraseña</th>
            <th>Telefono</th>
            <th>Rol</th>
        </thead>  
        
        <tbody id="content">

        </tbody>

</table>

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

