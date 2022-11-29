<?php

require_once "conexion.php";

class ModeloEmpleadoDescuentos{

	

	/*=============================================
	INGRESAR REGISTRO
	=============================================*/

	static public function mdlIngresarEmpleadoDescuento($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(
            id_empleado,
            id_tipo_devengo_descuento,
            valor,
            fecha_caducidad,
            referencia
            ) VALUES (
            :id_empleado,
            :id_tipo_devengo_descuento,
            :valor,
            :fecha_caducidad,
            :referencia
            )");
        $stmt->bindParam(":id_empleado", $datos["id_empleado"], PDO::PARAM_INT);
		$stmt->bindParam(":id_tipo_devengo_descuento", $datos["id_tipo_devengo_descuento"], PDO::PARAM_INT);
		$stmt->bindParam(":valor", $datos["valor"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_caducidad", $datos["fecha_caducidad"], PDO::PARAM_STR);
		$stmt->bindParam(":referencia", $datos["referencia"], PDO::PARAM_STR);

        

		if($stmt->execute()){

			return "ok";	

		}else{

			return "error";
		
		}

		$stmt->close();
		
		$stmt = null;

	}

	

	

	

}