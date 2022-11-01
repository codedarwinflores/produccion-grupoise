<?php

require_once "../controladores/departamentos.controlador.php";
require_once "../modelos/departamentos.modelo.php";

$departamaneto_id = $_POST["idDepartamento"];

function getContent() {
	global $departamaneto_id;
	$query = "SELECT * FROM cat_departamento WHERE id=$departamaneto_id";
	$stmt = Conexion::conectar()->prepare($query);
	$stmt->execute();			
	return $stmt->fetchAll();
	
	$stmt->close();
	
	$stmt = null;
};
$columnas_municipios="";
$data = getContent();
foreach($data as $row) {
    
    $columnas_municipios .= $row["id"].','.$row["Nombre"].';';
}

echo json_encode(substr($columnas_municipios,0,-1));


