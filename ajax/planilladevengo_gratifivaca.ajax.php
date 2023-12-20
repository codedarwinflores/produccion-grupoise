

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


$fecha_planilladevengo_gratifivaca="";
if ( isset($_POST["fecha_planilladevengo_gratifivaca"]) ) {
    $fecha_planilladevengo_gratifivaca = $_POST["fecha_planilladevengo_gratifivaca"];
}


$accion="";
if ( isset($_POST["accion01"]) ) {
    $accion = $_POST["accion01"];
}

$codigo_empleado_planilladevengo_gratifivaca="";
if ( isset($_POST["codigo_empleado_planilladevengo_gratifivaca"]) ) {
    	$codigo_empleado_planilladevengo_gratifivaca = $_POST["codigo_empleado_planilladevengo_gratifivaca"];
		/* ********VALIDAR SI VA A AGREGAR O ACTUALIZAR************ */
		function validarempleado($e)
		{
					$query01 = "SELECT count(*) as valor FROM planilladevengo_gratifivaca WHERE codigo_empleado_planilladevengo_gratifivaca='$e' ";
					$sql = Conexion::conectar()->prepare($query01);
					$sql->execute();
					return $sql->fetchAll();
		}
		$existeempleado="";
		$data03 = validarempleado($codigo_empleado_planilladevengo_gratifivaca);
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
	$query = "SHOW COLUMNS FROM planilladevengo_gratifivaca";
	$stmt = Conexion::conectar()->prepare($query);
	$stmt->execute();
	return $stmt->fetchAll();
	$stmt->close();
	$stmt = null;
}

function getContent_insert()
{
	$query = "SHOW COLUMNS FROM planilladevengo_gratifivaca WHERE Field NOT IN ('id')";
	$stmt = Conexion::conectar()->prepare($query);
	$stmt->execute();
	return $stmt->fetchAll();
	$stmt->close();
	$stmt = null;
}


function getContent_devengo_gratifivaca()
{
	$query = "SHOW COLUMNS FROM tbl_devengo_descuento_planilla_gratifivaca";
	$stmt = Conexion::conectar()->prepare($query);
	$stmt->execute();
	return $stmt->fetchAll();
	$stmt->close();
	$stmt = null;
}






switch ($accion) {
	case "lista":

		$tipo_planilladevengo_gratifivaca = $_POST["tipo_planilladevengo_gratifivaca"];
		$periodo_planilladevengo_gratifivaca = $_POST["periodo_planilladevengo_gratifivaca"];
		$numero_planilladevengo_gratifivaca = $_POST["numero_planilladevengo_gratifivaca"];
		$descripcion_planilladevengo_gratifivaca = $_POST["descripcion_planilladevengo_gratifivaca"];
		$gratificacion_vacacion = $_POST["gratificacion_vacacion"];


		
		/* ***CONSULTAR DEVENGO***** */
		function consultar_devengo()
		{
			$query01 = "SELECT `id`, `codigo`, `descripcion`, `porcentaje`, `tipo`, `cargo_abono`, `cuenta_contable`, `isss_devengo`, `afp_devengo`, `renta_devengo` FROM `tbl_devengo_descuento` WHERE id='88'";
		
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};
		$data01 = consultar_devengo();
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


		function consultar($e,$dia1,$dia2)
		{
			/* $query01="SELECT * FROM tbl_empleados 
					  WHERE YEAR(fecha_contratacion)<YEAR(NOW()) and DAY(fecha_contratacion)=DAY(NOW()) AND MONTH(fecha_contratacion)=MONTH(NOW()) AND DAY(fecha_contratacion) BETWEEN '16' AND '31'  and tbl_empleados.fecha_contratacion < '$e'"; */

			/* 			$query01 = "SELECT tbl_empleados.id as idempleado, tbl_empleados.*, tbl_empleados_devengos_descuentos.* , 				tbl_devengo_descuento.* 
						FROM `tbl_empleados` , tbl_empleados_devengos_descuentos,tbl_devengo_descuento WHERE tbl_empleados.id=tbl_empleados_devengos_descuentos.id_empleado and tbl_devengo_descuento.id = tbl_empleados_devengos_descuentos.id_tipo_devengo_descuento and tbl_devengo_descuento.codigo='0022' and tbl_empleados_devengos_descuentos.valor is NOT null  and tbl_empleados.fecha_contratacion < '$e' and YEAR(fecha_contratacion)<YEAR(NOW()) AND  DATE_FORMAT(DATE(NOW()), '%m-%d') >= DATE_FORMAT(tbl_empleados.fecha_contratacion, '%m-%d') AND MONTH(fecha_contratacion)=MONTH(NOW()) AND DAY(fecha_contratacion) BETWEEN '$dia1' AND '$dia2' "; */

		/* 	$query01="SELECT DATE_FORMAT(DATE(NOW()), '%m-%d')as fecha_actual,DATE_FORMAT(tbl_empleados.fecha_contratacion, '%m-%d') as fechacontracion, tbl_empleados.id as idempleado, tbl_empleados.*, tbl_empleados_devengos_descuentos.* , tbl_devengo_descuento.*, tbl_clientes_ubicaciones.id as idubicacion, tbl_clientes_ubicaciones.*
			FROM `tbl_empleados` , tbl_empleados_devengos_descuentos,tbl_devengo_descuento , tbl_clientes_ubicaciones,tbl_ubicaciones_agentes_asignados
			WHERE tbl_empleados.id=tbl_empleados_devengos_descuentos.id_empleado and tbl_devengo_descuento.id = tbl_empleados_devengos_descuentos.id_tipo_devengo_descuento and tbl_devengo_descuento.codigo='0022' and tbl_empleados_devengos_descuentos.valor is NOT null  and tbl_empleados.fecha_contratacion < '$e' and tbl_empleados.codigo_empleado=tbl_ubicaciones_agentes_asignados.codigo_agente and  tbl_ubicaciones_agentes_asignados.idubicacion_agente=tbl_clientes_ubicaciones.id"; */

			/* $query01="SELECT DATE_FORMAT(DATE(NOW()), '%m-%d')as fecha_actual,DATE_FORMAT(tbl_empleados.fecha_contratacion, '%m-%d') as fechacontracion, tbl_empleados.id as idempleado, tbl_empleados.*, tbl_empleados_devengos_descuentos.* , tbl_devengo_descuento.*
			FROM `tbl_empleados` , tbl_empleados_devengos_descuentos,tbl_devengo_descuento
			WHERE tbl_empleados.id=tbl_empleados_devengos_descuentos.id_empleado and tbl_devengo_descuento.id = tbl_empleados_devengos_descuentos.id_tipo_devengo_descuento and tbl_devengo_descuento.codigo='0022' and tbl_empleados_devengos_descuentos.valor is NOT null  and tbl_empleados.fecha_contratacion < '$e'  GROUP by tbl_empleados.id"; */

			/* $query01="SELECT DATE_FORMAT(DATE(NOW()), '%m-%d')as fecha_actual,DATE_FORMAT(tbl_empleados.fecha_contratacion, '%m-%d') as fechacontracion, tbl_empleados.id as idempleado, tbl_empleados.*, tbl_empleados_devengos_descuentos.* , tbl_devengo_descuento.*, MAX(planilladevengo_vacacion.numero_planilladevengo_vacacion)
			FROM `tbl_empleados` , tbl_empleados_devengos_descuentos,tbl_devengo_descuento, planilladevengo_vacacion
			WHERE tbl_empleados.id=tbl_empleados_devengos_descuentos.id_empleado and tbl_devengo_descuento.id = tbl_empleados_devengos_descuentos.id_tipo_devengo_descuento and planilladevengo_vacacion.id_empleado_planilladevengo_vacacion=tbl_empleados.id 
            group by tbl_empleados.id"; */

			$query01="SELECT DATE_FORMAT(DATE(NOW()), '%m-%d')as fecha_actual,DATE_FORMAT(tbl_empleados.fecha_contratacion, '%m-%d') as fechacontracion, tbl_empleados.id as idempleado, tbl_empleados.* , planilladevengo_vacacion.numero_planilladevengo_vacacion
			FROM `tbl_empleados` , planilladevengo_vacacion
			WHERE planilladevengo_vacacion.id_empleado_planilladevengo_vacacion=tbl_empleados.id and planilladevengo_vacacion.numero_planilladevengo_vacacion=(SELECT MAX(planilladevengo_vacacion.numero_planilladevengo_vacacion)from planilladevengo_vacacion) group by tbl_empleados.id";

			/* echo $query01; */
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};
		$newDate = date("Y-m-d", strtotime($fecha_planilladevengo_gratifivaca));
		$fechaperiodo1_total = date("Y-m-d", strtotime($_POST["fechaperiodo1"]));
		$fechaperiodo2_total= date("Y-m-d", strtotime($_POST["fechaperiodo2"]));
		$fechaperiodo1 = date("d",strtotime($_POST["fechaperiodo1"]));
		$fechaperiodo2 = date("d",strtotime($_POST["fechaperiodo2"]));
		$data01 = consultar($newDate,$fechaperiodo1,$fechaperiodo2);
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

		
		/* ********* PORCENTAJES DE ISSS, AFP, RENTA************* */

		

			
			/* ************************ */
			function afp($e)
						{
							$query01="SELECT*FROM afp WHERE codigo='$e'";
							$sql = Conexion::conectar()->prepare($query01);
							$sql->execute();
							return $sql->fetchAll();
						};
						
			/* ************************ */
			/* ************************ */
			function configuracion()
			{
				$query01="SELECT*FROM configuracion";
				$sql = Conexion::conectar()->prepare($query01);
				$sql->execute();
				return $sql->fetchAll();
			};
			/* ************************* */
			/* ************************ */
				function isr($salario,$periodo)
				{
					$query01="SELECT isr.id as idisr, `codigo`, `nombre_rango`, `periodo_pago`, `salario_desde`, `salario_hasta`, `base_1`, `tasa_sobre_excedente`, `base_2`, periodo_de_pago.id as idperiodo 
							FROM `isr`, periodo_de_pago 
							WHERE isr.periodo_pago=periodo_de_pago.id and nombre_periodo='$periodo' and '$salario'>=salario_desde and '$salario'<=salario_hasta";
					$sql = Conexion::conectar()->prepare($query01);
					$sql->execute();
					return $sql->fetchAll();
				};
				
				/* ************************* */

			/* echo $porcentaje_isss.",".$porcentaje_afp.",".$porcentaje_base1.",".$porcentaje_base2.",".$tasa_sobre_excedente; */
			
			/* ************ */


		/* ******************************************************** */


		foreach ($data01 as $value) {



			$idempleado=$value["idempleado"];
			
			/* *********************************** */
				$tipo_afp=$value["codigo_afp"];
				$periodo_pago=$value["periodo_pago"];
				
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
			/* *********************************** */

			$data013 = afp($tipo_afp);
			$porcentaje_afp="";
			foreach ($data013 as $value3) {
							$porcentaje_afp=$value3["porcentaje"];
			}
			/* *************************************** */
			$data014 = configuracion();
			$porcentaje_isss="";
			foreach ($data014 as $value4) {
				$porcentaje_isss=$value4["porcentaje_isss"];
			}

			/* ************************************** */

			$calculo_sujeto_renta=$gratificacion_vacacion-$porcentaje_isss-$porcentaje_afp;


				$data015 = isr($gratificacion_vacacion,$periodo_pago);
				$porcentaje_base1="";
				$porcentaje_base2="";
				$tasa_sobre_excedente="";

				foreach ($data015 as $value5) {
					$porcentaje_base1=$value5["base_1"];
					$porcentaje_base2=$value5["base_2"];
					$tasa_sobre_excedente=$value5["tasa_sobre_excedente"];

				}

			$convertir_afp=$porcentaje_afp/100;
			$convertir_isss=$porcentaje_isss/100;


			$calculo_base2=$gratificacion_vacacion-$porcentaje_base2;
			$porcentaje_tasa=$tasa_sobre_excedente/100;
			$tasa_por_exedente=$calculo_base2*$porcentaje_tasa;

			$descuento_renta=$tasa_por_exedente+$porcentaje_base1;/* ---descuento_renta */
			$calculo_isss=$gratificacion_vacacion*$convertir_isss; /* ---decuento isss */
			$calculo_afp=$gratificacion_vacacion*$convertir_afp; /* ---decuento isss */
			$total_liquido=$gratificacion_vacacion-$descuento_renta-$calculo_isss-$calculo_afp;/* --total liquido */


			
			/* ************* GUARDAR EMPLEADO EN PLANILLA ***************** */

			$numero_planilladevengo_gratifivaca=$numero_planilladevengo_gratifivaca;
			$fecha_planilladevengo_gratifivaca=$newDate;
			$fecha_desde_planilladevengo_gratifivaca=$fechaperiodo1_total;
			$fecha_hasta_planilladevengo_gratifivaca=$fechaperiodo2_total;
			$descripcion_planilladevengo_gratifivaca=$descripcion_planilladevengo_gratifivaca;
			$codigo_empleado_planilladevengo_gratifivaca=$value["codigo_empleado"];
			$nombre_empleado_planilladevengo_gratifivaca=$value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"];
			$id_empleado_planilladevengo_gratifivaca=$value["idempleado"];
			$sueldo_planilladevengo_gratifivaca="0";
			$sueldo="0";
			/* $devengo=$value["valor"]; */

			/* $totaldevengo=$gratificacion_vacacion; */

			$total_devengo_gratifivaca_planilladevengo_gratifivaca=number_format($gratificacion_vacacion, 2, '.', '');
			
			$descuento_isss_planilladevengo_gratifivaca=$calculo_isss;
			$descuento_afp_planilladevengo_gratifivaca=$calculo_afp;
			$descuento_renta_planilladevengo_gratifivaca=$descuento_renta;

			$total_liquidado_planilladevengo_gratifivaca=number_format($total_liquido, 2, '.', '');

			$total_sujeto_renta=$gratificacion_vacacion-$calculo_isss-$calculo_afp;

			$sueldo_renta_planilladevengo_gratifivaca=number_format($total_sujeto_renta, 2, '.', '');
			$sujeto_isss="";
			if($gratificacion_vacacion>="500"){
				$sujeto_isss="500";
			}
			else{
				$sujeto_isss=$gratificacion_vacacion;
			}
			$sueldo_isss_planilladevengo_gratifivaca=$sujeto_isss;
			$sueldo_afp_planilladevengo_gratifivaca=$gratificacion_vacacion;

			$codigo_ubicacion_planilladevengo_gratifivaca="";
			$nombre_ubicacion_planilladevengo_gratifivaca="";
			$id_ubicacion_planilladevengo_gratifivaca="";
			$periodo_planilladevengo_gratifivaca=$periodo_planilladevengo_gratifivaca;
			$tipo_planilladevengo_gratifivaca=$tipo_planilladevengo_gratifivaca;
			$empleado_rango_desde=$empleado_rango_desde;
			$empleado_rango_hasta=$empleado_rango_hasta;

			$values_consulta.="('$numero_planilladevengo_gratifivaca','$fecha_planilladevengo_gratifivaca','$fecha_desde_planilladevengo_gratifivaca','$fecha_hasta_planilladevengo_gratifivaca','$descripcion_planilladevengo_gratifivaca','$codigo_empleado_planilladevengo_gratifivaca','$nombre_empleado_planilladevengo_gratifivaca','$id_empleado_planilladevengo_gratifivaca','$sueldo_planilladevengo_gratifivaca','$total_devengo_gratifivaca_planilladevengo_gratifivaca', '$descuento_isss_planilladevengo_gratifivaca','$descuento_afp_planilladevengo_gratifivaca','$descuento_renta_planilladevengo_gratifivaca','$total_liquidado_planilladevengo_gratifivaca','$sueldo_renta_planilladevengo_gratifivaca','$sueldo_isss_planilladevengo_gratifivaca','$sueldo_afp_planilladevengo_gratifivaca','$codigo_ubicacion_planilladevengo_gratifivaca','$nombre_ubicacion_planilladevengo_gratifivaca','$id_ubicacion_planilladevengo_gratifivaca','$periodo_planilladevengo_gratifivaca','$tipo_planilladevengo_gratifivaca','$empleado_rango_desde','$empleado_rango_hasta'),";

			/* ************************************** */


			/* **********GUARDAR DEVENGO*********** */
				/* $id_tipo_devengo_descuento=$value["id_tipo_devengo_descuento"]; */
				$codigo_devengo_descuento_planilla=$codigo_devengo;
				$descripcion_devengo_descuento_planilla=$descipcion_devengo;
				$tipo_devengo_descuento_planilla=$id_devengo;
				$isss_devengo_devengo_descuento_planilla=$isss_devengo;
				$afp_devengo_devengo_descuento_planilla=$afp_devengo;
				$renta_devengo_devengo_descuento_planilla=$renta_devengo;
				$idempleado_devengo=$value["idempleado"];
				$valor_devengo_planilla=number_format($gratificacion_vacacion, 2, '.', '');
				$tipo_valor="Suma";
				$codigo_planilla_devengo=$numero_planilladevengo_gratifivaca;

				$values_devengo.="('$codigo_devengo_descuento_planilla', '$descripcion_devengo_descuento_planilla', '$tipo_devengo_descuento_planilla', '$isss_devengo_devengo_descuento_planilla', '$afp_devengo_devengo_descuento_planilla', '$renta_devengo_devengo_descuento_planilla', '$idempleado_devengo', '$valor_devengo_planilla', '$tipo_valor', '$codigo_planilla_devengo'),";
			/* *********************************** */



			$datos_html .= ' <tr class="btnEditarabase" hora_extra_nocturna_domingo="'.$value["hora_extra_nocturna_domingo"].'"   hora_extra_domingo="'.$value["hora_extra_domingo"].'"  hora_extra_nocturna="'.$value["hora_extra_nocturna"].'" hora_extra_diurna="'.$value["hora_extra_diurna"].'"   salario_por_hora="'.$value["salario_por_hora"].'"  sueldo="'.$value["sueldo"].'"  idempleado="'.$value["idempleado"].'" codigo="'.$value["codigo_empleado"].'"  nombre="'.$value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"].'">
			<td>'.$value["codigo_empleado"].'</td>
			<td>'.$value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"].' </td>';
			$datos_html .='<td><div class="btn btn-danger eliminarempleado" numero_planilla="'.$numero_planilladevengo_gratifivaca.'" idempleado="'.$value["idempleado"].'"><i class="fa fa-times"></i></div></td>';
			$datos_html .= '</tr>';
		}
		$datos_html .= '</tbody></table>';
		/* echo trim($values_consulta, ","); */

		/* echo $datos_html; */
		function consultar_planilla($numero_planilladevengo_gratifivaca1)
			{
				$query01="SELECT `id`, `numero_planilladevengo_gratifivaca`, `fecha_planilladevengo_gratifivaca`, `fecha_desde_planilladevengo_gratifivaca`, `fecha_hasta_planilladevengo_gratifivaca`, `descripcion_planilladevengo_gratifivaca`, `codigo_empleado_planilladevengo_gratifivaca`, `nombre_empleado_planilladevengo_gratifivaca`, `id_empleado_planilladevengo_gratifivaca`, `dias_trabajo_planilladevengo_gratifivaca`, `sueldo_planilladevengo_gratifivaca`, `hora_extra_diurna_planilladevengo_gratifivaca`, `hora_extra_nocturna_planilladevengo_gratifivaca`, `hora_extra_domingo_planilladevengo_gratifivaca`, `hora_extra_domingo_nocturna_planilladevengo_gratifivaca`, `otro_devengo_gratifivaca_planilladevengo_gratifivaca`, `total_devengo_gratifivaca_planilladevengo_gratifivaca`, `descuento_isss_planilladevengo_gratifivaca`, `descuento_afp_planilladevengo_gratifivaca`, `descuento_renta_planilladevengo_gratifivaca`, `otro_descuento_planilladevengo_gratifivaca`, `total_descuento_planilladevengo_gratifivaca`, `total_liquidado_planilladevengo_gratifivaca`, `sueldo_renta_planilladevengo_gratifivaca`, `sueldo_isss_planilladevengo_gratifivaca`, `sueldo_afp_planilladevengo_gratifivaca`, `departamento_planilladevengo_gratifivaca`, `codigo_ubicacion_planilladevengo_gratifivaca`, `nombre_ubicacion_planilladevengo_gratifivaca`, `id_ubicacion_planilladevengo_gratifivaca`, `observacion_planilladevengo_gratifivaca`, `periodo_planilladevengo_gratifivaca`, `tipo_planilladevengo_gratifivaca`, `dias_incapacidad`, `empleado_rango_desde`, `empleado_rango_hasta`, COUNT(*) as registro FROM `planilladevengo_gratifivaca` WHERE numero_planilladevengo_gratifivaca='$numero_planilladevengo_gratifivaca1'";
				$sql = Conexion::conectar()->prepare($query01);
				$sql->execute();
				return $sql->fetchAll();
			};
		$data_planilla = consultar_planilla($numero_planilladevengo_gratifivaca);
		$registro="";
		foreach ($data_planilla as $value) {
			$registro.=$value["registro"];
		}

		if($registro == 0){


			
			$insertar_devengo="INSERT INTO `tbl_devengo_descuento_planilla_gratifivaca`(`codigo_devengo_descuento_planilla`, `descripcion_devengo_descuento_planilla`, `tipo_devengo_descuento_planilla`, `isss_devengo_devengo_descuento_planilla`, `afp_devengo_devengo_descuento_planilla`, `renta_devengo_devengo_descuento_planilla`,`idempleado_devengo`, `valor_devengo_planilla`, `tipo_valor`, `codigo_planilla_devengo`) VALUES  ".trim($values_devengo, ",")."";
			$sql_devengo = Conexion::conectar()->prepare($insertar_devengo);
			$sql_devengo->execute();


			$insertar="INSERT INTO `planilladevengo_gratifivaca`(`numero_planilladevengo_gratifivaca`, `fecha_planilladevengo_gratifivaca`, `fecha_desde_planilladevengo_gratifivaca`, `fecha_hasta_planilladevengo_gratifivaca`, `descripcion_planilladevengo_gratifivaca`, `codigo_empleado_planilladevengo_gratifivaca`, `nombre_empleado_planilladevengo_gratifivaca`, `id_empleado_planilladevengo_gratifivaca`, `sueldo_planilladevengo_gratifivaca`,  `total_devengo_gratifivaca_planilladevengo_gratifivaca`, descuento_isss_planilladevengo_gratifivaca,descuento_afp_planilladevengo_gratifivaca,descuento_renta_planilladevengo_gratifivaca,`total_liquidado_planilladevengo_gratifivaca`,sueldo_renta_planilladevengo_gratifivaca,sueldo_isss_planilladevengo_gratifivaca,sueldo_afp_planilladevengo_gratifivaca, `codigo_ubicacion_planilladevengo_gratifivaca`, `nombre_ubicacion_planilladevengo_gratifivaca`, `id_ubicacion_planilladevengo_gratifivaca`, `periodo_planilladevengo_gratifivaca`, `tipo_planilladevengo_gratifivaca`, `empleado_rango_desde`, `empleado_rango_hasta`) value ".trim($values_consulta, ",")."";
			$sql = Conexion::conectar()->prepare($insertar);
			if ($sql->execute()) {

				$data_planilla = consultar_planilla($numero_planilladevengo_gratifivaca);
				$id="";
				foreach ($data_planilla as $value) {
					$id.=$value["id"];
					
				}
				echo $numero_planilladevengo_gratifivaca;
				/* echo "OK"; */
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

		$tipo_planilladevengo_gratifivaca = $_POST["tipo_planilladevengo_gratifivaca"];
		$periodo_planilladevengo_gratifivaca = $_POST["periodo_planilladevengo_gratifivaca"];
		$numero_planilladevengo_gratifivaca = $_POST["numero_planilladevengo_gratifivaca"];
		$descripcion_planilladevengo_gratifivaca = $_POST["descripcion_planilladevengo_gratifivaca"];
		function consultar($e,$dia1,$dia2,$empleado_rango_desde1,$empleado_rango_hasta1)
		{
			/* $query01="SELECT * FROM tbl_empleados 
					  WHERE YEAR(fecha_contratacion)<YEAR(NOW()) and DAY(fecha_contratacion)=DAY(NOW()) AND MONTH(fecha_contratacion)=MONTH(NOW()) AND DAY(fecha_contratacion) BETWEEN '16' AND '31'  and tbl_empleados.fecha_contratacion < '$e'"; */

			/* 			$query01 = "SELECT tbl_empleados.id as idempleado, tbl_empleados.*, tbl_empleados_devengos_descuentos.* , 				tbl_devengo_descuento.* 
						FROM `tbl_empleados` , tbl_empleados_devengos_descuentos,tbl_devengo_descuento WHERE tbl_empleados.id=tbl_empleados_devengos_descuentos.id_empleado and tbl_devengo_descuento.id = tbl_empleados_devengos_descuentos.id_tipo_devengo_descuento and tbl_devengo_descuento.codigo='0022' and tbl_empleados_devengos_descuentos.valor is NOT null  and tbl_empleados.fecha_contratacion < '$e' and YEAR(fecha_contratacion)<YEAR(NOW()) AND  DATE_FORMAT(DATE(NOW()), '%m-%d') >= DATE_FORMAT(tbl_empleados.fecha_contratacion, '%m-%d') AND MONTH(fecha_contratacion)=MONTH(NOW()) AND DAY(fecha_contratacion) BETWEEN '$dia1' AND '$dia2' "; */

			/* $query01="SELECT DATE_FORMAT(DATE(NOW()), '%m-%d')as fecha_actual,DATE_FORMAT(tbl_empleados.fecha_contratacion, '%m-%d') as fechacontracion, tbl_empleados.id as idempleado, tbl_empleados.*, tbl_empleados_devengos_descuentos.* , tbl_devengo_descuento.*
			FROM `tbl_empleados` , tbl_empleados_devengos_descuentos,tbl_devengo_descuento 
			WHERE tbl_empleados.id=tbl_empleados_devengos_descuentos.id_empleado and tbl_devengo_descuento.id = tbl_empleados_devengos_descuentos.id_tipo_devengo_descuento and tbl_devengo_descuento.codigo='0022' and tbl_empleados_devengos_descuentos.valor is NOT null    and tbl_empleados.id >= '$empleado_rango_desde1' and tbl_empleados.id <= '$empleado_rango_hasta1' GROUP by tbl_empleados.id"; */


			$query01="SELECT DATE_FORMAT(DATE(NOW()), '%m-%d')as fecha_actual,DATE_FORMAT(tbl_empleados.fecha_contratacion, '%m-%d') as fechacontracion, tbl_empleados.id as idempleado, tbl_empleados.* , planilladevengo_vacacion.numero_planilladevengo_vacacion
			FROM `tbl_empleados` , planilladevengo_vacacion
			WHERE planilladevengo_vacacion.id_empleado_planilladevengo_vacacion=tbl_empleados.id and planilladevengo_vacacion.numero_planilladevengo_vacacion=(SELECT MAX(planilladevengo_vacacion.numero_planilladevengo_vacacion)from planilladevengo_vacacion)  and tbl_empleados.id >= '$empleado_rango_desde1' and tbl_empleados.id <= '$empleado_rango_hasta1' GROUP by tbl_empleados.id";

			/* echo $query01; */
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};
		$newDate = date("Y-m-d", strtotime($fecha_planilladevengo_gratifivaca));
		$fechaperiodo1_total = date("Y-m-d", strtotime($_POST["fechaperiodo1"]));
		$fechaperiodo2_total= date("Y-m-d", strtotime($_POST["fechaperiodo2"]));
		$fechaperiodo1 = date("d",strtotime($_POST["fechaperiodo1"]));
		$fechaperiodo2 = date("d",strtotime($_POST["fechaperiodo2"]));
		$data01 = consultar($newDate,$fechaperiodo1,$fechaperiodo2,$empleado_rango_desde,$empleado_rango_hasta);
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

			$numero_planilladevengo_gratifivaca=$numero_planilladevengo_gratifivaca;
			$fecha_planilladevengo_gratifivaca=$newDate;
			$fecha_desde_planilladevengo_gratifivaca=$fechaperiodo1_total;
			$fecha_hasta_planilladevengo_gratifivaca=$fechaperiodo2_total;
			$descripcion_planilladevengo_gratifivaca=$descripcion_planilladevengo_gratifivaca;
			$codigo_empleado_planilladevengo_gratifivaca=$value["codigo_empleado"];
			$nombre_empleado_planilladevengo_gratifivaca=$value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"];
			$id_empleado_planilladevengo_gratifivaca=$value["idempleado"];
			$sueldo_planilladevengo_gratifivaca="0";
			$sueldo="0";
			$devengo=$value["valor"];
			$totaldevengo=$sueldo+$devengo;
			$total_devengo_gratifivaca_planilladevengo_gratifivaca=$totaldevengo;
			$total_liquidado_planilladevengo_gratifivaca=$totaldevengo;
			$codigo_ubicacion_planilladevengo_gratifivaca="";
			$nombre_ubicacion_planilladevengo_gratifivaca="";
			$id_ubicacion_planilladevengo_gratifivaca="";
			$periodo_planilladevengo_gratifivaca=$periodo_planilladevengo_gratifivaca;
			$tipo_planilladevengo_gratifivaca=$tipo_planilladevengo_gratifivaca;
			$empleado_rango_desde=$empleado_rango_desde;
			$empleado_rango_hasta=$empleado_rango_hasta;

			$values_consulta.="('$numero_planilladevengo_gratifivaca','$fecha_planilladevengo_gratifivaca','$fecha_desde_planilladevengo_gratifivaca','$fecha_hasta_planilladevengo_gratifivaca','$descripcion_planilladevengo_gratifivaca','$codigo_empleado_planilladevengo_gratifivaca','$nombre_empleado_planilladevengo_gratifivaca','$id_empleado_planilladevengo_gratifivaca','$sueldo_planilladevengo_gratifivaca','$total_devengo_gratifivaca_planilladevengo_gratifivaca','$total_liquidado_planilladevengo_gratifivaca','$codigo_ubicacion_planilladevengo_gratifivaca','$nombre_ubicacion_planilladevengo_gratifivaca','$id_ubicacion_planilladevengo_gratifivaca','$periodo_planilladevengo_gratifivaca','$tipo_planilladevengo_gratifivaca','$empleado_rango_desde','$empleado_rango_hasta'),";

			$datos_html .= ' <tr class="btnEditarabase" hora_extra_nocturna_domingo="'.$value["hora_extra_nocturna_domingo"].'"   hora_extra_domingo="'.$value["hora_extra_domingo"].'"  hora_extra_nocturna="'.$value["hora_extra_nocturna"].'" hora_extra_diurna="'.$value["hora_extra_diurna"].'"    salario_por_hora="'.$value["salario_por_hora"].'"  sueldo="'.$value["sueldo"].'"  idempleado="'.$value["idempleado"].'" codigo="'.$value["codigo_empleado"].'"  nombre="'.$value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"].'">
			<td>'.$value["codigo_empleado"].'</td>
			<td>'.$value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"].' </td>';
			$datos_html .='<td><div class="btn btn-danger eliminarempleado" numero_planilla="'.$numero_planilladevengo_gratifivaca.'" idempleado="'.$value["idempleado"].'"><i class="fa fa-times"></i></div></td>';
			$datos_html .= '</tr>';

		}
		$datos_html .= '</tbody></table>';
		/* echo trim($values_consulta, ","); */


		/* echo $datos_html; */
		function consultar_planilla($numero_planilladevengo_gratifivaca1)
			{
			
				$query01="SELECT `id`, `numero_planilladevengo_gratifivaca`, `fecha_planilladevengo_gratifivaca`, `fecha_desde_planilladevengo_gratifivaca`, `fecha_hasta_planilladevengo_gratifivaca`, `descripcion_planilladevengo_gratifivaca`, `codigo_empleado_planilladevengo_gratifivaca`, `nombre_empleado_planilladevengo_gratifivaca`, `id_empleado_planilladevengo_gratifivaca`, `dias_trabajo_planilladevengo_gratifivaca`, `sueldo_planilladevengo_gratifivaca`, `hora_extra_diurna_planilladevengo_gratifivaca`, `hora_extra_nocturna_planilladevengo_gratifivaca`, `hora_extra_domingo_planilladevengo_gratifivaca`, `hora_extra_domingo_nocturna_planilladevengo_gratifivaca`, `otro_devengo_gratifivaca_planilladevengo_gratifivaca`, `total_devengo_gratifivaca_planilladevengo_gratifivaca`, `descuento_isss_planilladevengo_gratifivaca`, `descuento_afp_planilladevengo_gratifivaca`, `descuento_renta_planilladevengo_gratifivaca`, `otro_descuento_planilladevengo_gratifivaca`, `total_descuento_planilladevengo_gratifivaca`, `total_liquidado_planilladevengo_gratifivaca`, `sueldo_renta_planilladevengo_gratifivaca`, `sueldo_isss_planilladevengo_gratifivaca`, `sueldo_afp_planilladevengo_gratifivaca`, `departamento_planilladevengo_gratifivaca`, `codigo_ubicacion_planilladevengo_gratifivaca`, `nombre_ubicacion_planilladevengo_gratifivaca`, `id_ubicacion_planilladevengo_gratifivaca`, `observacion_planilladevengo_gratifivaca`, `periodo_planilladevengo_gratifivaca`, `tipo_planilladevengo_gratifivaca`, `dias_incapacidad`, `empleado_rango_desde`, `empleado_rango_hasta`, COUNT(*) as registro FROM `planilladevengo_gratifivaca` WHERE numero_planilladevengo_gratifivaca='$numero_planilladevengo_gratifivaca1'";
				$sql = Conexion::conectar()->prepare($query01);
				$sql->execute();
				return $sql->fetchAll();
			};
		$data_planilla = consultar_planilla($numero_planilladevengo_gratifivaca);
		$registro="";
		foreach ($data_planilla as $value) {
			$registro.=$value["registro"];
		}
		if($registro == 0){
			$insertar="INSERT INTO `planilladevengo_gratifivaca`(`numero_planilladevengo_gratifivaca`, `fecha_planilladevengo_gratifivaca`, `fecha_desde_planilladevengo_gratifivaca`, `fecha_hasta_planilladevengo_gratifivaca`, `descripcion_planilladevengo_gratifivaca`, `codigo_empleado_planilladevengo_gratifivaca`, `nombre_empleado_planilladevengo_gratifivaca`, `id_empleado_planilladevengo_gratifivaca`, `sueldo_planilladevengo_gratifivaca`,  `total_devengo_gratifivaca_planilladevengo_gratifivaca`, `total_liquidado_planilladevengo_gratifivaca`, `codigo_ubicacion_planilladevengo_gratifivaca`, `nombre_ubicacion_planilladevengo_gratifivaca`, `id_ubicacion_planilladevengo_gratifivaca`, `periodo_planilladevengo_gratifivaca`, `tipo_planilladevengo_gratifivaca`, `empleado_rango_desde`, `empleado_rango_hasta`) value ".trim($values_consulta, ",")."";
			$sql = Conexion::conectar()->prepare($insertar);
			if ($sql->execute()) {
				/* echo "OK"; */
				echo $numero_planilladevengo_gratifivaca;
			} else {
				/* echo "error"; */
			}
			$sql = null;
		}
		else{
		/* 	echo $datos_html; */
		}
	break;
	case "empleadosguardados":
		
		$tipo_planilladevengo_gratifivaca = $_POST["tipo_planilladevengo_gratifivaca"];
		$periodo_planilladevengo_gratifivaca = $_POST["periodo_planilladevengo_gratifivaca"];
		$numero_planilladevengo_gratifivaca = $_POST["numero_planilladevengo_gratifivaca"];
		$descripcion_planilladevengo_gratifivaca = $_POST["descripcion_planilladevengo_gratifivaca"];
		function consultar($e,$dia1,$dia2,$numero_planilladevengo_gratifivaca1)
		{

		/* 			$query01="SELECT  tbl_empleados.id as idempleado, tbl_empleados.*, tbl_empleados_devengos_descuentos.* , tbl_devengo_descuento.*
			FROM `tbl_empleados` , tbl_empleados_devengos_descuentos,tbl_devengo_descuento, planilladevengo_gratifivaca
			WHERE tbl_empleados.id=tbl_empleados_devengos_descuentos.id_empleado and tbl_devengo_descuento.id = tbl_empleados_devengos_descuentos.id_tipo_devengo_descuento and planilladevengo_gratifivaca.id_empleado_planilladevengo_gratifivaca=tbl_empleados.id and planilladevengo_gratifivaca.numero_planilladevengo_gratifivaca=$numero_planilladevengo_gratifivaca1 group by tbl_empleados.id"; */

			$query01="SELECT  tbl_empleados.id as idempleado, tbl_empleados.*
			FROM `tbl_empleados` , planilladevengo_gratifivaca
			WHERE  planilladevengo_gratifivaca.id_empleado_planilladevengo_gratifivaca=tbl_empleados.id and planilladevengo_gratifivaca.numero_planilladevengo_gratifivaca=$numero_planilladevengo_gratifivaca1 group by tbl_empleados.id";

			
		

			/* echo $query01; */
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};
		$newDate = date("Y-m-d", strtotime($fecha_planilladevengo_gratifivaca));
		$fechaperiodo1_total = date("Y-m-d", strtotime($_POST["fechaperiodo1"]));
		$fechaperiodo2_total= date("Y-m-d", strtotime($_POST["fechaperiodo2"]));
		$fechaperiodo1 = date("d",strtotime($_POST["fechaperiodo1"]));
		$fechaperiodo2 = date("d",strtotime($_POST["fechaperiodo2"]));
		$data01 = consultar($newDate,$fechaperiodo1,$fechaperiodo2,$numero_planilladevengo_gratifivaca);
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

			
			$datos_html .= ' <tr class="btnEditarabase" hora_extra_nocturna_domingo="'.$value["hora_extra_nocturna_domingo"].'"   hora_extra_domingo="'.$value["hora_extra_domingo"].'"  hora_extra_nocturna="'.$value["hora_extra_nocturna"].'" hora_extra_diurna="'.$value["hora_extra_diurna"].'"   sueldo_diario="'.$value["sueldo_diario"].'"  fecha_contratacion="'.$value["fecha_contratacion"].'"  salario_por_hora="'.$value["salario_por_hora"].'"  sueldo="'.$value["sueldo"].'"  idempleado="'.$value["idempleado"].'" codigo="'.$value["codigo_empleado"].'"  nombre="'.$value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"].'">
			<td>'.$value["codigo_empleado"].'</td>
			<td>'.$value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"].' </td>';
			$datos_html .='<td><div class="btn btn-danger eliminarempleado" numero_planilla="'.$numero_planilladevengo_gratifivaca.'" idempleado="'.$value["idempleado"].'"><i class="fa fa-times"></i></div></td>';
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
		$stmt = Conexion::conectar()->prepare("INSERT INTO planilladevengo_gratifivaca(" . trim($namecolumnas_situacion, ",") . ") VALUES (" . trim($namecampos_situacion, ",") . ")");

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

		$codigo_empleado_planilladevengo_gratifivaca = $_POST["codigo_empleado_planilladevengo_gratifivaca"];
		$numero_planilladevengo_gratifivaca = $_POST["numero_planilladevengo_gratifivaca"];

		function validarempleado01($e,$numero_planilladevengo_gratifivaca1)
		{
					$query01 = "SELECT * FROM planilladevengo_gratifivaca WHERE codigo_empleado_planilladevengo_gratifivaca='$e' and numero_planilladevengo_gratifivaca=$numero_planilladevengo_gratifivaca1 ";
					$sql = Conexion::conectar()->prepare($query01);
					$sql->execute();
					return $sql->fetchAll();
		}
		$existeempleado="";
		$data03 = validarempleado01($codigo_empleado_planilladevengo_gratifivaca,$numero_planilladevengo_gratifivaca);
		foreach ($data03 as $value) {
		$existeempleado.=$value["id"];
		}


		$query01 = "UPDATE planilladevengo_gratifivaca SET " . trim($test, ",") . " WHERE id LIKE $existeempleado and numero_planilladevengo_gratifivaca=$numero_planilladevengo_gratifivaca";
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
		/* 	$query01 = "SELECT * FROM `planilladevengo_gratifivaca`  WHERE codigo_empleado_planilladevengo_gratifivaca='$e'"; */
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
					$result['numero_planilladevengo_gratifivaca'] = $value['numero_planilladevengo_gratifivaca'];
					$result['fecha_planilladevengo_gratifivaca'] = $value['fecha_planilladevengo_gratifivaca'];
					$result['fecha_desde_planilladevengo_gratifivaca'] = $value['fecha_desde_planilladevengo_gratifivaca'];
					$result['fecha_hasta_planilladevengo_gratifivaca'] = $value['fecha_hasta_planilladevengo_gratifivaca'];
					$result['descripcion_planilladevengo_gratifivaca'] = $value['descripcion_planilladevengo_gratifivaca'];
					$result['codigo_empleado_planilladevengo_gratifivaca'] = $value['codigo_empleado_planilladevengo_gratifivaca'];
					$result['nombre_empleado_planilladevengo_gratifivaca'] = $value['nombre_empleado_planilladevengo_gratifivaca'];
					$result['id_empleado_planilladevengo_gratifivaca'] = $value['id_empleado_planilladevengo_gratifivaca'];
					$result['dias_trabajo_planilladevengo_gratifivaca'] = $value['dias_trabajo_planilladevengo_gratifivaca'];
					$result['sueldo_planilladevengo_gratifivaca'] = $value['sueldo_planilladevengo_gratifivaca'];
					$result['hora_extra_diurna_planilladevengo_gratifivaca'] = $value['hora_extra_diurna_planilladevengo_gratifivaca'];
					$result['hora_extra_nocturna_planilladevengo_gratifivaca'] = $value['hora_extra_nocturna_planilladevengo_gratifivaca'];
					$result['hora_extra_domingo_planilladevengo_gratifivaca'] = $value['hora_extra_domingo_planilladevengo_gratifivaca'];
					$result['hora_extra_domingo_nocturna_planilladevengo_gratifivaca'] = $value['hora_extra_domingo_nocturna_planilladevengo_gratifivaca'];
					$result['otro_devengo_gratifivaca_planilladevengo_gratifivaca'] = $value['otro_devengo_gratifivaca_planilladevengo_gratifivaca'];
					$result['total_devengo_gratifivaca_planilladevengo_gratifivaca'] = $value['total_devengo_gratifivaca_planilladevengo_gratifivaca'];
					$result['descuento_isss_planilladevengo_gratifivaca	'] = $value['descuento_isss_planilladevengo_gratifivaca	'];
					$result['descuento_afp_planilladevengo_gratifivaca'] = $value['descuento_afp_planilladevengo_gratifivaca'];
					$result['descuento_renta_planilladevengo_gratifivaca'] = $value['descuento_renta_planilladevengo_gratifivaca'];
					$result['otro_descuento_planilladevengo_gratifivaca'] = $value['otro_descuento_planilladevengo_gratifivaca'];
					$result['total_descuento_planilladevengo_gratifivaca'] = $value['total_descuento_planilladevengo_gratifivaca'];
					$result['total_liquidado_planilladevengo_gratifivaca'] = $value['total_liquidado_planilladevengo_gratifivaca'];
					$result['sueldo_renta_planilladevengo_gratifivaca'] = $value['sueldo_renta_planilladevengo_gratifivaca'];
					$result['sueldo_isss_planilladevengo_gratifivaca'] = $value['sueldo_isss_planilladevengo_gratifivaca'];
					$result['sueldo_afp_planilladevengo_gratifivaca'] = $value['sueldo_afp_planilladevengo_gratifivaca'];
					$result['departamento_planilladevengo_gratifivaca'] = $value['departamento_planilladevengo_gratifivaca'];
					$result['codigo_ubicacion_planilladevengo_gratifivaca'] = $value['codigo_ubicacion_planilladevengo_gratifivaca'];
					$result['nombre_ubicacion_planilladevengo_gratifivaca'] = $value['nombre_ubicacion_planilladevengo_gratifivaca'];
					$result['id_ubicacion_planilladevengo_gratifivaca'] = $value['id_ubicacion_planilladevengo_gratifivaca'];
					$result['observacion_planilladevengo_gratifivaca'] = $value['observacion_planilladevengo_gratifivaca'];
					$result['periodo_planilladevengo_gratifivaca'] = $value['periodo_planilladevengo_gratifivaca'];
					$result['tipo_planilladevengo_gratifivaca'] = $value['tipo_planilladevengo_gratifivaca'];
					$result['dias_incapacidad'] = $value['dias_incapacidad'];

				} */

				/* echo json_encode($result); */

		
			/* ************ */
	break;
	case "obtenerdatatotal":
		/* ************ */

		$numero_planilladevengo_gratifivaca=$_POST["numero_planilladevengo_gratifivaca"];
		function consultar_situacion2($e,$numero_planilladevengo_gratifivaca1)
		{
		/* 	$query01 = "SELECT * FROM `planilladevengo_gratifivaca`  WHERE codigo_empleado_planilladevengo_gratifivaca='$e'"; */
		$query01="SELECT `id`, `numero_planilladevengo_gratifivaca`, `fecha_planilladevengo_gratifivaca`, `fecha_desde_planilladevengo_gratifivaca`, `fecha_hasta_planilladevengo_gratifivaca`, `descripcion_planilladevengo_gratifivaca`, `codigo_empleado_planilladevengo_gratifivaca`, `nombre_empleado_planilladevengo_gratifivaca`, `id_empleado_planilladevengo_gratifivaca`, `dias_trabajo_planilladevengo_gratifivaca`, `sueldo_planilladevengo_gratifivaca`, `hora_extra_diurna_planilladevengo_gratifivaca`, `hora_extra_nocturna_planilladevengo_gratifivaca`, `hora_extra_domingo_planilladevengo_gratifivaca`, `hora_extra_domingo_nocturna_planilladevengo_gratifivaca`, `otro_devengo_gratifivaca_planilladevengo_gratifivaca`, `total_devengo_gratifivaca_planilladevengo_gratifivaca`, `descuento_isss_planilladevengo_gratifivaca`, `descuento_afp_planilladevengo_gratifivaca`, `descuento_renta_planilladevengo_gratifivaca`, `otro_descuento_planilladevengo_gratifivaca`, `total_descuento_planilladevengo_gratifivaca`, `total_liquidado_planilladevengo_gratifivaca`, `sueldo_renta_planilladevengo_gratifivaca`, `sueldo_isss_planilladevengo_gratifivaca`, `sueldo_afp_planilladevengo_gratifivaca`, `departamento_planilladevengo_gratifivaca`, `codigo_ubicacion_planilladevengo_gratifivaca`, `nombre_ubicacion_planilladevengo_gratifivaca`, `id_ubicacion_planilladevengo_gratifivaca`, `observacion_planilladevengo_gratifivaca`, `periodo_planilladevengo_gratifivaca`, `tipo_planilladevengo_gratifivaca`, `dias_incapacidad` FROM `planilladevengo_gratifivaca` WHERE id_empleado_planilladevengo_gratifivaca=$e and numero_planilladevengo_gratifivaca=$numero_planilladevengo_gratifivaca1";


			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			$outp = $sql->fetchAll();
			echo json_encode($outp);
		};
		$data01 = consultar_situacion2($consultarempleado,$numero_planilladevengo_gratifivaca);
		$result = [];


		
			/* ************ */
	break;
	case "consultard":
		/* ************ */
		function consultar_situacion2($e,$x,$z)
		{
			$query01="SELECT*FROM tbl_devengo_descuento_planilla_gratifivaca WHERE idempleado_devengo='$e' and codigo_planilla_devengo='$z' and tipo_valor LIKE '%$x%'";
			
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
			<td class="subtotal2" isss="'.$value["isss_devengo_devengo_descuento_planilla"].'" afp="'.$value["afp_devengo_devengo_descuento_planilla"].'" renta="'.$value["renta_devengo_devengo_descuento_planilla"].'"  >'.bcdiv($value["valor_devengo_planilla"], '1', 2).'</td>
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
			$query01="SELECT*FROM tbl_devengo_descuento_planilla_gratifivaca WHERE idempleado_devengo='$e' and codigo_planilla_devengo='$z' and tipo_valor LIKE '%$x%'";
	
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
	case "agregardevengo":
				/* ****************** */
				/* CAPTURA NOMBRE DE LAS COLUMNAS Y CAMPOS DEL IMPUT */
				$namecolumnas_situacion = "";
				$namecampos_situacion = "";
		
				$data = getContent_devengo_gratifivaca();
				foreach ($data as $row) {
					$namecolumnas_situacion .= $row['Field'] . ",";
					$namecampos_situacion .= ":" . $row['Field'] . ",";
				}
				$stmt = Conexion::conectar()->prepare("INSERT INTO tbl_devengo_descuento_planilla_gratifivaca(" . trim($namecolumnas_situacion, ",") . ") VALUES (" . trim($namecampos_situacion, ",") . ")");

				
				$campos="";
				foreach ($data as $row) {
					$stmt->bindParam(":" . $row['Field'], $_POST["" . $row['Field'] . ""], PDO::PARAM_STR);
					$campos.= $_POST["" . $row['Field'] . ""].',';
					
				}

						/* 		echo "INSERT INTO tbl_devengo_gratifivaca_descuento_planilla(" . trim($namecolumnas_situacion, ",") . ") VALUES (" . trim($campos, ",") . ")";
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
					$data = getContent_devengo_gratifivaca();
					$test = "";
					foreach ($data as $row) {
						$namecolumnas_situacion .= $row['Field'] . "=" . ":" . $row['Field'] . ",";
						$test .= $row['Field'] . "='" . $_POST["" . $row['Field'] . ""] . "',";
					}
			
					$query01 = "UPDATE tbl_devengo_descuento_planilla_gratifivaca SET " . trim($test, ",") . " WHERE id LIKE $id";
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
		/* 	$query01 = "SELECT * FROM `planilladevengo_gratifivaca`  WHERE codigo_empleado_planilladevengo_gratifivaca='$e'"; */
			$query01="SELECT*FROM tbl_devengo_descuento_planilla_gratifivaca WHERE id='$e'";
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
		/* 	$query01 = "SELECT * FROM `planilladevengo_gratifivaca`  WHERE codigo_empleado_planilladevengo_gratifivaca='$e'"; */
			$query01="SELECT*FROM tbl_empleados_devengos_descuentos WHERE id='$e' ";
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
		$query = "DELETE FROM `tbl_devengo_descuento_planilla_gratifivaca` WHERE id=$consultarempleado";
		echo $query;
		$stmt = Conexion::conectar()->prepare($query);
		$stmt->execute();
		/* ****************** */
		/* 		$query = "DELETE FROM `planilladevengo_gratifivaca` WHERE id_empleado_planilladevengo_gratifivaca=$idempleado";
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
		/* 	$query01 = "SELECT * FROM `planilladevengo_gratifivaca`  WHERE codigo_empleado_planilladevengo_gratifivaca='$e'"; */
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
		/* 	$query01 = "SELECT * FROM `planilladevengo_gratifivaca`  WHERE codigo_empleado_planilladevengo_gratifivaca='$e'"; */
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
					$query01="SELECT isr.id as idisr, `codigo`, `nombre_rango`, `periodo_pago`, `salario_desde`, `salario_hasta`, `base_1`, `tasa_sobre_excedente`, `base_2`, periodo_de_pago.id as idperiodo 
							FROM `isr`, periodo_de_pago 
							WHERE isr.periodo_pago=periodo_de_pago.id and nombre_periodo='$periodo' and '$salario'>=salario_desde and '$salario'<=salario_hasta";
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
	/* ************ */
	function consultar_situacion2($e,$x,$z)
	{

		$query01="SELECT  tbl_empleados_devengos_descuentos.id as idempleadodevengo, tbl_empleados_devengos_descuentos.* ,tbl_devengo_descuento.* FROM `tbl_empleados_devengos_descuentos`, tbl_devengo_descuento
		where tbl_empleados_devengos_descuentos.id_tipo_devengo_descuento = tbl_devengo_descuento.id
		and tbl_empleados_devengos_descuentos.id_empleado='$e' and tbl_devengo_descuento.tipo LIKE '%$x%' and tbl_empleados_devengos_descuentos.id_tipo_devengo_descuento=22";
		
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
		$query01="SELECT `codigo_devengo_descuento_planilla`, `descripcion_devengo_descuento_planilla`, `tipo_devengo_descuento_planilla`, `isss_devengo_devengo_descuento_planilla`, `afp_devengo_devengo_descuento_planilla`, `renta_devengo_devengo_descuento_planilla`, `porcentaje_renta_devengo_descuento_planilla`, `porcentaje_isss_devengo_descuento_planilla`, `porcentaje_afp_devengo_descuento_planilla`, `idempleado_devengo`, `id`, `valor_devengo_planilla`, `tipo_valor`, `codigo_planilla_devengo` FROM `tbl_devengo_descuento_planilla` WHERE codigo_devengo_descuento_planilla='$codigo1' and idempleado_devengo='$idempleados1' and codigo_planilla_devengo='$codigo_planilla1' and descripcion_devengo_descuento_planilla='vacio'";
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
		$data = getContent_devengo_gratifivaca();
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
		$query = "DELETE FROM `tbl_empleados_devengos_descuentos` WHERE id=$consultarempleado";
		echo $query;
		$stmt = Conexion::conectar()->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
		$stmt = null;
		/* ********************* */
	break;
	case "valordevengo_gratifivaca":

			/* ************************ */
			function consultar($e)
			{
				$query01="SELECT*FROM tbl_devengo_descuento_planilla_gratifivaca WHERE idempleado_devengo='$e' and descripcion_devengo_descuento_planilla LIKE '%vacacion%'";
	
			
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
			$query01="SELECT*FROM planilladevengo_gratifivaca ORDER by id DESC
			LIMIT 1";
			
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
			
		};
		$data01 = consultar_situacion2();
		$correlativo_dato="";
		foreach ($data01 as $value) {
		
				$numero = $value["numero_planilladevengo_gratifivaca"];
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
		$numero_planilladevengo_gratifivaca=$_POST["numero_planilladevengo_gratifivaca"];
		$id_empleado_planilladevengo_gratifivaca=$_POST["id_empleado_planilladevengo_gratifivaca"];
		$query = "DELETE FROM `planilladevengo_gratifivaca` WHERE numero_planilladevengo_gratifivaca=$numero_planilladevengo_gratifivaca and id_empleado_planilladevengo_gratifivaca=$id_empleado_planilladevengo_gratifivaca";
		echo $query;
		$stmt = Conexion::conectar()->prepare($query);
		$stmt->execute();

		/* ********************* */

		$query01 = "DELETE FROM `tbl_devengo_descuento_planilla_gratifivaca` WHERE codigo_planilla_devengo=$numero_planilladevengo_gratifivaca and idempleado_devengo=$id_empleado_planilladevengo_gratifivaca";
	
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
		$numero_planilladevengo_gratifivaca=$_POST["numero_planilladevengo_gratifivaca"];

		$query = "DELETE FROM `planilladevengo_gratifivaca` WHERE numero_planilladevengo_gratifivaca=$numero_planilladevengo_gratifivaca ";
		echo $query;
		$stmt = Conexion::conectar()->prepare($query);
		$stmt->execute();

		/* ********************* */

		$query01 = "DELETE FROM `tbl_devengo_descuento_planilla_gratifivaca` WHERE codigo_planilla_devengo=$numero_planilladevengo_gratifivaca ";
		echo $query01;
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
			$query01="SELECT SUM(total_liquidado_planilladevengo_gratifivaca) AS total_liquido FROM `planilladevengo_gratifivaca` where numero_planilladevengo_gratifivaca='$numero'";
	
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
			$query01="SELECT COUNT(*) AS total_empleados FROM `planilladevengo_gratifivaca` where numero_planilladevengo_gratifivaca='$numero'";
	
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			$outp = $sql->fetchAll();
			echo json_encode($outp);
		};
		$data01 = global_datos($numero);
		$result = [];
		/* ************ */
	break;
	default:
		echo $accion."respuesta nula";
}



?>