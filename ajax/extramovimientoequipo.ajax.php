<?php

require_once "../controladores/movimientoequipo.controlador.php";
require_once "../modelos/movimientoequipo.modelo.php";


$accion="";
if ( isset($_POST["accion01"]) ) {
    $accion = $_POST["accion01"];
}
function getContent_insert()
{
	$query = "SHOW COLUMNS FROM movimientosequipos WHERE Field NOT IN ('id')";
	$stmt = Conexion::conectar()->prepare($query);
	$stmt->execute();
	return $stmt->fetchAll();
	$stmt->close();
	$stmt = null;
}

switch ($accion) {
	case "correlativo":
		/* ************ */
		function consultar_situacion2()
		{
			$query01="SELECT*FROM movimientosequipos ORDER by id DESC
			LIMIT 1";
			
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
			
		};
		$data01 = consultar_situacion2();
		$correlativo_dato="";
		foreach ($data01 as $value) {
		
				$numero = $value["correlativo_movimiento"];
				$quitarletra = substr($numero, 4);
              	$quitarceros = ltrim($quitarletra, "0"); 
				
				if($quitarceros=="")
				{
					$addnumber=0+1;
				}
				else{
              	$addnumber = addslashes($quitarceros)+1;
				}

             	 $correlativo_numero = sprintf("%09d",$addnumber);
				 $correlativo_dato=$correlativo_numero;
              
		}
		if($correlativo_dato == "")
		{
			$correlativo_dato="000000001";
		}
		echo $correlativo_dato;
		/* ************ */
	break;
	case "cantidades":
		$idubicacion=$_POST["idubicacion"];
		/* ************ */
		function arma($idubicacion1)
		{
			$query01="SELECT COUNT(*) as cuenta_arma
			FROM `movimientosequipos` 
			WHERE id_ubicacion_movimiento='$idubicacion1' and tipoequipo='arma'";
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};
		function radio($idubicacion1)
		{
			$query01="SELECT COUNT(*) as cuenta_radio
			FROM `movimientosequipos` 
			WHERE id_ubicacion_movimiento='$idubicacion1' and tipoequipo='radio';";
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};
		function celular($idubicacion1)
		{
			$query01="SELECT COUNT(*) as cuenta_celular
			FROM `movimientosequipos` 
			WHERE id_ubicacion_movimiento='$idubicacion1' and tipoequipo='celular';";
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};
		$data01 = arma($idubicacion);
		$numero_arma="";
		$numero_radio="";
		$numero_celular="";
		foreach ($data01 as $value) {
				$numero_arma.=$value["cuenta_arma"];  
		}
		$data01 = radio($idubicacion);
		foreach ($data01 as $value) {
				$numero_radio.=$value["cuenta_radio"];    
		}
		$data01 = celular($idubicacion);
		foreach ($data01 as $value) {
				$numero_celular.=$value["cuenta_celular"];    
		}
		echo $numero_arma.",".$numero_radio.",".$numero_celular;
		/* ************ */
	break;
	case "ubicacion":
		$codigo=$_POST["codigo"];
		/* ************ */
		function ubicacion($idubicacion1)
		{
			$query01="SELECT * FROM `tbl_clientes_ubicaciones` WHERE id='$idubicacion1'";
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};
		function movimiento($codigo1)
		{
			$query01="SELECT * FROM `movimientosequipos` 
			WHERE codigo_equipo='$codigo1'";
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};
		$data01 = movimiento($codigo);
		$nombre_ubicacion="";
		foreach ($data01 as $value) {
				$id_ubicacion_movimiento=$value["id_ubicacion_movimiento"];  
				$data_ubicacion = ubicacion($id_ubicacion_movimiento);
				foreach ($data_ubicacion as $value_ubicacion) {
					$nombre_ubicacion.=$value_ubicacion["nombre_ubicacion"];  
				}
		}
		if($nombre_ubicacion==""){
			$nombre_ubicacion="Actualmente no esta asignada";
		}
		echo $nombre_ubicacion;
		/* ************ */
	break;
	case "insertar":
		$codigo=$_POST["codigo_equipo"];
		/* ************ */
		function movimiento($codigo1)
		{
			$query01="SELECT COUNT(*) as cuenta FROM `movimientosequipos` 
			WHERE codigo_equipo='$codigo1'";
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};
		$data01 = movimiento($codigo);
		$codigoequipo="";
		foreach ($data01 as $value) {
				$codigoequipo.=$value["cuenta"];  
		}
		
		if($codigoequipo==0){
			/* ----------INSERTAR-------------------- */
			$data = getContent_insert();
			$namecampos_situacion="";
			$namecolumnas_situacion_his="";
			$namecolumnas_situacion="";
			foreach ($data as $row) {
				$namecolumnas_situacion .= $row['Field'] . ",";
				$namecolumnas_situacion_his .= $row['Field']."_his" . ",";
				$namecampos_situacion .= ":" . $row['Field'] . ",";
			}
			$stmt = Conexion::conectar()->prepare("INSERT INTO movimientosequipos(" . trim($namecolumnas_situacion, ",") . ") VALUES (" . trim($namecampos_situacion, ",") . ")");
		
			echo "INSERT INTO movimientosequipos(" . trim($namecolumnas_situacion, ",") . ") VALUES (" . trim($namecampos_situacion, ",") . ")";
			foreach ($data as $row) {
				$stmt->bindParam(":" . $row['Field'], $_POST["" . $row['Field'] . ""], PDO::PARAM_STR);
			}
			$stmt->execute();

			$stmt = Conexion::conectar()->prepare("INSERT INTO historialmovimientosequipos(" . trim($namecolumnas_situacion_his, ",") . ") VALUES (" . trim($namecampos_situacion, ",") . ")");
			foreach ($data as $row) {
				$stmt->bindParam(":" . $row['Field'], $_POST["" . $row['Field'] . ""], PDO::PARAM_STR);
			}
			$stmt->execute();
			/* ------------------------------ */
		}
		else{

			/* ----------------MODIFICAR */
			$data = getContent_insert();
			foreach ($data as $row) {
				$namecolumnas_situacion_his .= $row['Field']."_his" . ",";
				$test .= $row['Field'] . "='" . $_POST["" . $row['Field'] . ""] . "',";
				$namecampos_situacion .= ":" . $row['Field'] . ",";

			}


			$query01 = "UPDATE movimientosequipos SET " . trim($test, ",") . " WHERE codigo_equipo='$codigo'";
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();

			$stmt = Conexion::conectar()->prepare("INSERT INTO historialmovimientosequipos(" . trim($namecolumnas_situacion_his, ",") . ") VALUES (" . trim($namecampos_situacion, ",") .")");
			foreach ($data as $row) {
				$stmt->bindParam(":" . $row['Field'], $_POST["" . $row['Field'] . ""], PDO::PARAM_STR);
			}
			$stmt->execute();
			/* ----------------MODIFICAR */
		}
		/* ************ */
	break;
	default:
		echo $accion."respuesta nula";
}
?>