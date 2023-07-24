<?php

require_once "conexion.php";
$namecolumnas="";
$namecampos="";
$nombretabla_celular="celular";
class Modelocelular{


	/* CAPTURAR NOMBRE COLUMNAS*/

	function getContent() {
		global $nombretabla_celular;
		$query = "SHOW COLUMNS FROM $nombretabla_celular";
		$stmt = Conexion::conectar()->prepare($query);
		$stmt->execute();			
		return $stmt->fetchAll();
		
		$stmt->close();
		
		$stmt = null;
	}


	/*=============================================
	MOSTRAR 
	=============================================*/

	static public function mdlMostrar($tabla, $item, $valor){

		if($item != null){

/* 			$stmt = Conexion::conectar()->prepare("SELECT celular.id as idcelular, celular.codigo as codigocelular , `descripcion`, `costo`, `numero`, `imei`, celular.sim as simcelular , `marca`, `modelo`, `color`, tarjetas_sim.id as idsim, `operador`, tarjetas_sim.sim as simtarjeta, `IMEI`, `sim_card`,tipo_celular.id as idtipocelular , tipo_celular.codigo as codigotipocelular, tipo_celular.nombre as nombretipocelular, fecha_asignacion_celular, codigo_nombre_empleado_celular,plan_datos_celular, observacion_celular, `operador_celular`, `imei_celular` FROM `celular`, tarjetas_sim, tipo_celular WHERE celular.sim=tarjetas_sim.id and celular.tipocelular=tipo_celular.id and celular.id = :$item"); */

			$stmt = Conexion::conectar()->prepare("SELECT celular.id as idcelular, celular.codigo as codigocelular , `descripcion`, `costo`, `numero`, celular.sim as simcelular , `marca`, `modelo`, `color`,tipo_celular.id as idtipocelular , tipo_celular.codigo as codigotipocelular, tipo_celular.nombre as nombretipocelular, fecha_asignacion_celular, codigo_nombre_empleado_celular,plan_datos_celular, observacion_celular, `operador_celular`, `imei_celular` 
			FROM `celular`, tipo_celular 
			WHERE celular.tipocelular=tipo_celular.id and celular.id = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT celular.id as idcelular, celular.codigo as codigocelular , `descripcion`, `costo`, `numero`, celular.sim as simcelular , `marca`, `modelo`, `color`,tipo_celular.id as idtipocelular , tipo_celular.codigo as codigotipocelular, tipo_celular.nombre as nombretipocelular, fecha_asignacion_celular, codigo_nombre_empleado_celular,plan_datos_celular, observacion_celular, `operador_celular`, `imei_celular` 
			FROM `celular`, tipo_celular 
			WHERE celular.tipocelular=tipo_celular.id");


		/* 	$stmt = Conexion::conectar()->prepare("SELECT celular.id as idcelular, celular.codigo as codigocelular , `descripcion`, `costo`, `numero`, `imei`, celular.sim as simcelular , `marca`, `modelo`, `color`, tarjetas_sim.id as idsim, `operador`, tarjetas_sim.sim as simtarjeta, `IMEI`, `sim_card`,tipo_celular.id as idtipocelular , tipo_celular.codigo as codigotipocelular, tipo_celular.nombre as nombretipocelular, fecha_asignacion_celular, codigo_nombre_empleado_celular,plan_datos_celular, observacion_celular, `operador_celular`, `imei_celular` FROM `celular`, tarjetas_sim, tipo_celular WHERE celular.sim=tarjetas_sim.id and celular.tipocelular=tipo_celular.id"); */

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	INGRESAR REGISTRO
	=============================================*/

	static public function mdlIngresar($tabla, $datos){
		global $namecolumnas;
		global $namecampos;
		
		
		/* CAPTURA NOMBRE DE LAS COLUMNAS Y CAMPOS DEL IMPUT */
		$data = getContent();
		foreach($data as $row) {
			$namecolumnas.=$row['Field'].",";
			$namecampos.=":".$row['Field'].",";
		}

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(".trim($namecolumnas,",").") VALUES (".trim($namecampos,",").")");

		foreach($data as $row) {
			$stmt->bindParam(":".$row['Field'], $datos["".$row['Field'].""], PDO::PARAM_STR);	
		}

		if($stmt->execute()){

			return "ok";	

		}else{

			return "error";
		
		}

		$stmt->close();
		
		$stmt = null;

	}

	/*=============================================
	EDITAR REGISTRO
	=============================================*/

	static public function mdlEditar($tabla, $datos){
		global $namecolumnas;
		global $namecampos;

		$data = getContent();
		foreach($data as $row) {
			$namecolumnas.= $row['Field']."=".":".$row['Field'].",";
			
		}
		
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET ".trim($namecolumnas,",")." WHERE id = :id");

		foreach($data as $row) {
			$stmt->bindParam(":".$row['Field'], $datos["".$row['Field'].""], PDO::PARAM_STR);	
		}
		

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	ACTUALIZAR REGISTRO
	=============================================*/

	static public function mdlActualizar($tabla, $item1, $valor1, $item2, $valor2){

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
	BORRAR REGISTRO
	=============================================*/

	static public function mdlBorrar($tabla, $datos){

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