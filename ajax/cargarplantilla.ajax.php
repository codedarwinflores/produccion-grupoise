<?php

require_once "../controladores/recibo.controlador.php";
require_once "../modelos/recibo.modelo.php";

$accion="cargar";

$tipoplanilla=$_POST["tipoplanilla"];

function nombre_columnas($tipoplanilla)
{
	$query = "SHOW COLUMNS FROM $tipoplanilla";
	$stmt = Conexion::conectar()->prepare($query);
	$stmt->execute();
	return $stmt->fetchAll();
	$stmt->close();
	$stmt = null;
}


switch ($accion) {
	
	case "cargar":
		/* ********************** */
		
		$datamodificar=nombre_columnas($tipoplanilla);
		$columna_nombre = array();
		$indice = 1; // Comenzar desde 1
		foreach ($datamodificar as $row) {
		    $columna_nombre[$indice] = $row['Field'];
			$indice++;
		}
		$numero_planilla=$columna_nombre[2];
		$fecha_desde=$columna_nombre[4];
		$fecha_hasta=$columna_nombre[5];

		
		function planilladevengo_admin($tipoplanilla,$numero) {
			$query = "SELECT * from $tipoplanilla GROUP BY $numero ORDER BY id ASC";
			/* echo $query; */
			$sql = Conexion::conectar()->prepare($query);
			$sql->execute();			
			return $sql->fetchAll();
			};
			/* el numero de columna nombre corresponde al numero de la columna que se puede ver en phpmyadmin en la opcion de estructura en este caso empieza del 1 */
			$data = planilladevengo_admin($tipoplanilla,$numero_planilla);
			foreach($data as $value) {

			if($tipoplanilla=="planilladevengo_admin"){
				echo "<option value=".$value["numero_planilladevengo_admin"]." vacacion=".$value["numero_plan_vacacion"].">".$value["numero_planilladevengo_admin"].' Planilla desde '.$value["fecha_desde_planilladevengo_admin"].' al '.$value["fecha_hasta_planilladevengo_admin"]."</option>";
			}
			else{
			echo "<option value=".$value[$numero_planilla].">".$value[$numero_planilla].' Planilla desde '.$value[$fecha_desde].' al '.$value[$fecha_hasta]."</option>";
			}
			}

	break;
	
	default:
		echo $accion."respuesta nula";
}
?>