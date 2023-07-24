

<?php

require_once "../modelos/conexion.php";

$valor=$_POST["valor"];


	function tblempleados($valor1) {
		$query01 = "SELECT tbl_ubicaciones_agentes_asignados.*, tbl_clientes_ubicaciones.* FROM `tbl_ubicaciones_agentes_asignados` INNER JOIN tbl_clientes_ubicaciones WHERE tbl_clientes_ubicaciones.id = tbl_ubicaciones_agentes_asignados.idubicacion_agente and tbl_ubicaciones_agentes_asignados.codigo_agente='$valor1'";
		echo $query01;
		$sql = Conexion::conectar()->prepare($query01);
		$sql->execute();			
		return $sql->fetchAll();
		}


		$data01 = tblempleados($valor);
		foreach($data01 as $value) {
			echo $value["idubicacion_agente"].'-'.$value["codigo_ubicacion"].'-'. $value["nombre_ubicacion"];
		
		}

?>