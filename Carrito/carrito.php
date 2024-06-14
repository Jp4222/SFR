<?php 
$mensaje = "";

if (isset($_POST['btnAccion'])) {

    switch ($_POST['btnAccion']) {

        case 'Agregar':
            if (is_numeric(openssl_decrypt($_POST['id'], COD, KEY))) {
                $ID = openssl_decrypt($_POST['id'], COD, KEY);
                $mensaje = 'okey ID correcto ' . $ID;
            } else {
                $mensaje = 'ups ID incorrecto';
                break;
            }
            if (is_string(openssl_decrypt($_POST['nombre'], COD, KEY))) {
                $NOMBRE = openssl_decrypt($_POST['nombre'], COD, KEY);
                $mensaje .= "ok Nombre " . $NOMBRE . "<br/>";
            } else {
                $mensaje = "upps.. algo pasa con el nombre";
                break;
            }
            if (is_numeric(openssl_decrypt($_POST['cantidad'], COD, KEY))) {
                $CANTIDAD = openssl_decrypt($_POST['cantidad'], COD, KEY);
                $mensaje .= "ok Cantidad " . $CANTIDAD . "<br/>";
            } else {
                $mensaje = "upps.. algo pasa con la cantidad";
                break;
            }
            if (is_numeric(openssl_decrypt($_POST['precio'], COD, KEY))) {
                $PRECIO = openssl_decrypt($_POST['precio'], COD, KEY);
                $mensaje .= "ok Precio " . $PRECIO . "<br/>";
            } else {
                $mensaje = "upps.. algo pasa con el precio";
                break;
            }

            // Obtener la fecha y hora actuales
            $fecha = date('Y-m-d H:i:s');

            // Verificar si el producto ya existe en el carrito
            if (!isset($_SESSION['CARRITO2'])) {
                $_SESSION['CARRITO2'] = array();
            }

            $productoEncontrado = false;
            foreach ($_SESSION['CARRITO2'] as $indice => $producto) {
                if ($producto['ID'] == $ID) {
                    // Si el producto ya existe, actualizar la cantidad
                    $_SESSION['CARRITO2'][$indice]['CANTIDAD'] += $CANTIDAD;
                    $productoEncontrado = true;
                    break;
                }
            }

            if (!$productoEncontrado) {
                // Si el producto no existe, agregarlo al carrito
                $producto = array(
                    'ID' => $ID,
                    'NOMBRE' => $NOMBRE,
                    'CANTIDAD' => $CANTIDAD,
                    'PRECIO' => $PRECIO,
                    'METODO_PAGO' => 'efectivo', 
                    'FECHA_PEDIDO' => $fecha
                );
                $_SESSION['CARRITO2'][] = $producto;
            }

            $mensaje = print_r($_SESSION, true);
            break;

        case "Eliminar":
            if (is_numeric(openssl_decrypt($_POST['id'], COD, KEY))) {
                $ID = openssl_decrypt($_POST['id'], COD, KEY);

                foreach ($_SESSION['CARRITO2'] as $indice => $producto) {
                    if ($producto['ID'] == $ID) {
                        if ($_SESSION['CARRITO2'][$indice]['CANTIDAD'] > 1) {
                            $_SESSION['CARRITO2'][$indice]['CANTIDAD'] -= 1;
                        } else {
                            unset($_SESSION['CARRITO2'][$indice]);
                            $_SESSION['CARRITO2'] = array_values($_SESSION['CARRITO2']); // Reindexar el array
                        }
                        echo "<script>alert('Cantidad actualizada o producto eliminado...');</script>";
                        break;
                    }
                }
            } else {
                $mensaje = 'ups ID incorrecto' . "<br/>";
            }
            break;
    }
}
?>
