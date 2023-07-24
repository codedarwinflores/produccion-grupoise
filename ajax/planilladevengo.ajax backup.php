

<?php

require_once "../modelos/conexion.php";
$id="";
if ( isset($_POST["id"]) ) {
    $id = $_POST["id"];
}


$consultarempleado="";
if ( isset($_POST["consultarempleado"]) ) {
    $consultarempleado = $_POST["consultarempleado"];
}

$empleado_rango_desde="";
if ( isset($_POST["empleado_rango_desde"]) ) {
    $empleado_rango_desde = $_POST["empleado_rango_desde"];
}

$empleado_rango_hasta="";
if ( isset($_POST["empleado_rango_hasta"]) ) {
    $empleado_rango_hasta = $_POST["empleado_rango_hasta"];
}


$fecha_planilladevengo="";
if ( isset($_POST["fecha_planilladevengo"]) ) {
    $fecha_planilladevengo = $_POST["fecha_planilladevengo"];
}


$accion="";
if ( isset($_POST["accion01"]) ) {
    $accion = $_POST["accion01"];
}

$codigo_empleado_planilladevengo="";
if ( isset($_POST["codigo_empleado_planilladevengo"]) ) {
    	$codigo_empleado_planilladevengo = $_POST["codigo_empleado_planilladevengo"];
		/* ********VALIDAR SI VA A AGREGAR O ACTUALIZAR************ */
		function validarempleado($e)
		{
					$query01 = "SELECT count(*) as valor FROM planilladevengo WHERE codigo_empleado_planilladevengo='$e' ";
					$sql = Conexion::conectar()->prepare($query01);
					$sql->execute();
					return $sql->fetchAll();
		}
		$existeempleado="";
		$data03 = validarempleado($codigo_empleado_planilladevengo);
		foreach ($data03 as $value) {
		$existeempleado.=$value["valor"];
		}
		if($existeempleado == "0"){
			$accion="insertar";
		}
		else{
			$accion="modificar";
		}
		/* ********VALIDAR SI VA A AGREGAR O ACTUALIZAR************ */

}


function getContent()
{
	$query = "SHOW COLUMNS FROM planilladevengo";
	$stmt = Conexion::conectar()->prepare($query);
	$stmt->execute();
	return $stmt->fetchAll();
	$stmt->close();
	$stmt = null;
}

function getContent_insert()
{
	$query = "SHOW COLUMNS FROM planilladevengo WHERE Field NOT IN ('id')";
	$stmt = Conexion::conectar()->prepare($query);
	$stmt->execute();
	return $stmt->fetchAll();
	$stmt->close();
	$stmt = null;
}


function getContent_devengo()
{
	$query = "SHOW COLUMNS FROM tbl_devengo_descuento_planilla";
	$stmt = Conexion::conectar()->prepare($query);
	$stmt->execute();
	return $stmt->fetchAll();
	$stmt->close();
	$stmt = null;
}




switch ($accion) {
	case "lista":

		function consultar($e)
		{
			$query01 = "SELECT tbl_empleados.id as idempleado, tbl_empleados.*, tbl_empleados_devengos_descuentos.* , tbl_devengo_descuento.* 
			FROM `tbl_empleados` , tbl_empleados_devengos_descuentos,tbl_devengo_descuento WHERE tbl_empleados.id=tbl_empleados_devengos_descuentos.id_empleado and tbl_devengo_descuento.id = tbl_empleados_devengos_descuentos.id_tipo_devengo_descuento and tbl_devengo_descuento.codigo='0022' and tbl_empleados_devengos_descuentos.valor is NOT null  and tbl_empleados.fecha_contratacion < '$e' ";
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};
		$newDate = date("Y-m-d", strtotime($fecha_planilladevengo));
		$data01 = consultar($newDate);
		$datos_html = "";
		$datos_html .= '  <table class="table table-bordered table-striped dt-responsive tablas1" width="100%">
		<thead>
		  <tr>
			<th style="width:90px">Código</th>
			<th>Nombre Empleado</th>
		  </tr> 
		</thead>
		<tbody>';
		foreach ($data01 as $value) {
			$datos_html .= ' <tr class="btnEditarabase"  sueldo="'.$value["sueldo"].'"  idempleado="'.$value["idempleado"].'" codigo="'.$value["codigo_empleado"].'"  nombre="'.$value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"].'">
			<td>'.$value["codigo_empleado"].'</td>
			<td>'.$value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"].' </td>';
			echo '</tr>';
		}
		$datos_html .= '</tbody></table>';

		echo $datos_html;

	break;
	case "listaconempleado":

		function consultar($e,$x)
		{
			$query01 = "SELECT tbl_empleados.id as idempleado, tbl_empleados.*, tbl_empleados_devengos_descuentos.* , tbl_devengo_descuento.* 
			FROM `tbl_empleados` , tbl_empleados_devengos_descuentos,tbl_devengo_descuento WHERE tbl_empleados.id=tbl_empleados_devengos_descuentos.id_empleado and tbl_devengo_descuento.id = tbl_empleados_devengos_descuentos.id_tipo_devengo_descuento and tbl_devengo_descuento.codigo='0022' and tbl_empleados_devengos_descuentos.valor is NOT null  and tbl_empleados.id >= '$e' and tbl_empleados.id <= '$x' ";
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};
		$data01 = consultar($empleado_rango_desde,$empleado_rango_hasta);
		$datos_html = "";
		$datos_html .= '  <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
		<thead>
		  <tr>
			<th style="width:90px">Código</th>
			<th>Nombre Empleado</th>
		  </tr> 
		</thead>
		<tbody>';
		foreach ($data01 as $value) {
			$datos_html .= ' <tr class="btnEditarabase"  sueldo="'.$value["sueldo"].'"  idempleado="'.$value["idempleado"].'" codigo="'.$value["codigo_empleado"].'"  nombre="'.$value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"].'">
			<td>'.$value["codigo_empleado"].'</td>
			<td>'.$value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"].' </td>';
			echo '</tr>';
		}
		$datos_html .= '</tbody></table>';

		echo $datos_html;

	break;
	case "insertar":
		echo "insertar";
		/* ****************** */
		/* CAPTURA NOMBRE DE LAS COLUMNAS Y CAMPOS DEL IMPUT */
		$namecolumnas_situacion = "";
		$namecampos_situacion = "";

		$data = getContent_insert();
		foreach ($data as $row) {
			$namecolumnas_situacion .= $row['Field'] . ",";
			$namecampos_situacion .= ":" . $row['Field'] . ",";
		}
		$stmt = Conexion::conectar()->prepare("INSERT INTO planilladevengo(" . trim($namecolumnas_situacion, ",") . ") VALUES (" . trim($namecampos_situacion, ",") . ")");

		foreach ($data as $row) {
			$stmt->bindParam(":" . $row['Field'], $_POST["" . $row['Field'] . ""], PDO::PARAM_STR);
		}
		$respuesta = "";
		if ($stmt->execute()) {
			$respuesta = "ok";
			return "ok";
		} else {
			$respuesta = "error";
			return "error";
		}
		$stmt->close();
		$stmt = null;
		/* ***************** */
	break;
	case "modificar":
		/* ***************** */
	
		$namecolumnas_situacion = "";
		$namecampos_situacion = "";
		$data = getContent_insert();
		$test = "";
		foreach ($data as $row) {
			$namecolumnas_situacion .= $row['Field'] . "=" . ":" . $row['Field'] . ",";
			$test .= $row['Field'] . "='" . $_POST["" . $row['Field'] . ""] . "',";
		}

		$codigo_empleado_planilladevengo = $_POST["codigo_empleado_planilladevengo"];
		function validarempleado01($e)
		{
					$query01 = "SELECT * FROM planilladevengo WHERE codigo_empleado_planilladevengo='$e' ";
					$sql = Conexion::conectar()->prepare($query01);
					$sql->execute();
					return $sql->fetchAll();
		}
		$existeempleado="";
		$data03 = validarempleado01($codigo_empleado_planilladevengo);
		foreach ($data03 as $value) {
		$existeempleado.=$value["id"];
		}


		$query01 = "UPDATE planilladevengo SET " . trim($test, ",") . " WHERE id LIKE $existeempleado";
		echo $query01;

		$sql = Conexion::conectar()->prepare($query01);
		$sql->execute();
		return $sql->fetchAll();
		$sql->close();
		$sql = null;






		/* ***************** */


	break;
	case "obtenerdata":
		/* ************ */
		function consultar_situacion2($e)
		{
		/* 	$query01 = "SELECT * FROM `planilladevengo`  WHERE codigo_empleado_planilladevengo='$e'"; */
		$query01="SELECT tbl_empleados.id as idempleado, tbl_clientes_ubicaciones.id as idubicacion, tbl_clientes_ubicaciones.* , tbl_empleados_devengos_descuentos.* , tbl_clientes_ubicaciones.* ,  tbl_empleados.*,SUM(tbl_empleados_devengos_descuentos.valor) as valorempleado
		FROM tbl_empleados,tbl_ubicaciones_agentes_asignados,tbl_empleados_devengos_descuentos, tbl_clientes_ubicaciones
		WHERE tbl_empleados.codigo_empleado=tbl_ubicaciones_agentes_asignados.codigo_agente and tbl_empleados.id=tbl_empleados_devengos_descuentos.id_empleado and tbl_ubicaciones_agentes_asignados.idubicacion_agente=tbl_clientes_ubicaciones.id and  tbl_empleados.codigo_empleado='$e'";
		
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			$outp = $sql->fetchAll();
			echo json_encode($outp);
		};
		$data01 = consultar_situacion2($consultarempleado);
		$result = [];

			/* 	foreach ($data01 as $value) {
					$result['id'] = $value['id'];
					$result['numero_planilladevengo'] = $value['numero_planilladevengo'];
					$result['fecha_planilladevengo'] = $value['fecha_planilladevengo'];
					$result['fecha_desde_planilladevengo'] = $value['fecha_desde_planilladevengo'];
					$result['fecha_hasta_planilladevengo'] = $value['fecha_hasta_planilladevengo'];
					$result['descripcion_planilladevengo'] = $value['descripcion_planilladevengo'];
					$result['codigo_empleado_planilladevengo'] = $value['codigo_empleado_planilladevengo'];
					$result['nombre_empleado_planilladevengo'] = $value['nombre_empleado_planilladevengo'];
					$result['id_empleado_planilladevengo'] = $value['id_empleado_planilladevengo'];
					$result['dias_trabajo_planilladevengo'] = $value['dias_trabajo_planilladevengo'];
					$result['sueldo_planilladevengo'] = $value['sueldo_planilladevengo'];
					$result['hora_extra_diurna_planilladevengo'] = $value['hora_extra_diurna_planilladevengo'];
					$result['hora_extra_nocturna_planilladevengo'] = $value['hora_extra_nocturna_planilladevengo'];
					$result['hora_extra_domingo_planilladevengo'] = $value['hora_extra_domingo_planilladevengo'];
					$result['hora_extra_domingo_nocturna_planilladevengo'] = $value['hora_extra_domingo_nocturna_planilladevengo'];
					$result['otro_devengo_planilladevengo'] = $value['otro_devengo_planilladevengo'];
					$result['total_devengo_planilladevengo'] = $value['total_devengo_planilladevengo'];
					$result['descuento_isss_planilladevengo	'] = $value['descuento_isss_planilladevengo	'];
					$result['descuento_afp_planilladevengo'] = $value['descuento_afp_planilladevengo'];
					$result['descuento_renta_planilladevengo'] = $value['descuento_renta_planilladevengo'];
					$result['otro_descuento_planilladevengo'] = $value['otro_descuento_planilladevengo'];
					$result['total_descuento_planilladevengo'] = $value['total_descuento_planilladevengo'];
					$result['total_liquidado_planilladevengo'] = $value['total_liquidado_planilladevengo'];
					$result['sueldo_renta_planilladevengo'] = $value['sueldo_renta_planilladevengo'];
					$result['sueldo_isss_planilladevengo'] = $value['sueldo_isss_planilladevengo'];
					$result['sueldo_afp_planilladevengo'] = $value['sueldo_afp_planilladevengo'];
					$result['departamento_planilladevengo'] = $value['departamento_planilladevengo'];
					$result['codigo_ubicacion_planilladevengo'] = $value['codigo_ubicacion_planilladevengo'];
					$result['nombre_ubicacion_planilladevengo'] = $value['nombre_ubicacion_planilladevengo'];
					$result['id_ubicacion_planilladevengo'] = $value['id_ubicacion_planilladevengo'];
					$result['observacion_planilladevengo'] = $value['observacion_planilladevengo'];
					$result['periodo_planilladevengo'] = $value['periodo_planilladevengo'];
					$result['tipo_planilladevengo'] = $value['tipo_planilladevengo'];
					$result['dias_incapacidad'] = $value['dias_incapacidad'];

				} */

				/* echo json_encode($result); */

		
			/* ************ */
	break;
	case "obtenerdatatotal":
		/* ************ */
		function consultar_situacion2($e)
		{
		/* 	$query01 = "SELECT * FROM `planilladevengo`  WHERE codigo_empleado_planilladevengo='$e'"; */
		$query01="SELECT `id`, `numero_planilladevengo`, `fecha_planilladevengo`, `fecha_desde_planilladevengo`, `fecha_hasta_planilladevengo`, `descripcion_planilladevengo`, `codigo_empleado_planilladevengo`, `nombre_empleado_planilladevengo`, `id_empleado_planilladevengo`, `dias_trabajo_planilladevengo`, `sueldo_planilladevengo`, `hora_extra_diurna_planilladevengo`, `hora_extra_nocturna_planilladevengo`, `hora_extra_domingo_planilladevengo`, `hora_extra_domingo_nocturna_planilladevengo`, `otro_devengo_planilladevengo`, `total_devengo_planilladevengo`, `descuento_isss_planilladevengo`, `descuento_afp_planilladevengo`, `descuento_renta_planilladevengo`, `otro_descuento_planilladevengo`, `total_descuento_planilladevengo`, `total_liquidado_planilladevengo`, `sueldo_renta_planilladevengo`, `sueldo_isss_planilladevengo`, `sueldo_afp_planilladevengo`, `departamento_planilladevengo`, `codigo_ubicacion_planilladevengo`, `nombre_ubicacion_planilladevengo`, `id_ubicacion_planilladevengo`, `observacion_planilladevengo`, `periodo_planilladevengo`, `tipo_planilladevengo`, `dias_incapacidad` FROM `planilladevengo` WHERE id_empleado_planilladevengo=$e";
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			$outp = $sql->fetchAll();
			echo json_encode($outp);
		};
		$data01 = consultar_situacion2($consultarempleado);
		$result = [];


		
			/* ************ */
	break;
	case "consultard":

	
			/* ************ */
			function consultar_situacion2($e,$x,$z)
			{
			
				$query01="SELECT*FROM tbl_devengo_descuento_planilla WHERE idempleado_devengo='$e' and codigo_planilla_devengo='$z' and tipo_valor LIKE '%$x%'";
				$sql = Conexion::conectar()->prepare($query01);
				$sql->execute();
				return $sql->fetchAll();
				
			};
			$tipo=$_POST["tipo"];
			$codigo_planilla_devengo=$_POST["codigo_planilla_devengo"];
			$data01 = consultar_situacion2($consultarempleado,$tipo,$codigo_planilla_devengo);
			foreach ($data01 as $value) {
				echo' <tr>
				<td>'.$value["codigo_devengo_descuento_planilla"].'</td>
				<td>'.$value["descripcion_devengo_descuento_planilla"].'</td>
				<td>'.$value["valor_devengo_planilla"].'</td>
				<td>'.$value["isss_devengo_devengo_descuento_planilla"].'</td>
				<td>'.$value["afp_devengo_devengo_descuento_planilla"].'</td>
				<td>'.$value["renta_devengo_devengo_descuento_planilla"].'</td>
				<td>
				  <div class="btn btn-warning modificar" id="'.$value["id"].'"  accion="modificar_devengo"><i class="fa fa-pencil"></i></div>
				  <div class="btn btn-danger eliminar" id="'.$value["id"].'" accion="eliminar_devengo"><i class="fa fa-times"></i></div>
				</td>
			  </tr>';
			}
			/* ************ */
    break;
	case "agregardevengo":
				/* ****************** */
				/* CAPTURA NOMBRE DE LAS COLUMNAS Y CAMPOS DEL IMPUT */
				$namecolumnas_situacion = "";
				$namecampos_situacion = "";
		
				$data = getContent_devengo();
				foreach ($data as $row) {
					$namecolumnas_situacion .= $row['Field'] . ",";
					$namecampos_situacion .= ":" . $row['Field'] . ",";
				}
				$stmt = Conexion::conectar()->prepare("INSERT INTO tbl_devengo_descuento_planilla(" . trim($namecolumnas_situacion, ",") . ") VALUES (" . trim($namecampos_situacion, ",") . ")");

				
				$campos="";
				foreach ($data as $row) {
					$stmt->bindParam(":" . $row['Field'], $_POST["" . $row['Field'] . ""], PDO::PARAM_STR);
					$campos.= $_POST["" . $row['Field'] . ""].',';
					
				}

						/* 		echo "INSERT INTO tbl_devengo_descuento_planilla(" . trim($namecolumnas_situacion, ",") . ") VALUES (" . trim($campos, ",") . ")";
				*/


				
				$respuesta = "";
				if ($stmt->execute()) {
					$respuesta = "ok";
					return "ok";
				} else {
					print_r($stmt->errorInfo());
					return "error";
				}
				$stmt->close();
				$stmt = null;
				
		
		
				/* ***************** */
	break;
	case "modificardevengo":
					/* ***************** */
			
					$namecolumnas_situacion = "";
					$namecampos_situacion = "";
					$data = getContent_devengo();
					$test = "";
					foreach ($data as $row) {
						$namecolumnas_situacion .= $row['Field'] . "=" . ":" . $row['Field'] . ",";
						$test .= $row['Field'] . "='" . $_POST["" . $row['Field'] . ""] . "',";
					}
			
					$query01 = "UPDATE tbl_devengo_descuento_planilla SET " . trim($test, ",") . " WHERE id LIKE $id";
					echo $query01;
					$sql = Conexion::conectar()->prepare($query01);
					$sql->execute();
					return $sql->fetchAll();
					$sql->close();
					$sql = null;
					/* ***************** */
    break;
	case "obtenerdatadevengo":
		/* ************ */
		function consultar_situacion2($e)
		{
		/* 	$query01 = "SELECT * FROM `planilladevengo`  WHERE codigo_empleado_planilladevengo='$e'"; */
			$query01="SELECT*FROM tbl_devengo_descuento_planilla WHERE id='$e'";
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			$outp = $sql->fetchAll();
			echo json_encode($outp);
			
		};
		$data01 = consultar_situacion2($consultarempleado);
		$result = [];
			/* ************ */
	break;
	case "eliminardevengo":
		/* ********************* */
		$query = "DELETE FROM `tbl_devengo_descuento_planilla` WHERE id=$consultarempleado";
		$stmt = Conexion::conectar()->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
		$stmt = null;
		/* ********************* */
	break;
	case "calculos":
		/* ************ */
		function consultar($e)
		{
		/* 	$query01 = "SELECT * FROM `planilladevengo`  WHERE codigo_empleado_planilladevengo='$e'"; */
			$query01="SELECT*FROM tbl_empleados WHERE id='$e'";
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
			/* $outp = $sql->fetchAll(); */
			
		};
		$data01 = consultar($consultarempleado);
		$sueldo="";
		$periodo_pago="";
		$tipo_afp="";
		foreach ($data01 as $value) {
		$sueldo=$value["sueldo"];
		$periodo_pago=$value["periodo_pago"];
		$tipo_afp=$value["codigo_afp"];
		}
		if($periodo_pago=="015"){
			$periodo_pago="quincenal";
		}

		/* ************************ */

		function consultar_isr($salario,$periodo)
		{
		/* 	$query01 = "SELECT * FROM `planilladevengo`  WHERE codigo_empleado_planilladevengo='$e'"; */
			$query01="SELECT isr.id as idisr, `codigo`, `nombre_rango`, `periodo_pago`, `salario_desde`, `salario_hasta`, `base_1`, `tasa_sobre_excedente`, `base_2`, periodo_de_pago.id as idperiodo FROM `isr`, periodo_de_pago WHERE isr.periodo_pago=periodo_de_pago.id and nombre_periodo='$periodo' and '$salario'>=salario_desde and '$salario'<=salario_hasta";
			/* echo $query01; */
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			/* return $sql->fetchAll(); */
			$outp = $sql->fetchAll();
			echo json_encode($outp);
			
		};
		$data_isr = consultar_isr($sueldo,$periodo_pago);
		$result = [];



			/* ************ */
	break;
	case "calculosisss":

		$renta_devengo=$_POST["renta_devengo"];
		$afp_devengo=$_POST["afp_devengo"];
		$isss_devengo=$_POST["isss_devengo"];
		$valor_devengo_planilla=$_POST["valor_devengo_planilla"];



			/* ************************ */
			function consultar($e)
			{
				$query01="SELECT*FROM tbl_empleados WHERE id='$e'";
				$sql = Conexion::conectar()->prepare($query01);
				$sql->execute();
				return $sql->fetchAll();
			};
			$data01 = consultar($consultarempleado);
			$tipo_afp="";
			$periodo_pago="";

			foreach ($data01 as $value) {
				$tipo_afp=$value["codigo_afp"];
				$periodo_pago=$value["periodo_pago"];
			}
			if($periodo_pago=="015"){
				$periodo_pago="quincenal";
			}
			/* ************************ */
			/* ************************ */
			function afp($e)
						{
							$query01="SELECT*FROM afp WHERE codigo='$e'";
							$sql = Conexion::conectar()->prepare($query01);
							$sql->execute();
							return $sql->fetchAll();
						};
						$data01 = afp($tipo_afp);
						$porcentaje_afp="";
						foreach ($data01 as $value) {
							$porcentaje_afp=$value["porcentaje"];
						 }
			/* ************************ */
			/* ************************ */
			function configuracion()
			{
				$query01="SELECT*FROM configuracion";
				$sql = Conexion::conectar()->prepare($query01);
				$sql->execute();
				return $sql->fetchAll();
			};
			$data01 = configuracion();
			$porcentaje_isss="";
			foreach ($data01 as $value) {
				$porcentaje_isss=$value["porcentaje_isss"];
			}
			/* ************************* */
				/* ************************ */
				function isr($salario,$periodo)
				{
					$query01="SELECT isr.id as idisr, `codigo`, `nombre_rango`, `periodo_pago`, `salario_desde`, `salario_hasta`, `base_1`, `tasa_sobre_excedente`, `base_2`, periodo_de_pago.id as idperiodo FROM `isr`, periodo_de_pago WHERE isr.periodo_pago=periodo_de_pago.id and nombre_periodo='$periodo' and '$salario'>=salario_desde and '$salario'<=salario_hasta";
					$sql = Conexion::conectar()->prepare($query01);
					$sql->execute();
					return $sql->fetchAll();
				};
				$data01 = isr($valor_devengo_planilla,$periodo_pago);
				$porcentaje_base1="";
				$porcentaje_base2="";
				foreach ($data01 as $value) {
					$porcentaje_base1=$value["base_1"];
					$porcentaje_base2=$value["base_2"];
				}
				/* ************************* */

			echo $porcentaje_isss.",".$porcentaje_afp.",".$porcentaje_base1.",".$porcentaje_base2;
			



			/* ************ */
	break;
	default:
		echo $accion;
}








?>