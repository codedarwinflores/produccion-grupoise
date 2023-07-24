<?php

require_once "../modelos/conexion.php";

$codigo = $_POST["codigo"];
$tabla = $_POST["tabla"];
$columna = $_POST["columna"];




function ObtenerCorrelativo($tabla1, $columna1, $codigo1) {
	
	$query = "select count(*) as codigo from $tabla1 where $columna1='".$codigo1."'";
	$sql = Conexion::conectar()->prepare($query);
	$sql->execute();			
	return $sql->fetchAll();
  };

$codigo0="";
 $data0 = ObtenerCorrelativo( $tabla, $columna, $codigo);
 foreach($data0 as $row0) {
  $codigo0 = $row0['codigo'];
  /* echo $correlativo; */
  
}

echo $codigo0;


?>

