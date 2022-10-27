<?php

require_once "../controladores/pago.controlador.php";
require_once "../modelos/pago.modelo.php";


		$item = "id";
		$id = $_POST["idpago"];

function getContent() {
	global $id;
	$query = "SELECT `id`, `fecha`, `id_pedido`, `saldo_anterior`, `abono`, `saldo_actual` 
	FROM `tbl_proveedores_pagos`
	where  id_pedido =$id ORDER by id DESC LIMIT 1";
	$stmt = Conexion::conectar()->prepare($query);
	$stmt->execute();			
	return $stmt->fetchAll();
	
	$stmt->close();
	
	$stmt = null;
};
		$dato="";
		$data = getContent();



        foreach ($data as $value){
			$variable = array( 'variable1' => $value["saldo_anterior"], 
								'variable2' => $value["saldo_actual"] );
			echo json_encode($variable);

		}
