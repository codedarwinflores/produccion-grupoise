<?php

require_once "../controladores/recibo.controlador.php";
require_once "../modelos/recibo.modelo.php";

function getContent_modificar()
{
	$query = "SHOW COLUMNS FROM kardex WHERE Field NOT IN ('id') and Field NOT IN ('cantidad_kardex')";
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

switch ($accion) {
	case "correlativoplanilla":
		function consultar_situacion2()
		{
			$query01="SELECT*FROM recibos ORDER by id DESC
			LIMIT 1";
			
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
			
		};
		$data01 = consultar_situacion2();
		$correlativo_dato="";
		foreach ($data01 as $value) {
		
				$numero = $value["numero_recibo"];
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
	case "insertdetalle":
		/* ********************** */
		$numero_recibo_detalle  =$_POST["numero_recibo_detalle"];
		$equipo_kardex=$_POST["kardex_detalle"];
		$cantidad_kardex=$_POST["cantidad_detalle"];
		$precio_detalle  =$_POST["precio_detalle"];
		$total_detalle  =$_POST["total_detalle"];
		$fecha_kardexh  =$_POST["fecha_kardexh"];
		/* $transancion_kardexh  =$_POST["transancion_kardexh"]; */
		$transancion_kardexh  ="17";
		$empleado_kardexh  =$_POST["empleado_kardexh"];


		$namecolumnas_situacion = "";
		$namecampos_situacion = "";
		/* $datamodificar=getContent_modificar();
		$test = "";
		foreach ($datamodificar as $row) {
			$namecolumnas_situacion .= $row['Field'] . "=" . ":" . $row['Field'] . ",";
			$test .= $row['Field'] . "='" . $_POST["" . $row['Field'] . ""] . "',";
		} */
		function kardex($equipo_kardex1)
		{
					$query01 = "SELECT * FROM kardex WHERE equipo_kardex='$equipo_kardex1' ";
					$sql = Conexion::conectar()->prepare($query01);
					$sql->execute();
					return $sql->fetchAll();
		}
		$inventario="";
		$correlativo_kardexh="";
		$ubicacion_kardexh="";
		$data03 = kardex($equipo_kardex);
		foreach ($data03 as $value) {
			$inventario.=$value["cantidad_kardex"];
			$correlativo_kardexh.=$value["correlativo_kardex"];
			$ubicacion_kardexh.=$value["ubicacion_kardex"];
		}

		function transancion()
		{
					$query01 = "SELECT * FROM `tbl_transacciones_equipo` where codigo=17";
					$sql = Conexion::conectar()->prepare($query01);
					$sql->execute();
					return $sql->fetchAll();
		}
		$data04 = transancion();
		$idtransaccion="";
		foreach ($data04 as $value) {
			$idtransaccion.=$value["id"];
		}


		$total_inventario=$inventario-$cantidad_kardex;
		$query01 = "UPDATE kardex SET fecha_kardex='$fecha_kardexh', 
									  cantidad_kardex='$total_inventario'
					WHERE equipo_kardex='$equipo_kardex'";
		$sql = Conexion::conectar()->prepare($query01);
		$sql->execute();

		
		/* ************************ */
		$query04 = "INSERT INTO `detalle_recibo`(`numero_recibo_detalle`, 
												 `kardex_detalle`, 
												 `cantidad_detalle`, 
												 `precio_detalle`, 
												 `total_detalle`) 
												 VALUES ('$numero_recibo_detalle',
												 		 '$equipo_kardex',
														 '$cantidad_kardex',
														 '$precio_detalle',
														 '$total_detalle')";
		$sql = Conexion::conectar()->prepare($query04);
		$sql->execute();
		/* ************************ */

		function detallerecibo2($numero_recibo_detalle1,$kardex_detalle1)
		{
			$query01 = "SELECT*FROM detalle_recibo WHERE id IN (SELECT MAX(id) FROM detalle_recibo GROUP BY kardex_detalle)   and numero_recibo_detalle='$numero_recibo_detalle1' AND kardex_detalle='$kardex_detalle1' ORDER BY id DESC";
			echo $query01;
					$sql = Conexion::conectar()->prepare($query01);
					$sql->execute();
					return $sql->fetchAll();
		}
		$data05 = detallerecibo2($numero_recibo_detalle,$equipo_kardex);
		$idrecibo="";
		foreach ($data05 as $value) {
			$idrecibo.='recibo'.$value["id"];
		}


		/* ******************* */

		$query02 = "INSERT INTO `historial_kardex`( `correlativo_kardexh`, 
													`fecha_kardexh`, 
													`transancion_kardexh`, 
													`empleado_kardexh`, 
													`ubicacion_kardexh`, 
													`equipo_kardexh`, 
													`cantidad_kardexh`, 
													`precio_kardexh`, 
													`subtotal_kardexh`, 
													`total_kardexh`) 
													VALUES ('$idrecibo',
															'$fecha_kardexh',
															'$idtransaccion',
															'$empleado_kardexh',
															'$ubicacion_kardexh',
															'$equipo_kardex',
															'$cantidad_kardex',
															'$precio_detalle',
															'$total_detalle',
															'$total_detalle')";
															echo $query02;
		$sql = Conexion::conectar()->prepare($query02);
		$sql->execute();
				
		/* ************************ */

		function detalle_recibo($numero_recibo_detalle1)
		{
					$query01 = "SELECT kardex.id as idkardex, detalle_recibo.id as iddetalle, detalle_recibo.* ,kardex.*,tbl_otros_equipos.*
								FROM detalle_recibo,kardex,tbl_otros_equipos
								where detalle_recibo.kardex_detalle=kardex.equipo_kardex and kardex.equipo_kardex=tbl_otros_equipos.codigo_equipo and numero_recibo_detalle='$numero_recibo_detalle1'";
					$sql = Conexion::conectar()->prepare($query01);
					$sql->execute();
					return $sql->fetchAll();
		}
		$data04 = detalle_recibo($numero_recibo_detalle);
		foreach ($data04 as $value) {
			echo "<tr>".
					"<td>".$value["equipo_kardex"]."</td>".
					"<td>".$value["descripcion"]."</td>".
					"<td>".$value["cantidad_detalle"]."</td>".
					"<td>".$value["precio_detalle"]."</td>".
					"<td>".$value["total_detalle"]."</td>".
					"<td>"."<div class='btn btn-danger eliminardetalle'  idkardex='".$value["idkardex"]."' id='".$value["iddetalle"]."'><i class='fa fa-times'></i></div>"."</td>".
				"</tr>";
		}

	break;
	case "eliminardetalle":
		$id=$_POST["id"];
		$fecha_kardexh  =$_POST["fecha_kardexh"];
		$transancion_kardexh  =$_POST["transancion_kardexh"];
		$empleado_kardexh  =$_POST["empleado_kardexh"];
		$idkardex  =$_POST["idkardex"];

		function detalle_recibo($id1)
		{
					$query01 = "SELECT * FROM detalle_recibo WHERE id='$id1' ";
					$sql = Conexion::conectar()->prepare($query01);
					$sql->execute();
					return $sql->fetchAll();
		}
		$cantidad_detalle="";
		$kardex_detalle="";
		$precio_detalle="";
		$total_detalle="";
		$numero_recibo_detalle="";
		$data03 = detalle_recibo($id);
		foreach ($data03 as $value) {
			$cantidad_detalle.=$value["cantidad_detalle"];
			$kardex_detalle.=$value["kardex_detalle"];
			$precio_detalle.=$value["precio_detalle"];
			$total_detalle.=$value["total_detalle"];
			$numero_recibo_detalle.=$value["numero_recibo_detalle"];
		}

		/* ********************* */

		function kardex($equipo_kardex1)
		{
					$query01 = "SELECT * FROM kardex WHERE equipo_kardex='$equipo_kardex1' ";
					$sql = Conexion::conectar()->prepare($query01);
					$sql->execute();
					return $sql->fetchAll();
		}
		$inventario="";
		$correlativo_kardexh="";
		$ubicacion_kardexh="";
		$data04 = kardex($kardex_detalle);
		foreach ($data04 as $value) {
			$inventario.=$value["cantidad_kardex"];
			$correlativo_kardexh.=$value["correlativo_kardex"];
			$ubicacion_kardexh.=$value["ubicacion_kardex"];
		}
		$total_inventario=$inventario+$cantidad_detalle;
		$query01 = "UPDATE kardex SET fecha_kardex='$fecha_kardexh', 
									  cantidad_kardex='$total_inventario'
					WHERE equipo_kardex='$kardex_detalle'";
		$sql = Conexion::conectar()->prepare($query01);
		$sql->execute();

		function transancion()
		{
					$query01 = "SELECT * FROM `tbl_transacciones_equipo` where codigo=17";
					$sql = Conexion::conectar()->prepare($query01);
					$sql->execute();
					return $sql->fetchAll();
		}
		$data04 = transancion();
		$idtransaccion="";
		foreach ($data04 as $value) {
			$idtransaccion.=$value["id"];
		}


		/* *************************** */

		$correlativoid="recibo".$id;
		$query = "DELETE FROM `historial_kardex` WHERE correlativo_kardexh='$correlativoid'";
		echo $query;
		$stmt = Conexion::conectar()->prepare($query);
		$stmt->execute();


				

		/* ********************* */
		$query = "DELETE FROM `detalle_recibo` WHERE id=$id";
		$stmt = Conexion::conectar()->prepare($query);
		$stmt->execute();
		/* ****************** */
		
		
		/* ********************* */
		/* ************************ */

		function detalle_recibo1($numero_recibo_detalle1)
		{
					$query01 = "SELECT detalle_recibo.id as iddetalle, detalle_recibo.* , kardex.*,tbl_otros_equipos.*
								FROM detalle_recibo,kardex,tbl_otros_equipos
								where detalle_recibo.kardex_detalle=kardex.equipo_kardex and kardex.equipo_kardex=tbl_otros_equipos.codigo_equipo and numero_recibo_detalle='$numero_recibo_detalle1'";
					
					$sql = Conexion::conectar()->prepare($query01);
					$sql->execute();
					return $sql->fetchAll();
		}
		$data04 = detalle_recibo1($numero_recibo_detalle);
		$html="";
		foreach ($data04 as $value) {
			$html.= "<tr>".
					"<td>".$value["equipo_kardex"]."</td>".
					"<td>".$value["descripcion"]."</td>".
					"<td>".$value["cantidad_detalle"]."</td>".
					"<td>".$value["precio_detalle"]."</td>".
					"<td>".$value["total_detalle"]."</td>".
					"<td>"."<div class='btn btn-danger eliminardetalle' id='".$value["iddetalle"]."'><i class='fa fa-times'></i></div>"."</td>".
				"</tr>";
		}
		if($html == ""){
			$html= "<tr>".
			"<td></td>".
			"<td></td>".
			"<td></td>".
			"<td></td>".
			"<td></td>".
			"<td></td>".
			"</tr>";
		}
		echo $html;
	break;
	case "cargardetalle":
			$numero_recibo_detalle=$_POST["numero_planilla_liquidado"];
			function detalle_recibo1($numero_recibo_detalle1)
			{
						$query01 = "SELECT detalle_recibo.id as iddetalle, detalle_recibo.* , kardex.*,tbl_otros_equipos.*
									FROM detalle_recibo,kardex,tbl_otros_equipos
									where detalle_recibo.kardex_detalle=kardex.equipo_kardex and kardex.equipo_kardex=tbl_otros_equipos.codigo_equipo and numero_recibo_detalle='$numero_recibo_detalle1'";
						echo $query01;
						$sql = Conexion::conectar()->prepare($query01);
						$sql->execute();
						return $sql->fetchAll();
			}
			$data04 = detalle_recibo1($numero_recibo_detalle);
			$html="";
			foreach ($data04 as $value) {
				$html.= "<tr>".
						"<td>".$value["equipo_kardex"]."</td>".
						"<td>".$value["descripcion"]."</td>".
						"<td>".$value["cantidad_detalle"]."</td>".
						"<td>".$value["precio_detalle"]."</td>".
						"<td>".$value["total_detalle"]."</td>".
						"<td>"."<div class='btn btn-danger eliminardetalle' id='".$value["iddetalle"]."'><i class='fa fa-times'></i></div>"."</td>".
					"</tr>";
			}
			if($html == ""){
				$html= "<tr>".
				"<td></td>".
				"<td></td>".
				"<td></td>".
				"<td></td>".
				"<td></td>".
				"<td></td>".
				"</tr>";
			}
			echo $html;
	break;
	default:
		echo $accion."respuesta nula";
}
