<?php

require_once "../modelos/conexion.php";

$idempleadoretiro=$_POST["id"];
function getContent() {
	global $idempleadoretiro;
	$query = "SELECT * FROM `tbl_empleados` WHERE id=$idempleadoretiro";
	$stmt = Conexion::conectar()->prepare($query);
	$stmt->execute();			
	return $stmt->fetchAll();
	$stmt->close();
	$stmt = null;
};
		$data = getContent();
		foreach($data as $row) {

			$nombre=$row["primer_nombre"].' '.$row["segundo_nombre"].' '.$row["tercer_nombre"].' '.$row["primer_apellido"].' '.$row["segundo_apellido"].' '.$row["apellido_casada"];

			$fechacontratacion=$row["fecha_contratacion"];

			echo $nombre."/".$fechacontratacion;

		}


?>