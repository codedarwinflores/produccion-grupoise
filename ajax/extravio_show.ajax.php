<?php

require_once "../modelos/conexion.php";

$idempleadoretiro=$_POST["id"];
function getContent() {
	global $idempleadoretiro;
	$query = "SELECT `id`, `fecha_extravio`, `descuento_extravio`, `valor_extravio`, `idempleado_extravio` FROM `extravios` WHERE idempleado_extravio=$idempleadoretiro";
	$stmt = Conexion::conectar()->prepare($query);
	$stmt->execute();			
	return $stmt->fetchAll();
	$stmt->close();
	$stmt = null;
};
		$data = getContent();

		foreach($data as $value) {

			echo ' <tr>
			<td>'.$value["fecha_extravio"].'</td>
			<td>'.$value["descuento_extravio"].'</td>
			<td>'.$value["valor_extravio"].'</td>';

		   

			echo '<td>

			  <div class="btn-group">
				  
				<button class="btn btn-warning btnEditarextravios" idextravios="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarextravios"><i class="fa fa-pencil"></i></button>

				<button class="btn btn-danger btnEliminarextravios" idextravios="'.$value["id"].'"  Codigo="'.$value["idempleado_extravio"].'"><i class="fa fa-times"></i></button>

			  </div>  

			</td>

		  </tr>';
		
		}


?>