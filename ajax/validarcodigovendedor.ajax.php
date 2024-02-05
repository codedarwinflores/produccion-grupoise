<?php

require_once "../modelos/conexion.php";

$codigo = $_POST["codigo"];

function ObtenerCorrelativo() {
	global $codigo;
	$query = "select count(*) as codigo from tbl_vendedor where codigo='".$codigo."'";
	$sql = Conexion::conectar()->prepare($query);
	$sql->execute();			
	return $sql->fetchAll();
  };

$codigo0="";
 $data0 = ObtenerCorrelativo();
 foreach($data0 as $row0) {
  $codigo0 = $row0['codigo'];
  /* echo $correlativo; */
  
}

echo $codigo0;


?>

