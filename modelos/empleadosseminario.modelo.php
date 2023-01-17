<?php

require_once "conexion.php";

class ModeloEmpleadoSeminarios{

	

	/*=============================================
	INGRESAR REGISTRO
	=============================================*/

	static public function mdlIngresarEmpleadoSeminario($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(
            codigo,
            id_empleado,
            fecha_realizacion,
            id_seminario  
            ) VALUES (
            :codigo,
            :id_empleado,
            :fecha_realizacion,
            :id_seminario  
            )");
        $stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt->bindParam(":id_empleado", $datos["id_empleado"], PDO::PARAM_INT);
		$stmt->bindParam(":fecha_realizacion", $datos["fecha_realizacion"], PDO::PARAM_STR);
        $stmt->bindParam(":id_seminario", $datos["id_seminario"], PDO::PARAM_INT);


        

		if($stmt->execute()){

			return "ok";	

		}else{
           // print_r($stmt->errorInfo());
			return "error";
		
		}

		$stmt->close();
		
		$stmt = null;

	}

	

	

	

}