<?php
session_start();
include 'global/config1.php';
include 'carrito.php';
include 'templates/cabecera.php';

//var_dump($_SESSION['CARRITO1']);//
?>

<br>
<h3>Lista Del Carrito</h3>
<?php if(!empty($_SESSION['CARRITO2'])) { ?>
<table class="table table-light table-bordered">
    <tbody>
        <tr>
            <th width="40%" class="text-center">Nombre</th>
            <th width="15%" class="text-center">Cantidad</th>
            <th width="20%" class="text-center">Precio</th>
            <th width="20%" class="text-center">Total</th>
            <th width="5%">--</th>
        </tr>
        <?php $total = 0; ?>
        <?php foreach($_SESSION['CARRITO2'] as $indice => $producto) { ?>
        <tr>
            <td width="40%" class="text-center"><?php echo $producto['NOMBRE'] ?></td>
            <td width="15%" class="text-center"><?php echo $producto['CANTIDAD'] ?></td>
            <td width="20%" class="text-center"><?php echo $producto['PRECIO'] ?></td>
            <td width="20%" class="text-center"><?php echo number_format($producto['PRECIO'] * $producto['CANTIDAD'], 2); ?></td>
            <td width="5%">
                <form action="" method="post">
                    <input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($producto['ID'], COD, KEY); ?>">
                    <button class="btn btn-danger" type="submit" name="btnAccion" value="Eliminar">Eliminar</button>
                </form>
            </td>
        </tr>
        <?php $total += ($producto['PRECIO'] * $producto['CANTIDAD']); ?>
        <?php } ?>
        <tr>
            <td colspan="3" align="right"><h3>Total</h3></td>
            <td align="right"><h3><?php echo number_format($total, 2); ?></h3></td>
            <td></td>
        </tr>
    </tbody>
</table>
<?php } else { ?>
    <div class="alert alert-success" role="alert">
        No hay productos en el carrito...
    </div>
<?php } ?>

<?php
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
                            // Reducir la cantidad en uno
                            $_SESSION['CARRITO2'][$indice]['CANTIDAD'] -= 1;
                        } else {
                            // Eliminar el producto del carrito
                            unset($_SESSION['CARRITO2'][$indice]);
                        }

                        // Reindexar el array para evitar problemas de índices no consecutivos
                        $_SESSION['CARRITO2'] = array_values($_SESSION['CARRITO2']);

                        echo "<script>alert('Cantidad actualizada en el carrito.');</script>";
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
