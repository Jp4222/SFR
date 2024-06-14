<?php
session_start();
include 'global/config1.php';
include 'carrito.php';
include 'templates/cabecera.php';

//var_dump($_SESSION['CARRITO1']);//
?>
<br><br><br><br><br><br><br><br>
<?php if(!empty($_SESSION['CARRITO2'])) { ?>
<table class="table table-light table-bordered">
    <tbody>
        <tr>
            <th width="40%" class="text-center">Nombre</th>
            <th width="15%" class="text-center">Cantidad</th>
            <th width="20%" class="text-center">Precio</th>
            <th width="20%" class="text-center">Total</th>
            <th width="5%">Opciones</th>
        </tr>
        <?php $total = 0; ?>
        <?php foreach($_SESSION['CARRITO2'] as $indice => $producto) { ?>
        <tr>
            <td width="40%"> <?php echo $producto['NOMBRE'] ?></td>
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
        <?php $total = $total + ($producto['PRECIO'] * $producto['CANTIDAD']); ?>
        <?php } ?>
        <tr>
            <td colspan="3" align="right"><h3>Total</h3></td>
            <td align="right"><h3><?php echo number_format($total, 2); ?></h3></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="5">
                <form action="pagar.php" method="post">
                    <div class="form-group">
                        <label for="direccion">Dirección de Domicilio:</label>
                        <input type="text" class="formulario" name="direccion" id="direccion" required>
                    </div>
                    <br><br><br>
                    <center><button class="btn btn-success btn-lg btn-block" type="submit" name="btnAccion" value="Pagar">Proceder a pagar</button></center>
                </form>
            </td>
        </tr>
    </tbody>
</table>
<?php } else { ?>
    <div class="alert alert-success" role="alert">
        No hay productos en el carrito...
    </div>
<?php }?>
