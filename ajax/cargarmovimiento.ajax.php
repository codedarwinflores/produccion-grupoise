

<?php

require_once "../modelos/conexion.php";

$valor=$_POST["valor"];


	function tblempleados($valor1) {
		$query01 = "SELECT `id`, `idagente_transacciones_agente`, `fecha_transacciones_agente`, `hora_transacciones_agente`, `tipo_movimiento_transacciones_agente`, `nueva_ubicacion_transacciones_agente`, `ubicacion_anterior_transacciones_agente`, `fecha_desde_transacciones_agente`, `fecha_hasta_transacciones_agente`, `presento_incapacidad_transacciones_agente`, `comentarios_transacciones_agente`, `turno_transacciones_agente`, `horario_desde_transacciones_agente`, `horario_hasta_transacciones_agente` 
		FROM `transacciones_agente` 
		WHERE idagente_transacciones_agente='$valor1' ORDER BY STR_TO_DATE(fecha_transacciones_agente, '%d-%m') DESC";
		$sql = Conexion::conectar()->prepare($query01);
		$sql->execute();			
		return $sql->fetchAll();
		}

		$data01 = tblempleados($valor);
		foreach($data01 as $value) {
			echo ' <tr>
			<td>'.$value["fecha_transacciones_agente"].'</td>
			<td>'.$value["tipo_movimiento_transacciones_agente"].'</td>
			<td>'.$value["nueva_ubicacion_transacciones_agente"].'</td>
			<td>'.$value["ubicacion_anterior_transacciones_agente"].'</td>';

		
			echo '<td>

			  <div class="btn-group">
				  
				<button class="btn btn-warning btnEditartransacciones_agente" idtransacciones_agente="'.$value["id"].'" data-toggle="modal" data-target="#modalEditartransacciones_agente"><i class="fa fa-pencil"></i></button>

				<button class="btn btn-danger btnEliminartransacciones_agente" idtransacciones_agente="'.$value["id"].'"  Codigo="'.$value["id"].'"><i class="fa fa-times"></i></button>

			  </div>  

			</td>

		  </tr>';
		
		}

?>