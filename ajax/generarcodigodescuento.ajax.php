<?php

require_once "../modelos/conexion.php";

$idempleadoretiro=$_POST["id"];
function getContent() {
	global $idempleadoretiro;
	$query = "SELECT `id`, `fecha_descuento`, `codigo_empleado_descuento`, `codigo_uni_descuento`, `numero_recibo_descuento`, `valor_descuento`, `observacion_descuento`, count(*) as nombre FROM `uniformedescuento` ORDER by id desc";
	$stmt = Conexion::conectar()->prepare($query);
	$stmt->execute();			
	return $stmt->fetchAll();
	$stmt->close();
	$stmt = null;
};
		$data = getContent();
		foreach($data as $row) {

		


			if($row["nombre"] == 0)
			{
				echo "00000001";
			}
			else{
				$quitarceros = ltrim($row["numero_recibo_descuento"], "0");
				$addnumber = addslashes($quitarceros)+1;
				$correlativo_numero = sprintf("%08d",$addnumber);
				echo $correlativo_numero;
			}
	
		}


?>