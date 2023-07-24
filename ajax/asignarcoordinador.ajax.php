

<?php

require_once "../modelos/conexion.php";

$idpatrulla=$_POST["idpatrulla"];
$idubiacion=$_POST["idubiacion"];
$idcoordinador=$_POST["idcoordinador"];


	$query01 = "INSERT INTO `tbl_patrullas_ubicaciones`(`id_patrullas_pu`, `id_ubicacion_pu`) VALUES($idpatrulla,$idubiacion)";
	echo $query01;
	$stmt = Conexion::conectar()->prepare($query01);
	$stmt->execute();	



	$query = "UPDATE `tbl_clientes_ubicaciones` SET `id_coordinador_zona`=$idcoordinador where id=$idubiacion";
	$stmt1 = Conexion::conectar()->prepare($query);
	$stmt1->execute();	

	

	




?>