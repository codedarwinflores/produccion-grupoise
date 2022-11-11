<?php

require_once "../modelos/conexion.php";

$obtenercodigo = $_POST["obtenercodigo"];

function tbl_tipos_de_armas() {
	global $obtenercodigo;
	$query = "SELECT * FROM tbl_tipos_de_armas WHERE codigo='$obtenercodigo'";
	$stmt = Conexion::conectar()->prepare($query);
	$stmt->execute();			
	return $stmt->fetchAll();
	
	$stmt->close();
	
	$stmt = null;
};
		$id_tipo_arma;
		$data = tbl_tipos_de_armas();
		foreach($data as $row) {
			$id_tipo_arma = $row["id"];

		}


	/* 	******************* */


	function armas() {
		global $id_tipo_arma;
		$query = "SELECT * FROM tbl_armas WHERE id_tipo_arma='$id_tipo_arma' order by id desc limit 1";
		$stmt = Conexion::conectar()->prepare($query);
		$stmt->execute();			
		return $stmt->fetchAll();
		
		$stmt->close();
		
		$stmt = null;
	};

			$correlativo_arma;
			$data01 = armas();
			$quitarceros;
			foreach($data01 as $row) {
				$numero = $row["codigo"];

				$quitarletra = substr($numero, 3);
              	$quitarceros = ltrim($quitarletra, "0"); 
				
				if($quitarceros=="")
				{
					$addnumber=0+1;
				}
				else{
              	$addnumber = addslashes($quitarceros)+1;
				}

             	 $correlativo_numero = sprintf("%04d",$addnumber);
				 $correlativo_arma=$obtenercodigo.$correlativo_numero;
              
	
			}

	/* ****************** */
	$query = "SELECT * FROM tbl_armas WHERE id_tipo_arma='$id_tipo_arma' order by id desc limit 1";

echo json_encode($correlativo_arma);


