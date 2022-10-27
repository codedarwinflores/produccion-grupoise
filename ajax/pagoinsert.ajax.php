<?php

require_once "../controladores/pago.controlador.php";
require_once "../modelos/pago.modelo.php";


		$nuevofecha = $_POST["nuevofechap"];
		$nuevoid_pedido = $_POST["nuevoid_pedidop"];
		$nuevosaldo_anterior = $_POST["nuevosaldo_anteriorp"];
		$nuevoabono = $_POST["nuevoabonop"];
		$nuevosaldo_actual = $_POST["nuevosaldo_actualp"];


		/* 
		$nuevofecha = "1";
		$nuevoid_pedido = "1";
		$nuevosaldo_anterior = "1";
		$nuevoabono = "1";
		$nuevosaldo_actual = "1"; */

		function getContent() {
			global $nuevoid_pedido;
			$query0 = "SELECT COUNT(*) as columnas from tbl_proveedores_pagos where id_pedido=".$nuevoid_pedido."";
			
			$stmt0 = Conexion::conectar()->prepare($query0);
			$stmt0->execute();			
			return $stmt0->fetchAll();
			$stmt0->close();
			$stmt0 = null;
		};
	

		$data = getContent();
        foreach ($data as $value){

			if($value["columnas"]==0){

				$query = "INSERT INTO `tbl_proveedores_pagos`(`fecha`, `id_pedido`, `saldo_anterior`, `abono`, `saldo_actual`) VALUES ('".$nuevofecha."',".$nuevoid_pedido.",".$nuevosaldo_anterior.",".$nuevoabono.", ".$nuevosaldo_actual.")";


				$stmt = Conexion::conectar()->prepare($query);
				$stmt->execute();			
				return $stmt->fetchAll();
				
				$stmt->close();

				$stmt = null;


			}
			else{
			
				}
		}
