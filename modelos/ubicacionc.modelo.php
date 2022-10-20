<?php

require_once "conexion.php";
$namecolumnas="";
$namecampos="";
$nombretabla_ubicacionc="tbl_clientes_ubicaciones";
class Modeloubicacionc{


	/* CAPTURAR NOMBRE COLUMNAS*/

	function getContent() {
		global $nombretabla_ubicacionc;
		$query = "SHOW COLUMNS FROM $nombretabla_ubicacionc";
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

			$stmt = Conexion::conectar()->prepare("SELECT tbl_clientes_ubicaciones.id as idubicacionc , `id_cliente`, `codigo_cliente`, `id_coordinador_zona`, `nombre_ubicacion`, `latitude`, `longitude`, tbl_clientes_ubicaciones.direccion as direccionubicacionc , `persona_contacto`, `telefono_contacto`, `email_contacto`, `cantidad_armas`, `cantidad_radios`, `cantidad_celulares`, `bonos`, `visitas`, `zona`, `rubro`, `fecha_inicio`, `fecha_fin`, `horas_permitidas`, tbl_clientes_ubicaciones.id_departamento as departamentoubicacionc , tbl_clientes_ubicaciones.id_municipio as idmunicipioubicacionc, `observaciones_generales`, `fecha_ultimo_inventario`, `hombres_autorizados`,cat_departamento.id as iddepartamento, cat_departamento.Nombre as nombredepartamento, `lat_depto`, `lon_depto` ,cat_municipios.id as idmunicipio , `idDpto`, `Nombre_m`, `latitud`, `longitud`,clientes.id as idcliente, `fecha_apertura`, clientes.codigo as codigocliente, clientes.nombre as nombrecliente, `nit`, `nrc`, `nombre_registro`, `giro`, `contribuyente`, `clasificacion`, `tipo_cliente`, `correo_electronico`, clientes.direccion as direccioncliente, `telefono_1`, `telefono_2`, `fax`, `contacto`, `id_pais`, `limite_credito`, `plazo`, `observaciones`, `cuenta_contable`
			FROM `tbl_clientes_ubicaciones` , cat_departamento, cat_municipios, clientes
			WHERE tbl_clientes_ubicaciones.id_departamento= cat_departamento.id  and tbl_clientes_ubicaciones.id_municipio = cat_municipios.id and cat_municipios.idDpto = cat_departamento.id and tbl_clientes_ubicaciones.id and clientes.id = tbl_clientes_ubicaciones.id_cliente and tbl_clientes_ubicaciones.id = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT tbl_clientes_ubicaciones.id as idubicacionc , `id_cliente`, `codigo_cliente`, `id_coordinador_zona`, `nombre_ubicacion`, `latitude`, `longitude`, tbl_clientes_ubicaciones.direccion as direccionubicacionc , `persona_contacto`, `telefono_contacto`, `email_contacto`, `cantidad_armas`, `cantidad_radios`, `cantidad_celulares`, `bonos`, `visitas`, `zona`, `rubro`, `fecha_inicio`, `fecha_fin`, `horas_permitidas`, tbl_clientes_ubicaciones.id_departamento as departamentoubicacionc , tbl_clientes_ubicaciones.id_municipio as idmunicipioubicacionc, `observaciones_generales`, `fecha_ultimo_inventario`, `hombres_autorizados`,cat_departamento.id as iddepartamento, cat_departamento.Nombre as nombredepartamento, `lat_depto`, `lon_depto` ,cat_municipios.id as idmunicipio , `idDpto`, `Nombre_m`, `latitud`, `longitud`,clientes.id as idcliente, `fecha_apertura`, clientes.codigo as codigocliente, clientes.nombre as nombrecliente, `nit`, `nrc`, `nombre_registro`, `giro`, `contribuyente`, `clasificacion`, `tipo_cliente`, `correo_electronico`, clientes.direccion as direccioncliente, `telefono_1`, `telefono_2`, `fax`, `contacto`, `id_pais`, `limite_credito`, `plazo`, `observaciones`, `cuenta_contable`
			FROM `tbl_clientes_ubicaciones` , cat_departamento, cat_municipios, clientes
			WHERE tbl_clientes_ubicaciones.id_departamento= cat_departamento.id  and tbl_clientes_ubicaciones.id_municipio = cat_municipios.id and cat_municipios.idDpto = cat_departamento.id and tbl_clientes_ubicaciones.id and clientes.id = tbl_clientes_ubicaciones.id_cliente;");

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