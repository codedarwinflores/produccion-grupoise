

<?php

require_once "../modelos/conexion.php";

$idaumento=$_POST["idaumento"];
$facturar=$_POST["facturar"];
$codigo_ubicacion_aumento=$_POST["codigo_ubicacion_aumento"];
$supervisor_aumento=$_POST["supervisor_aumento"];




	$query = "UPDATE `aumentos_hombres` SET `facturar_aumento`='$facturar',`codigo_ubicacion_aumento`='$codigo_ubicacion_aumento',`supervisor_aumento`='$supervisor_aumento' WHERE id=$idaumento";
	echo $query;

	$stmt = Conexion::conectar()->prepare($query);
	$stmt->execute();			
	return $stmt->fetchAll();
	$stmt->close();
	$stmt = null;

?>