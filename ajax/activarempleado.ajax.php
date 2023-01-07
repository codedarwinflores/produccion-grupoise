<?php 
require_once "../modelos/conexion.php";

$fecha_contratacion = $_POST['fecha_contratacion'] ;
$estado_contratacion = $_POST['estado_contratacion']; 
$id_empleado = $_POST['id_empleado']; 




        global $fecha_contratacion;
        global $estado_contratacion;
        global $id_empleado;
        $query = "UPDATE tbl_empleados SET estado=$estado_contratacion where id=$id_empleado";
        echo $query;
        $sql = Conexion::conectar()->prepare($query);
        $sql->execute();			
 






?>