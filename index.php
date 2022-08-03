<?php
include_once "models/funciones.php";

(isset($_GET['t'])) ? $tipoaccion=$_GET['t'] :$tipoaccion='';
(isset($_GET['e'])) ? $geterror=$_GET['e'] :$geterror='';
(isset($_GET['r'])) ? $nuevacompra=$_GET['r'] :$nuevacompra='';

session_start();
if ($nuevacompra=="1"){
    session_destroy();
}

// Verifica alerta para mostrar 
$funciones = new Funciones();
$info = $funciones->alertaProceso($tipoaccion, $geterror);

// Arma la Tabla a Mostrar
$tabla = $funciones->listaOrden($nuevacompra);

?>

<html>
<head>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/estilos.css">
    <title>Lista de Compras</title>
</head>
<body>
    <div class="container" style="margin-top: 20px">
        <div class="row">
            <div class="col-12">
                <h1 style="font-size: 20px; text-align: center">
                    Lista de Compras
                </h1>
            </div>
        </div>
        <form action="procesarcompra.php" method="POST">
            <div class="row" style="margin-top: 20px">
                <div class="col-2" style="text-align: right; padding-top: 5">
                    <label >
                        Producto:
                    </label>
                </div>
                <div class="col-6">
                    <input type="text" name="producto" class="form-control" placeholder="Agregue su producto" required="required" autocomplete="off" />
                </div>
                <div class="col-4">
                    <button type="submit" class="btn btn-primary">
                        Agregar producto a la lista
                    </button>
                    <a href="index.php?r=1">
                        <button type="button" class="btn btn-primary">
                            Nueva Compra
                        </button>
                    </a>
                </div>
            </div>
        </form>
        <?php echo $info; ?>

        <div class="row" style="margin-top: 20px">
            <div class="col-12" style="text-align: center">
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Producto</th>
                        <th scope="col">Fecha Registro</th>
                        <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo $tabla; ?>                        
                    </tbody>
                </table>
            </div>          
        </div>
       
    </div>
</body>
</html>