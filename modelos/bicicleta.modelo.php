<?php

require_once "conexion.php";
$namecolumnas="";
$namecampos="";
$nombretabla_bicicleta="tbl_bicicleta";
class Modelobicicleta{


	/* CAPTURAR NOMBRE COLUMNAS*/

	function getContent() {
		global $nombretabla_bicicleta;
		$query = "SHOW COLUMNS FROM $nombretabla_bicicleta";
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

			$stmt = Conexion::conectar()->prepare("SELECT tbl_bicicleta.id as idbicicleta, `id_familia`, `id_tipo_bicicleta`, `marca`, `numero_serie`,tbl_familia.id as idfamilia, tbl_familia.codigo as codigofamilia , tbl_familia.nombre as nombrefamilia , `correrlativo`,tbl_tipos_bicicleta.id as idtipobicicleta, tbl_tipos_bicicleta.codigo as codigotipobicicleta, tbl_tipos_bicicleta.nombre as nombretipobicicleta,codigo_bicicleta , descripcion_bicicleta, costo_bicicleta, modelo_bicicleta, color_bicicleta, fecha_adquisicion ,observaciones, estado_bicicleta 
			FROM `tbl_bicicleta`,tbl_tipos_bicicleta,tbl_familia
			WHERE tbl_bicicleta.id_familia=tbl_familia.id  and tbl_bicicleta.id_tipo_bicicleta=tbl_tipos_bicicleta.id and tbl_bicicleta.id = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT tbl_bicicleta.id as idbicicleta, `id_familia`, `id_tipo_bicicleta`, `marca`, `numero_serie`,tbl_familia.id as idfamilia, tbl_familia.codigo as codigofamilia , tbl_familia.nombre as nombrefamilia , `correrlativo`,tbl_tipos_bicicleta.id as idtipobicicleta, tbl_tipos_bicicleta.codigo as codigotipobicicleta, tbl_tipos_bicicleta.nombre as nombretipobicicleta,codigo_bicicleta , descripcion_bicicleta, costo_bicicleta, modelo_bicicleta, color_bicicleta , fecha_adquisicion ,observaciones, estado_bicicleta
			FROM `tbl_bicicleta`,tbl_tipos_bicicleta,tbl_familia
			WHERE tbl_bicicleta.id_familia=tbl_familia.id  and tbl_bicicleta.id_tipo_bicicleta=tbl_tipos_bicicleta.id");

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