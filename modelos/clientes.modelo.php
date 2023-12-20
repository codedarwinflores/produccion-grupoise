<?php

require_once "conexion.php";
$namecolumnas="";
$namecampos="";
$nombretabla_clientes="clientes";
class Modeloclientes{


	/* CAPTURAR NOMBRE COLUMNAS*/

	function getContent() {
		global $nombretabla_clientes;
		$query = "SHOW COLUMNS FROM $nombretabla_clientes";
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

			/* $stmt = Conexion::conectar()->prepare("SELECT clientes.id as clienteid, `fecha_apertura`, clientes.codigo as clientecodigo, clientes.nombre as clientenombre, `nit`, `nrc`, `nombre_registro`, `giro`, `contribuyente`, `clasificacion`, `tipo_cliente`, `correo_electronico`, `direccion`, `telefono_1`, `telefono_2`, `fax`, `contacto`, `id_pais`, `id_departamento`, `id_municipio`, `limite_credito`, `plazo`, `observaciones`, `cuenta_contable` ,cat_departamento.id as departamentoid, cat_departamento.Nombre as departamentonombre, `lat_depto`, `lon_depto`,cat_municipios.id as municipioid, `idDpto`, `Nombre_m`, `latitud`, `longitud`,paises.id as idpais, paises.codigo as paiscodigo, paises.nombre as paisnombre, vendedor, porcentaje_comision, vigencia_contrato, posee_contrato, tipo_servicio, categoria_cliente, dui , servicios_prestados.id as id_servicios , servicios_prestados.codigo as codigo_servicio , servicios_prestados.nombre as nombreservicio,contacto_contable, telefono_contacto_contable, correo_contacto_contable , `nombre_representante_cliente`, `profecion_cliente`, `domicilio_cliente`, `departamento_representante_cliente`, `dui_cliente`, `cargo_cliente`, `denominacion_cliente`, `dia_quedan_cliente`, `dia_quedan_observacion_cliente`, `dia_cobro_cliente`, `dia_entrega_facturacion_cliente`,estado_cliente 
			FROM `clientes`, cat_municipios, cat_departamento, paises, servicios_prestados
			WHERE clientes.id_pais = paises.id and clientes.id_departamento = cat_departamento.id and clientes.id_municipio = cat_municipios.id and clientes.tipo_servicio= servicios_prestados.id and clientes.id = :$item "); */

			$stmt = Conexion::conectar()->prepare("SELECT clientes.id as clienteid, `fecha_apertura`, clientes.codigo as clientecodigo, clientes.nombre as clientenombre, `nit`, `nrc`, `nombre_registro`, `giro`, `contribuyente`, `clasificacion`, `tipo_cliente`, `correo_electronico`, `direccion`, `telefono_1`, `telefono_2`, `fax`, `contacto`, `id_pais`, `id_departamento`, `id_municipio`, `limite_credito`, `plazo`, `observaciones`, `cuenta_contable` ,cat_departamento.id as departamentoid, cat_departamento.Nombre as departamentonombre, `lat_depto`, `lon_depto`,cat_municipios.id as municipioid, `idDpto`, `Nombre_m`, `latitud`, `longitud`,paises.id as idpais, paises.codigo as paiscodigo, paises.nombre as paisnombre, vendedor, porcentaje_comision, vigencia_contrato, posee_contrato, tipo_servicio, categoria_cliente, dui , contacto_contable, telefono_contacto_contable, correo_contacto_contable , `nombre_representante_cliente`, `profecion_cliente`, `domicilio_cliente`, `departamento_representante_cliente`, `dui_cliente`, `cargo_cliente`, `denominacion_cliente`, `dia_quedan_cliente`, `dia_quedan_observacion_cliente`, `dia_cobro_cliente`, `dia_entrega_facturacion_cliente`,estado_cliente,valor_hora_extra_cliente,des_valor_hora_extra_cliente
			FROM `clientes`, cat_municipios, cat_departamento, paises
			WHERE clientes.id_pais = paises.id and clientes.id_departamento = cat_departamento.id and clientes.id_municipio = cat_municipios.id and clientes.id = :$item ");


			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			/* $stmt = Conexion::conectar()->prepare("SELECT clientes.id as clienteid, `fecha_apertura`, clientes.codigo as clientecodigo, clientes.nombre as clientenombre, `nit`, `nrc`, `nombre_registro`, `giro`, `contribuyente`, `clasificacion`, `tipo_cliente`, `correo_electronico`, `direccion`, `telefono_1`, `telefono_2`, `fax`, `contacto`, `id_pais`, `id_departamento`, `id_municipio`, `limite_credito`, `plazo`, `observaciones`, `cuenta_contable` ,cat_departamento.id as departamentoid, cat_departamento.Nombre as departamentonombre, `lat_depto`, `lon_depto`,cat_municipios.id as municipioid, `idDpto`, `Nombre_m`, `latitud`, `longitud`,paises.id as idpais, paises.codigo as paiscodigo, paises.nombre as paisnombre, vendedor, porcentaje_comision, vigencia_contrato, posee_contrato, tipo_servicio, categoria_cliente, dui , servicios_prestados.id as id_servicios , servicios_prestados.codigo as codigo_servicio , servicios_prestados.nombre as nombreservicio,contacto_contable, telefono_contacto_contable, correo_contacto_contable , `nombre_representante_cliente`, `profecion_cliente`, `domicilio_cliente`, `departamento_representante_cliente`, `dui_cliente`, `cargo_cliente`, `denominacion_cliente`, `dia_quedan_cliente`, `dia_quedan_observacion_cliente`, `dia_cobro_cliente`, `dia_entrega_facturacion_cliente`,estado_cliente 
			FROM `clientes`, cat_municipios, cat_departamento, paises, servicios_prestados
			WHERE clientes.id_pais = paises.id and clientes.id_departamento = cat_departamento.id and clientes.id_municipio = cat_municipios.id and clientes.tipo_servicio= servicios_prestados.id"); */
			$stmt = Conexion::conectar()->prepare("SELECT clientes.id as clienteid, `fecha_apertura`, clientes.codigo as clientecodigo, clientes.nombre as clientenombre, `nit`, `nrc`, `nombre_registro`, `giro`, `contribuyente`, `clasificacion`, `tipo_cliente`, `correo_electronico`, `direccion`, `telefono_1`, `telefono_2`, `fax`, `contacto`, `id_pais`, `id_departamento`, `id_municipio`, `limite_credito`, `plazo`, `observaciones`, `cuenta_contable` ,cat_departamento.id as departamentoid, cat_departamento.Nombre as departamentonombre, `lat_depto`, `lon_depto`,cat_municipios.id as municipioid, `idDpto`, `Nombre_m`, `latitud`, `longitud`,paises.id as idpais, paises.codigo as paiscodigo, paises.nombre as paisnombre, vendedor, porcentaje_comision, vigencia_contrato, posee_contrato, tipo_servicio, categoria_cliente, dui ,contacto_contable, telefono_contacto_contable, correo_contacto_contable , `nombre_representante_cliente`, `profecion_cliente`, `domicilio_cliente`, `departamento_representante_cliente`, `dui_cliente`, `cargo_cliente`, `denominacion_cliente`, `dia_quedan_cliente`, `dia_quedan_observacion_cliente`, `dia_cobro_cliente`, `dia_entrega_facturacion_cliente`,estado_cliente ,valor_hora_extra_cliente,des_valor_hora_extra_cliente
			FROM `clientes`, cat_municipios, cat_departamento, paises
			WHERE clientes.id_pais = paises.id and clientes.id_departamento = cat_departamento.id and clientes.id_municipio = cat_municipios.id");

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