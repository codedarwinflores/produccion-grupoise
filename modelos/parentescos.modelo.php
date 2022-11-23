<?php

require_once "conexion.php";

class ModeloParentescos{

	

	/*=============================================
	INGRESAR REGISTRO
	=============================================*/

	static public function mdlIngresarParentescos($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(
            id_empleado,
            parentesco,
            nombre,
            edad,
            con_vida,
            direccion,
            telefono
            ) VALUES (
            :id_empleado,
            :parentesco,
            :nombre,
            :edad,
            :con_vida,
            :direccion,
            :telefono
            )");
        $stmt->bindParam(":id_empleado", $datos["id_empleado"], PDO::PARAM_STR);
		$stmt->bindParam(":parentesco", $datos["parentesco"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":edad", $datos["edad"], PDO::PARAM_STR);
		$stmt->bindParam(":con_vida", $datos["con_vida"], PDO::PARAM_STR);
        $stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
        

		if($stmt->execute()){

			return "ok";	

		}else{

			return "error";
		
		}

		$stmt->close();
		
		$stmt = null;

	}

	

	

	

}