<?php

require_once "../controladores/recibo.controlador.php";
require_once "../modelos/recibo.modelo.php";



/* $id="";
if ( isset($_POST["id"]) ) {
    $id = $_POST["id"];
}
if($id==""){
	$accion="insertar";
}
else{
	$accion="modificar";
} */

function getContent_insert()
{
	$query = "SHOW COLUMNS FROM kardex WHERE Field NOT IN ('id')";
	$stmt = Conexion::conectar()->prepare($query);
	$stmt->execute();
	return $stmt->fetchAll();
	$stmt->close();
	$stmt = null;
}

function getContent_modificar()
{
	$query = "SHOW COLUMNS FROM kardex WHERE Field NOT IN ('id') and Field NOT IN ('cantidad_kardex')";
	$stmt = Conexion::conectar()->prepare($query);
	$stmt->execute();
	return $stmt->fetchAll();
	$stmt->close();
	$stmt = null;
}
function getContent_insert_historial()
{
	$query = "SHOW COLUMNS FROM historial_kardex WHERE Field NOT IN ('id')";
	$stmt = Conexion::conectar()->prepare($query);
	$stmt->execute();
	return $stmt->fetchAll();
	$stmt->close();
	$stmt = null;
}

$accion="";
if ( isset($_POST["accion01"]) ) {
    $accion = $_POST["accion01"];
}
else{

/* ******************** */

$equipo_kardex="";
if ( isset($_POST["equipo_kardex"]) ) {
    $equipo_kardex = $_POST["equipo_kardex"];
}
function consultar_situacion($equipo)
	{
		$query01="SELECT COUNT(*) as numero FROM `kardex` where equipo_kardex='$equipo'";
			
		$sql = Conexion::conectar()->prepare($query01);
		$sql->execute();
		return $sql->fetchAll();
			
	};
	$data01 = consultar_situacion($equipo_kardex);
	$cuenta="";
	foreach ($data01 as $value) {
		$cuenta.=$value["numero"];  
	}
	if($cuenta=="0"){
		$accion="insertar";
	}
	else{
		$accion="modificar";
	}
/* ******************** */
}
switch ($accion) {
	case "correlativoplanilla":
		
		function consultar_situacion2()
		{
			$query01="SELECT*FROM kardex ORDER by id DESC  LIMIT 1";
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
			
		};
		$data01 = consultar_situacion2();
		$correlativo_dato="";
		foreach ($data01 as $value) {
		
				$numero = $value["correlativo_kardex"];
				$quitarletra = substr($numero, 4);
              	$quitarceros = ltrim($quitarletra, "0"); 
				
				if($quitarceros=="")
				{
					$addnumber=0+1;
				}
				else{
              	$addnumber = addslashes($quitarceros)+1;
				}
             	 $correlativo_numero = sprintf("%08d",$addnumber);
				 $correlativo_dato=$correlativo_numero;
              
		}
		if($correlativo_dato == "")
		{
			$correlativo_dato="00000001";
		}
		echo $correlativo_dato;
	break;
	case "insertar":
		/* ****************** */
		/* CAPTURA NOMBRE DE LAS COLUMNAS Y CAMPOS DEL IMPUT */
		$namecolumnas_situacion = "";
		$namecampos_situacion = "";

		$data = getContent_insert();
		foreach ($data as $row) {
			$namecolumnas_situacion .= $row['Field'] . ",";
			$namecampos_situacion .= ":" . $row['Field'] . ",";
		}
		$stmt = Conexion::conectar()->prepare("INSERT INTO kardex(" . trim($namecolumnas_situacion, ",") . ") VALUES (" . trim($namecampos_situacion, ",") . ")");
	
		
		foreach ($data as $row) {
			$stmt->bindParam(":" . $row['Field'], $_POST["" . $row['Field'] . ""], PDO::PARAM_STR);
		}
		$stmt->execute();
		/* ****************** */
		/* CAPTURA NOMBRE DE LAS COLUMNAS Y CAMPOS DEL IMPUT */
		$namecolumnas_situacion2 = "";

		$data10 = getContent_insert_historial();
		foreach ($data10 as $row) {
			$namecolumnas_situacion2 .= $row['Field'] . ",";
		}
		$stmt = Conexion::conectar()->prepare("INSERT INTO historial_kardex(" . trim($namecolumnas_situacion2, ",") . ") VALUES (" . trim($namecampos_situacion, ",") . ")");

		foreach ($data as $row) {
			$stmt->bindParam(":" . $row['Field'], $_POST["" . $row['Field'] . ""], PDO::PARAM_STR);
		}
		$respuesta = "";
		$stmt->execute();
		$stmt = null;
		/* ***************** */
	break;
	case "modificar":
		$namecolumnas_situacion = "";
		$namecampos_situacion = "";
		$data = getContent_insert();
		$datamodificar=getContent_modificar();
		$test = "";
		foreach ($datamodificar as $row) {
			$namecolumnas_situacion .= $row['Field'] . "=" . ":" . $row['Field'] . ",";
			$test .= $row['Field'] . "='" . $_POST["" . $row['Field'] . ""] . "',";
		}
		$equipo_kardex=$_POST["equipo_kardex"];
		function kardex($equipo_kardex1)
		{
					$query01 = "SELECT * FROM kardex WHERE equipo_kardex='$equipo_kardex1' ";
					$sql = Conexion::conectar()->prepare($query01);
					$sql->execute();
					return $sql->fetchAll();
		}
		$inventario="";
		$data03 = kardex($equipo_kardex);
		foreach ($data03 as $value) {
			$inventario.=$value["cantidad_kardex"];
		}
		$tipo_transaccion_equipo=$_POST["tipo_transaccion_equipo"];
		$cantidad_kardex=$_POST["cantidad_kardex"];

		$total_inventario=0;
		if($tipo_transaccion_equipo=="Aumenta"){
			$total_inventario=$inventario+$cantidad_kardex;
		}
		else{
			$total_inventario=$inventario-$cantidad_kardex;
		}

		if($total_inventario<="0"){
			$total_inventario="0";
		}

		$query01 = "UPDATE kardex SET " . trim($test, ",") . ",cantidad_kardex='$total_inventario' WHERE equipo_kardex='$equipo_kardex'";
		$sql = Conexion::conectar()->prepare($query01);
		$sql->execute();
		
		/* ****************** */
		/* CAPTURA NOMBRE DE LAS COLUMNAS Y CAMPOS DEL IMPUT */
		$namecolumnas_situacion2 = "";
		$namecampos_situacion2 = "";
		$data1 = getContent_insert_historial();
		foreach ($data1 as $row) {
			$namecolumnas_situacion2 .= $row['Field'] . ",";
			$namecampos_situacion2 .= ":" . $row['Field'] . ",";
		}
		$stmt = Conexion::conectar()->prepare("INSERT INTO historial_kardex(" . trim($namecolumnas_situacion2, ",") . ") VALUES (" . trim($namecampos_situacion2, ",") . ")");


		foreach ($data as $row) {
			$stmt->bindParam(":" . $row['Field']."h", $_POST["" . $row['Field'] . ""], PDO::PARAM_STR);
		}
		$respuesta = "";
		if ($stmt->execute()) {
			$respuesta = "ok";
			return "ok";
		} else {
			$respuesta = "error";
			return "error";
		}
		echo $respuesta;
		$stmt->close();
		$stmt = null;
		/* ***************** */
	break;
	case "eliminar":
		/* ********************* */
		$idkardex=$_POST["idkardex"];
		$query = "DELETE FROM `kardex` WHERE id=$idkardex";
		echo $query;
		$stmt = Conexion::conectar()->prepare($query);
		$stmt->execute();
		/* ****************** */
		return $stmt->fetchAll();
		$stmt->close();
		$stmt = null;
		/* ********************* */
	break;
	case "eliminartransanccion":
		/* ********************* */
		$idkardex=$_POST["idkardex"];/* --correlativo */

		function infokardexhistorial($correlativo_kardex1)
        {

              $query01 = "SELECT historial_kardex.*, tbl_transacciones_equipo.* 
			  				FROM historial_kardex,tbl_transacciones_equipo  
							where correlativo_kardexh='$correlativo_kardex1'  and historial_kardex.transancion_kardexh=tbl_transacciones_equipo.id ";
              $sql = Conexion::conectar()->prepare($query01);
              $sql->execute();
              return $sql->fetchAll();
        }
		$data04 = infokardexhistorial($idkardex);
		function infokardex($id1)
        {
              $query01 = "SELECT*FROM kardex 
							where equipo_kardex='$id1' ";
              $sql = Conexion::conectar()->prepare($query01);
              $sql->execute();
              return $sql->fetchAll();
        }
		foreach ($data04 as $value) {
			$cantidad_anterior=$value["cantidad_kardexh"];
			$equipo_kardex=$value["equipo_kardexh"];
			$tipo_transaccion_equipo=$value["tipo_transaccion_equipo"];

			$data05 = infokardex($equipo_kardex);
			foreach ($data05 as $value2) {
				$cantidad_actual=$value2["cantidad_kardex"];


				if($tipo_transaccion_equipo=="Disminuye"){
					$restar_cantidad=$cantidad_actual+$cantidad_anterior;

				}
				else{
					$restar_cantidad=$cantidad_actual-$cantidad_anterior;

				}
				if($restar_cantidad<="0"){
					$restar_cantidad="0";
				}

				$query01 = "UPDATE kardex SET cantidad_kardex='$restar_cantidad' WHERE equipo_kardex='$equipo_kardex'";
				echo $query01;
				$sql = Conexion::conectar()->prepare($query01);
				$sql->execute();

			}

		}

		$query = "DELETE FROM `historial_kardex` WHERE correlativo_kardexh=$idkardex";
		echo $query;
		$stmt = Conexion::conectar()->prepare($query);
		$stmt->execute();
		/* ****************** */
		return $stmt->fetchAll();
		$stmt->close();
		$stmt = null;
		/* ********************* */
	break;
	case "modificarproducto":
		/* ********************* */
		$codigoproducto=$_POST["codigoproducto"];/* -- */
		$idregistro=$_POST["idregistro"];/* -- */
		$cantidadtext=$_POST["cantidadtext"];/* -- */
		$preciotext=$_POST["preciotext"];/* -- */
		$totaltext=$_POST["totaltext"];/* -- */
		$totalglobal=$_POST["totalglobal"];/* -- */


		function infokardexhistorial($idregistro1)
        {
              $query01 = "SELECT*FROM historial_kardex where id='$idregistro1'";
			  echo $query01;
              $sql = Conexion::conectar()->prepare($query01);
              $sql->execute();
              return $sql->fetchAll();
        }
		$data04 = infokardexhistorial($idregistro);
		function infokardex($id1)
        {
              $query01 = "SELECT*FROM kardex where equipo_kardex='$id1'";
              $sql = Conexion::conectar()->prepare($query01);
              $sql->execute();
              return $sql->fetchAll();
        }
		$cantidad_anterior="";
		$equipo_kardex="";
		foreach ($data04 as $value) {
			$cantidad_anterior.=$value["cantidad_kardexh"];
			$equipo_kardex.=$value["equipo_kardexh"];

		}
		$data05 = infokardex($equipo_kardex);
		$cantidad_actual="";
		foreach ($data05 as $value2) {
			$cantidad_actual.=$value2["cantidad_kardex"];
		}

		$restar_cantidad=$cantidad_actual-$cantidad_anterior;
		if($restar_cantidad<="0"){
			$restar_cantidad="0";
		}
		$nuevacantidad=$restar_cantidad+$cantidadtext;

		$query01 = "UPDATE kardex SET cantidad_kardex='$nuevacantidad',precio_kardex='$preciotext',subtotal_kardex='$totaltext',total_kardex='$totalglobal' WHERE equipo_kardex='$equipo_kardex'";
		
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();

		$query01 = "UPDATE historial_kardex SET cantidad_kardexh='$cantidadtext',precio_kardexh='$preciotext',subtotal_kardexh='$totaltext',total_kardexh='$totalglobal' WHERE id='$idregistro'";
		echo $query01;
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();

	
	break;
	case "eliminarproducto":
		/* ********************* */
		$codigoproducto=$_POST["codigoproducto"];/* -- */
		$idregistro=$_POST["idregistro"];/* -- */


		function infokardexhistorial($idregistro1)
        {
              $query01 = "SELECT historial_kardex.*, tbl_transacciones_equipo.* 
			  				FROM historial_kardex,tbl_transacciones_equipo  
							where historial_kardex.id='$idregistro1'  and historial_kardex.transancion_kardexh=tbl_transacciones_equipo.id";
			  echo $query01;
              $sql = Conexion::conectar()->prepare($query01);
              $sql->execute();
              return $sql->fetchAll();
        }
		$data04 = infokardexhistorial($idregistro);
		function infokardex($id1)
        {
              $query01 = "SELECT * FROM kardex
						  where equipo_kardex='$id1'";
			echo $query01;
              $sql = Conexion::conectar()->prepare($query01);
              $sql->execute();
              return $sql->fetchAll();
        }
		$cantidad_anterior="";
		$equipo_kardex="";
		$total="";
		$correlativo="";
		$tipo_transaccion_equipo="";
		foreach ($data04 as $value) {
			$cantidad_anterior.=$value["cantidad_kardexh"];
			$equipo_kardex.=$value["equipo_kardexh"];
			$correlativo.=$value["correlativo_kardexh"];
			$total.=$value["total_kardexh"]-$value["subtotal_kardexh"];
			$tipo_transaccion_equipo.=$value["tipo_transaccion_equipo"];


		}
		$data05 = infokardex($equipo_kardex);
		$cantidad_actual="";
		foreach ($data05 as $value2) {
			$cantidad_actual.=$value2["cantidad_kardex"];

		}

		if($tipo_transaccion_equipo=="Disminuye"){
			$restar_cantidad=$cantidad_actual+$cantidad_anterior;
		}
		else{
			$restar_cantidad=$cantidad_actual-$cantidad_anterior;
		}

		if($restar_cantidad<="0"){
			$restar_cantidad="0";
		}

			$query01 = "UPDATE kardex SET cantidad_kardex='$restar_cantidad' WHERE equipo_kardex='$equipo_kardex'";
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();

			$query01 = "UPDATE historial_kardex SET total_kardexh='$total' WHERE correlativo_kardexh='$correlativo'";
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();

			$query = "DELETE FROM `historial_kardex` WHERE id=$idregistro";
			$stmt = Conexion::conectar()->prepare($query);
			$stmt->execute();
			/* ****************** */
			return $stmt->fetchAll();
			$stmt->close();
			$stmt = null;
			/* ********************* */
	
	break;
	default:
		echo $accion."respuesta nula";
}
?>