<?php 

$menesaje="";
if(isset($_POST['btnAccion'])){

switch ($_POST['btnAccion']){
    
    case 'Agregar':
        if(is_numeric(($_POST['id']))){
            $ID=($_POST['id']);
            $menesaje='okey ID correcto'.$ID;
        }else{
            $menesaje='ups ID incorrecto'.$ID;
        }
        if(is_string(($_POST['nombre']))){
            $NOMBRE=($_POST['nombre']);
            $menesaje.="ok Nombre".$NOMBRE."<br/>";
            }else{$menesaje="upps.. algo pasa con el nombre"; break;}
        if(is_string(($_POST['cantidad']))){
            $CANTIDAD=($_POST['cantidad']);
            $menesaje.="ok Cantidad".$CANTIDAD."<br/>";
            }else{$menesaje="upps.. algo pasa con el cantidad"; break;}
        if(is_string(($_POST['precio']))){
            $PRECIO=($_POST['precio']);
            $menesaje.="ok Precio".$PRECIO."<br/>";
            }else{$menesaje="upps.. algo pasa con el precio"; break;}
            if (!isset($_SESSION['CARRITO'])){
                $producto= array (
                    'ID'=>$ID,
                    'NOMBRE'=>$NOMBRE,
                    'CANTIDAD'=>$CANTIDAD,
                    'PRECIO'=>$PRECIO,  
                );
                $_SESSION['CARRITO'][0]=$producto;
            }else{
                $NumeroProductos=count($_SESSION['CARRITO']);
                $producto= array (
                    'ID'=>$ID,
                    'NOMBRE'=>$NOMBRE,
                    'CANTIDAD'=>$CANTIDAD,
                    'PRECIO'=>$PRECIO,  
                );
                $_SESSION['CARRITO'][$NumeroProductos]=$producto;
            }
            $menesaje=print_r($_SESSION,true);
        break;
        case "Eliminar";

            if(is_numeric( ($_POST['id']))){
                $ID=($_POST['id']);
              
                foreach($_SESSION['CARRITO'] as $indice=>$producto){
                    if($producto['ID']==$ID){

                        unset($_SESSION['CARRITO'][$indice]);
                        echo "<script>alert('Elemento borrado...');</script>";

                    }


                }
            }else{
                $menesaje='ups ID incorrecto'.$ID."<br/>";
            }
        break;
}
}