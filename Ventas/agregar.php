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
        right: 110px;
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
        echo "<div id='nombreUsuario'>Bienvenido, " . $_SESSION['nombres'] . "</div>";
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
<?php

require '..\config.php'; 

// Define variables e inicializa con valores vacíos
$menus = [];
$id_menu = $cantidad = $metodo_pago = $precio = '';
$id_menu_err = $cantidad_err = $metodo_pago_err = $precio_err = '';

// Procesa los datos del formulario cuando se envía el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar y procesar cada menú
    foreach ($_POST['menu'] as $key => $value) {
        // Validar el campo ID del Menú
        if (empty(trim($value['id_menu']))) {
            $id_menu_err = "Por favor ingresa el ID del Menú.";
        } else {
            $id_menu = $conn->real_escape_string(trim($value['id_menu']));
        }

        // Validar el campo Cantidad
        if (empty(trim($value['cantidad']))) {
            $cantidad_err = "Por favor ingresa la cantidad.";
        } else {
            $cantidad = $conn->real_escape_string(trim($value['cantidad']));
        }

        // Si no hay errores, calcular el total y agregar al array de menus
        if (empty($precio_err) && empty($cantidad_err)) {
            $sql_price = "SELECT precio FROM tblmenus WHERE Id_menu = id_menu ";
            if ($stmt_price = $conn->prepare($sql_price)) {
                $stmt_price->bind_param("s", $precio);
                $stmt_price->execute();
                $stmt_price->bind_result($precio_unitario);
                $stmt_price->fetch();
                $stmt_price->close();
            }

            // Calcular el total
            $total = $cantidad * $precio_unitario;

            // Agregar al array de menus
            $menus[] = array(
                'id_menu' => $id_menu,
                'cantidad' => $cantidad,
                'precio_unitario' => $precio_unitario,
                'total' => $total,
                'fecha' => $fecha
            );
        }
    }

    // Redirigir de vuelta a la página principal o a donde sea necesario
    header("Location: index.php");
    exit();
}

// Cierra la conexión
$conn->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="..\style2.css">
    <title>Agregar Venta</title>
</head>
<body>
    <center><h2>Agregar Venta</h2></center>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div id="menus">
            <div class="menu-item">
                <label for="menu[0][id_menu]">ID del Menú:</label><br>
                <input type="text" id="menu[0][id_menu]" name="menu[0][id_menu]" value=""><br>
                <label for="menu[0][cantidad]">Cantidad:</label><br>
                <input type="text" id="menu[0][cantidad]" name="menu[0][cantidad]" value="" oninput="calculateTotal(0)"><br>
                <label for="menu[0][total]">Total:</label><br>
                <input type="text" id="menu[0][total]" name="menu[0][total]" value="" readonly><br>
                <label for="menu[0][fecha]">Fecha:</label><br>
                <input type="text" id="menu[0][fecha]" name="menu[0][fecha]" value="" readonly><br>
                <br>
            </div>
        </div>
        <button type="button" onclick="addMenu()">Agregar Menú</button><br><br>
        <label for="total">Total Venta:</label><br>
        <input type="text" id="total" name="total" value="" readonly><br><br>
        <label for="metodo_pago">Método de Pago:</label><br>
        <input type="text" id="metodo_pago" name="metodo_pago" value="<?php echo $metodo_pago; ?>"><br>
        <input type="submit" value="Agregar">
    </form>

    <script>
        function calculateTotal(index) {
            var total = 0;
            var menus = document.querySelectorAll('.menu-item');
            menus.forEach(function(menu, idx) {
                var cantidad = parseInt(menu.querySelector('[name="menu[' + idx + '][cantidad]"]').value);
                var precio_unitario = parseInt(menu.querySelector('[name="menu[' + idx + '][id_menu]"]').value); // Suponiendo que el precio unitario viene de la misma fuente que el id_menu
                var subtotal = cantidad * precio_unitario;
                total += subtotal;
                menu.querySelector('[name="menu[' + idx + '][total]"]').value = subtotal.toFixed(2);
            });
            document.getElementById('total').value = total.toFixed(2);
        }

        function addMenu() {
            var menusContainer = document.getElementById('menus');
            var newIndex = menusContainer.childElementCount;
            var newMenuDiv = document.createElement('div');
            newMenuDiv.className = 'menu-item';
            newMenuDiv.innerHTML = '<label for="menu['+newIndex+'][id_menu]">ID del Menú:</label><br>' +
                                   '<input type="text" id="menu['+newIndex+'][id_menu]" name="menu['+newIndex+'][id_menu]" value="" oninput="calculateTotal('+newIndex+')"><br>' +
                                   '<label for="menu['+newIndex+'][cantidad]">Cantidad:</label><br>' +
                                   '<input type="text" id="menu['+newIndex+'][cantidad]" name="menu['+newIndex+'][cantidad]" value="" oninput="calculateTotal('+newIndex+')"><br>' +
                                   '<label for="menu['+newIndex+'][total]">Total:</label><br>' +
                                   '<input type="text" id="menu['+newIndex+'][total]" name="menu['+newIndex+'][total]" value="" readonly><br>' +
                                   '<label for="menu['+newIndex+'][fecha]">Fecha:</label><br>' +
                                   '<input type="text" id="menu['+newIndex+'][fecha]" name="menu['+newIndex+'][fecha]" value="" readonly><br>' +
                                   '<br>';
            menusContainer.appendChild(newMenuDiv);
        }
    </script>
</body>
</html>