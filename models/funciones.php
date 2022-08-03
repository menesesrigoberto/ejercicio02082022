<?php
include_once "models/compra.php";


class Funciones {
   
    function alertaProceso($tipoaccion, $geterror){  

        $info  = ""; // Utilizado para enviar informacion de las acciones

        if ($tipoaccion=="1"){// Eliminar
            
            if ($geterror=="1"){
                $texto = "Error eliminando el producto, por favor verifique e intente nuevamente";
                $tipoalerta = "alert-danger";
            }else{
                $texto = "Eliminado correctamente el producto";
                $tipoalerta = "alert-info";
            }

            $info  = "
            <div class='alert $tipoalerta' style='text-align: center; font-weight: normal;'>
                <a style='color: #000; font-size: 14px; text-decoration: none;'>
                    $texto
                </a>
            </div>
            ";
        }else if ($tipoaccion=="2"){// Guardar
            
            if ($geterror=="1"){
                $texto = "Error guardando el producto, por favor verifique e intente nuevamente";
                $tipoalerta = "alert-danger";
            }else{
                $texto = "Guardado correctamente el producto";
                $tipoalerta = "alert-info";
            }
        }

        if($tipoaccion!=""){
            $info  = "
            <div class='alert $tipoalerta' style='text-align: center; font-weight: normal;'>
                <a style='color: #000; font-size: 14px; text-decoration: none;'>
                    $texto
                </a>
            </div>
            ";
        }

        return $info;
        
    }

    function listaOrden($nuevacompra){

        (isset($_SESSION["compra_id"])) ? $compra_id=$_SESSION["compra_id"] :$compra_id='';
        if($nuevacompra=="1"){
            $compra_id = 0;
        }
        
        $compra = new Compra();
        $resultado = $compra->obtener($compra_id);
        $cont = 0;

        $tabla = "";

        foreach($resultado as $item){
            $cont = $cont + 1;

            $id = $item["id"];
            $producto = $item["producto"];
            $fecharegistro = $item["fecharegistro"];

            $eliminar = "<a href='procesarcompra.php?accion=eliminar&id=$id'>Eliminar</a>";
            
            $tabla .= "
            <tr>
                <th scope='row'>$cont</th>
                <td>$producto</td>
                <td>$fecharegistro</td>
                <td>$eliminar</td>
            </tr>
            ";
        }

        if($tabla==""){
            $tabla .= "
            <tr>
                <td colspan='4'>
                    <div class='alert alert-info' style='text-align: center; font-weight: normal;'>
                        <a style='color: #000; font-size: 14px; text-decoration: none;'>
                            No existen productos en la lista de compra
                        </a>
                    </div>
                </td>
            </tr>
            ";
        }

        return $tabla;
    }

}
?>