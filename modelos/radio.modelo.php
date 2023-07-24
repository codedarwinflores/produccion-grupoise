<?php

require_once "conexion.php";
$namecolumnas="";
$namecampos="";
$nombretabla_radio="tbl_radios";
class Modeloradio{


	/* CAPTURAR NOMBRE COLUMNAS*/

	function getContent() {
		global $nombretabla_radio;
		$query = "SHOW COLUMNS FROM $nombretabla_radio";
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

			$stmt = Conexion::conectar()->prepare("SELECT tbl_radios.id as idradios, tbl_radios.id_familia as idfamiliaradio  , `id_tipo_de_radio`, `marca`, `numero_serie` , tbl_familia.id as idfamilia, tbl_familia.nombre as nombrefamilia, tbl_tipos_de_radios.id as idtiporadio, tbl_tipos_de_radios.nombre as nombretiporadio, codigo_radio, descripcion_radio, costo_radio, modelo_radio, color_radio ,fecha_adquisicion ,observaciones, estado_radio
			FROM `tbl_radios` , tbl_tipos_de_radios, tbl_familia
			WHERE tbl_tipos_de_radios.id=tbl_radios.id_tipo_de_radio and tbl_radios.id_familia = tbl_familia.id and tbl_radios.id = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT tbl_radios.id as idradios, tbl_radios.id_familia as idfamiliaradio  , `id_tipo_de_radio`, `marca`, `numero_serie` , tbl_familia.id as idfamilia, tbl_familia.nombre as nombrefamilia, tbl_tipos_de_radios.id as idtiporadio, tbl_tipos_de_radios.nombre as nombretiporadio, codigo_radio, descripcion_radio, costo_radio, modelo_radio, color_radio  ,fecha_adquisicion ,observaciones, estado_radio
			FROM `tbl_radios` , tbl_tipos_de_radios, tbl_familia
			WHERE tbl_tipos_de_radios.id=tbl_radios.id_tipo_de_radio and tbl_radios.id_familia = tbl_familia.id;");

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