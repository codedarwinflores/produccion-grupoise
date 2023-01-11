<?php

require_once "../modelos/conexion.php";

$idempleadoretiro=$_POST["id"];
function getContent() {
	global $idempleadoretiro;
	$query = "SELECT `id`, `fecha`, `regalo_prenda`, `descripcion`, `cantidad`, `precio`, `idempleado` FROM `regalo` WHERE idempleado=$idempleadoretiro";
	$stmt = Conexion::conectar()->prepare($query);
	$stmt->execute();			
	return $stmt->fetchAll();
	$stmt->close();
	$stmt = null;
};
		$data = getContent();
		foreach($data as $value) {

		

			echo ' <tr>
			<td>'.$value["fecha"].'</td>
			<td>'.$value["regalo_prenda"].'</td>
			<td>'.$value["descripcion"].'</td>
			<td>'.$value["cantidad"].'</td>
			<td>'.$value["precio"].'</td>';

		   

			echo '<td>

			  <div class="btn-group">
				  
				<button class="btn btn-warning btnEditarregalo" idregalo="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarregalo"><i class="fa fa-pencil"></i></button>

				<button class="btn btn-danger btnEliminarregalo" idregalo="'.$value["id"].'"  Codigo="'.$value["id"].'"><i class="fa fa-times"></i></button>

			  </div>  

			</td>

		  </tr>';	
		}


?>