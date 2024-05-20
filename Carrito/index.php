<?php
include 'carrito.php';
include 'templates/cabecera.php'
?>
    <br>
    <div class="alert alert-success" role="alert">
        Pantalla de mensaje...
        <a href="#" class="badge badge-success" >Ver carrito</a>
    </div>
    <div class="row">
        <?php
            $sentencia=$pdo->prepare("SELECT * FROM tblproductos");
            $sentencia->execute();
            $listaProductos=$sentencia->fetchAll(PDO::FETCH_ASSOC);
            //print_r($listaProductos);
        ?>
        <?php foreach($listaProductos as $producto){ ?>
            <div class="col-3">
            <div class="card">
                <img 
                title="<?php echo $producto['Nombre'] ?>"
                alt="<?php echo $producto['Imagen'] ?>"
                class="card-img-top" 
                src="<?php echo $producto['Imagen'] ?>"
                data-toggle="popover"
                data-trigger="hover"
                data-content="<?php echo $producto['Descripcion'] ?>"
                >
                <div class="card-body">
                    <span><?php echo $producto['Nombre'] ?></span>
                    <h5 class="card-title"><?php echo $producto['Precio'] ?></h5>
                    <p class="card-text">Descripcion</p>             
                        <button class="btn btn-primary" 
                        name="btnAccion" 
                        value="Agregar" 
                        type="submit"
                        >
                        Agregar al carrito
                        </button>

                    </form>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
   </div>
   <script>
    $(function () {
  $('[data-toggle="popover"]').popover()
});
</script>
<?php
include 'templates/pie.php'
?>