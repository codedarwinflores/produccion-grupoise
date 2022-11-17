<?php

require_once "conexion.php";
$namecolumnas="";
$namecampos="";
$nombretabla_equipos="tbl_otros_equipos";
class Modeloequipos{


	/* CAPTURAR NOMBRE COLUMNAS*/

	function getContent() {
		global $nombretabla_equipos;
		$query = "SHOW COLUMNS FROM $nombretabla_equipos";
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

			$stmt = Conexion::conectar()->prepare("SELECT tbl_otros_equipos.id as idequipos, `id_familia`, `descripcion`, `numero_serie`, tbl_familia.id as idfamilia , tbl_familia.codigo as codigofamilia , tbl_familia.nombre as nombrefamilia, `correrlativo`,tipo_equipos,tipo_otros_equipos.id as idtipo, tipo_otros_equipos.codigo as codigotipo, tipo_otros_equipos.nombre as nombretipo,codigo_equipo ,descripcion_equipo ,costo_equipo ,modelo_equipo ,color_equipo  ,fecha_adquisicion ,observaciones FROM `tbl_otros_equipos`, tbl_familia, tipo_otros_equipos WHERE tbl_otros_equipos.id_familia = tbl_familia.id and tipo_otros_equipos.id=tbl_otros_equipos.tipo_equipos and tbl_otros_equipos.id = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT tbl_otros_equipos.id as idequipos, `id_familia`, `descripcion`, `numero_serie`, tbl_familia.id as idfamilia , tbl_familia.codigo as codigofamilia , tbl_familia.nombre as nombrefamilia, `correrlativo`,tipo_equipos,tipo_otros_equipos.id as idtipo, tipo_otros_equipos.codigo as codigotipo, tipo_otros_equipos.nombre as nombretipo,codigo_equipo ,descripcion_equipo ,costo_equipo ,modelo_equipo ,color_equipo  ,fecha_adquisicion ,observaciones FROM `tbl_otros_equipos`, tbl_familia, tipo_otros_equipos WHERE tbl_otros_equipos.id_familia = tbl_familia.id and tipo_otros_equipos.id=tbl_otros_equipos.tipo_equipos");

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