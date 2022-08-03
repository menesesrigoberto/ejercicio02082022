<?php
include_once "models/compra.php";

(isset($_GET['accion'])) ? $accion=$_GET['accion'] :$accion='';
(isset($_GET['id'])) ? $id=$_GET['id'] :$id='';
(isset($_POST['producto'])) ? $producto=$_POST['producto'] :$producto='';

$compra = new Compra();

if ($accion=="eliminar"){
    $resultado = $compra->eliminar($id);
    if ($resultado){
        header("Location: index.php?t=1");
    }else{
        header("Location: index.php?t=1&e=1");
    }
}
else if ($producto!=""){
    $resultado = $compra->guardar($producto);
    if ($resultado){
        header("Location: index.php?t=2");
    }else{
        header("Location: index.php?t=2&e=1");
    }
}


?>