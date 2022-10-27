<?php

require_once "conexion.php";
$namecolumnas="";
$namecampos="";
$nombretabla_pago="tbl_proveedores_pagos";
class Modelopago{


	/* CAPTURAR NOMBRE COLUMNAS*/

	function getContent() {
		global $nombretabla_pago;
		$query = "SHOW COLUMNS FROM $nombretabla_pago";
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

			$stmt = Conexion::conectar()->prepare("SELECT tbl_proveedores_pedidos.id as idpedido , `fecha_pedido`, `id_proveedor`, `descripcion`, `monto`, proveedores.id as idproveedor, proveedores.codigo as codigo, proveedores.nombre as nombreproveedor, tbl_proveedores_pagos.id as idpago , tbl_proveedores_pagos.fecha as fechapago, `id_pedido`, `saldo_anterior`, `abono`, `saldo_actual`
			FROM `tbl_proveedores_pedidos`, proveedores , tbl_proveedores_pagos
			where tbl_proveedores_pedidos.id_proveedor=proveedores.id and tbl_proveedores_pedidos.id=tbl_proveedores_pagos.id_pedido and tbl_proveedores_pagos.id = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT tbl_proveedores_pedidos.id as idpedido , `fecha_pedido`, `id_proveedor`, `descripcion`, `monto`, proveedores.id as idproveedor, proveedores.codigo as codigo, proveedores.nombre as nombreproveedor, tbl_proveedores_pagos.id as idpago , tbl_proveedores_pagos.fecha as fechapago, `id_pedido`, `saldo_anterior`, `abono`, `saldo_actual`
			FROM `tbl_proveedores_pedidos`, proveedores , tbl_proveedores_pagos
			where tbl_proveedores_pedidos.id_proveedor=proveedores.id and tbl_proveedores_pedidos.id=tbl_proveedores_pagos.id_pedido");

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