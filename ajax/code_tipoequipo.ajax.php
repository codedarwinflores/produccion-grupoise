<?php

require_once "../modelos/conexion.php";

$obtenercodigo = $_POST["obtenercodigo"];

function tbl_tipos_de_armas() {
	global $obtenercodigo;
	$query = "SELECT * FROM tipo_otros_equipos WHERE codigo='$obtenercodigo'";
	$stmt = Conexion::conectar()->prepare($query);
	$stmt->execute();			
	return $stmt->fetchAll();
	
	$stmt->close();
	
	$stmt = null;
};
		$id_tipo;
		$data = tbl_tipos_de_armas();
		foreach($data as $row) {
			$id_tipo = $row["id"];

		}


	/* 	******************* */


	function armas() {
		global $id_tipo;
		$query = "SELECT * FROM tbl_otros_equipos WHERE tipo_equipos='$id_tipo' order by id desc limit 1";
		$stmt = Conexion::conectar()->prepare($query);
		$stmt->execute();			
		return $stmt->fetchAll();
		
		$stmt->close();
		
		$stmt = null;
	};

			$correlativo="";
			$data01 = armas();
			$quitarceros;
			foreach($data01 as $row) {
				$numero = $row["codigo_equipo"];

				$quitarletra = substr($numero, 4);
              	$quitarceros = ltrim($quitarletra, "0"); 
				
				if($quitarceros=="")
				{
					$addnumber=0+1;
				}
				else{
              	$addnumber = addslashes($quitarceros)+1;
				}

             	 $correlativo_numero = sprintf("%04d",$addnumber);
				 $correlativo=$obtenercodigo.$correlativo_numero;
              
	
			}
			if($correlativo=="")
			{
				$correlativo=$obtenercodigo."0001";
			}

	/* ****************** */
	/* $query = "SELECT * FROM tbl_otros_equipos WHERE tipo_equipos='$id_tipo' order by id desc limit 1"; */
echo json_encode($correlativo);


