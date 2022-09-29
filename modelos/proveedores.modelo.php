<?php

require_once "conexion.php";

class ModeloProveedores{

	/*=============================================
	MOSTRAR PROVEEDORES
	=============================================*/

	static public function mdlMostrarProveedores($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	REGISTRO DE PROVEEDORES
	=============================================*/

	static public function mdlIngresarProveedores($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(`codigo`, `nombre`, `direccion`, `telefono`, `extension`, `numero_de_resgistro`, `encargado`, `comentarios`, `nacionalidad`, `codigo_contable`, `contribuyente`) VALUES (:codigo, :nombre, :direccion, :telefono, :extension, :numero_de_registro, :encargado, :comentarios, :nacionalidad, :codigo_contable, :contribuyente)");

		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":extension", $datos["extension"], PDO::PARAM_STR);
		$stmt->bindParam(":numero_de_registro", $datos["numero_de_registro"], PDO::PARAM_STR);
		$stmt->bindParam(":encargado", $datos["encargado"], PDO::PARAM_STR);
		$stmt->bindParam(":comentarios", $datos["comentarios"], PDO::PARAM_STR);
		$stmt->bindParam(":nacionalidad", $datos["nacionalidad"], PDO::PARAM_STR);
		$stmt->bindParam(":codigo_contable", $datos["codigo_contable"], PDO::PARAM_STR);
		$stmt->bindParam(":contribuyente", $datos["contribuyente"], PDO::PARAM_STR);
		
		if($stmt->execute()){

			return "ok";	

		}else{

			return "error";
		
		}

		$stmt->close();
		
		$stmt = null;

	}

	/*=============================================
	EDITAR PROVEEDORES
	=============================================*/

	static public function mdlEditarProveedores($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET codigo = :codigo, nombre = :nombre, direccion = :direccion, telefono = :telefono, extension = :extension, numero_de_resgistro = :numero_de_registro, encargado = :encargado, comentarios = :comentarios, nacionalidad = :nacionalidad, codigo_contable = :codigo_contable, contribuyente = :contribuyente WHERE id = :id");

					
		
			$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
			$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
			$stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
			$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
			$stmt->bindParam(":extension", $datos["extension"], PDO::PARAM_STR);
			$stmt->bindParam(":numero_de_registro", $datos["numero_de_registro"], PDO::PARAM_STR);
			$stmt->bindParam(":encargado", $datos["encargado"], PDO::PARAM_STR);
			$stmt->bindParam(":comentarios", $datos["comentarios"], PDO::PARAM_STR);
			$stmt->bindParam(":nacionalidad", $datos["nacionalidad"], PDO::PARAM_STR);
			$stmt->bindParam(":codigo_contable", $datos["codigo_contable"], PDO::PARAM_STR);
			$stmt->bindParam(":contribuyente", $datos["contribuyente"], PDO::PARAM_STR);
			$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_STR);

			
		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	ACTUALIZAR PROVEEDORES
	=============================================*/

	static public function mdlActualizarProveedores($tabla, $item1, $valor1, $item2, $valor2){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	BORRAR PROVEEDORES
	=============================================*/

	static public function mdlBorrarProveedores($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;


	}

}