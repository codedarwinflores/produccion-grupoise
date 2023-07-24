

<?php

require_once "../modelos/conexion.php";

$nuevo24hr=$_POST["nuevo24hr"];
$nuevo12hde=$_POST["nuevo12hde"];
$nuevo12hd6=$_POST["nuevo12hd6"];
$nuevo12hn6=$_POST["nuevo12hn6"];
$nuevo12hd7=$_POST["nuevo12hd7"];
$nuevo12hn7=$_POST["nuevo12hn7"];
$nuevoextraordinario=$_POST["nuevoextraordinario"];
$nuevoseptimo=$_POST["nuevoseptimo"];
$nuevoturnos_comodin=$_POST["nuevoturnos_comodin"];
$nuevonotas=$_POST["nuevonotas"];
$idubicacion_turno=$_POST["idubicacion_turno"];
$idcache=$_POST["id"];


if($idcache==""){


	$query = "INSERT INTO `tbl_ubicaciones_turnos`(`24hr`, `12hde`, `12hd6`, `12hn6`, `12hd7`, `12hn7`, `extraordinario`, `septimo`, `turnos_comodin`, `notas`, `idubicacion`) VALUES ('$nuevo24hr','$nuevo12hde','$nuevo12hd6','$nuevo12hn6','$nuevo12hd7','$nuevo12hn7','$nuevoextraordinario','$nuevoseptimo','$nuevoturnos_comodin','$nuevonotas','$idubicacion_turno')";
	$stmt = Conexion::conectar()->prepare($query);
	$stmt->execute();			
	return $stmt->fetchAll();
	$stmt->close();
	$stmt = null;

	echo "Si";




}
else{
	
	
	/* *********** */
	$query = "UPDATE `tbl_ubicaciones_turnos` SET `24hr`='$nuevo24hr',`12hde`='$nuevo12hde',`12hd6`='$nuevo12hd6',`12hn6`='$nuevo12hn6',`12hd7`='$nuevo12hd7',`12hn7`='$nuevo12hn7',`extraordinario`='$nuevoextraordinario',`septimo`='$nuevoseptimo',`turnos_comodin`='$nuevoturnos_comodin',`notas`='$nuevonotas',`idubicacion`='$idubicacion_turno' WHERE  id=$idcache";
	$stmt = Conexion::conectar()->prepare($query);
	$stmt->execute();			
	return $stmt->fetchAll();
	$stmt->close();
	$stmt = null;

	echo "Si";
	
}

?>