<?php
require_once "../modelos/conexion.php";

$tabla_validar = $_POST["tabla_validar"];
$item_validar = $_POST["item_validar"];
$valor_validar = $_POST["valor_validar"];
$columnas_validar;

if($tabla_validar == "undefined"){
	
	$columnas_validar="0";
	echo json_encode($columnas_validar);
	
}
else{



function getContent() {
	global $tabla_validar;
	global $item_validar;
	global $valor_validar;
	
	$query = "SELECT COUNT($item_validar) as numero FROM $tabla_validar WHERE $item_validar = '$valor_validar'";
	$stmt = Conexion::conectar()->prepare($query);
	$stmt->execute();			
	return $stmt->fetchAll();
	
	$stmt->close();
	
	$stmt = null;
};
		$data = getContent();
		foreach($data as $row) {

			$columnas_validar=$row["numero"];

		}


		$query = "SELECT COUNT($item_validar) as numero FROM $tabla_validar WHERE $item_validar = '$valor_validar'";

		echo json_encode($columnas_validar);


}