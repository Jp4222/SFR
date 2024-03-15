<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="..\style.css">
    <title>Meraki sushi ♛ Ventas</title>
</head>
<body>
    <header id="titulo">
      <h2>Roles</h2>
    </header>
    <section>
        <nav id="navega">
            <ul class="menu">
                <li><a href="..\Usuarios/index.php">Usuarios</a></li>
                <li><a href="..\Menus/index.php">Menus</a></li>
                <li><a href="..\Inventario/index.php">Inventario</a></li>
                <li><a href="">Domicilios</a></li>
                <li><a href="..\Metododepago/index.php">Metodos de pago</a></li>
                <li><a href="..\Roles/index.php">Rol</a></li>
                <li><a href="..\Ventas/index.php">Ventas</a></li>
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
            <th>Id rol</th>
            <th>Rol</th>
            <th colspan="2" class="opciones"  >Opciones</th>
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
</body>
</html>