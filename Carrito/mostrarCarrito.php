<?php
include 'global/config1.php';
include 'carrito.php';
include 'templates/cabecera.php';
?>

<br>
<h3>Lista Del Carrito</h3>
<?php if(!empty($_SESSION['CARRITO'])) { ?>
<table class="table table-light table-bordered">
    <tbody>
        <tr>
            <th width="40%" class="text-center">Descripcion</th>
            <th width="15%" class="text-center">cantidad</th>
            <th width="20%" class="text-center">Precio</th>
            <th width="20%" class="text-center">Total</th>
            <th width="5%">--</th>
        </tr>
        <?php $total=0; ?>
        <?php foreach($_SESSION['CARRITO'] as $indice=>$row){ ?>
        <tr>
            <td width="40%"> <?php echo $row['nombre'] ?></td>
            <td width="15%" class="text-center"><?php echo $row['cantidad'] ?></td>
            <td width="20%" class="text-center"><?php echo $row['precio'] ?></td>
            <td width="20%" class="text-center"><?php echo number_format($row['precio']*$row['cantidad'],2);  ?></td>
            <td width="5%">
                
            <form action="" method="post">
                
                <input type="text" 
                name="id" 
                id="id" 
                value="<?php echo ($row['id']);?>" >

                <button class="btn btn-danger"
                type="submit"
                name="btnAccion"
                value="Eliminar"
                >Elminar</button>

            </form>



           </td>
        </tr>
        <?php $total=$total+($row['precio']*$row['cantidad']); ?>
        <?php } ?>
        <tr>
            <td colspan="3" align="right"><h3>Total</h3></td>
            <td align="right"><h3><?php echo number_format($total,2);?></h3></td>
            <td></td>
        </tr>
    </tbody>
</table>
<?php } else { ?>

    <div class="alert alert-success" role="alert">
        No hay productos en el carrito...
    </div>

    <?php }?>
