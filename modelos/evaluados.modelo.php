<?php

require_once "conexion.php";

class ModeloEvaluado
{

	/*=============================================
	MOSTRAR 
	=============================================*/

	static public function mdlMostrar($tabla, $item, $valor)
	{

		if ($item != null) {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetch();
		} else {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt->execute();

			return $stmt->fetchAll();
		}


		$stmt->close();

		$stmt = null;
	}


	static public function codigoCorrelativo()
	{
		// Obtener el último valor generado
		$stmt = Conexion::conectar()->prepare("SELECT MAX(codigo) as maximo FROM `evaluados`");
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if ($row) {
			$lastValue = $row['maximo'];
		} else {
			$lastValue = 0;
		}

		// Generar el próximo correlativo
		$newValue = $lastValue + 1;
		$correlativo = str_pad($newValue, 5, '0', STR_PAD_LEFT); // Asegura que tenga 6 dígitos rellenando con ceros
		return $correlativo;
	}


	static public function obetenerCodigoCliente($id)
	{
		// Obtener el último valor generado
		$stmt = Conexion::conectar()->prepare("SELECT codigo_cliente FROM `tbl_clientes_morse` WHERE id=?");
		$stmt->execute([$id]);
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if ($row) {
			return  $row['codigo_cliente'];
		}

		return 0;
	}

	/*=============================================
	INGRESAR REGISTRO
	=============================================*/

	static public function mdlIngresar($tabla, $datos)
	{

		$codigo = self::codigoCorrelativo();
		$codigoCliente = self::obetenerCodigoCliente($datos["id_cliente_morse"]);

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(codigo,nombres, primer_apellido, segundo_apellido,estado_civil,direccion,telefono,documento,padre,madre,conyuge,lugar_nac,fecha_nac,profesion,id_cliente_morse,codigo_cliente,foto) VALUES (:codigo,:nombres, :primer_apellido, :segundo_apellido,:estado_civil,:direccion,:telefono,:documento,:padre,:madre,:conyuge,:lugar_nac,:fecha_nac,:profesion,:id_cliente_morse,:codigo_cliente,:foto)");

		$stmt->bindParam(":codigo", $codigo, PDO::PARAM_STR);
		$stmt->bindParam(":nombres", $datos["nombres"], PDO::PARAM_STR);
		$stmt->bindParam(":primer_apellido", $datos["primer_apellido"], PDO::PARAM_STR);
		$stmt->bindParam(":segundo_apellido", $datos["segundo_apellido"], PDO::PARAM_STR);
		$stmt->bindParam(":estado_civil", $datos["estado_civil"], PDO::PARAM_STR);
		$stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":documento", $datos["documento"], PDO::PARAM_STR);
		$stmt->bindParam(":padre", $datos["padre"], PDO::PARAM_STR);
		$stmt->bindParam(":madre", $datos["madre"], PDO::PARAM_STR);
		$stmt->bindParam(":conyuge", $datos["conyuge"], PDO::PARAM_STR);
		$stmt->bindParam(":lugar_nac", $datos["lugar_nac"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_nac", $datos["fecha_nac"], PDO::PARAM_STR);
		$stmt->bindParam(":profesion", $datos["profesion"], PDO::PARAM_STR);
		$stmt->bindParam(":id_cliente_morse", $datos["id_cliente_morse"], PDO::PARAM_INT);
		$stmt->bindParam(":codigo_cliente", $codigoCliente, PDO::PARAM_STR);
		$stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();

		$stmt = null;
	}

	/*=============================================
	EDITAR REGISTRO
	=============================================*/

	static public function mdlEditar($tabla, $datos)
	{
		$codigoCliente = self::obetenerCodigoCliente($datos["id_cliente_morse"]);

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombres=:nombres, primer_apellido=:primer_apellido,segundo_apellido=:segundo_apellido,estado_civil=:estado_civil,direccion=:direccion,telefono=:telefono,documento=:documento,padre=:padre,madre=:madre,conyuge=:conyuge,lugar_nac=:lugar_nac,fecha_nac=:fecha_nac,profesion=:profesion,id_cliente_morse=:id_cliente_morse,codigo_cliente=:codigo_cliente,foto=:foto WHERE id = :id");

		$stmt->bindParam(":nombres", $datos["nombres"], PDO::PARAM_STR);
		$stmt->bindParam(":primer_apellido", $datos["primer_apellido"], PDO::PARAM_STR);
		$stmt->bindParam(":segundo_apellido", $datos["segundo_apellido"], PDO::PARAM_STR);
		$stmt->bindParam(":estado_civil", $datos["estado_civil"], PDO::PARAM_STR);
		$stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":documento", $datos["documento"], PDO::PARAM_STR);
		$stmt->bindParam(":padre", $datos["padre"], PDO::PARAM_STR);
		$stmt->bindParam(":madre", $datos["madre"], PDO::PARAM_STR);
		$stmt->bindParam(":conyuge", $datos["conyuge"], PDO::PARAM_STR);
		$stmt->bindParam(":lugar_nac", $datos["lugar_nac"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_nac", $datos["fecha_nac"], PDO::PARAM_STR);
		$stmt->bindParam(":profesion", $datos["profesion"], PDO::PARAM_STR);
		$stmt->bindParam(":id_cliente_morse", $datos["id_cliente_morse"], PDO::PARAM_INT);
		$stmt->bindParam(":codigo_cliente", $codigoCliente, PDO::PARAM_STR);
		$stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();

		$stmt = null;
	}


	/*=============================================
	BORRAR REGISTRO
	=============================================*/

	static public function mdlBorrar($tabla, $datos)
	{

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt->bindParam(":id", $datos, PDO::PARAM_INT);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();

		$stmt = null;
	}
}
