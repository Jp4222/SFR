<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="..\style.css">
    <title>Meraki sushi</title>
</head>
</head>
<body>
    <header id="titulo">
      <h2>Roles</h2>
    </header>
    <section>
        <nav id="navega">
            <ul class="menu">
                <li><a href="file:///G:/11_09_2023/PaginaInicio.html">inicio</a></li>
                <li><a href="">Menus</a></li>
                <li><a href="">Reservas</a></li>
                <li><a href="">Domicilios</a></li>
                <li><a href="">Inventario</a></li>
                <li><a href="">Rol</a></li>
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