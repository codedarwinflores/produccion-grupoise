

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


$fecha_planilladevengo_vacacion="";
if ( isset($_POST["fecha_planilladevengo_vacacion"]) ) {
    $fecha_planilladevengo_vacacion = $_POST["fecha_planilladevengo_vacacion"];
}


$accion="";
if ( isset($_POST["accion01"]) ) {
    $accion = $_POST["accion01"];
}

$codigo_empleado_planilladevengo_vacacion="";
if ( isset($_POST["codigo_empleado_planilladevengo_vacacion"]) ) {
    	$codigo_empleado_planilladevengo_vacacion = $_POST["codigo_empleado_planilladevengo_vacacion"];
		/* ********VALIDAR SI VA A AGREGAR O ACTUALIZAR************ */
		function validarempleado($e)
		{
					$query01 = "SELECT count(*) as valor FROM planilladevengo_vacacion WHERE codigo_empleado_planilladevengo_vacacion='$e' ";
					$sql = Conexion::conectar()->prepare($query01);
					$sql->execute();
					return $sql->fetchAll();
		}
		$existeempleado="";
		$data03 = validarempleado($codigo_empleado_planilladevengo_vacacion);
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
	$query = "SHOW COLUMNS FROM planilladevengo_vacacion";
	$stmt = Conexion::conectar()->prepare($query);
	$stmt->execute();
	return $stmt->fetchAll();
	$stmt->close();
	$stmt = null;
}

function getContent_insert()
{
	$query = "SHOW COLUMNS FROM planilladevengo_vacacion WHERE Field NOT IN ('id')";
	$stmt = Conexion::conectar()->prepare($query);
	$stmt->execute();
	return $stmt->fetchAll();
	$stmt->close();
	$stmt = null;
}


function getContent_devengo_vacacion()
{
	$query = "SHOW COLUMNS FROM tbl_devengo_descuento_planilla_vacacion";
	$stmt = Conexion::conectar()->prepare($query);
	$stmt->execute();
	return $stmt->fetchAll();
	$stmt->close();
	$stmt = null;
}




switch ($accion) {
	case "lista":

		

		$tipo_planilladevengo_vacacion = $_POST["tipo_planilladevengo_vacacion"];
		$periodo_planilladevengo_vacacion = $_POST["periodo_planilladevengo_vacacion"];
		$numero_planilladevengo_vacacion = $_POST["numero_planilladevengo_vacacion"];
		$descripcion_planilladevengo_vacacion = $_POST["descripcion_planilladevengo_vacacion"];


		/* ***CONSULTAR DEVENGO02***** */
		function consultar_devengo2()
		{
			$query01 = "SELECT `id`, `codigo`, `descripcion`, `porcentaje`, `tipo`, `cargo_abono`, `cuenta_contable`, `isss_devengo`, `afp_devengo`, `renta_devengo` FROM `tbl_devengo_descuento` WHERE codigo='0024'";
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};
		$data01 = consultar_devengo2();
		$codigo_devengo="";
		$descipcion_devengo="";
		$isss_devengo="";
		$afp_devengo="";
		$renta_devengo="";
		$id_devengo="";
		foreach ($data01 as $value) {
			$id_devengo=$value["id"];
			$codigo_devengo=$value["codigo"];
			$descipcion_devengo=$value["descripcion"];
			$isss_devengo=$value["isss_devengo"];
			$afp_devengo=$value["afp_devengo"];
			$renta_devengo=$value["renta_devengo"];
		}

		/* *************** */

		function consultar($e,$dia1,$dia2,$anio1,$mes1)
		{
			/* $query01="SELECT * FROM tbl_empleados 
					  WHERE YEAR(fecha_contratacion)<YEAR(NOW()) and DAY(fecha_contratacion)=DAY(NOW()) AND MONTH(fecha_contratacion)=MONTH(NOW()) AND DAY(fecha_contratacion) BETWEEN '16' AND '31'  and tbl_empleados.fecha_contratacion < '$e'"; */

			/* 			$query01 = "SELECT tbl_empleados.id as idempleado, tbl_empleados.*, tbl_empleados_devengos_descuentos.* , 				tbl_devengo_descuento.* 
						FROM `tbl_empleados` , tbl_empleados_devengos_descuentos,tbl_devengo_descuento WHERE tbl_empleados.id=tbl_empleados_devengos_descuentos.id_empleado and tbl_devengo_descuento.id = tbl_empleados_devengos_descuentos.id_tipo_devengo_descuento and tbl_devengo_descuento.codigo='0022' and tbl_empleados_devengos_descuentos.valor is NOT null  and tbl_empleados.fecha_contratacion < '$e' and YEAR(fecha_contratacion)<YEAR(NOW()) AND  DATE_FORMAT(DATE(NOW()), '%m-%d') >= DATE_FORMAT(tbl_empleados.fecha_contratacion, '%m-%d') AND MONTH(fecha_contratacion)=MONTH(NOW()) AND DAY(fecha_contratacion) BETWEEN '$dia1' AND '$dia2' "; */

			/* $query01="SELECT DATE_FORMAT(DATE(NOW()), '%m-%d')as fecha_actual,DATE_FORMAT(tbl_empleados.fecha_contratacion, '%m-%d') as fechacontracion, tbl_empleados.id as idempleado, tbl_empleados.*, tbl_empleados_devengos_descuentos.* , tbl_devengo_descuento.*
			FROM `tbl_empleados` , tbl_empleados_devengos_descuentos,tbl_devengo_descuento
			WHERE tbl_empleados.id=tbl_empleados_devengos_descuentos.id_empleado and tbl_devengo_descuento.id = tbl_empleados_devengos_descuentos.id_tipo_devengo_descuento  and tbl_empleados_devengos_descuentos.valor is NOT null  and tbl_empleados.fecha_contratacion < '$e' and YEAR(fecha_contratacion)<YEAR(NOW())  and  DATE_FORMAT(DATE(NOW()), '%m-%d') >= DATE_FORMAT(tbl_empleados.fecha_contratacion, '%m-%d')  AND MONTH(NOW()) >= MONTH(fecha_contratacion) AND DAY(fecha_contratacion) BETWEEN '$dia1' AND '$dia2' GROUP by tbl_empleados.id"; */
			
			/* $query01="SELECT DATE_FORMAT(DATE(NOW()), '%m-%d')as fecha_actual,DATE_FORMAT(tbl_empleados.fecha_contratacion, '%m-%d') as fechacontracion, tbl_empleados.id as idempleado, tbl_empleados.*, tbl_empleados_devengos_descuentos.* , tbl_devengo_descuento.*
			FROM `tbl_empleados` , tbl_empleados_devengos_descuentos,tbl_devengo_descuento
			WHERE tbl_empleados.id=tbl_empleados_devengos_descuentos.id_empleado and tbl_devengo_descuento.id = tbl_empleados_devengos_descuentos.id_tipo_devengo_descuento  and tbl_empleados_devengos_descuentos.valor is NOT null  and tbl_empleados.fecha_contratacion < '$e' and YEAR(fecha_contratacion)<YEAR(NOW())  AND MONTH(NOW()) = MONTH(fecha_contratacion) AND DAY(fecha_contratacion) BETWEEN '$dia1' AND '$dia2' GROUP by tbl_empleados.id"; */

			$query01="SELECT DATE_FORMAT(DATE(NOW()), '%m-%d')as fecha_actual,DATE_FORMAT(tbl_empleados.fecha_contratacion, '%m-%d') as fechacontracion, tbl_empleados.id as idempleado, tbl_empleados.*
			FROM `tbl_empleados` 
			WHERE  tbl_empleados.estado=2 and tbl_empleados.fecha_contratacion < '$e' and YEAR(fecha_contratacion)<'$anio1'  AND '$mes1' = MONTH(fecha_contratacion) AND DAY(fecha_contratacion) BETWEEN '$dia1' AND '$dia2' GROUP by tbl_empleados.id";
			

			/* echo $query01; */
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};
		$newDate = date("Y-m-d", strtotime($fecha_planilladevengo_vacacion));
		$fechaperiodo1_total = date("Y-m-d", strtotime($_POST["fechaperiodo1"]));
		$fechaperiodo2_total= date("Y-m-d", strtotime($_POST["fechaperiodo2"]));
		$fechaperiodo1 = date("d",strtotime($_POST["fechaperiodo1"]));
		$fechaperiodo2 = date("d",strtotime($_POST["fechaperiodo2"]));

		$anio = date("Y",strtotime($_POST["fecha_planilladevengo_vacacion"]));
		$mes = date("m",strtotime($_POST["fecha_planilladevengo_vacacion"]));


		$data01 = consultar($newDate,$fechaperiodo1,$fechaperiodo2,$anio,$mes);
		$datos_html = "";
		$datos_html .= '  <table class="table table-bordered table-striped dt-responsive tablas1" width="100%">
		<thead>
		  <tr>
			<th style="width:90px">Código</th>
			<th>Nombre Empleado</th>
			<th>Acciones</th>
		  </tr> 
		</thead>
		<tbody>';

		/* variable para agregar vacacion a la tabla tbl_devengo_descuento_planilla_vacacion */
		$values_consulta="";
		$values_devengo="";


		/* ***CONSULTAR DEVENGO***** */
			function consultar_devengo($idempleado1)
			{
				$query01 = "SELECT `id`, `id_empleado`, `id_tipo_devengo_descuento`, `valor`, `fecha_caducidad`, `referencia` FROM `tbl_empleados_devengos_descuentos` WHERE id_empleado=$idempleado1";
			
				$sql = Conexion::conectar()->prepare($query01);
				$sql->execute();
				return $sql->fetchAll();
			};
		/* *************************** */
		foreach ($data01 as $value) {

			$idempleado=$value["idempleado"];

			$data02 = consultar_devengo($idempleado);
			$id_tipo_devengo_descuento="";
			$valor_viaticos=0;
			foreach ($data02 as $value1) {

				if($value1["id_tipo_devengo_descuento"]=="2"){
					$id_tipo_devengo_descuento.=$value1["id_tipo_devengo_descuento"];
					$valor_viaticos .= $value1["valor"];
				}

			}

			/* OBTENER DATOS PARA CALCULAR VACACION */
			
			
			$sueldo_empleado=$value["sueldo"];
			if($valor_viaticos==""){
					$valor_viaticos=0;
				}
			if($sueldo_empleado==""){
					$sueldo_empleado=0;
				}
				$suma_sueldo_viatico=$valor_viaticos+$sueldo_empleado;
				$calculo_vacacion=$suma_sueldo_viatico*0.30;

						
				$codigo_devengo_descuento_planilla=$codigo_devengo;
				$descripcion_devengo_descuento_planilla=$descipcion_devengo;
				$tipo_devengo_descuento_planilla=$id_devengo;
				$isss_devengo_devengo_descuento_planilla=$isss_devengo;
				$afp_devengo_devengo_descuento_planilla=$afp_devengo;
				$renta_devengo_devengo_descuento_planilla=$renta_devengo;
				$idempleado_devengo=$value["idempleado"];
				$valor_devengo_planilla=$calculo_vacacion;
				$tipo_valor="Suma";
				$codigo_planilla_devengo=$numero_planilladevengo_vacacion;

				$values_devengo.="('$codigo_devengo_descuento_planilla', '$descripcion_devengo_descuento_planilla', '$tipo_devengo_descuento_planilla', '$isss_devengo_devengo_descuento_planilla', '$afp_devengo_devengo_descuento_planilla', '$renta_devengo_devengo_descuento_planilla', '$idempleado_devengo', '$valor_devengo_planilla', '$tipo_valor', '$codigo_planilla_devengo'),";

				


			/* **************** */

			$numero_planilladevengo_vacacion=$numero_planilladevengo_vacacion;
			$fecha_planilladevengo_vacacion=$newDate;
			$fecha_desde_planilladevengo_vacacion=$fechaperiodo1_total;
			$fecha_hasta_planilladevengo_vacacion=$fechaperiodo2_total;
			$descripcion_planilladevengo_vacacion=$descripcion_planilladevengo_vacacion;
			$codigo_empleado_planilladevengo_vacacion=$value["codigo_empleado"];
			$nombre_empleado_planilladevengo_vacacion=$value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"];
			$id_empleado_planilladevengo_vacacion=$value["idempleado"];
			$sueldo_planilladevengo_vacacion=$value["sueldo"];
			$sueldo=$value["sueldo"];
			$devengo=$valor_viaticos;

			$otro_devengo_vacacion_planilladevengo_vacacion=$calculo_vacacion;
			$totaldevengo=$sueldo+$calculo_vacacion;
			
			$total_devengo_vacacion_planilladevengo_vacacion=$totaldevengo;
			$total_liquidado_planilladevengo_vacacion=$totaldevengo;
			$codigo_ubicacion_planilladevengo_vacacion="";
			$nombre_ubicacion_planilladevengo_vacacion="";
			$id_ubicacion_planilladevengo_vacacion="";
			$periodo_planilladevengo_vacacion=$periodo_planilladevengo_vacacion;
			$tipo_planilladevengo_vacacion=$tipo_planilladevengo_vacacion;
			$empleado_rango_desde=$empleado_rango_desde;
			$empleado_rango_hasta=$empleado_rango_hasta;

			$values_consulta.="('$numero_planilladevengo_vacacion','$fecha_planilladevengo_vacacion','$fecha_desde_planilladevengo_vacacion','$fecha_hasta_planilladevengo_vacacion','$descripcion_planilladevengo_vacacion','$codigo_empleado_planilladevengo_vacacion','$nombre_empleado_planilladevengo_vacacion','$id_empleado_planilladevengo_vacacion','$sueldo_planilladevengo_vacacion','$otro_devengo_vacacion_planilladevengo_vacacion','$total_devengo_vacacion_planilladevengo_vacacion','$total_liquidado_planilladevengo_vacacion','$codigo_ubicacion_planilladevengo_vacacion','$nombre_ubicacion_planilladevengo_vacacion','$id_ubicacion_planilladevengo_vacacion','$periodo_planilladevengo_vacacion','$tipo_planilladevengo_vacacion','$empleado_rango_desde','$empleado_rango_hasta'),";

			$datos_html .= ' <tr class="btnEditarabase" hora_extra_nocturna_domingo="'.$value["hora_extra_nocturna_domingo"].'"   hora_extra_domingo="'.$value["hora_extra_domingo"].'"  hora_extra_nocturna="'.$value["hora_extra_nocturna"].'" hora_extra_diurna="'.$value["hora_extra_diurna"].'"   salario_por_hora="'.$value["salario_por_hora"].'"  sueldo="'.$value["sueldo"].'"  idempleado="'.$value["idempleado"].'" codigo="'.$value["codigo_empleado"].'"  nombre="'.$value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"].'">
			<td>'.$value["codigo_empleado"].'</td>
			<td>'.$value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"].' </td>';
			$datos_html .='<td><div class="btn btn-danger eliminarempleado" numero_planilla="'.$numero_planilladevengo_vacacion.'" idempleado="'.$value["idempleado"].'"><i class="fa fa-times"></i></div></td>';
			$datos_html .= '</tr>';
		}
		$datos_html .= '</tbody></table>';
		/* echo trim($values_consulta, ","); */


		/* echo $datos_html; */
		function consultar_planilla($numero_planilladevengo_vacacion1)
			{
			
				$query01="SELECT `id`, `numero_planilladevengo_vacacion`, `fecha_planilladevengo_vacacion`, `fecha_desde_planilladevengo_vacacion`, `fecha_hasta_planilladevengo_vacacion`, `descripcion_planilladevengo_vacacion`, `codigo_empleado_planilladevengo_vacacion`, `nombre_empleado_planilladevengo_vacacion`, `id_empleado_planilladevengo_vacacion`, `dias_trabajo_planilladevengo_vacacion`, `sueldo_planilladevengo_vacacion`, `hora_extra_diurna_planilladevengo_vacacion`, `hora_extra_nocturna_planilladevengo_vacacion`, `hora_extra_domingo_planilladevengo_vacacion`, `hora_extra_domingo_nocturna_planilladevengo_vacacion`, `otro_devengo_vacacion_planilladevengo_vacacion`, `total_devengo_vacacion_planilladevengo_vacacion`, `descuento_isss_planilladevengo_vacacion`, `descuento_afp_planilladevengo_vacacion`, `descuento_renta_planilladevengo_vacacion`, `otro_descuento_planilladevengo_vacacion`, `total_descuento_planilladevengo_vacacion`, `total_liquidado_planilladevengo_vacacion`, `sueldo_renta_planilladevengo_vacacion`, `sueldo_isss_planilladevengo_vacacion`, `sueldo_afp_planilladevengo_vacacion`, `departamento_planilladevengo_vacacion`, `codigo_ubicacion_planilladevengo_vacacion`, `nombre_ubicacion_planilladevengo_vacacion`, `id_ubicacion_planilladevengo_vacacion`, `observacion_planilladevengo_vacacion`, `periodo_planilladevengo_vacacion`, `tipo_planilladevengo_vacacion`, `dias_incapacidad`, `empleado_rango_desde`, `empleado_rango_hasta`, COUNT(*) as registro FROM `planilladevengo_vacacion` WHERE numero_planilladevengo_vacacion='$numero_planilladevengo_vacacion1'";
				$sql = Conexion::conectar()->prepare($query01);
				$sql->execute();
				return $sql->fetchAll();
			};
		$data_planilla = consultar_planilla($numero_planilladevengo_vacacion);
		$registro="";
		foreach ($data_planilla as $value) {
			$registro.=$value["registro"];
		}
		if($registro == 0){

			
			$insertar_devengo="INSERT INTO `tbl_devengo_descuento_planilla_vacacion`(`codigo_devengo_descuento_planilla`, `descripcion_devengo_descuento_planilla`, `tipo_devengo_descuento_planilla`, `isss_devengo_devengo_descuento_planilla`, `afp_devengo_devengo_descuento_planilla`, `renta_devengo_devengo_descuento_planilla`,`idempleado_devengo`, `valor_devengo_planilla`, `tipo_valor`, `codigo_planilla_devengo`) VALUES  ".trim($values_devengo, ",")."";
			$sql_devengo = Conexion::conectar()->prepare($insertar_devengo);
			$sql_devengo->execute();
	


			$insertar="INSERT INTO `planilladevengo_vacacion`(`numero_planilladevengo_vacacion`, `fecha_planilladevengo_vacacion`, `fecha_desde_planilladevengo_vacacion`, `fecha_hasta_planilladevengo_vacacion`, `descripcion_planilladevengo_vacacion`, `codigo_empleado_planilladevengo_vacacion`, `nombre_empleado_planilladevengo_vacacion`, `id_empleado_planilladevengo_vacacion`, `sueldo_planilladevengo_vacacion`,`otro_devengo_vacacion_planilladevengo_vacacion`, `total_devengo_vacacion_planilladevengo_vacacion`, `total_liquidado_planilladevengo_vacacion`, `codigo_ubicacion_planilladevengo_vacacion`, `nombre_ubicacion_planilladevengo_vacacion`, `id_ubicacion_planilladevengo_vacacion`, `periodo_planilladevengo_vacacion`, `tipo_planilladevengo_vacacion`, `empleado_rango_desde`, `empleado_rango_hasta`) value ".trim($values_consulta, ",")."";
			
			$sql = Conexion::conectar()->prepare($insertar);
			if ($sql->execute()) {
				$data_planilla = consultar_planilla($numero_planilladevengo_vacacion);
				$id="";
				foreach ($data_planilla as $value) {
					$id.=$value["id"];	
				}
				echo $numero_planilladevengo_vacacion;
			} else {
				/* echo "error"; */
			}
			$sql = null;





		}
		else{
			/* echo $datos_html; */
		}
	break;
	case "listaconempleado":

		$tipo_planilladevengo_vacacion = $_POST["tipo_planilladevengo_vacacion"];
		$periodo_planilladevengo_vacacion = $_POST["periodo_planilladevengo_vacacion"];
		$numero_planilladevengo_vacacion = $_POST["numero_planilladevengo_vacacion"];
		$descripcion_planilladevengo_vacacion = $_POST["descripcion_planilladevengo_vacacion"];

		
		/* ***CONSULTAR DEVENGO02***** */
		function consultar_devengo2()
		{
			$query01 = "SELECT `id`, `codigo`, `descripcion`, `porcentaje`, `tipo`, `cargo_abono`, `cuenta_contable`, `isss_devengo`, `afp_devengo`, `renta_devengo` FROM `tbl_devengo_descuento` WHERE codigo='0024'";
		
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};
		$data01 = consultar_devengo2();
		$codigo_devengo="";
		$descipcion_devengo="";
		$isss_devengo="";
		$afp_devengo="";
		$renta_devengo="";
		$id_devengo="";
		foreach ($data01 as $value) {
			$id_devengo=$value["id"];
			$codigo_devengo=$value["codigo"];
			$descipcion_devengo=$value["descripcion"];
			$isss_devengo=$value["isss_devengo"];
			$afp_devengo=$value["afp_devengo"];
			$renta_devengo=$value["renta_devengo"];
		}

		/* *************** */


		function consultar($e,$dia1,$dia2,$empleado_rango_desde1,$empleado_rango_hasta1,$anio1,$mes1)
		{
			/* $query01="SELECT * FROM tbl_empleados 
					  WHERE YEAR(fecha_contratacion)<YEAR(NOW()) and DAY(fecha_contratacion)=DAY(NOW()) AND MONTH(fecha_contratacion)=MONTH(NOW()) AND DAY(fecha_contratacion) BETWEEN '16' AND '31'  and tbl_empleados.fecha_contratacion < '$e'"; */

			/* 			$query01 = "SELECT tbl_empleados.id as idempleado, tbl_empleados.*, tbl_empleados_devengos_descuentos.* , 				tbl_devengo_descuento.* 
						FROM `tbl_empleados` , tbl_empleados_devengos_descuentos,tbl_devengo_descuento WHERE tbl_empleados.id=tbl_empleados_devengos_descuentos.id_empleado and tbl_devengo_descuento.id = tbl_empleados_devengos_descuentos.id_tipo_devengo_descuento and tbl_devengo_descuento.codigo='0022' and tbl_empleados_devengos_descuentos.valor is NOT null  and tbl_empleados.fecha_contratacion < '$e' and YEAR(fecha_contratacion)<YEAR(NOW()) AND  DATE_FORMAT(DATE(NOW()), '%m-%d') >= DATE_FORMAT(tbl_empleados.fecha_contratacion, '%m-%d') AND MONTH(fecha_contratacion)=MONTH(NOW()) AND DAY(fecha_contratacion) BETWEEN '$dia1' AND '$dia2' "; */

			/* $query01="SELECT DATE_FORMAT(DATE(NOW()), '%m-%d')as fecha_actual,DATE_FORMAT(tbl_empleados.fecha_contratacion, '%m-%d') as fechacontracion, tbl_empleados.id as idempleado, tbl_empleados.*, tbl_empleados_devengos_descuentos.* , tbl_devengo_descuento.*
			FROM `tbl_empleados` , tbl_empleados_devengos_descuentos,tbl_devengo_descuento 
			WHERE tbl_empleados.id=tbl_empleados_devengos_descuentos.id_empleado and tbl_devengo_descuento.id = tbl_empleados_devengos_descuentos.id_tipo_devengo_descuento  and tbl_empleados_devengos_descuentos.valor is NOT null  and YEAR(fecha_contratacion)<YEAR(NOW())  and  DATE_FORMAT(DATE(NOW()), '%m-%d') >= DATE_FORMAT(tbl_empleados.fecha_contratacion, '%m-%d')  AND MONTH(NOW()) >= MONTH(fecha_contratacion) AND DAY(fecha_contratacion) BETWEEN '$dia1' AND '$dia2'   and tbl_empleados.id >= '$empleado_rango_desde1' and tbl_empleados.id <= '$empleado_rango_hasta1' GROUP by tbl_empleados.id"; */

			$query01="SELECT DATE_FORMAT(DATE(NOW()), '%m-%d')as fecha_actual,DATE_FORMAT(tbl_empleados.fecha_contratacion, '%m-%d') as fechacontracion, tbl_empleados.id as idempleado, tbl_empleados.*
			FROM `tbl_empleados` 
			WHERE  YEAR(fecha_contratacion)<'$anio1'  and  '$mes1' = MONTH(fecha_contratacion) AND DAY(fecha_contratacion) BETWEEN '$dia1' AND '$dia2'   and tbl_empleados.id >= '$empleado_rango_desde1' and tbl_empleados.id <= '$empleado_rango_hasta1' GROUP by tbl_empleados.id";

			/* echo $query01; */
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};
		$newDate = date("Y-m-d", strtotime($fecha_planilladevengo_vacacion));
		$fechaperiodo1_total = date("Y-m-d", strtotime($_POST["fechaperiodo1"]));
		$fechaperiodo2_total= date("Y-m-d", strtotime($_POST["fechaperiodo2"]));
		$fechaperiodo1 = date("d",strtotime($_POST["fechaperiodo1"]));
		$fechaperiodo2 = date("d",strtotime($_POST["fechaperiodo2"]));

		$anio = date("Y", strtotime($fecha_planilladevengo_vacacion));
		$mes = date("m", strtotime($fecha_planilladevengo_vacacion));


		$data01 = consultar($newDate,$fechaperiodo1,$fechaperiodo2,$empleado_rango_desde,$empleado_rango_hasta,$anio,$mes);
		$datos_html = "";
		$datos_html .= '  <table class="table table-bordered table-striped dt-responsive tablas1" width="100%">
		<thead>
		  <tr>
			<th style="width:90px">Código</th>
			<th>Nombre Empleado</th>
			<th>Acciones</th>
		  </tr> 
		</thead>
		<tbody>';
		$values_consulta="";
		$values_devengo="";


		/* ***CONSULTAR DEVENGO***** */
		function consultar_devengo($idempleado1)
		{
			$query01 = "SELECT `id`, `id_empleado`, `id_tipo_devengo_descuento`, `valor`, `fecha_caducidad`, `referencia` FROM `tbl_empleados_devengos_descuentos` WHERE id_empleado=$idempleado1";
		
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};
		/* *************************** */

		foreach ($data01 as $value) {

			$idempleado=$value["idempleado"];
			$data02 = consultar_devengo($idempleado);
			$id_tipo_devengo_descuento="";
			$valor_viaticos=0;
			foreach ($data02 as $value1) {
				if($value1["id_tipo_devengo_descuento"]=="2"){
					$id_tipo_devengo_descuento.=$value1["id_tipo_devengo_descuento"];
					$valor_viaticos .= $value1["valor"];
				}

			}

			/* OBTENER DATOS PARA CALCULAR VACACION */
			$sueldo_empleado=$value["sueldo"];
			if($valor_viaticos==""){
					$valor_viaticos=0;
				}
			if($sueldo_empleado==""){
					$sueldo_empleado=0;
				}
			$suma_sueldo_viatico=$valor_viaticos+$sueldo_empleado;
			$calculo_vacacion=$suma_sueldo_viatico*0.30;


			$codigo_devengo_descuento_planilla=$codigo_devengo;
			$descripcion_devengo_descuento_planilla=$descipcion_devengo;
			$tipo_devengo_descuento_planilla=$id_devengo;
			$isss_devengo_devengo_descuento_planilla=$isss_devengo;
			$afp_devengo_devengo_descuento_planilla=$afp_devengo;
			$renta_devengo_devengo_descuento_planilla=$renta_devengo;
			$idempleado_devengo=$value["idempleado"];
			$valor_devengo_planilla=$calculo_vacacion;
			$tipo_valor="Suma";
			$codigo_planilla_devengo=$numero_planilladevengo_vacacion;

			$values_devengo.="('$codigo_devengo_descuento_planilla', '$descripcion_devengo_descuento_planilla', '$tipo_devengo_descuento_planilla', '$isss_devengo_devengo_descuento_planilla', '$afp_devengo_devengo_descuento_planilla', '$renta_devengo_devengo_descuento_planilla', '$idempleado_devengo', '$valor_devengo_planilla', '$tipo_valor', '$codigo_planilla_devengo'),";

		/* **************** */
			$numero_planilladevengo_vacacion=$numero_planilladevengo_vacacion;
			$fecha_planilladevengo_vacacion=$newDate;
			$fecha_desde_planilladevengo_vacacion=$fechaperiodo1_total;
			$fecha_hasta_planilladevengo_vacacion=$fechaperiodo2_total;
			$descripcion_planilladevengo_vacacion=$descripcion_planilladevengo_vacacion;
			$codigo_empleado_planilladevengo_vacacion=$value["codigo_empleado"];
			$nombre_empleado_planilladevengo_vacacion=$value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"];
			$id_empleado_planilladevengo_vacacion=$value["idempleado"];
			$sueldo_planilladevengo_vacacion=$value["sueldo"];
			$sueldo=$value["sueldo"];
			$devengo=$value["valor"];
			$totaldevengo=$sueldo+$devengo;
			$total_devengo_vacacion_planilladevengo_vacacion=$totaldevengo;
			$total_liquidado_planilladevengo_vacacion=$totaldevengo;
			$codigo_ubicacion_planilladevengo_vacacion="";
			$nombre_ubicacion_planilladevengo_vacacion="";
			$id_ubicacion_planilladevengo_vacacion="";
			$periodo_planilladevengo_vacacion=$periodo_planilladevengo_vacacion;
			$tipo_planilladevengo_vacacion=$tipo_planilladevengo_vacacion;
			$empleado_rango_desde=$empleado_rango_desde;
			$empleado_rango_hasta=$empleado_rango_hasta;

			$values_consulta.="('$numero_planilladevengo_vacacion','$fecha_planilladevengo_vacacion','$fecha_desde_planilladevengo_vacacion','$fecha_hasta_planilladevengo_vacacion','$descripcion_planilladevengo_vacacion','$codigo_empleado_planilladevengo_vacacion','$nombre_empleado_planilladevengo_vacacion','$id_empleado_planilladevengo_vacacion','$sueldo_planilladevengo_vacacion','$total_devengo_vacacion_planilladevengo_vacacion','$total_liquidado_planilladevengo_vacacion','$codigo_ubicacion_planilladevengo_vacacion','$nombre_ubicacion_planilladevengo_vacacion','$id_ubicacion_planilladevengo_vacacion','$periodo_planilladevengo_vacacion','$tipo_planilladevengo_vacacion','$empleado_rango_desde','$empleado_rango_hasta'),";

			$datos_html .= ' <tr class="btnEditarabase" hora_extra_nocturna_domingo="'.$value["hora_extra_nocturna_domingo"].'"   hora_extra_domingo="'.$value["hora_extra_domingo"].'"  hora_extra_nocturna="'.$value["hora_extra_nocturna"].'" hora_extra_diurna="'.$value["hora_extra_diurna"].'"    salario_por_hora="'.$value["salario_por_hora"].'"  sueldo="'.$value["sueldo"].'"  idempleado="'.$value["idempleado"].'" codigo="'.$value["codigo_empleado"].'"  nombre="'.$value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"].'">
			<td>'.$value["codigo_empleado"].'</td>
			<td>'.$value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"].' </td>';
			$datos_html .='<td><div class="btn btn-danger eliminarempleado" numero_planilla="'.$numero_planilladevengo_vacacion.'" idempleado="'.$value["idempleado"].'"><i class="fa fa-times"></i></div></td>';
			$datos_html .= '</tr>';
		}
		$datos_html .= '</tbody></table>';
		/* echo trim($values_consulta, ","); */


		/* echo $datos_html; */
		function consultar_planilla($numero_planilladevengo_vacacion1)
			{
			
				$query01="SELECT `id`, `numero_planilladevengo_vacacion`, `fecha_planilladevengo_vacacion`, `fecha_desde_planilladevengo_vacacion`, `fecha_hasta_planilladevengo_vacacion`, `descripcion_planilladevengo_vacacion`, `codigo_empleado_planilladevengo_vacacion`, `nombre_empleado_planilladevengo_vacacion`, `id_empleado_planilladevengo_vacacion`, `dias_trabajo_planilladevengo_vacacion`, `sueldo_planilladevengo_vacacion`, `hora_extra_diurna_planilladevengo_vacacion`, `hora_extra_nocturna_planilladevengo_vacacion`, `hora_extra_domingo_planilladevengo_vacacion`, `hora_extra_domingo_nocturna_planilladevengo_vacacion`, `otro_devengo_vacacion_planilladevengo_vacacion`, `total_devengo_vacacion_planilladevengo_vacacion`, `descuento_isss_planilladevengo_vacacion`, `descuento_afp_planilladevengo_vacacion`, `descuento_renta_planilladevengo_vacacion`, `otro_descuento_planilladevengo_vacacion`, `total_descuento_planilladevengo_vacacion`, `total_liquidado_planilladevengo_vacacion`, `sueldo_renta_planilladevengo_vacacion`, `sueldo_isss_planilladevengo_vacacion`, `sueldo_afp_planilladevengo_vacacion`, `departamento_planilladevengo_vacacion`, `codigo_ubicacion_planilladevengo_vacacion`, `nombre_ubicacion_planilladevengo_vacacion`, `id_ubicacion_planilladevengo_vacacion`, `observacion_planilladevengo_vacacion`, `periodo_planilladevengo_vacacion`, `tipo_planilladevengo_vacacion`, `dias_incapacidad`, `empleado_rango_desde`, `empleado_rango_hasta`, COUNT(*) as registro FROM `planilladevengo_vacacion` WHERE numero_planilladevengo_vacacion='$numero_planilladevengo_vacacion1'";
				$sql = Conexion::conectar()->prepare($query01);
				$sql->execute();
				return $sql->fetchAll();
			};
		$data_planilla = consultar_planilla($numero_planilladevengo_vacacion);
		$registro="";
		foreach ($data_planilla as $value) {
			$registro.=$value["registro"];
		}
		if($registro == 0){


			$insertar_devengo="INSERT INTO `tbl_devengo_descuento_planilla_vacacion`(`codigo_devengo_descuento_planilla`, `descripcion_devengo_descuento_planilla`, `tipo_devengo_descuento_planilla`, `isss_devengo_devengo_descuento_planilla`, `afp_devengo_devengo_descuento_planilla`, `renta_devengo_devengo_descuento_planilla`,`idempleado_devengo`, `valor_devengo_planilla`, `tipo_valor`, `codigo_planilla_devengo`) VALUES  ".trim($values_devengo, ",")."";
			$sql_devengo = Conexion::conectar()->prepare($insertar_devengo);
			$sql_devengo->execute();
	

			$insertar="INSERT INTO `planilladevengo_vacacion`(`numero_planilladevengo_vacacion`, `fecha_planilladevengo_vacacion`, `fecha_desde_planilladevengo_vacacion`, `fecha_hasta_planilladevengo_vacacion`, `descripcion_planilladevengo_vacacion`, `codigo_empleado_planilladevengo_vacacion`, `nombre_empleado_planilladevengo_vacacion`, `id_empleado_planilladevengo_vacacion`, `sueldo_planilladevengo_vacacion`,  `total_devengo_vacacion_planilladevengo_vacacion`, `total_liquidado_planilladevengo_vacacion`, `codigo_ubicacion_planilladevengo_vacacion`, `nombre_ubicacion_planilladevengo_vacacion`, `id_ubicacion_planilladevengo_vacacion`, `periodo_planilladevengo_vacacion`, `tipo_planilladevengo_vacacion`, `empleado_rango_desde`, `empleado_rango_hasta`) value ".trim($values_consulta, ",")."";
			$sql = Conexion::conectar()->prepare($insertar);
			if ($sql->execute()) {
				/* echo "OK"; */
				$data_planilla = consultar_planilla($numero_planilladevengo_vacacion);
				$id="";
				foreach ($data_planilla as $value) {
					$id.=$value["id"];	
				}
				echo $numero_planilladevengo_vacacion;
			} else {
				/* echo "error"; */
			}
			$sql = null;
		 }
	    	else{
			echo $datos_html;
		 }
	break;
	case "empleadosguardados":
		
		$tipo_planilladevengo_vacacion = $_POST["tipo_planilladevengo_vacacion"];
		$periodo_planilladevengo_vacacion = $_POST["periodo_planilladevengo_vacacion"];
		$numero_planilladevengo_vacacion = $_POST["numero_planilladevengo_vacacion"];
		$descripcion_planilladevengo_vacacion = $_POST["descripcion_planilladevengo_vacacion"];
		function consultar($e,$dia1,$dia2,$numero_planilladevengo_vacacion1)
		{

			$query01="SELECT  tbl_empleados.id as idempleado, tbl_empleados.*
			FROM `tbl_empleados` , planilladevengo_vacacion
			WHERE planilladevengo_vacacion.id_empleado_planilladevengo_vacacion=tbl_empleados.id and planilladevengo_vacacion.numero_planilladevengo_vacacion='$numero_planilladevengo_vacacion1' group by tbl_empleados.id";

			/* echo $query01; */
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};
		$newDate = date("Y-m-d", strtotime($fecha_planilladevengo_vacacion));
		$fechaperiodo1_total = date("Y-m-d", strtotime($_POST["fechaperiodo1"]));
		$fechaperiodo2_total= date("Y-m-d", strtotime($_POST["fechaperiodo2"]));
		$fechaperiodo1 = date("d",strtotime($_POST["fechaperiodo1"]));
		$fechaperiodo2 = date("d",strtotime($_POST["fechaperiodo2"]));
		$data01 = consultar($newDate,$fechaperiodo1,$fechaperiodo2,$numero_planilladevengo_vacacion);
		$datos_html = "";
		$datos_html .= '  <table class="table table-bordered table-striped dt-responsive tablas1" width="100%">
		<thead>
		<tr>
			<th style="width:90px">Código</th>
			<th>Nombre Empleado</th>
			<th>Acciones</th>
		</tr> 
		</thead>
		<tbody>';
		$values_consulta="";
		foreach ($data01 as $value) {

			
			$datos_html .= ' <tr class="btnEditarabase" hora_extra_nocturna_domingo="'.$value["hora_extra_nocturna_domingo"].'"   hora_extra_domingo="'.$value["hora_extra_domingo"].'"  hora_extra_nocturna="'.$value["hora_extra_nocturna"].'" hora_extra_diurna="'.$value["hora_extra_diurna"].'"   sueldo_diario="'.$value["sueldo_diario"].'"  fecha_contratacion="'.$value["fecha_contratacion"].'" salario_por_hora="'.$value["salario_por_hora"].'"  sueldo="'.$value["sueldo"].'"  idempleado="'.$value["idempleado"].'" codigo="'.$value["codigo_empleado"].'"  nombre="'.$value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"].'">
			<td>'.$value["codigo_empleado"].'</td>
			<td>'.$value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"].' </td>';
			$datos_html .='<td><div class="btn btn-danger eliminarempleado" numero_planilla="'.$numero_planilladevengo_vacacion.'" idempleado="'.$value["idempleado"].'"><i class="fa fa-times"></i></div></td>';
			$datos_html .= '</tr>';
		}
		$datos_html .= '</tbody></table>';
		/* echo trim($values_consulta, ","); */

		echo $datos_html;
		
	break;
	case "listaconempleado_backup":




		function consultar($e,$x)
		{
			$query01 = "SELECT tbl_empleados.id as idempleado, tbl_empleados.*, tbl_empleados_devengos_descuentos.* , tbl_devengo_descuento.* 
			FROM `tbl_empleados` , tbl_empleados_devengos_descuentos,tbl_devengo_descuento WHERE tbl_empleados.id=tbl_empleados_devengos_descuentos.id_empleado and tbl_devengo_descuento.id = tbl_empleados_devengos_descuentos.id_tipo_devengo_descuento and tbl_devengo_descuento.codigo='0022' and tbl_empleados_devengos_descuentos.valor is NOT null  and tbl_empleados.id >= '$e' and tbl_empleados.id <= '$x' ";
			echo $query01;
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
		$stmt = Conexion::conectar()->prepare("INSERT INTO planilladevengo_vacacion(" . trim($namecolumnas_situacion, ",") . ") VALUES (" . trim($namecampos_situacion, ",") . ")");

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

		$codigo_empleado_planilladevengo_vacacion = $_POST["codigo_empleado_planilladevengo_vacacion"];
		$numero_planilladevengo_vacacion = $_POST["numero_planilladevengo_vacacion"];
		function validarempleado01($e,$numero_planilladevengo_vacacion1)
		{
					$query01 = "SELECT * FROM planilladevengo_vacacion WHERE codigo_empleado_planilladevengo_vacacion='$e' and numero_planilladevengo_vacacion=$numero_planilladevengo_vacacion1 ";
					$sql = Conexion::conectar()->prepare($query01);
					$sql->execute();
					return $sql->fetchAll();
		}
		$existeempleado="";
		$data03 = validarempleado01($codigo_empleado_planilladevengo_vacacion,$numero_planilladevengo_vacacion);
		foreach ($data03 as $value) {
		$existeempleado.=$value["id"];
		}


		$query01 = "UPDATE planilladevengo_vacacion SET " . trim($test, ",") . " WHERE id LIKE $existeempleado and numero_planilladevengo_vacacion=$numero_planilladevengo_vacacion";
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
		/* 	$query01 = "SELECT * FROM `planilladevengo_vacacion`  WHERE codigo_empleado_planilladevengo_vacacion='$e'"; */
		/* 		$query01="SELECT tbl_empleados.id as idempleado, tbl_clientes_ubicaciones.id as idubicacion, tbl_clientes_ubicaciones.* , tbl_empleados_devengos_descuentos.* , tbl_clientes_ubicaciones.* ,  tbl_empleados.*,SUM(tbl_empleados_devengos_descuentos.valor) as valorempleado
		FROM tbl_empleados,tbl_ubicaciones_agentes_asignados,tbl_empleados_devengos_descuentos, tbl_clientes_ubicaciones
		WHERE tbl_empleados.codigo_empleado=tbl_ubicaciones_agentes_asignados.codigo_agente and tbl_empleados.id=tbl_empleados_devengos_descuentos.id_empleado and tbl_ubicaciones_agentes_asignados.idubicacion_agente=tbl_clientes_ubicaciones.id and  tbl_empleados.codigo_empleado='$e' and tbl_empleados_devengos_descuentos.id_tipo_devengo_descuento=2"; */
		
		
		/* $query01="SELECT tbl_empleados.id as idempleado, tbl_clientes_ubicaciones.id as idubicacion, tbl_clientes_ubicaciones.* , tbl_empleados_devengos_descuentos.* , tbl_clientes_ubicaciones.* ,  tbl_empleados.*,SUM(tbl_empleados_devengos_descuentos.valor) as valorempleado
		FROM tbl_empleados,tbl_ubicaciones_agentes_asignados,tbl_empleados_devengos_descuentos, tbl_clientes_ubicaciones
		WHERE tbl_empleados.codigo_empleado=tbl_ubicaciones_agentes_asignados.codigo_agente and tbl_empleados.id=tbl_empleados_devengos_descuentos.id_empleado and tbl_ubicaciones_agentes_asignados.idubicacion_agente=tbl_clientes_ubicaciones.id and  tbl_empleados.codigo_empleado='$e'"; */

		$query01="SELECT tbl_empleados.id as idempleado, tbl_clientes_ubicaciones.id as idubicacion, tbl_clientes_ubicaciones.* , tbl_empleados_devengos_descuentos.* , tbl_clientes_ubicaciones.* ,  tbl_empleados.*,SUM(tbl_empleados_devengos_descuentos.valor) as valorempleado, departamentos_empresa.*, departamentos_empresa.nombre as nombredepartamento
		FROM tbl_empleados,tbl_ubicaciones_agentes_asignados,tbl_empleados_devengos_descuentos, tbl_clientes_ubicaciones,departamentos_empresa
		WHERE tbl_empleados.codigo_empleado=tbl_ubicaciones_agentes_asignados.codigo_agente and tbl_empleados.id=tbl_empleados_devengos_descuentos.id_empleado and tbl_ubicaciones_agentes_asignados.idubicacion_agente=tbl_clientes_ubicaciones.id and
		departamentos_empresa.id = tbl_empleados.id_departamento_empresa and tbl_empleados.codigo_empleado='$e'";
	
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			$outp = $sql->fetchAll();
			echo json_encode($outp);
		};
		$data01 = consultar_situacion2($consultarempleado);
		$result = [];

			/* 	foreach ($data01 as $value) {
					$result['id'] = $value['id'];
					$result['numero_planilladevengo_vacacion'] = $value['numero_planilladevengo_vacacion'];
					$result['fecha_planilladevengo_vacacion'] = $value['fecha_planilladevengo_vacacion'];
					$result['fecha_desde_planilladevengo_vacacion'] = $value['fecha_desde_planilladevengo_vacacion'];
					$result['fecha_hasta_planilladevengo_vacacion'] = $value['fecha_hasta_planilladevengo_vacacion'];
					$result['descripcion_planilladevengo_vacacion'] = $value['descripcion_planilladevengo_vacacion'];
					$result['codigo_empleado_planilladevengo_vacacion'] = $value['codigo_empleado_planilladevengo_vacacion'];
					$result['nombre_empleado_planilladevengo_vacacion'] = $value['nombre_empleado_planilladevengo_vacacion'];
					$result['id_empleado_planilladevengo_vacacion'] = $value['id_empleado_planilladevengo_vacacion'];
					$result['dias_trabajo_planilladevengo_vacacion'] = $value['dias_trabajo_planilladevengo_vacacion'];
					$result['sueldo_planilladevengo_vacacion'] = $value['sueldo_planilladevengo_vacacion'];
					$result['hora_extra_diurna_planilladevengo_vacacion'] = $value['hora_extra_diurna_planilladevengo_vacacion'];
					$result['hora_extra_nocturna_planilladevengo_vacacion'] = $value['hora_extra_nocturna_planilladevengo_vacacion'];
					$result['hora_extra_domingo_planilladevengo_vacacion'] = $value['hora_extra_domingo_planilladevengo_vacacion'];
					$result['hora_extra_domingo_nocturna_planilladevengo_vacacion'] = $value['hora_extra_domingo_nocturna_planilladevengo_vacacion'];
					$result['otro_devengo_vacacion_planilladevengo_vacacion'] = $value['otro_devengo_vacacion_planilladevengo_vacacion'];
					$result['total_devengo_vacacion_planilladevengo_vacacion'] = $value['total_devengo_vacacion_planilladevengo_vacacion'];
					$result['descuento_isss_planilladevengo_vacacion	'] = $value['descuento_isss_planilladevengo_vacacion	'];
					$result['descuento_afp_planilladevengo_vacacion'] = $value['descuento_afp_planilladevengo_vacacion'];
					$result['descuento_renta_planilladevengo_vacacion'] = $value['descuento_renta_planilladevengo_vacacion'];
					$result['otro_descuento_planilladevengo_vacacion'] = $value['otro_descuento_planilladevengo_vacacion'];
					$result['total_descuento_planilladevengo_vacacion'] = $value['total_descuento_planilladevengo_vacacion'];
					$result['total_liquidado_planilladevengo_vacacion'] = $value['total_liquidado_planilladevengo_vacacion'];
					$result['sueldo_renta_planilladevengo_vacacion'] = $value['sueldo_renta_planilladevengo_vacacion'];
					$result['sueldo_isss_planilladevengo_vacacion'] = $value['sueldo_isss_planilladevengo_vacacion'];
					$result['sueldo_afp_planilladevengo_vacacion'] = $value['sueldo_afp_planilladevengo_vacacion'];
					$result['departamento_planilladevengo_vacacion'] = $value['departamento_planilladevengo_vacacion'];
					$result['codigo_ubicacion_planilladevengo_vacacion'] = $value['codigo_ubicacion_planilladevengo_vacacion'];
					$result['nombre_ubicacion_planilladevengo_vacacion'] = $value['nombre_ubicacion_planilladevengo_vacacion'];
					$result['id_ubicacion_planilladevengo_vacacion'] = $value['id_ubicacion_planilladevengo_vacacion'];
					$result['observacion_planilladevengo_vacacion'] = $value['observacion_planilladevengo_vacacion'];
					$result['periodo_planilladevengo_vacacion'] = $value['periodo_planilladevengo_vacacion'];
					$result['tipo_planilladevengo_vacacion'] = $value['tipo_planilladevengo_vacacion'];
					$result['dias_incapacidad'] = $value['dias_incapacidad'];

				} */

				/* echo json_encode($result); */

		
			/* ************ */
	break;
	case "obtenerdatatotal":

		$numero_planilladevengo_vacacion=$_POST["numero_planilladevengo_vacacion"];
		/* ************ */
		function consultar_situacion2($e,$numero_planilladevengo_vacacion1)
		{
		/* 	$query01 = "SELECT * FROM `planilladevengo_vacacion`  WHERE codigo_empleado_planilladevengo_vacacion='$e'"; */
		$query01="SELECT `id`, `numero_planilladevengo_vacacion`, `fecha_planilladevengo_vacacion`, `fecha_desde_planilladevengo_vacacion`, `fecha_hasta_planilladevengo_vacacion`, `descripcion_planilladevengo_vacacion`, `codigo_empleado_planilladevengo_vacacion`, `nombre_empleado_planilladevengo_vacacion`, `id_empleado_planilladevengo_vacacion`, `dias_trabajo_planilladevengo_vacacion`, `sueldo_planilladevengo_vacacion`, `hora_extra_diurna_planilladevengo_vacacion`, `hora_extra_nocturna_planilladevengo_vacacion`, `hora_extra_domingo_planilladevengo_vacacion`, `hora_extra_domingo_nocturna_planilladevengo_vacacion`, `otro_devengo_vacacion_planilladevengo_vacacion`, `total_devengo_vacacion_planilladevengo_vacacion`, `descuento_isss_planilladevengo_vacacion`, `descuento_afp_planilladevengo_vacacion`, `descuento_renta_planilladevengo_vacacion`, `otro_descuento_planilladevengo_vacacion`, `total_descuento_planilladevengo_vacacion`, `total_liquidado_planilladevengo_vacacion`, `sueldo_renta_planilladevengo_vacacion`, `sueldo_isss_planilladevengo_vacacion`, `sueldo_afp_planilladevengo_vacacion`, `departamento_planilladevengo_vacacion`, `codigo_ubicacion_planilladevengo_vacacion`, `nombre_ubicacion_planilladevengo_vacacion`, `id_ubicacion_planilladevengo_vacacion`, `observacion_planilladevengo_vacacion`, `periodo_planilladevengo_vacacion`, `tipo_planilladevengo_vacacion`, `dias_incapacidad` FROM `planilladevengo_vacacion` WHERE id_empleado_planilladevengo_vacacion=$e and numero_planilladevengo_vacacion=$numero_planilladevengo_vacacion1";


			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			$outp = $sql->fetchAll();
			echo json_encode($outp);
		};
		$data01 = consultar_situacion2($consultarempleado,$numero_planilladevengo_vacacion);
		$result = [];


		
			/* ************ */
	break;
	case "consultard":
		/* ************ */
		function consultar_situacion2($e,$x,$z)
		{
			$query01="SELECT*FROM tbl_devengo_descuento_planilla_vacacion WHERE idempleado_devengo='$e' and codigo_planilla_devengo='$z' and tipo_valor LIKE '%$x%'";
			
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
			<td class="subtotal2" isss="'.$value["isss_devengo_devengo_descuento_planilla"].'" afp="'.$value["afp_devengo_devengo_descuento_planilla"].'" renta="'.$value["renta_devengo_devengo_descuento_planilla"].'" >'.bcdiv($value["valor_devengo_planilla"], '1', 2).'</td>
			<td>'.$value["isss_devengo_devengo_descuento_planilla"].'</td>
			<td>'.$value["afp_devengo_devengo_descuento_planilla"].'</td>
			<td>'.$value["renta_devengo_devengo_descuento_planilla"].'</td>
			<td>
			  <div class="btn btn-warning modificar" id="'.$value["id"].'"  accion="modificar_devengo"><i class="fa fa-pencil"></i></div>
			  <div class="btn btn-danger eliminar" idempleado_devengo="'.$value["idempleado_devengo"].'" id="'.$value["id"].'" accion="eliminar_devengo"><i class="fa fa-times"></i></div>
			</td>
		  </tr>';
		}
		/* ************ */
	break;
	
	case "consultarviatico":
		/* ************ */
		function consultar_situacion2($e,$x,$z)
		{
			/* $query01="SELECT*FROM tbl_devengo_descuento_planilla_vacacion WHERE idempleado_devengo='$e' and codigo_planilla_devengo='$z' and tipo_valor LIKE '%$x%'";
		 */
			$query01="SELECT*FROM tbl_empleados_devengos_descuentos WHERE id_empleado='$e' and id_tipo_devengo_descuento='2'";
		
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			$outp = $sql->fetchAll();
			echo json_encode($outp);
		};
		$tipo=$_POST["tipo"];
		$codigo_planilla_devengo=$_POST["codigo_planilla_devengo"];
		$data01 = consultar_situacion2($consultarempleado,$tipo,$codigo_planilla_devengo);
		$result = [];
		/* ************ */
	break;
	case "agregarvacacion":
		$sueldo=$_POST["sueldo"];
		$codigo_planilla_devengo=$_POST["codigo_planilla_devengo"];
		/* ************ */
		function consultar_situacion2($e)
		{
			/* $query01="SELECT*FROM tbl_devengo_descuento_planilla_vacacion WHERE idempleado_devengo='$e' and codigo_planilla_devengo='$z' and tipo_valor LIKE '%$x%'";
		 */
			$query01="SELECT*FROM tbl_empleados_devengos_descuentos WHERE id_empleado='$e' and id_tipo_devengo_descuento='2'";
		
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};
		$data01 = consultar_situacion2($consultarempleado);
		$valor_devengo="";
		foreach ($data01 as $value) {
			$valor_devengo=$value["valor"];
		}
		if($valor_devengo==""){
			$valor_devengo=0;
		}
		$suma_viatico_sueldo=$sueldo+$valor_devengo;
		$total_vacacion=$suma_viatico_sueldo*0.30;
		/* ***CONSULTAR DEVENGO02***** */
		function consultar_devengo2()
		{
			$query01 = "SELECT `id`, `codigo`, `descripcion`, `porcentaje`, `tipo`, `cargo_abono`, `cuenta_contable`, `isss_devengo`, `afp_devengo`, `renta_devengo` FROM `tbl_devengo_descuento` WHERE codigo='0024'";
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};
		$data01 = consultar_devengo2();
		$codigo_devengo="";
		$descipcion_devengo="";
		$isss_devengo="";
		$afp_devengo="";
		$renta_devengo="";
		$id_devengo="";
		foreach ($data01 as $value) {
			$id_devengo=$value["id"];
			$codigo_devengo=$value["codigo"];
			$descipcion_devengo=$value["descripcion"];
			$isss_devengo=$value["isss_devengo"];
			$afp_devengo=$value["afp_devengo"];
			$renta_devengo=$value["renta_devengo"];
		}

		/* *************** */


		$codigo_devengo_descuento_planilla=$codigo_devengo;
		$descripcion_devengo_descuento_planilla=$descipcion_devengo;
		$tipo_devengo_descuento_planilla=$id_devengo;/* --este es el id de devengoydescuento tabla */
		$isss_devengo_devengo_descuento_planilla=$isss_devengo;
		$afp_devengo_devengo_descuento_planilla=$afp_devengo;
		$renta_devengo_devengo_descuento_planilla=$renta_devengo;
		$idempleado_devengo=$consultarempleado;
		$valor_devengo_planilla=$total_vacacion;
		$tipo_valor="Suma";
		$codigo_planilla_devengo=$codigo_planilla_devengo;

		$values_devengo="('$codigo_devengo_descuento_planilla', '$descripcion_devengo_descuento_planilla', '$tipo_devengo_descuento_planilla', '$isss_devengo_devengo_descuento_planilla', '$afp_devengo_devengo_descuento_planilla', '$renta_devengo_devengo_descuento_planilla', '$idempleado_devengo', '$valor_devengo_planilla', '$tipo_valor', '$codigo_planilla_devengo'),";
		
			
		$insertar_devengo="INSERT INTO `tbl_devengo_descuento_planilla_vacacion`(`codigo_devengo_descuento_planilla`, `descripcion_devengo_descuento_planilla`, `tipo_devengo_descuento_planilla`, `isss_devengo_devengo_descuento_planilla`, `afp_devengo_devengo_descuento_planilla`, `renta_devengo_devengo_descuento_planilla`,`idempleado_devengo`, `valor_devengo_planilla`, `tipo_valor`, `codigo_planilla_devengo`) VALUES  ".trim($values_devengo, ",")."";
		$sql_devengo = Conexion::conectar()->prepare($insertar_devengo);
		$sql_devengo->execute();
		echo $insertar_devengo;


		/* ************ */
	break;
	case "agregardevengo":
				/* ****************** */
				/* CAPTURA NOMBRE DE LAS COLUMNAS Y CAMPOS DEL IMPUT */
				$namecolumnas_situacion = "";
				$namecampos_situacion = "";
		
				$data = getContent_devengo_vacacion();
				foreach ($data as $row) {
					$namecolumnas_situacion .= $row['Field'] . ",";
					$namecampos_situacion .= ":" . $row['Field'] . ",";
				}
				$stmt = Conexion::conectar()->prepare("INSERT INTO tbl_devengo_descuento_planilla_vacacion(" . trim($namecolumnas_situacion, ",") . ") VALUES (" . trim($namecampos_situacion, ",") . ")");

				
				$campos="";
				foreach ($data as $row) {
					$stmt->bindParam(":" . $row['Field'], $_POST["" . $row['Field'] . ""], PDO::PARAM_STR);
					$campos.= $_POST["" . $row['Field'] . ""].',';
					
				}

						/* 		echo "INSERT INTO tbl_devengo_vacacion_descuento_planilla(" . trim($namecolumnas_situacion, ",") . ") VALUES (" . trim($campos, ",") . ")";
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
					$data = getContent_devengo_vacacion();
					$test = "";
					foreach ($data as $row) {
						$namecolumnas_situacion .= $row['Field'] . "=" . ":" . $row['Field'] . ",";
						$test .= $row['Field'] . "='" . $_POST["" . $row['Field'] . ""] . "',";
					}
			
					$query01 = "UPDATE tbl_devengo_descuento_planilla_vacacion SET " . trim($test, ",") . " WHERE id LIKE $id";
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
		/* 	$query01 = "SELECT * FROM `planilladevengo_vacacion`  WHERE codigo_empleado_planilladevengo_vacacion='$e'"; */
			$query01="SELECT*FROM tbl_devengo_descuento_planilla_vacacion WHERE id='$e'";
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			$outp = $sql->fetchAll();
			echo json_encode($outp);
			
		};
		$data01 = consultar_situacion2($consultarempleado);
		$result = [];
			/* ************ */
	break;
	case "obtenerdataempleados_devengos_descuentos":
		/* ************ */
		function consultar_situacion2($e)
		{
		/* 	$query01 = "SELECT * FROM `planilladevengo_vacacion`  WHERE codigo_empleado_planilladevengo_vacacion='$e'"; */
			$query01="SELECT*FROM tbl_empleados_devengos_descuentos WHERE id='$e'";
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
		$idempleado=$_POST["idempleado"];
		$query = "DELETE FROM `tbl_devengo_descuento_planilla_vacacion` WHERE id=$consultarempleado";
		echo $query;
		$stmt = Conexion::conectar()->prepare($query);
		$stmt->execute();
		/* ****************** */
		/* 		$query = "DELETE FROM `planilladevengo_vacacion` WHERE id_empleado_planilladevengo_vacacion=$idempleado";
		echo $query;
		$stmt = Conexion::conectar()->prepare($query);
		$stmt->execute(); */

		return $stmt->fetchAll();
		$stmt->close();
		$stmt = null;
		/* ********************* */
	break;
	case "calculos":
		/* ************ */
		function consultar($e)
		{
		/* 	$query01 = "SELECT * FROM `planilladevengo_vacacion`  WHERE codigo_empleado_planilladevengo_vacacion='$e'"; */
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
		if($periodo_pago=="15"){
			$periodo_pago="quincenal";
		}
		if($periodo_pago=="030"){
			$periodo_pago="Mensual";
		}
		if($periodo_pago=="30"){
			$periodo_pago="Mensual";
		}
		/* ************************ */

		function consultar_isr($salario,$periodo)
		{
		/* 	$query01 = "SELECT * FROM `planilladevengo_vacacion`  WHERE codigo_empleado_planilladevengo_vacacion='$e'"; */
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
			if($periodo_pago=="15"){
				$periodo_pago="quincenal";
			}
			if($periodo_pago=="030"){
				$periodo_pago="Mensual";
			}
			if($periodo_pago=="30"){
				$periodo_pago="Mensual";
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
				$tasa_sobre_excedente="";

				foreach ($data01 as $value) {
					$porcentaje_base1=$value["base_1"];
					$porcentaje_base2=$value["base_2"];
					$tasa_sobre_excedente=$value["tasa_sobre_excedente"];

				}
				/* ************************* */


				
				/* cuando empleado esta indemdizado */
				function empleado_no_isss($e)
				{
					$query01="SELECT*FROM tbl_empleados WHERE id='$e' and descontar_isss='No'";
				
					$sql = Conexion::conectar()->prepare($query01);
					$sql->execute();
					return $sql->fetchAll();
				};
				$data_planilla = empleado_no_isss($consultarempleado);
				$validar_isss=0;
				foreach ($data_planilla as $value_planilla) {
					$validar_isss.=$value_planilla["id"];
				}
				if($validar_isss!=0){
					$porcentaje_isss="0";
				}

				function empleado_no_afp($e)
				{
					$query01="SELECT*FROM tbl_empleados WHERE id='$e' and descontar_afp='No'";
					$sql = Conexion::conectar()->prepare($query01);
					$sql->execute();
					return $sql->fetchAll();
				};
				$data_planilla = empleado_no_afp($consultarempleado);
				$validar_afp=0;
				foreach ($data_planilla as $value_planilla) {
					$validar_afp.=$value_planilla["id"];
				}
				if($validar_afp!=0){
					$porcentaje_afp="0";
				}

				/* ********************** */

			echo $porcentaje_isss.",".$porcentaje_afp.",".$porcentaje_base1.",".$porcentaje_base2.",".$tasa_sobre_excedente;
			
			/* ************ */
	break;

	case "consultardevengosexistentes":
		/* ************ */
		function consultar_situacion2($e,$x,$z)
		{

			$query01="SELECT  tbl_empleados_devengos_descuentos.id as idempleadodevengo, tbl_empleados_devengos_descuentos.* ,tbl_devengo_descuento.* FROM `tbl_empleados_devengos_descuentos`, tbl_devengo_descuento
			where tbl_empleados_devengos_descuentos.id_tipo_devengo_descuento = tbl_devengo_descuento.id
			and tbl_empleados_devengos_descuentos.id_empleado='$e' and tbl_devengo_descuento.tipo LIKE '%$x%' and tbl_empleados_devengos_descuentos.id_tipo_devengo_descuento=2";

			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
			
		};
		$tipo=$_POST["tipo"];
		$codigo_planilla_devengo=$_POST["codigo_planilla_devengo"];
		$data01 = consultar_situacion2($consultarempleado,$tipo,$codigo_planilla_devengo);

		/* *********** */

		function consultar_planilla($codigo1,$idempleados1,$codigo_planilla1)
		{
			$query01="SELECT `codigo_devengo_descuento_planilla`, `descripcion_devengo_descuento_planilla`, `tipo_devengo_descuento_planilla`, `isss_devengo_devengo_descuento_planilla`, `afp_devengo_devengo_descuento_planilla`, `renta_devengo_devengo_descuento_planilla`, `porcentaje_renta_devengo_descuento_planilla`, `porcentaje_isss_devengo_descuento_planilla`, `porcentaje_afp_devengo_descuento_planilla`, `idempleado_devengo`, `id`, `valor_devengo_planilla`, `tipo_valor`, `codigo_planilla_devengo` FROM `tbl_devengo_descuento_planilla_vacacion` WHERE codigo_devengo_descuento_planilla='$codigo1' and idempleado_devengo='$idempleados1' and codigo_planilla_devengo='$codigo_planilla1' and descripcion_devengo_descuento_planilla='vacio'";
			echo $query01;
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};

		/* ************** */
		foreach ($data01 as $value) {


			$codigo=$value["codigo"];
			$idempleadodevengo=$value["idempleadodevengo"];

			$dato1 = consultar_planilla($codigo,$consultarempleado,$codigo_planilla_devengo);
			$codigo="";
			foreach ($dato1 as $value2) {
				$codigo.=$value2["codigo_devengo_descuento_planilla"];
			}
			echo $codigo;
			if($codigo == ""){
				echo' <tr>
				<td>'.$value["codigo"].'</td>
				<td>'.$value["descripcion"].'</td>
				<td class="subtotal">'.$value["valor"].'</td>
				<td>'.$value["isss_devengo"].'</td>
				<td>'.$value["afp_devengo"].'</td>
				<td>'.$value["renta_devengo"].'</td>
				<td>
				  <div class="btn btn-warning modificarempleadosdevengosdescuentos" id="'.$value["idempleadodevengo"].'"  accion="modificar_devengo" style="display:none"><i class="fa fa-pencil"></i></div>
				  <div class="btn btn-danger eliminar_empleados_devengos_descuentos" id="'.$value["idempleadodevengo"].'" accion="eliminar_devengo"><i class="fa fa-times"></i></div>
				</td>
			  </tr>';
			}
			else{
				echo '<tr></tr>';
			}

		
		}
		/* ************ */
	break;
	case "modificarempleados_devengos_descuentos":
		/* ***************** */

		$namecolumnas_situacion = "";
		$namecampos_situacion = "";
		$data = getContent_devengo_vacacion();
		$test = "";


		$valor=$_POST["valor_devengo_planilla"];
		
		$query01 = "UPDATE tbl_empleados_devengos_descuentos SET `valor`='$valor' WHERE id LIKE $id";
		echo $query01."resultado";
		$sql = Conexion::conectar()->prepare($query01);
		$sql->execute();
		return $sql->fetchAll();
		$sql->close();
		$sql = null;
		/* ***************** */
	break;
	case "eliminarempleados_devengos_descuentos":
		/* ********************* */
/* 		$query = "DELETE FROM `tbl_empleados_devengos_descuentos` WHERE id=$consultarempleado";
		echo $query;
		$stmt = Conexion::conectar()->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
		$stmt = null; */
		/* ********************* */

		$numero_planilladevengo_vacacion=$_POST["numero_planilladevengo_vacacion"];
		/* ************ */
		function consultar_situacion2($id)
		{
			
			$query01="SELECT  tbl_empleados_devengos_descuentos.id as idempleadodevengo, tbl_empleados_devengos_descuentos.* ,tbl_devengo_descuento.* FROM `tbl_empleados_devengos_descuentos`, tbl_devengo_descuento
			where tbl_empleados_devengos_descuentos.id_tipo_devengo_descuento = tbl_devengo_descuento.id and tbl_empleados_devengos_descuentos.id=$id";
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
			
		};

		$data01 = consultar_situacion2($consultarempleado);

		function consultar_planilla($codigo1,$idempleados1,$codigo_planilla1)
		{
			$query01="SELECT `codigo_devengo_descuento_planilla`, `descripcion_devengo_descuento_planilla`, `tipo_devengo_descuento_planilla`, `isss_devengo_devengo_descuento_planilla`, `afp_devengo_devengo_descuento_planilla`, `renta_devengo_devengo_descuento_planilla`, `porcentaje_renta_devengo_descuento_planilla`, `porcentaje_isss_devengo_descuento_planilla`, `porcentaje_afp_devengo_descuento_planilla`, `idempleado_devengo`, `id`, `valor_devengo_planilla`, `tipo_valor`, `codigo_planilla_devengo` FROM `tbl_devengo_descuento_planilla_vacacion` WHERE codigo_devengo_descuento_planilla='$codigo1' and idempleado_devengo='$idempleados1' and codigo_planilla_devengo='$codigo_planilla1' and descripcion_devengo_descuento_planilla='vacio'";
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};

		$iddevengo_planilla="";
		$idempleado_planilla="";
		foreach ($data01 as $value) {
		
			
			$iddevengo_planilla.=$value["id"];
			$idempleado_planilla.=$value["id_empleado"];

			$codigo=$value["codigo"];
			$idempleadodevengo=$value["id_empleado"];
			$dato1 = consultar_planilla($codigo,$idempleadodevengo,$numero_planilladevengo_vacacion);
			$codigo="";
			foreach ($dato1 as $value2) {
				$codigo.=$value2["codigo_devengo_descuento_planilla"];
			}
			if($codigo==""){
				$codigo_devengo_descuento_planilla=$value["codigo"];
				$descripcion_devengo_descuento_planilla="vacio";
				$tipo_devengo_descuento_planilla="";
				$isss_devengo_devengo_descuento_planilla="";
				$afp_devengo_devengo_descuento_planilla="";
				$renta_devengo_devengo_descuento_planilla="";
				$idempleado_devengo=$value["id_empleado"];
				$valor_devengo_planilla="";
				$tipo_valor="";
				$codigo_planilla_devengo=$numero_planilladevengo_vacacion;

				$values_devengo ="('$codigo_devengo_descuento_planilla', '$descripcion_devengo_descuento_planilla', '$tipo_devengo_descuento_planilla', '$isss_devengo_devengo_descuento_planilla', '$afp_devengo_devengo_descuento_planilla', '$renta_devengo_devengo_descuento_planilla', '$idempleado_devengo', '$valor_devengo_planilla', '$tipo_valor', '$codigo_planilla_devengo'),";

				$insertar_devengo="INSERT INTO `tbl_devengo_descuento_planilla_vacacion`(`codigo_devengo_descuento_planilla`, `descripcion_devengo_descuento_planilla`, `tipo_devengo_descuento_planilla`, `isss_devengo_devengo_descuento_planilla`, `afp_devengo_devengo_descuento_planilla`, `renta_devengo_devengo_descuento_planilla`,`idempleado_devengo`, `valor_devengo_planilla`, `tipo_valor`, `codigo_planilla_devengo`) VALUES  ".trim($values_devengo, ",")."";
				$sql_devengo = Conexion::conectar()->prepare($insertar_devengo);
				$sql_devengo->execute();

			}

			/* ******************** */

			

				/* ***CONSULTAR DEVENGO02***** */
						function consultar_devengo2($idempleado1)
						{
							$query01 = "SELECT * FROM `tbl_empleados` WHERE id='$idempleado1'";
							$sql = Conexion::conectar()->prepare($query01);
							$sql->execute();
							return $sql->fetchAll();
						};
						$data01 = consultar_devengo2($idempleado_planilla);
						$sueldo="";
						foreach ($data01 as $value) {
							$sueldo.=$value["sueldo"];
						}
						$total_devengo=$sueldo*0.30;

						$update="UPDATE `tbl_devengo_descuento_planilla_vacacion` SET `valor_devengo_planilla`='$total_devengo' where idempleado_devengo=$idempleado_planilla and codigo_planilla_devengo=$numero_planilladevengo_vacacion";
						echo $update;
						$sql_up = Conexion::conectar()->prepare($update);
						$sql_up->execute();




			/* ********************** */



		
		}
		/* ************ */

		/* *********************** */
	break;
	
	case "valordevengo_vacacion":

			/* ************************ */
			function consultar($e)
			{
				$query01="SELECT*FROM tbl_devengo_descuento_planilla_vacacion WHERE idempleado_devengo='$e' and descripcion_devengo_descuento_planilla LIKE '%vacacion%'";
	
			
				$sql = Conexion::conectar()->prepare($query01);
				$sql->execute();
				return $sql->fetchAll();
			};
			$data01 = consultar($consultarempleado);
			$valor_devengo_planilla="";

			foreach ($data01 as $value) {
				$valor_devengo_planilla=$value["valor_devengo_planilla"];
			}

			echo $valor_devengo_planilla;
			
			/* ************ */
	break;

	case "correlativoplanilla":
		/* ************ */
		function consultar_situacion2()
		{
			$query01="SELECT*FROM planilladevengo_vacacion ORDER by id DESC
			LIMIT 1";
			
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
			
		};
		$data01 = consultar_situacion2();
		$correlativo_dato="";
		foreach ($data01 as $value) {
		
				$numero = $value["numero_planilladevengo_vacacion"];
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

	
	case "eliminarempleado":
		/* ********************* */
		$numero_planilladevengo_vacacion=$_POST["numero_planilladevengo_vacacion"];
		$id_empleado_planilladevengo_vacacion=$_POST["id_empleado_planilladevengo_vacacion"];
		$query = "DELETE FROM `planilladevengo_vacacion` WHERE numero_planilladevengo_vacacion=$numero_planilladevengo_vacacion and id_empleado_planilladevengo_vacacion=$id_empleado_planilladevengo_vacacion";
		echo $query;
		$stmt = Conexion::conectar()->prepare($query);
		$stmt->execute();

		/* ********************* */

		$query01 = "DELETE FROM `tbl_devengo_descuento_planilla_vacacion` WHERE codigo_planilla_devengo=$numero_planilladevengo_vacacion and idempleado_devengo=$id_empleado_planilladevengo_vacacion";
	
		$stmt01 = Conexion::conectar()->prepare($query01);
		$stmt01->execute();


		/* ****************** */
		/* 		$query = "DELETE FROM `planilladevengo_vacacion` WHERE id_empleado_planilladevengo_vacacion=$idempleado";
		echo $query;
		$stmt = Conexion::conectar()->prepare($query);
		$stmt->execute(); */

		return $stmt->fetchAll();
		$stmt->close();
		$stmt = null;
		/* ********************* */
	break;
	
	case "eliminarplanilla":
		/* ********************* */
		$numero_planilladevengo_vacacion=$_POST["numero_planilladevengo_vacacion"];

		$query = "DELETE FROM `planilladevengo_vacacion` WHERE numero_planilladevengo_vacacion=$numero_planilladevengo_vacacion";
		echo $query;
		$stmt = Conexion::conectar()->prepare($query);
		$stmt->execute();

		/* ********************* */

		$query01 = "DELETE FROM `tbl_devengo_descuento_planilla_vacacion` WHERE codigo_planilla_devengo=$numero_planilladevengo_vacacion ";
	
		$stmt01 = Conexion::conectar()->prepare($query01);
		$stmt01->execute();


		/* ****************** */
		/* 		$query = "DELETE FROM `planilladevengo_vacacion` WHERE id_empleado_planilladevengo_vacacion=$idempleado";
		echo $query;
		$stmt = Conexion::conectar()->prepare($query);
		$stmt->execute(); */

		return $stmt->fetchAll();
		$stmt->close();
		$stmt = null;
		/* ********************* */
	break;

	
	case "calculosglobales":
		
		$numero=$_POST["numero"];
		/* ************ */
		function global_datos($numero)
		{
			$query01="SELECT SUM(total_liquidado_planilladevengo_vacacion) AS total_liquido FROM `planilladevengo_vacacion` where numero_planilladevengo_vacacion='$numero'";
	
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			$outp = $sql->fetchAll();
			echo json_encode($outp);
		};
		$data01 = global_datos($numero);
		$result = [];
		/* ************ */
	break;
	case "totalempleados":
		
		$numero=$_POST["numero"];
		/* ************ */
		function global_datos($numero)
		{
			$query01="SELECT COUNT(*) AS total_empleados FROM `planilladevengo_vacacion` where numero_planilladevengo_vacacion='$numero'";
	
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			$outp = $sql->fetchAll();
			echo json_encode($outp);
		};
		$data01 = global_datos($numero);
		$result = [];
		/* ************ */
	break;
	case "cargardataporempleado":
		
		$numero=$_POST["planilla"];
		/* ************ */
		function global_datos($numero)
		{
			$query01="SELECT * FROM `planilladevengo_vacacion` where numero_planilladevengo_vacacion='$numero'";
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();

			/* echo json_encode($outp); */
		};
		function empleados($id)
		{
			$query01="SELECT * FROM `tbl_empleados` where id=$id";
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};


		$data01 = global_datos($numero);
		$array_resultado = array(); // El array que contendrá los elementos
		foreach ($data01 as $value) {
			$idempleado=$value["id_empleado_planilladevengo_vacacion"];

			$data_emple=empleados($idempleado);
			foreach ($data_emple as $val_emple) {
				
				$fila = array();
				foreach ($val_emple as $columna => $valor) {
					// Utiliza el nombre de la columna como clave en lugar de índice
					$fila[$columna] = $valor;
				}
				// Agrega la fila al array_resultado
				$array_resultado[] = $fila;
			
			}
		}
		echo json_encode($array_resultado);

		/* ************ */
	break;

	default:
		echo $accion."respuesta nula";
}



?>