<?php

require_once "../modelos/conexion.php";

$obtenercodigo = $_POST["obtenercodigo"];



function consulta() {
	global $obtenercodigo;
	$query = "SELECT * FROM tbl_tipos_de_vehiculo WHERE codigo='$obtenercodigo'";
	$stmt = Conexion::conectar()->prepare($query);
	$stmt->execute();			
	return $stmt->fetchAll();
	
	$stmt->close();
	
	$stmt = null;
};
		$id_tipo;
		$data = consulta();
		foreach($data as $row) {
			$id_tipo = $row["id"];

		}



	/* 	******************* */


	function consultadatos() {
		global $id_tipo;
		$query = "SELECT * FROM tbl_vehiculos WHERE id_tipo_vehiculo='$id_tipo' order by id desc limit 1";
		$stmt = Conexion::conectar()->prepare($query);
		$stmt->execute();			
		return $stmt->fetchAll();
		
		$stmt->close();
		
		$stmt = null;
	};

			$correlativo_dato="";
			$data01 = consultadatos();
			$quitarceros;
			foreach($data01 as $row) {
				$numero = $row["codigo_vehiculo"];

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
				 $correlativo_dato=$obtenercodigo.$correlativo_numero;
              
	
			}
			if($correlativo_dato=="")
			{
				$correlativo_dato=$obtenercodigo."0001";
			}

	/* ****************** */
/* 	$query = "SELECT * FROM tbl_consultadatos WHERE id_tipo_dato='$id_tipo_dato' order by id desc limit 1";
 */
echo json_encode($correlativo_dato);


