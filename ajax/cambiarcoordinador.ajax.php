

<?php

require_once "../modelos/conexion.php";

$coordinadoractual=$_POST["coordinadoractual"];
$ubicacion=$_POST["ubicacion"];
$coordinadornuevo=$_POST["coordinadornuevo"];

if($ubicacion=="*"){
	$query = "UPDATE `tbl_clientes_ubicaciones` SET `id_coordinador_zona`=$coordinadornuevo where id_coordinador_zona=$coordinadoractual";
	$stmt = Conexion::conectar()->prepare($query);
	$stmt->execute();			
	return $stmt->fetchAll();
	$stmt->close();
	$stmt = null;
}else{
	

	$query = "UPDATE `tbl_clientes_ubicaciones` SET `id_coordinador_zona`=$coordinadornuevo where id=$ubicacion";
	$stmt = Conexion::conectar()->prepare($query);
	$stmt->execute();			
	return $stmt->fetchAll();
	$stmt->close();
	$stmt = null;

	
}	


?>