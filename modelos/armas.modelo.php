<?php

require_once "conexion.php";
$namecolumnas="";
$namecampos="";
$nombretabla_armas="tbl_armas";
class Modeloarmas{


	/* CAPTURAR NOMBRE COLUMNAS*/

	function getContent() {
		global $nombretabla_armas;
		$query = "SHOW COLUMNS FROM $nombretabla_armas";
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

			/* $stmt = Conexion::conectar()->prepare("SELECT tbl_armas.id as idarmas, `fecha_ingreso`, `id_empresa`, `id_familia`, `id_tipo_arma`, tbl_armas.codigo as codigoarmas, `numero_serie`, `marca`, `modelo`, `color`, `numero_matricula`, `fecha_vencimiento`, `tipo_matricula`, `tipo_municion`, `lugar_adquisicion`, `precio_costo`, `estado` , tbl_tipos_de_armas.id as idtipoarmas, tbl_tipos_de_armas.codigo as codigotipoarmas , `nombre_tipo` , empresas.id as idempresas , `codigo_empresa`, empresas.nombre as nombreempresas , `logo` , tbl_familia.id as idfamilia , tbl_familia.codigo as codigofamilia, tbl_familia.nombre as nombrefamilia, `correrlativo` 
			FROM `tbl_armas` , tbl_tipos_de_armas , empresas , tbl_familia
			WHERE tbl_armas.id_empresa = empresas.id and tbl_tipos_de_armas.id = tbl_armas.id_tipo_arma and tbl_familia.id= tbl_armas.id_familia and tbl_armas.id = :$item"); */
			$stmt = Conexion::conectar()->prepare("SELECT tbl_armas.id as idarmas, `fecha_ingreso`, `id_empresa`, `id_familia`, `id_tipo_arma`, tbl_armas.codigo as codigoarmas, `numero_serie`, `marca`, `modelo`, `color`, `numero_matricula`, `fecha_vencimiento`, `tipo_matricula`, `tipo_municion`, `lugar_adquisicion`, `precio_costo`, `estado` , tbl_tipos_de_armas.id as idtipoarmas, tbl_tipos_de_armas.codigo as codigotipoarmas , `nombre_tipo` , tbl_familia.id as idfamilia , tbl_familia.codigo as codigofamilia, tbl_familia.nombre as nombrefamilia, `correrlativo` FROM `tbl_armas` , tbl_tipos_de_armas , tbl_familia WHERE tbl_tipos_de_armas.id = tbl_armas.id_tipo_arma and tbl_familia.id= tbl_armas.id_familia and tbl_armas.id = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			/* $stmt = Conexion::conectar()->prepare("SELECT tbl_armas.id as idarmas, `fecha_ingreso`, `id_empresa`, `id_familia`, `id_tipo_arma`, tbl_armas.codigo as codigoarmas, `numero_serie`, `marca`, `modelo`, `color`, `numero_matricula`, `fecha_vencimiento`, `tipo_matricula`, `tipo_municion`, `lugar_adquisicion`, `precio_costo`, `estado` , tbl_tipos_de_armas.id as idtipoarmas, tbl_tipos_de_armas.codigo as codigotipoarmas , `nombre_tipo` , empresas.id as idempresas , `codigo_empresa`, empresas.nombre as nombreempresas , `logo` , tbl_familia.id as idfamilia , tbl_familia.codigo as codigofamilia, tbl_familia.nombre as nombrefamilia, `correrlativo` 
			FROM `tbl_armas` , tbl_tipos_de_armas , empresas , tbl_familia
			WHERE tbl_armas.id_empresa = empresas.id and tbl_tipos_de_armas.id = tbl_armas.id_tipo_arma and tbl_familia.id= tbl_armas.id_familia"); */

			$stmt = Conexion::conectar()->prepare("SELECT tbl_armas.id as idarmas, `fecha_ingreso`, `id_empresa`, `id_familia`, `id_tipo_arma`, tbl_armas.codigo as codigoarmas, `numero_serie`, `marca`, `modelo`, `color`, `numero_matricula`, `fecha_vencimiento`, `tipo_matricula`, `tipo_municion`, `lugar_adquisicion`, `precio_costo`, `estado` , tbl_tipos_de_armas.id as idtipoarmas, tbl_tipos_de_armas.codigo as codigotipoarmas , `nombre_tipo` , tbl_familia.id as idfamilia , tbl_familia.codigo as codigofamilia, tbl_familia.nombre as nombrefamilia, `correrlativo` FROM `tbl_armas` , tbl_tipos_de_armas , tbl_familia WHERE tbl_tipos_de_armas.id = tbl_armas.id_tipo_arma and tbl_familia.id= tbl_armas.id_familia");

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