<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="..\style.css">
    <link rel="stylesheet" type="text/css" href="..\style.css">
    <title>Meraki sushi</title>
    
   
</head>
<body>

<h2>Usuarios</h2>

<form action="" method="post"></form>
    <label for="campo">Buscar</label>
    <input type="text" name="campo" id="campo">
</form>
<p></p>
<table>
        <thead>
            <th>Id Menu</th>
            <th>Categoria</th>
            <th>Nombre</th>
            <th>Descripcion</th>
            <th>imagen</th>
            <th>Precio</th>
        </thead>  
        <tbody id="content">
        </tbody>
        <?php 
include("conexion.php");

$query = "SELECT * FROM tblmenus";
$resultado = $conexion->query($query);
while ($row = $resultado->fetch_assoc()) {
?>
<tr>
    <td><?php echo $row['Id_menu']; ?></td>
    <td><?php echo $row['categoria']; ?></td>
    <td><?php echo $row['nombre']; ?></td>
    <td><?php echo $row['descripcion']; ?></td>
    <td><img src="data:image/jpg;base64,<?php echo base64_encode($row['imagen']); ?>"></td>
</tr>
<?php
}
?>
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