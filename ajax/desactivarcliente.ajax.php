

<?php

require_once "../modelos/conexion.php";

$id=$_POST["id"];
$estado=$_POST["estado"];




	$query = "UPDATE `clientes` SET `estado_cliente`='".$estado."' WHERE id=".$id."";
	$stmt = Conexion::conectar()->prepare($query);
	$stmt->execute();			



	$query01 = "UPDATE `tbl_clientes_ubicaciones` SET `estado_cliente_ubicacion`='".$estado."' WHERE id_cliente=".$id."";
	echo $query01;
	$stmt01 = Conexion::conectar()->prepare($query01);
	$stmt01->execute();			
	return $stmt01->fetchAll();
	$stmt->close();








?>