<?php 
$menesaje="";
if(isset($_POST['btnAccion'])){

switch ($_POST['btnAccion']){
    
    case 'Agregar':
        if(is_numeric(openssl_decrypt($_POST['id'],COD,KEY))){
            $ID=openssl_decrypt($_POST['id'],COD,KEY);
            $menesaje='okey ID correcto'.$ID;
        }else{
            $menesaje='ups ID incorrecto'.$ID;
        }
        if(is_string(openssl_decrypt($_POST['nombre'],COD,KEY))){
            $NOMBRE=openssl_decrypt($_POST['nombre'],COD,KEY);
            $menesaje.="ok Nombre".$NOMBRE."<br/>";
            }else{$menesaje="upps.. algo pasa con el nombre"; break;}
        if(is_string(openssl_decrypt($_POST['cantidad'],COD,KEY))){
            $CANTIDAD=openssl_decrypt($_POST['cantidad'],COD,KEY);
            $menesaje.="ok Cantidad".$CANTIDAD."<br/>";
            }else{$menesaje="upps.. algo pasa con el cantidad"; break;}
        if(is_string(openssl_decrypt($_POST['precio'],COD,KEY))){
            $PRECIO=openssl_decrypt($_POST['precio'],COD,KEY);
            $menesaje.="ok Precio".$PRECIO."<br/>";
            }else{$menesaje="upps.. algo pasa con el precio"; break;}
            if (!isset($_SESSION['CARRITO'])){
                $row= array (
                    'id'=>$ID,
                    'nombre'=>$NOMBRE,
                    'cantidad'=>$CANTIDAD,
                    'precio'=>$PRECIO,  
                );
                $_SESSION['CARRITO'][0]=$row;
            }else{
                $NumeroProductos=count($_SESSION['CARRITO']);
                $row= array (
                    'id'=>$ID,
                    'nombre'=>$NOMBRE,
                    'cantidad'=>$CANTIDAD,
                    'precio'=>$PRECIO,  
                );
                $_SESSION['CARRITO'][$NumeroProductos]=$row;
            }
            $menesaje=print_r($_SESSION,true);
        break;
        case "Eliminar";

            if(is_numeric( openssl_decrypt($_POST['id'],COD,KEY))){
                $ID=openssl_decrypt($_POST['id'],COD,KEY);
              
                foreach($_SESSION['CARRITO'] as $indice=>$row){
                    if($row['id']==$ID){

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
