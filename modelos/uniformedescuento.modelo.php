<?php

require_once "conexion.php";
$namecolumnas="";
$namecampos="";
$nombretabla_uniformedescuento="uniformedescuento";
class Modelouniformedescuento{


	/* CAPTURAR NOMBRE COLUMNAS*/

	function getContent() {
		global $nombretabla_uniformedescuento;
		$query = "SHOW COLUMNS FROM $nombretabla_uniformedescuento";
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

			$stmt = Conexion::conectar()->prepare("SELECT uniformedescuento.id as iddescuento, `fecha_descuento`, `codigo_empleado_descuento`, `codigo_uni_descuento`, `numero_recibo_descuento`, `valor_descuento`, `observacion_descuento` ,tbl_devengo_descuento.id as iddevengo, `codigo`, `descripcion`, `porcentaje`, `tipo`, `cargo_abono`, `cuenta_contable`,tbl_empleados.id as idempleado, `fecha_solicitud`, `primer_nombre`, `segundo_nombre`, `tercer_nombre`, `primer_apellido`, `segundo_apellido`, `apellido_casada`, `estado_civil`, `sexo`, `direccion`, `id_departamento`, `id_municipio`, `telefono`, `numero_isss`, `nombre_segun_isss`, `documento_identidad`, `numero_documento_identidad`, `imagen_documento_identidad`, `lugar_expedicion_documento`, `fecha_expedicion_documento`, `fecha_vencimiento_documento`, `licencia_conducir`, `tipo_licencia_conducir`, `imagen_licencia_conducir`, `nit`, `imagen_nit`, `codigo_afp`, `nup`, `profesion_oficio`, `nacionalidad`, `lugar_nacimiento`, `fecha_nacimiento`, `religion`, `grado_estudio`, `plantel`, `peso`, `estatura`, `piel`, `ojos`, `cabello`, `cara`, `tipo_sangre`, `senales_especiales`, `licencia_tenencia_armas`, `numero_licencia_tenencia_armas`, `imagen_licencia_tenencia_armas`, `servicio_militar`, `fecha_servicio_inicio`, `fecha_servicio_fin`, `lugar_servicio`, `grado_militar`, `motivo_baja`, `ex_pnc`, `curso_ansp`, `imagen_diploma_ansp`, `fotografia`, `trabajo_anterior`, `sueldo_que_devengo`, `trabajo_actual`, `sueldo_que_devenga`, `suspendido_trabajo_anterior`, `empresa_suspendio`, `motivo_suspension`, `fecha_suspension`, `experiencia_laboral`, `razon_trabajar_en_ise`, `numero_personas_dependientes`, `observaciones`, `telefono_trabajo_anterior`, `telefono_trabajo_actual`, `referencia_anterior`, `evaluacion_anterior`, `referencia_actual`, `evaluacion_actual`, `info_verificada`, `imagen_solicitud`, `imagen_partida_nacimiento`, `imagen_antecedentes_penales`, `fecha_vencimiento_antecedentes_penales`, `imagen_solvencia_pnc`, `fecha_vencimiento_solvencia_pnc`, `imagen_constancia_psicologica`, `imagen_examen_poligrafico`, `confiable`, `imagen_huellas`, `estado`, `nivel_cargo`
		FROM `uniformedescuento` ,tbl_devengo_descuento, tbl_empleados
		WHERE tbl_devengo_descuento.codigo=uniformedescuento.codigo_uni_descuento and tbl_empleados.id=uniformedescuento.codigo_empleado_descuento and uniformedescuento.id = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT uniformedescuento.id as iddescuento, `fecha_descuento`, `codigo_empleado_descuento`, `codigo_uni_descuento`, `numero_recibo_descuento`, `valor_descuento`, `observacion_descuento` ,tbl_devengo_descuento.id as iddevengo, `codigo`, `descripcion`, `porcentaje`, `tipo`, `cargo_abono`, `cuenta_contable`,tbl_empleados.id as idempleado, `fecha_solicitud`, `primer_nombre`, `segundo_nombre`, `tercer_nombre`, `primer_apellido`, `segundo_apellido`, `apellido_casada`, `estado_civil`, `sexo`, `direccion`, `id_departamento`, `id_municipio`, `telefono`, `numero_isss`, `nombre_segun_isss`, `documento_identidad`, `numero_documento_identidad`, `imagen_documento_identidad`, `lugar_expedicion_documento`, `fecha_expedicion_documento`, `fecha_vencimiento_documento`, `licencia_conducir`, `tipo_licencia_conducir`, `imagen_licencia_conducir`, `nit`, `imagen_nit`, `codigo_afp`, `nup`, `profesion_oficio`, `nacionalidad`, `lugar_nacimiento`, `fecha_nacimiento`, `religion`, `grado_estudio`, `plantel`, `peso`, `estatura`, `piel`, `ojos`, `cabello`, `cara`, `tipo_sangre`, `senales_especiales`, `licencia_tenencia_armas`, `numero_licencia_tenencia_armas`, `imagen_licencia_tenencia_armas`, `servicio_militar`, `fecha_servicio_inicio`, `fecha_servicio_fin`, `lugar_servicio`, `grado_militar`, `motivo_baja`, `ex_pnc`, `curso_ansp`, `imagen_diploma_ansp`, `fotografia`, `trabajo_anterior`, `sueldo_que_devengo`, `trabajo_actual`, `sueldo_que_devenga`, `suspendido_trabajo_anterior`, `empresa_suspendio`, `motivo_suspension`, `fecha_suspension`, `experiencia_laboral`, `razon_trabajar_en_ise`, `numero_personas_dependientes`, `observaciones`, `telefono_trabajo_anterior`, `telefono_trabajo_actual`, `referencia_anterior`, `evaluacion_anterior`, `referencia_actual`, `evaluacion_actual`, `info_verificada`, `imagen_solicitud`, `imagen_partida_nacimiento`, `imagen_antecedentes_penales`, `fecha_vencimiento_antecedentes_penales`, `imagen_solvencia_pnc`, `fecha_vencimiento_solvencia_pnc`, `imagen_constancia_psicologica`, `imagen_examen_poligrafico`, `confiable`, `imagen_huellas`, `estado`, `nivel_cargo`
		FROM `uniformedescuento` ,tbl_devengo_descuento, tbl_empleados
		WHERE tbl_devengo_descuento.codigo=uniformedescuento.codigo_uni_descuento and tbl_empleados.id=uniformedescuento.codigo_empleado_descuento");

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