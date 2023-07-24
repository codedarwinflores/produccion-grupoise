

<?php

require_once "../modelos/conexion.php";

$fecha_aumentar=$_POST["fecha_aumentar"];
$hora_aumentar=$_POST["hora_aumentar"];
$anterior_aumentar=$_POST["anterior_aumentar"];
$aumentar_hombres=$_POST["aumentar_hombres"];
$disminuye_hombres=$_POST["disminuye_hombres"];
$actual_hombre=$_POST["actual_hombre"];
$idubicacion_aumento=$_POST["idubicacion_aumento"];
$cuanta_registro=$_POST["cuanta_registro"];
/* 
if($cuenta==1){

	$query = "UPDATE `aumentos_hombres` SET `fecha_aumento`='$fecha_aumentar',`hora_aumento`='$hora_aumentar',`anterior_aumento`='$anterior_aumentar',`aumento_hombres`='$aumentar_hombres',`disminucion_hombre`='$disminuye_hombres',`actual_hombre`='$actual_hombre',`idubicacion_aumento`='$idubicacion_aumento' WHERE idubicacion_aumento=$cuenta";
	$stmt = Conexion::conectar()->prepare($query);
	$stmt->execute();			
	return $stmt->fetchAll();
	$stmt->close();
	$stmt = null;

	echo "Si";

}
else{ */
	

	$query = "INSERT INTO `aumentos_hombres`( `fecha_aumento`, `hora_aumento`, `anterior_aumento`, `aumento_hombres`, `disminucion_hombre`, `actual_hombre`, `idubicacion_aumento`) VALUES ('$fecha_aumentar','$hora_aumentar','$anterior_aumentar','$aumentar_hombres','$disminuye_hombres','$actual_hombre','$idubicacion_aumento')";
	$stmt = Conexion::conectar()->prepare($query);
	$stmt->execute();			
/* 	return $stmt->fetchAll();
	$stmt->close();
	$stmt = null; */

/* 	echo "Si"; */

/* }
 */

$query01 = "UPDATE `tbl_clientes_ubicaciones` SET `hombres_autorizados`='$actual_hombre' WHERE id=$idubicacion_aumento";

	$stmt01 = Conexion::conectar()->prepare($query01);
	$stmt01->execute();			
	return $stmt01->fetchAll();
	$stmt01->close();
	$stmt01 = null;

	echo "Si";
?>