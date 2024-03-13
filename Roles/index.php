<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="..\style.css">
    <title>Meraki sushi</title>
    
   
</head>
<style>
 
     *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body{
            background-color: white;
            background-repeat: repeat;
            background-position: center;
        }
        #titulo{
            width: 100%;
            background: linear-gradient(to bottom, rgb(0 0 0 / .50), rgb(0 0 0 / .5)), url(https://img.freepik.com/vector-premium/patron-costuras-comida-japonesa-sushi-fresco-sobre-fondo-blanco-sushi-asiatico-diferentes-tipos_508396-1178.jpg?size=626&ext=jpg&ga=GA1.1.1395991368.1710028800&semt=ais);
            color: white;
            opacity: 100;
            height: 150px;
            font-family: Arial, Helvetica, sans-serif;
            letter-spacing: 15px;
            text-transform: uppercase;
            font-size: 30px;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        #navega{
            width: 100%;
            margin: 0px;
            background: linear-gradient(to bottom, rgb(0 0 0 / .50), rgb(0 0 0 / .5)), url(https://img.freepik.com/vector-premium/patron-costuras-comida-japonesa-sushi-fresco-sobre-fondo-blanco-sushi-asiatico-diferentes-tipos_508396-1178.jpg?size=626&ext=jpg&ga=GA1.1.1395991368.1710028800&semt=ais);
            color: white;
            opacity: 100;
            text-align: center; 
            
        }
        .menu{
            list-style-type: none;
            box-sizing: border-box;
        }
        .menu >li{
            position: relative;
            display: inline-block;
        }
        .menu >li a{
            display: block;
            padding: 15px 20px;
            color: white;
            font-family: Georgia, 'Times New Roman', Times, serif;
            font-size: 20px;
            text-decoration: none;
        }
        .submenu{
            position: absolute;
            background-color: orangered;
            width: 180px;
            display: none;
            text-align: left;
            list-style-type: none;
        }
        .submenu li a{
            display: block;
            padding: 15px;
            color: white;
            text-decoration: none; 
        }
        .menu li:hover .submenu{
            display: block;
        }
        .menu li a:hover{
            background-color: black;
            border: 5px solid red;
            color: white;
            transition: all .5s;
        }

    </style>


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