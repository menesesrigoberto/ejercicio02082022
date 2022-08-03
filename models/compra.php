<?php
class Compra {

    public $servidor;
    public $bd;
    public $usuario;
    public $clave;

    function __construct(){

        $this->servidor = "localhost";
        $this->bd = "bdejercicio";
        $this->usuario = "userejercicio";
        $this->clave = "Ejercicio_02082022"; 
        
    }

    function abrirConexion(){  

        // Abre la conexion a la Bd
        $conexion = new mysqli($this->servidor,$this->usuario,$this->clave,$this->bd);
        return $conexion;
    }

    function obtener($compra_id){  

        $sql = "
        SELECT 
        compradetalle.id AS id, 
        compradetalle.producto, 
        DATE_FORMAT(compradetalle.fecharegistro,'%d/%m/%Y %H:%i:%s') as fecharegistro
        FROM compra 
            INNER JOIN compradetalle ON compra.id = compradetalle.compra_id
        WHERE compra.activo = 1 AND compradetalle.activo = 1 and compra.id = '$compra_id'
        ORDER BY compradetalle.id DESC
        ";
        
        $conexion = $this->abrirConexion();
        $resultado = $conexion->query($sql);

        if(!$resultado){  
            echo 'MySQL Error: ' . mysqli_error($conexion).$sql;  
			exit();  
        }        

        $row =array();
		while ($rowq = $resultado->fetch_assoc()) {
	        $row[] = $rowq;	
	    }

        return $row;
    }

    function guardar($producto){  

        session_start();
        $compra_id = $_SESSION["compra_id"];

        // Se obtiene la fecha actual
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $fechaactual = date('Y-m-d h:i:s', time());  

        // Abro conexion
        $conexion = $this->abrirConexion();

        // Se inserta en la tabla compra como la padre
        if($compra_id==""){

            $sqlCompra = "INSERT compra (fechacompra, activo) VALUES ('$fechaactual', 1)";
            $conexion->query($sqlCompra);

            // Se obtiene el ultimo id insertado
            $compra_id = $conexion->insert_id;

            $_SESSION["compra_id"] = $compra_id;

            if(!$compra_id){  
                echo 'MySQL Error: ' . mysqli_error($conexion).$sqlCompra;  
                exit();  
            }  

        }
        

        // Se inserta en la tabla compradetalle que se relaciona con la tabla de compra
        $sqlCompraDetalle = "
        INSERT compradetalle (compra_id, producto, fecharegistro, activo) 
        VALUES ('$compra_id', '$producto', '$fechaactual', 1)
        ";
        $resultado = $conexion->query($sqlCompraDetalle);

        if(!$resultado){  
            echo 'MySQL Error: ' . mysqli_error($conexion).$sqlCompraDetalle;  
			exit();  
        }  
        
        return true;

    }

    function eliminar($id){  

        // Se elimina de forma logica el registro
        $sql = "UPDATE compradetalle SET activo = 0 WHERE id = $id";
        
        $conexion = $this->abrirConexion();
        $resultado = $conexion->query($sql);

        if(!$resultado){  
            echo 'MySQL Error: ' . mysqli_error($conexion).$sql;  
			exit();  
        }   
        
        return true;

    }

}
?>