<?php

require_once "../modelos/conexion.php";

$obtenercodigo = $_POST["obtenercodigo"];




function ObtenerCorrelativo() {
	global $obtenercodigo;
	$query = "select * from clientes where nombre regexp '".$obtenercodigo."' order by id desc limit 1";
	$sql = Conexion::conectar()->prepare($query);
	$sql->execute();			
	return $sql->fetchAll();
  };

$correlativo="";
 $data0 = ObtenerCorrelativo();
 foreach($data0 as $row0) {
  $numero = $row0['codigo'];
  $quitarletra = substr($numero, 1);
  $quitarceros = ltrim($quitarletra, "0"); 
  $addnumber= $quitarceros+1;
  $correlativo = sprintf("%04d",$addnumber);
  
  /* echo $correlativo; */
  
}
if($correlativo == "")
{
  $correlativo="0001";
}

echo $correlativo;


?>

