<?php

require_once "../controladores/municipio.controlador.php";
require_once "../modelos/municipio.modelo.php";

$id_municipio = $_POST["idmunicipio"];

function getContent() {
	global $id_municipio;
	$query = "SELECT * FROM cat_municipios WHERE id=$id_municipio";
	$stmt = Conexion::conectar()->prepare($query);
	$stmt->execute();			
	return $stmt->fetchAll();
	
	$stmt->close();
	
	$stmt = null;
};
		$columnas_municipios="";
		$data = getContent();
		foreach($data as $row) {
			
            $columnas_municipios .= $row["id"].','.$row["Nombre_m"].';';
		}

echo json_encode(substr($columnas_municipios,0,-1));


