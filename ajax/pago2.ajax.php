<?php

require_once "../controladores/pago.controlador.php";
require_once "../modelos/pago.modelo.php";


		$item = "id";
		$id = $_POST["idpago"];

function getContent() {
	global $id;
	$query = "SELECT tbl_proveedores_pedidos.id as idpedido , `fecha_pedido`, `id_proveedor`, `descripcion`, `monto`, proveedores.id as idproveedor, proveedores.codigo as codigo, proveedores.nombre as nombreproveedor, tbl_proveedores_pagos.id as idpago , tbl_proveedores_pagos.fecha as fechapago, `id_pedido`, `saldo_anterior`, `abono`, `saldo_actual`
	FROM `tbl_proveedores_pedidos`, proveedores , tbl_proveedores_pagos
	where tbl_proveedores_pedidos.id_proveedor=proveedores.id and tbl_proveedores_pedidos.id=tbl_proveedores_pagos.id_pedido and tbl_proveedores_pedidos.id =$id";
	$stmt = Conexion::conectar()->prepare($query);
	$stmt->execute();			
	return $stmt->fetchAll();
	
	$stmt->close();
	
	$stmt = null;
};
		$dato="";
		$data = getContent();



        foreach ($data as $value){
          
		/* echo json_encode($respuesta); */
		$dato.="<tr>";
		$dato.="<td>".$value["fechapago"]."</td>";
		$dato.="<td>".$value["saldo_anterior"]."</td>";
		$dato.="<td>".$value["abono"]."</td>";
		$dato.="<td>".$value["saldo_actual"]."</td>";

		$dato .='<td><div class="btn-group">
                         
		<button class="btn btn-warning btnEditarpago" idpago="'.$value["idpago"].'" data-toggle="modal" data-target="#modalEditarpago"><i class="fa fa-pencil"></i></button>

		<button class="btn btn-danger btnEliminarpago" id="'.$id.'" idpago="'.$value["idpago"].'"  Codigo="'.$value["abono"].'"><i class="fa fa-times"></i></button>

	  </div>  
		</td>';
		$dato.="</tr>";
		}
		echo json_encode($dato);
