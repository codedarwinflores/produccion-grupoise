<?php

require_once "../controladores/municipio.controlador.php";
require_once "../modelos/municipio.modelo.php";

$departamaneto_id = $_POST["idmunicipios"];

function getContent() {
	global $departamaneto_id;
	$query = "SELECT * FROM cat_municipios WHERE idDpto=$departamaneto_id";
	$stmt = Conexion::conectar()->prepare($query);
	$stmt->execute();			
	return $stmt->fetchAll();
	
	$stmt->close();
	
	$stmt = null;
};
		$columnas_municipios="";
		$data = getContent();
		foreach($data as $row) {
			$columnas_municipios .= '<option value="'.$row["id"].'">'.$row["Nombre_m"].'</option>';

		}

echo json_encode($columnas_municipios);


