

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


$fecha_planilladevengo_aguinaldo="";
if ( isset($_POST["fecha_planilladevengo_aguinaldo"]) ) {
    $fecha_planilladevengo_aguinaldo = $_POST["fecha_planilladevengo_aguinaldo"];
}


$accion="";
if ( isset($_POST["accion01"]) ) {
    $accion = $_POST["accion01"];
}

$codigo_empleado_planilladevengo_aguinaldo="";
if ( isset($_POST["codigo_empleado_planilladevengo_aguinaldo"]) ) {
    	$codigo_empleado_planilladevengo_aguinaldo = $_POST["codigo_empleado_planilladevengo_aguinaldo"];
		/* ********VALIDAR SI VA A AGREGAR O ACTUALIZAR************ */
		function validarempleado($e)
		{
					$query01 = "SELECT count(*) as valor FROM planilladevengo_aguinaldo WHERE codigo_empleado_planilladevengo_aguinaldo='$e' ";
					$sql = Conexion::conectar()->prepare($query01);
					$sql->execute();
					return $sql->fetchAll();
		}
		$existeempleado="";
		$data03 = validarempleado($codigo_empleado_planilladevengo_aguinaldo);
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
	$query = "SHOW COLUMNS FROM planilladevengo_aguinaldo";
	$stmt = Conexion::conectar()->prepare($query);
	$stmt->execute();
	return $stmt->fetchAll();
	$stmt->close();
	$stmt = null;
}

function getContent_insert()
{
	$query = "SHOW COLUMNS FROM planilladevengo_aguinaldo WHERE Field NOT IN ('id')";
	$stmt = Conexion::conectar()->prepare($query);
	$stmt->execute();
	return $stmt->fetchAll();
	$stmt->close();
	$stmt = null;
}


function getContent_devengo_aguinaldo()
{
	$query = "SHOW COLUMNS FROM tbl_devengo_descuento_planilla_aguinaldo";
	$stmt = Conexion::conectar()->prepare($query);
	$stmt->execute();
	return $stmt->fetchAll();
	$stmt->close();
	$stmt = null;
}






switch ($accion) {
	case "lista":

		$tipo_planilladevengo_aguinaldo = $_POST["tipo_planilladevengo_aguinaldo"];
		$periodo_planilladevengo_aguinaldo = $_POST["periodo_planilladevengo_aguinaldo"];
		$numero_planilladevengo_aguinaldo = $_POST["numero_planilladevengo_aguinaldo"];
		$descripcion_planilladevengo_aguinaldo = $_POST["descripcion_planilladevengo_aguinaldo"];



		/* ***CONSULTAR DEVENGO***** */
		function consultar_devengo()
		{
			$query01 = "SELECT `id`, `codigo`, `descripcion`, `porcentaje`, `tipo`, `cargo_abono`, `cuenta_contable`, `isss_devengo`, `afp_devengo`, `renta_devengo` FROM `tbl_devengo_descuento` WHERE id='44'";
		
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

			$query01="SELECT DATE_FORMAT(DATE(NOW()), '%m-%d')as fecha_actual,DATE_FORMAT(tbl_empleados.fecha_contratacion, '%m-%d') as fechacontracion, tbl_empleados.id as idempleado, tbl_empleados.* 
			FROM `tbl_empleados`
			GROUP by tbl_empleados.id";
		

			/* echo $query01; */
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};
		$newDate = date("Y-m-d", strtotime($fecha_planilladevengo_aguinaldo));
		$fechaperiodo1_total = date("Y-m-d", strtotime($_POST["fechaperiodo1"]));
		$fechaperiodo2_total= date("Y-m-d", strtotime($_POST["fechaperiodo2"]));
		$fechaperiodo1 = date("d",strtotime($_POST["fechaperiodo1"]));
		$fechaperiodo2 = date("d",strtotime($_POST["fechaperiodo2"]));
		$data01 = consultar($newDate,$fechaperiodo1,$fechaperiodo2);
		$datos_html = "";
		$datos_html .= ' <table class="table table-bordered table-striped dt-responsive tablas1" width="100%">
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

		function consultar_devengo_empleados($idempleados)
		{
			$query01 = "SELECT `id`, `id_empleado`, `id_tipo_devengo_descuento`, `valor`, `fecha_caducidad`, `referencia` 
						FROM `tbl_empleados_devengos_descuentos` 
						WHERE id_empleado=$idempleados and id_tipo_devengo_descuento=2 
						group by id_empleado";
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};

		foreach ($data01 as $value) {

				
				/* ***CONSULTAR DEVENGO VIATICOS***** */
				$idempleado=$value["idempleado"];
				$valor_viaticos=0;
				$data02 = consultar_devengo_empleados($idempleado);
				foreach ($data02 as $consulta) {
							$valor_aguinaldo="";
							$valor_viaticos=$consulta["valor"];
							if($valor_aguinaldo==""){
								$valor_aguinaldo=0;
							}
					}
				/* *************** */
			

			/* 	******CALCULO AGUINALDO******* */
				$sueldo=(float)$value["sueldo"];
				$suma_sueldo_viatico=$sueldo+$valor_viaticos;
				$salario_mensual=$suma_sueldo_viatico*2;
				$salario_diario=$salario_mensual/30;
				$fechaActual = date("d-m-Y");
				$fechacontratacion=$value["fecha_contratacion"];
				$fechaActual = date('Y-m-d'); 

				$datetime1 = date_create($fechacontratacion);
				
				$datetime2 = date_create($newDate);
				/* $datetime2 = date_create($fechaActual); */
				$contador = date_diff($datetime1, $datetime2);

				$differenceFormat = '%a';
				$total_dias= $contador->format($differenceFormat)+1;


				if($total_dias < 365){
					/* AGUILNALDO PROPORCIONAL */
					$porcentaje=$total_dias/365;
					$valor_aguinaldo=$porcentaje*$suma_sueldo_viatico;
				}
				if($total_dias>365 && $total_dias<1095){
					/* AGUINALDO SERIA 15 Días de Salario */
					$valor_aguinaldo=$salario_diario*15;
					/* echo $valor_viaticos."-".$valor_aguinaldo."-".$salario_diario."-".$value["codigo_empleado"]."**************"; */
				}
				if($total_dias>1095 && $total_dias<3650){
					/* AGUINALDO 19 Días de Salario */
					$valor_aguinaldo=$salario_diario*19;
				}
				if($total_dias>3650){
					/* AGUINALDO 21 Días de Salario */
					$valor_aguinaldo=$salario_diario*21;
				}

				/* ************* GUARDAR EMPLEADO EN PLANILLA ***************** */
				$numero_planilladevengo_aguinaldo=$numero_planilladevengo_aguinaldo;
				$fecha_planilladevengo_aguinaldo=$newDate;
				$fecha_desde_planilladevengo_aguinaldo=$fechaperiodo1_total;
				$fecha_hasta_planilladevengo_aguinaldo=$fechaperiodo2_total;
				$descripcion_planilladevengo_aguinaldo=$descripcion_planilladevengo_aguinaldo;
				$codigo_empleado_planilladevengo_aguinaldo=$value["codigo_empleado"];
				$nombre_empleado_planilladevengo_aguinaldo=$value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"];
				$id_empleado_planilladevengo_aguinaldo=$value["idempleado"];
				$sueldo_planilladevengo_aguinaldo="0";
				$total_devengo_aguinaldo_planilladevengo_aguinaldo=$valor_aguinaldo;
				$total_liquidado_planilladevengo_aguinaldo=number_format($valor_aguinaldo, 2, '.', '');
				$codigo_ubicacion_planilladevengo_aguinaldo="";
				$nombre_ubicacion_planilladevengo_aguinaldo="";
				$id_ubicacion_planilladevengo_aguinaldo="";
				$periodo_planilladevengo_aguinaldo=$periodo_planilladevengo_aguinaldo;
				$tipo_planilladevengo_aguinaldo=$tipo_planilladevengo_aguinaldo;
				$empleado_rango_desde=$empleado_rango_desde;
				$empleado_rango_hasta=$empleado_rango_hasta;

				$values_consulta.="('$numero_planilladevengo_aguinaldo','$fecha_planilladevengo_aguinaldo','$fecha_desde_planilladevengo_aguinaldo','$fecha_hasta_planilladevengo_aguinaldo','$descripcion_planilladevengo_aguinaldo','$codigo_empleado_planilladevengo_aguinaldo','$nombre_empleado_planilladevengo_aguinaldo','$id_empleado_planilladevengo_aguinaldo','$sueldo_planilladevengo_aguinaldo','$total_devengo_aguinaldo_planilladevengo_aguinaldo','$total_liquidado_planilladevengo_aguinaldo','$codigo_ubicacion_planilladevengo_aguinaldo','$nombre_ubicacion_planilladevengo_aguinaldo','$id_ubicacion_planilladevengo_aguinaldo','$periodo_planilladevengo_aguinaldo','$tipo_planilladevengo_aguinaldo','$empleado_rango_desde','$empleado_rango_hasta'),";

				/* ************************************************************** */

				/* **********GUARDAR DEVENGO*********** */
				/* $id_tipo_devengo_descuento=$value["id_tipo_devengo_descuento"]; */
				$codigo_devengo_descuento_planilla=$codigo_devengo;
				$descripcion_devengo_descuento_planilla=$descipcion_devengo;
				$tipo_devengo_descuento_planilla=$id_devengo;
				$isss_devengo_devengo_descuento_planilla=$isss_devengo;
				$afp_devengo_devengo_descuento_planilla=$afp_devengo;
				$renta_devengo_devengo_descuento_planilla=$renta_devengo;
				$idempleado_devengo=$value["idempleado"];
				$valor_devengo_planilla=number_format($valor_aguinaldo, 2, '.', '');
				$tipo_valor="Suma";
				$codigo_planilla_devengo=$numero_planilladevengo_aguinaldo;

				$values_devengo.="('$codigo_devengo_descuento_planilla', '$descripcion_devengo_descuento_planilla', '$tipo_devengo_descuento_planilla', '$isss_devengo_devengo_descuento_planilla', '$afp_devengo_devengo_descuento_planilla', '$renta_devengo_devengo_descuento_planilla', '$idempleado_devengo', '$valor_devengo_planilla', '$tipo_valor', '$codigo_planilla_devengo'),";

			
			/* *********************************** */

			$datos_html .= ' <tr class="btnEditarabase" hora_extra_nocturna_domingo="'.$value["hora_extra_nocturna_domingo"].'"   hora_extra_domingo="'.$value["hora_extra_domingo"].'"  hora_extra_nocturna="'.$value["hora_extra_nocturna"].'" hora_extra_diurna="'.$value["hora_extra_diurna"].'"    salario_por_hora="'.$value["salario_por_hora"].'"  sueldo="'.$value["sueldo"].'"  idempleado="'.$value["idempleado"].'" codigo="'.$value["codigo_empleado"].'"  nombre="'.$value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"].'">
			<td>'.$value["codigo_empleado"].'</td>
			<td>'.$value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"].' </td>';
			$datos_html .='<td><div class="btn btn-danger eliminarempleado" numero_planilla="'.$numero_planilladevengo_aguinaldo.'" idempleado="'.$value["idempleado"].'"><i class="fa fa-times"></i></div></td>';
			$datos_html .= '</tr>';
		}
		$datos_html .= '</tbody></table>';
		/* echo trim($values_consulta, ","); */

		/* echo $datos_html; */
		function consultar_planilla($numero_planilladevengo_aguinaldo1)
			{
				$query01="SELECT `id`, `numero_planilladevengo_aguinaldo`, `fecha_planilladevengo_aguinaldo`, `fecha_desde_planilladevengo_aguinaldo`, `fecha_hasta_planilladevengo_aguinaldo`, `descripcion_planilladevengo_aguinaldo`, `codigo_empleado_planilladevengo_aguinaldo`, `nombre_empleado_planilladevengo_aguinaldo`, `id_empleado_planilladevengo_aguinaldo`, `dias_trabajo_planilladevengo_aguinaldo`, `sueldo_planilladevengo_aguinaldo`, `hora_extra_diurna_planilladevengo_aguinaldo`, `hora_extra_nocturna_planilladevengo_aguinaldo`, `hora_extra_domingo_planilladevengo_aguinaldo`, `hora_extra_domingo_nocturna_planilladevengo_aguinaldo`, `otro_devengo_aguinaldo_planilladevengo_aguinaldo`, `total_devengo_aguinaldo_planilladevengo_aguinaldo`, `descuento_isss_planilladevengo_aguinaldo`, `descuento_afp_planilladevengo_aguinaldo`, `descuento_renta_planilladevengo_aguinaldo`, `otro_descuento_planilladevengo_aguinaldo`, `total_descuento_planilladevengo_aguinaldo`, `total_liquidado_planilladevengo_aguinaldo`, `sueldo_renta_planilladevengo_aguinaldo`, `sueldo_isss_planilladevengo_aguinaldo`, `sueldo_afp_planilladevengo_aguinaldo`, `departamento_planilladevengo_aguinaldo`, `codigo_ubicacion_planilladevengo_aguinaldo`, `nombre_ubicacion_planilladevengo_aguinaldo`, `id_ubicacion_planilladevengo_aguinaldo`, `observacion_planilladevengo_aguinaldo`, `periodo_planilladevengo_aguinaldo`, `tipo_planilladevengo_aguinaldo`, `dias_incapacidad`, `empleado_rango_desde`, `empleado_rango_hasta`, COUNT(*) as registro FROM `planilladevengo_aguinaldo` WHERE numero_planilladevengo_aguinaldo='$numero_planilladevengo_aguinaldo1'";
				$sql = Conexion::conectar()->prepare($query01);
				$sql->execute();
				return $sql->fetchAll();
			};
		$data_planilla = consultar_planilla($numero_planilladevengo_aguinaldo);
		$registro="";
		foreach ($data_planilla as $value) {
			$registro.=$value["registro"];
		}

		if($registro == 0){

			
			$insertar_devengo="INSERT INTO `tbl_devengo_descuento_planilla_aguinaldo`(`codigo_devengo_descuento_planilla`, `descripcion_devengo_descuento_planilla`, `tipo_devengo_descuento_planilla`, `isss_devengo_devengo_descuento_planilla`, `afp_devengo_devengo_descuento_planilla`, `renta_devengo_devengo_descuento_planilla`,`idempleado_devengo`, `valor_devengo_planilla`, `tipo_valor`, `codigo_planilla_devengo`) VALUES  ".trim($values_devengo, ",")."";
			$sql_devengo = Conexion::conectar()->prepare($insertar_devengo);
			$sql_devengo->execute();


			$insertar="INSERT INTO `planilladevengo_aguinaldo`(`numero_planilladevengo_aguinaldo`, `fecha_planilladevengo_aguinaldo`, `fecha_desde_planilladevengo_aguinaldo`, `fecha_hasta_planilladevengo_aguinaldo`, `descripcion_planilladevengo_aguinaldo`, `codigo_empleado_planilladevengo_aguinaldo`, `nombre_empleado_planilladevengo_aguinaldo`, `id_empleado_planilladevengo_aguinaldo`, `sueldo_planilladevengo_aguinaldo`,  `total_devengo_aguinaldo_planilladevengo_aguinaldo`, `total_liquidado_planilladevengo_aguinaldo`, `codigo_ubicacion_planilladevengo_aguinaldo`, `nombre_ubicacion_planilladevengo_aguinaldo`, `id_ubicacion_planilladevengo_aguinaldo`, `periodo_planilladevengo_aguinaldo`, `tipo_planilladevengo_aguinaldo`, `empleado_rango_desde`, `empleado_rango_hasta`) value ".trim($values_consulta, ",")."";
			$sql = Conexion::conectar()->prepare($insertar);
			if ($sql->execute()) {

				$data_planilla = consultar_planilla($numero_planilladevengo_aguinaldo);
				$id="";
				foreach ($data_planilla as $value) {
					$id.=$value["id"];
					
				}
				echo $numero_planilladevengo_aguinaldo;
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

		$tipo_planilladevengo_aguinaldo = $_POST["tipo_planilladevengo_aguinaldo"];
		$periodo_planilladevengo_aguinaldo = $_POST["periodo_planilladevengo_aguinaldo"];
		$numero_planilladevengo_aguinaldo = $_POST["numero_planilladevengo_aguinaldo"];
		$descripcion_planilladevengo_aguinaldo = $_POST["descripcion_planilladevengo_aguinaldo"];


		/* ***CONSULTAR DEVENGO***** */
		function consultar_devengo()
		{
			$query01 = "SELECT `id`, `codigo`, `descripcion`, `porcentaje`, `tipo`, `cargo_abono`, `cuenta_contable`, `isss_devengo`, `afp_devengo`, `renta_devengo` FROM `tbl_devengo_descuento` WHERE id='44'";
		
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


		function consultar($e,$dia1,$dia2,$empleado_rango_desde1,$empleado_rango_hasta1)
		{
			/* $query01="SELECT * FROM tbl_empleados 
					  WHERE YEAR(fecha_contratacion)<YEAR(NOW()) and DAY(fecha_contratacion)=DAY(NOW()) AND MONTH(fecha_contratacion)=MONTH(NOW()) AND DAY(fecha_contratacion) BETWEEN '16' AND '31'  and tbl_empleados.fecha_contratacion < '$e'"; */

			/* 			$query01 = "SELECT tbl_empleados.id as idempleado, tbl_empleados.*, tbl_empleados_devengos_descuentos.* , 				tbl_devengo_descuento.* 
						FROM `tbl_empleados` , tbl_empleados_devengos_descuentos,tbl_devengo_descuento WHERE tbl_empleados.id=tbl_empleados_devengos_descuentos.id_empleado and tbl_devengo_descuento.id = tbl_empleados_devengos_descuentos.id_tipo_devengo_descuento and tbl_devengo_descuento.codigo='0022' and tbl_empleados_devengos_descuentos.valor is NOT null  and tbl_empleados.fecha_contratacion < '$e' and YEAR(fecha_contratacion)<YEAR(NOW()) AND  DATE_FORMAT(DATE(NOW()), '%m-%d') >= DATE_FORMAT(tbl_empleados.fecha_contratacion, '%m-%d') AND MONTH(fecha_contratacion)=MONTH(NOW()) AND DAY(fecha_contratacion) BETWEEN '$dia1' AND '$dia2' "; */

			/* $query01="SELECT DATE_FORMAT(DATE(NOW()), '%m-%d')as fecha_actual,DATE_FORMAT(tbl_empleados.fecha_contratacion, '%m-%d') as fechacontracion, tbl_empleados.id as idempleado, tbl_empleados.*, tbl_empleados_devengos_descuentos.* , tbl_devengo_descuento.*
			FROM `tbl_empleados` , tbl_empleados_devengos_descuentos,tbl_devengo_descuento 
			WHERE tbl_empleados.id=tbl_empleados_devengos_descuentos.id_empleado and tbl_devengo_descuento.id = tbl_empleados_devengos_descuentos.id_tipo_devengo_descuento   and tbl_empleados.id >= '$empleado_rango_desde1' and tbl_empleados.id <= '$empleado_rango_hasta1' GROUP by tbl_empleados.id"; */

			$query01="SELECT DATE_FORMAT(DATE(NOW()), '%m-%d')as fecha_actual,DATE_FORMAT(tbl_empleados.fecha_contratacion, '%m-%d') as fechacontracion, tbl_empleados.id as idempleado, tbl_empleados.*
			FROM `tbl_empleados`  
			WHERE tbl_empleados.id >= '$empleado_rango_desde1' and tbl_empleados.id <= '$empleado_rango_hasta1' 
			GROUP by tbl_empleados.id";

			/* echo $query01; */
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};
		$newDate = date("Y-m-d", strtotime($fecha_planilladevengo_aguinaldo));
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
		$values_devengo="";

		function consultar_devengo_empleados($idempleados)
		{
			$query01 = "SELECT `id`, `id_empleado`, `id_tipo_devengo_descuento`, `valor`, `fecha_caducidad`, `referencia` 
						FROM `tbl_empleados_devengos_descuentos` 
						WHERE id_empleado=$idempleados and id_tipo_devengo_descuento=2 
						group by id_empleado";
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};



		foreach ($data01 as $value) {

        /* ***CONSULTAR DEVENGO VIATICOS***** */
		$idempleado=$value["idempleado"];
		$valor_viaticos=0;
		$data02 = consultar_devengo_empleados($idempleado);
		$valor_aguinaldo="";
		foreach ($data02 as $consulta) {
				
					$valor_viaticos=$consulta["valor"];

					if($valor_aguinaldo==""){
						$valor_aguinaldo=0;
					}
			}
		/* *************** */
	

		/* 	******CALCULO AGUINALDO******* */
		$sueldo=(float)$value["sueldo"];
		$suma_sueldo_viatico=$sueldo+$valor_viaticos;
		$salario_mensual=$suma_sueldo_viatico*2;
		$salario_diario=$salario_mensual/30;
		$fechaActual = date("d-m-Y");
		$fechacontratacion=$value["fecha_contratacion"];
		$fechaActual = date('Y-m-d'); 
		$datetime1 = date_create($fechacontratacion);
		$datetime2 = date_create($fechaActual);
		$contador = date_diff($datetime1, $datetime2);
		$differenceFormat = '%a';
		$total_dias= $contador->format($differenceFormat)+1;
		$valor_aguinaldo="";

		if($total_dias < 365){
			/* AGUILNALDO PROPORCIONAL */
			$porcentaje=$total_dias/365;
			$valor_aguinaldo=$porcentaje*$suma_sueldo_viatico;
		}
		if($total_dias>365 && $total_dias<1095){
			/* AGUINALDO SERIA 15 Días de Salario */
			$valor_aguinaldo=$salario_diario*15;
			/* echo $valor_viaticos."-".$valor_aguinaldo."-".$salario_diario."-".$value["codigo_empleado"]."**************"; */
		}
		if($total_dias>1095 && $total_dias<3650){
			/* AGUINALDO 19 Días de Salario */
			$valor_aguinaldo=$salario_diario*19;
		}
		if($total_dias>3650){
			/* AGUINALDO 21 Días de Salario */
			$valor_aguinaldo=$salario_diario*21;
		}

		/* ************* GUARDAR EMPLEADO EN PLANILLA ***************** */
		$numero_planilladevengo_aguinaldo=$numero_planilladevengo_aguinaldo;
		$fecha_planilladevengo_aguinaldo=$newDate;
		$fecha_desde_planilladevengo_aguinaldo=$fechaperiodo1_total;
		$fecha_hasta_planilladevengo_aguinaldo=$fechaperiodo2_total;
		$descripcion_planilladevengo_aguinaldo=$descripcion_planilladevengo_aguinaldo;
		$codigo_empleado_planilladevengo_aguinaldo=$value["codigo_empleado"];
		$nombre_empleado_planilladevengo_aguinaldo=$value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"];
		$id_empleado_planilladevengo_aguinaldo=$value["idempleado"];
		$sueldo_planilladevengo_aguinaldo="0";
		$total_devengo_aguinaldo_planilladevengo_aguinaldo=$valor_aguinaldo;
		$total_liquidado_planilladevengo_aguinaldo=number_format($valor_aguinaldo, 2, '.', '');
		$codigo_ubicacion_planilladevengo_aguinaldo="";
		$nombre_ubicacion_planilladevengo_aguinaldo="";
		$id_ubicacion_planilladevengo_aguinaldo="";
		$periodo_planilladevengo_aguinaldo=$periodo_planilladevengo_aguinaldo;
		$tipo_planilladevengo_aguinaldo=$tipo_planilladevengo_aguinaldo;
		$empleado_rango_desde=$empleado_rango_desde;
		$empleado_rango_hasta=$empleado_rango_hasta;

		$values_consulta.="('$numero_planilladevengo_aguinaldo','$fecha_planilladevengo_aguinaldo','$fecha_desde_planilladevengo_aguinaldo','$fecha_hasta_planilladevengo_aguinaldo','$descripcion_planilladevengo_aguinaldo','$codigo_empleado_planilladevengo_aguinaldo','$nombre_empleado_planilladevengo_aguinaldo','$id_empleado_planilladevengo_aguinaldo','$sueldo_planilladevengo_aguinaldo','$total_devengo_aguinaldo_planilladevengo_aguinaldo','$total_liquidado_planilladevengo_aguinaldo','$codigo_ubicacion_planilladevengo_aguinaldo','$nombre_ubicacion_planilladevengo_aguinaldo','$id_ubicacion_planilladevengo_aguinaldo','$periodo_planilladevengo_aguinaldo','$tipo_planilladevengo_aguinaldo','$empleado_rango_desde','$empleado_rango_hasta'),";

		/* ************************************************************** */

		/* **********GUARDAR DEVENGO*********** */

		$codigo_devengo_descuento_planilla=$codigo_devengo;
		$descripcion_devengo_descuento_planilla=$descipcion_devengo;
		$tipo_devengo_descuento_planilla=$id_devengo;
		$isss_devengo_devengo_descuento_planilla=$isss_devengo;
		$afp_devengo_devengo_descuento_planilla=$afp_devengo;
		$renta_devengo_devengo_descuento_planilla=$renta_devengo;
		$idempleado_devengo=$value["idempleado"];
		$valor_devengo_planilla=number_format($valor_aguinaldo, 2, '.', '');
		$tipo_valor="Suma";
		$codigo_planilla_devengo=$numero_planilladevengo_aguinaldo;

		$values_devengo.="('$codigo_devengo_descuento_planilla', '$descripcion_devengo_descuento_planilla', '$tipo_devengo_descuento_planilla', '$isss_devengo_devengo_descuento_planilla', '$afp_devengo_devengo_descuento_planilla', '$renta_devengo_devengo_descuento_planilla', '$idempleado_devengo', '$valor_devengo_planilla', '$tipo_valor', '$codigo_planilla_devengo'),";

	
		/* *********************************** */




			$datos_html .= ' <tr class="btnEditarabase" hora_extra_nocturna_domingo="'.$value["hora_extra_nocturna_domingo"].'"   hora_extra_domingo="'.$value["hora_extra_domingo"].'"  hora_extra_nocturna="'.$value["hora_extra_nocturna"].'" hora_extra_diurna="'.$value["hora_extra_diurna"].'"   salario_por_hora="'.$value["salario_por_hora"].'"  sueldo="'.$value["sueldo"].'"  idempleado="'.$value["idempleado"].'" codigo="'.$value["codigo_empleado"].'"  nombre="'.$value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"].'">
			<td>'.$value["codigo_empleado"].'</td>
			<td>'.$value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"].' </td>';
			$datos_html .='<td><div class="btn btn-danger eliminarempleado" numero_planilla="'.$numero_planilladevengo_aguinaldo.'" idempleado="'.$value["idempleado"].'"><i class="fa fa-times"></i></div></td>';
			$datos_html .= '</tr>';

		}
		$datos_html .= '</tbody></table>';
		/* echo trim($values_consulta, ","); */


		/* echo $datos_html; */
		function consultar_planilla($numero_planilladevengo_aguinaldo1)
			{
			
				$query01="SELECT `id`, `numero_planilladevengo_aguinaldo`, `fecha_planilladevengo_aguinaldo`, `fecha_desde_planilladevengo_aguinaldo`, `fecha_hasta_planilladevengo_aguinaldo`, `descripcion_planilladevengo_aguinaldo`, `codigo_empleado_planilladevengo_aguinaldo`, `nombre_empleado_planilladevengo_aguinaldo`, `id_empleado_planilladevengo_aguinaldo`, `dias_trabajo_planilladevengo_aguinaldo`, `sueldo_planilladevengo_aguinaldo`, `hora_extra_diurna_planilladevengo_aguinaldo`, `hora_extra_nocturna_planilladevengo_aguinaldo`, `hora_extra_domingo_planilladevengo_aguinaldo`, `hora_extra_domingo_nocturna_planilladevengo_aguinaldo`, `otro_devengo_aguinaldo_planilladevengo_aguinaldo`, `total_devengo_aguinaldo_planilladevengo_aguinaldo`, `descuento_isss_planilladevengo_aguinaldo`, `descuento_afp_planilladevengo_aguinaldo`, `descuento_renta_planilladevengo_aguinaldo`, `otro_descuento_planilladevengo_aguinaldo`, `total_descuento_planilladevengo_aguinaldo`, `total_liquidado_planilladevengo_aguinaldo`, `sueldo_renta_planilladevengo_aguinaldo`, `sueldo_isss_planilladevengo_aguinaldo`, `sueldo_afp_planilladevengo_aguinaldo`, `departamento_planilladevengo_aguinaldo`, `codigo_ubicacion_planilladevengo_aguinaldo`, `nombre_ubicacion_planilladevengo_aguinaldo`, `id_ubicacion_planilladevengo_aguinaldo`, `observacion_planilladevengo_aguinaldo`, `periodo_planilladevengo_aguinaldo`, `tipo_planilladevengo_aguinaldo`, `dias_incapacidad`, `empleado_rango_desde`, `empleado_rango_hasta`, COUNT(*) as registro FROM `planilladevengo_aguinaldo` WHERE numero_planilladevengo_aguinaldo='$numero_planilladevengo_aguinaldo1'";
				$sql = Conexion::conectar()->prepare($query01);
				$sql->execute();
				return $sql->fetchAll();
			};
		$data_planilla = consultar_planilla($numero_planilladevengo_aguinaldo);
		$registro="";
		foreach ($data_planilla as $value) {
			$registro.=$value["registro"];
		}
		if($registro == 0){


			
			$insertar_devengo="INSERT INTO `tbl_devengo_descuento_planilla_aguinaldo`(`codigo_devengo_descuento_planilla`, `descripcion_devengo_descuento_planilla`, `tipo_devengo_descuento_planilla`, `isss_devengo_devengo_descuento_planilla`, `afp_devengo_devengo_descuento_planilla`, `renta_devengo_devengo_descuento_planilla`,`idempleado_devengo`, `valor_devengo_planilla`, `tipo_valor`, `codigo_planilla_devengo`) VALUES  ".trim($values_devengo, ",")."";
			$sql_devengo = Conexion::conectar()->prepare($insertar_devengo);
			$sql_devengo->execute();



			$insertar="INSERT INTO `planilladevengo_aguinaldo`(`numero_planilladevengo_aguinaldo`, `fecha_planilladevengo_aguinaldo`, `fecha_desde_planilladevengo_aguinaldo`, `fecha_hasta_planilladevengo_aguinaldo`, `descripcion_planilladevengo_aguinaldo`, `codigo_empleado_planilladevengo_aguinaldo`, `nombre_empleado_planilladevengo_aguinaldo`, `id_empleado_planilladevengo_aguinaldo`, `sueldo_planilladevengo_aguinaldo`,  `total_devengo_aguinaldo_planilladevengo_aguinaldo`, `total_liquidado_planilladevengo_aguinaldo`, `codigo_ubicacion_planilladevengo_aguinaldo`, `nombre_ubicacion_planilladevengo_aguinaldo`, `id_ubicacion_planilladevengo_aguinaldo`, `periodo_planilladevengo_aguinaldo`, `tipo_planilladevengo_aguinaldo`, `empleado_rango_desde`, `empleado_rango_hasta`) value ".trim($values_consulta, ",")."";
			$sql = Conexion::conectar()->prepare($insertar);
			if ($sql->execute()) {
				/* echo "OK"; */
				echo $numero_planilladevengo_aguinaldo;
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
		
		$tipo_planilladevengo_aguinaldo = $_POST["tipo_planilladevengo_aguinaldo"];
		$periodo_planilladevengo_aguinaldo = $_POST["periodo_planilladevengo_aguinaldo"];
		$numero_planilladevengo_aguinaldo = $_POST["numero_planilladevengo_aguinaldo"];
		$descripcion_planilladevengo_aguinaldo = $_POST["descripcion_planilladevengo_aguinaldo"];
		function consultar($e,$dia1,$dia2,$numero_planilladevengo_aguinaldo1)
		{

			/* $query01="SELECT  tbl_empleados.id as idempleado, tbl_empleados.*, tbl_empleados_devengos_descuentos.* , tbl_devengo_descuento.*
			FROM `tbl_empleados` , tbl_empleados_devengos_descuentos,tbl_devengo_descuento, planilladevengo_aguinaldo
			WHERE tbl_empleados.id=tbl_empleados_devengos_descuentos.id_empleado and tbl_devengo_descuento.id = tbl_empleados_devengos_descuentos.id_tipo_devengo_descuento and planilladevengo_aguinaldo.id_empleado_planilladevengo_aguinaldo=tbl_empleados.id and planilladevengo_aguinaldo.numero_planilladevengo_aguinaldo=$numero_planilladevengo_aguinaldo1 group by tbl_empleados.id"; */

			$query01="SELECT  tbl_empleados.id as idempleado, tbl_empleados.*
			FROM `tbl_empleados` , planilladevengo_aguinaldo
			WHERE  planilladevengo_aguinaldo.id_empleado_planilladevengo_aguinaldo=tbl_empleados.id and planilladevengo_aguinaldo.numero_planilladevengo_aguinaldo=$numero_planilladevengo_aguinaldo1 group by tbl_empleados.id";

			
		

			/* echo $query01; */
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};
		$newDate = date("Y-m-d", strtotime($fecha_planilladevengo_aguinaldo));
		$fechaperiodo1_total = date("Y-m-d", strtotime($_POST["fechaperiodo1"]));
		$fechaperiodo2_total= date("Y-m-d", strtotime($_POST["fechaperiodo2"]));
		$fechaperiodo1 = date("d",strtotime($_POST["fechaperiodo1"]));
		$fechaperiodo2 = date("d",strtotime($_POST["fechaperiodo2"]));
		$data01 = consultar($newDate,$fechaperiodo1,$fechaperiodo2,$numero_planilladevengo_aguinaldo);
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
			$datos_html .='<td><div class="btn btn-danger eliminarempleado" numero_planilla="'.$numero_planilladevengo_aguinaldo.'" idempleado="'.$value["idempleado"].'"><i class="fa fa-times"></i></div></td>';
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
		$stmt = Conexion::conectar()->prepare("INSERT INTO planilladevengo_aguinaldo(" . trim($namecolumnas_situacion, ",") . ") VALUES (" . trim($namecampos_situacion, ",") . ")");

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

		$codigo_empleado_planilladevengo_aguinaldo = $_POST["codigo_empleado_planilladevengo_aguinaldo"];
		$numero_planilladevengo_aguinaldo = $_POST["numero_planilladevengo_aguinaldo"];

		function validarempleado01($e,$numero_planilladevengo_aguinaldo1)
		{
					$query01 = "SELECT * FROM planilladevengo_aguinaldo WHERE codigo_empleado_planilladevengo_aguinaldo='$e' and numero_planilladevengo_aguinaldo='$numero_planilladevengo_aguinaldo1'";
					$sql = Conexion::conectar()->prepare($query01);
					$sql->execute();
					return $sql->fetchAll();
		}
		$existeempleado="";
		$data03 = validarempleado01($codigo_empleado_planilladevengo_aguinaldo,$numero_planilladevengo_aguinaldo);
		foreach ($data03 as $value) {
		$existeempleado.=$value["id"];
		}


		$query01 = "UPDATE planilladevengo_aguinaldo SET " . trim($test, ",") . " WHERE id LIKE $existeempleado and numero_planilladevengo_aguinaldo=$numero_planilladevengo_aguinaldo";
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
		/* 	$query01 = "SELECT * FROM `planilladevengo_aguinaldo`  WHERE codigo_empleado_planilladevengo_aguinaldo='$e'"; */
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
					$result['numero_planilladevengo_aguinaldo'] = $value['numero_planilladevengo_aguinaldo'];
					$result['fecha_planilladevengo_aguinaldo'] = $value['fecha_planilladevengo_aguinaldo'];
					$result['fecha_desde_planilladevengo_aguinaldo'] = $value['fecha_desde_planilladevengo_aguinaldo'];
					$result['fecha_hasta_planilladevengo_aguinaldo'] = $value['fecha_hasta_planilladevengo_aguinaldo'];
					$result['descripcion_planilladevengo_aguinaldo'] = $value['descripcion_planilladevengo_aguinaldo'];
					$result['codigo_empleado_planilladevengo_aguinaldo'] = $value['codigo_empleado_planilladevengo_aguinaldo'];
					$result['nombre_empleado_planilladevengo_aguinaldo'] = $value['nombre_empleado_planilladevengo_aguinaldo'];
					$result['id_empleado_planilladevengo_aguinaldo'] = $value['id_empleado_planilladevengo_aguinaldo'];
					$result['dias_trabajo_planilladevengo_aguinaldo'] = $value['dias_trabajo_planilladevengo_aguinaldo'];
					$result['sueldo_planilladevengo_aguinaldo'] = $value['sueldo_planilladevengo_aguinaldo'];
					$result['hora_extra_diurna_planilladevengo_aguinaldo'] = $value['hora_extra_diurna_planilladevengo_aguinaldo'];
					$result['hora_extra_nocturna_planilladevengo_aguinaldo'] = $value['hora_extra_nocturna_planilladevengo_aguinaldo'];
					$result['hora_extra_domingo_planilladevengo_aguinaldo'] = $value['hora_extra_domingo_planilladevengo_aguinaldo'];
					$result['hora_extra_domingo_nocturna_planilladevengo_aguinaldo'] = $value['hora_extra_domingo_nocturna_planilladevengo_aguinaldo'];
					$result['otro_devengo_aguinaldo_planilladevengo_aguinaldo'] = $value['otro_devengo_aguinaldo_planilladevengo_aguinaldo'];
					$result['total_devengo_aguinaldo_planilladevengo_aguinaldo'] = $value['total_devengo_aguinaldo_planilladevengo_aguinaldo'];
					$result['descuento_isss_planilladevengo_aguinaldo	'] = $value['descuento_isss_planilladevengo_aguinaldo	'];
					$result['descuento_afp_planilladevengo_aguinaldo'] = $value['descuento_afp_planilladevengo_aguinaldo'];
					$result['descuento_renta_planilladevengo_aguinaldo'] = $value['descuento_renta_planilladevengo_aguinaldo'];
					$result['otro_descuento_planilladevengo_aguinaldo'] = $value['otro_descuento_planilladevengo_aguinaldo'];
					$result['total_descuento_planilladevengo_aguinaldo'] = $value['total_descuento_planilladevengo_aguinaldo'];
					$result['total_liquidado_planilladevengo_aguinaldo'] = $value['total_liquidado_planilladevengo_aguinaldo'];
					$result['sueldo_renta_planilladevengo_aguinaldo'] = $value['sueldo_renta_planilladevengo_aguinaldo'];
					$result['sueldo_isss_planilladevengo_aguinaldo'] = $value['sueldo_isss_planilladevengo_aguinaldo'];
					$result['sueldo_afp_planilladevengo_aguinaldo'] = $value['sueldo_afp_planilladevengo_aguinaldo'];
					$result['departamento_planilladevengo_aguinaldo'] = $value['departamento_planilladevengo_aguinaldo'];
					$result['codigo_ubicacion_planilladevengo_aguinaldo'] = $value['codigo_ubicacion_planilladevengo_aguinaldo'];
					$result['nombre_ubicacion_planilladevengo_aguinaldo'] = $value['nombre_ubicacion_planilladevengo_aguinaldo'];
					$result['id_ubicacion_planilladevengo_aguinaldo'] = $value['id_ubicacion_planilladevengo_aguinaldo'];
					$result['observacion_planilladevengo_aguinaldo'] = $value['observacion_planilladevengo_aguinaldo'];
					$result['periodo_planilladevengo_aguinaldo'] = $value['periodo_planilladevengo_aguinaldo'];
					$result['tipo_planilladevengo_aguinaldo'] = $value['tipo_planilladevengo_aguinaldo'];
					$result['dias_incapacidad'] = $value['dias_incapacidad'];

				} */

				/* echo json_encode($result); */

		
			/* ************ */
	break;
	case "obtenerdatatotal":

		$numero_planilladevengo_aguinaldo=$_POST["numero_planilladevengo_aguinaldo"];
		/* ************ */
		function consultar_situacion2($e,$numero_planilladevengo_aguinaldo1)
		{
		/* 	$query01 = "SELECT * FROM `planilladevengo_aguinaldo`  WHERE codigo_empleado_planilladevengo_aguinaldo='$e'"; */
		$query01="SELECT `id`, `numero_planilladevengo_aguinaldo`, `fecha_planilladevengo_aguinaldo`, `fecha_desde_planilladevengo_aguinaldo`, `fecha_hasta_planilladevengo_aguinaldo`, `descripcion_planilladevengo_aguinaldo`, `codigo_empleado_planilladevengo_aguinaldo`, `nombre_empleado_planilladevengo_aguinaldo`, `id_empleado_planilladevengo_aguinaldo`, `dias_trabajo_planilladevengo_aguinaldo`, `sueldo_planilladevengo_aguinaldo`, `hora_extra_diurna_planilladevengo_aguinaldo`, `hora_extra_nocturna_planilladevengo_aguinaldo`, `hora_extra_domingo_planilladevengo_aguinaldo`, `hora_extra_domingo_nocturna_planilladevengo_aguinaldo`, `otro_devengo_aguinaldo_planilladevengo_aguinaldo`, `total_devengo_aguinaldo_planilladevengo_aguinaldo`, `descuento_isss_planilladevengo_aguinaldo`, `descuento_afp_planilladevengo_aguinaldo`, `descuento_renta_planilladevengo_aguinaldo`, `otro_descuento_planilladevengo_aguinaldo`, `total_descuento_planilladevengo_aguinaldo`, `total_liquidado_planilladevengo_aguinaldo`, `sueldo_renta_planilladevengo_aguinaldo`, `sueldo_isss_planilladevengo_aguinaldo`, `sueldo_afp_planilladevengo_aguinaldo`, `departamento_planilladevengo_aguinaldo`, `codigo_ubicacion_planilladevengo_aguinaldo`, `nombre_ubicacion_planilladevengo_aguinaldo`, `id_ubicacion_planilladevengo_aguinaldo`, `observacion_planilladevengo_aguinaldo`, `periodo_planilladevengo_aguinaldo`, `tipo_planilladevengo_aguinaldo`, `dias_incapacidad` FROM `planilladevengo_aguinaldo` WHERE id_empleado_planilladevengo_aguinaldo=$e and numero_planilladevengo_aguinaldo=$numero_planilladevengo_aguinaldo1";


			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			$outp = $sql->fetchAll();
			echo json_encode($outp);
		};
		$data01 = consultar_situacion2($consultarempleado,$numero_planilladevengo_aguinaldo);
		$result = [];


		
			/* ************ */
	break;
	case "consultard":
		/* ************ */
		function consultar_situacion2($e,$x,$z)
		{
			$query01="SELECT*FROM tbl_devengo_descuento_planilla_aguinaldo WHERE idempleado_devengo='$e' and codigo_planilla_devengo='$z' and tipo_valor LIKE '%$x%'";
			
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
			$query01="SELECT*FROM tbl_devengo_descuento_planilla_aguinaldo WHERE idempleado_devengo='$e' and codigo_planilla_devengo='$z' and tipo_valor LIKE '%$x%'";
	
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
		
				$data = getContent_devengo_aguinaldo();
				foreach ($data as $row) {
					$namecolumnas_situacion .= $row['Field'] . ",";
					$namecampos_situacion .= ":" . $row['Field'] . ",";
				}
				$stmt = Conexion::conectar()->prepare("INSERT INTO tbl_devengo_descuento_planilla_aguinaldo(" . trim($namecolumnas_situacion, ",") . ") VALUES (" . trim($namecampos_situacion, ",") . ")");

				
				$campos="";
				foreach ($data as $row) {
					$stmt->bindParam(":" . $row['Field'], $_POST["" . $row['Field'] . ""], PDO::PARAM_STR);
					$campos.= $_POST["" . $row['Field'] . ""].',';
					
				}

						/* 		echo "INSERT INTO tbl_devengo_aguinaldo_descuento_planilla(" . trim($namecolumnas_situacion, ",") . ") VALUES (" . trim($campos, ",") . ")";
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
					$data = getContent_devengo_aguinaldo();
					$test = "";
					foreach ($data as $row) {
						$namecolumnas_situacion .= $row['Field'] . "=" . ":" . $row['Field'] . ",";
						$test .= $row['Field'] . "='" . $_POST["" . $row['Field'] . ""] . "',";
					}
			
					$query01 = "UPDATE tbl_devengo_descuento_planilla_aguinaldo SET " . trim($test, ",") . " WHERE id LIKE $id";
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
		/* 	$query01 = "SELECT * FROM `planilladevengo_aguinaldo`  WHERE codigo_empleado_planilladevengo_aguinaldo='$e'"; */
			$query01="SELECT*FROM tbl_devengo_descuento_planilla_aguinaldo WHERE id='$e'";
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
		/* 	$query01 = "SELECT * FROM `planilladevengo_aguinaldo`  WHERE codigo_empleado_planilladevengo_aguinaldo='$e'"; */
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
		$query = "DELETE FROM `tbl_devengo_descuento_planilla_aguinaldo` WHERE id=$consultarempleado";
		echo $query;
		$stmt = Conexion::conectar()->prepare($query);
		$stmt->execute();
		/* ****************** */
		/* 		$query = "DELETE FROM `planilladevengo_aguinaldo` WHERE id_empleado_planilladevengo_aguinaldo=$idempleado";
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
		/* 	$query01 = "SELECT * FROM `planilladevengo_aguinaldo`  WHERE codigo_empleado_planilladevengo_aguinaldo='$e'"; */
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
		/* 	$query01 = "SELECT * FROM `planilladevengo_aguinaldo`  WHERE codigo_empleado_planilladevengo_aguinaldo='$e'"; */
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
		$data = getContent_devengo_aguinaldo();
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
	case "valordevengo_aguinaldo":

			/* ************************ */
			function consultar($e)
			{
				$query01="SELECT*FROM tbl_devengo_descuento_planilla_aguinaldo WHERE idempleado_devengo='$e' and descripcion_devengo_descuento_planilla LIKE '%vacacion%'";
	
			
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
			$query01="SELECT*FROM planilladevengo_aguinaldo ORDER by id DESC
			LIMIT 1";
			
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
			
		};
		$data01 = consultar_situacion2();
		$correlativo_dato="";
		foreach ($data01 as $value) {
		
				$numero = $value["numero_planilladevengo_aguinaldo"];
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
		$numero_planilladevengo_aguinaldo=$_POST["numero_planilladevengo_aguinaldo"];
		$id_empleado_planilladevengo_aguinaldo=$_POST["id_empleado_planilladevengo_aguinaldo"];
		$query = "DELETE FROM `planilladevengo_aguinaldo` WHERE numero_planilladevengo_aguinaldo=$numero_planilladevengo_aguinaldo and id_empleado_planilladevengo_aguinaldo=$id_empleado_planilladevengo_aguinaldo";
		echo $query;
		$stmt = Conexion::conectar()->prepare($query);
		$stmt->execute();

		/* ********************* */

		$query01 = "DELETE FROM `tbl_devengo_descuento_planilla_aguinaldo` WHERE codigo_planilla_devengo=$numero_planilladevengo_aguinaldo and idempleado_devengo=$id_empleado_planilladevengo_aguinaldo";
	
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
		$numero_planilladevengo_aguinaldo=$_POST["numero_planilladevengo_aguinaldo"];

		$query = "DELETE FROM `planilladevengo_aguinaldo` WHERE numero_planilladevengo_aguinaldo=$numero_planilladevengo_aguinaldo ";
		echo $query;
		$stmt = Conexion::conectar()->prepare($query);
		$stmt->execute();

		/* ********************* */

		$query01 = "DELETE FROM `tbl_devengo_descuento_planilla_aguinaldo` WHERE codigo_planilla_devengo=$numero_planilladevengo_aguinaldo ";
	
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
			$query01="SELECT SUM(total_liquidado_planilladevengo_aguinaldo) AS total_liquido FROM `planilladevengo_aguinaldo` where numero_planilladevengo_aguinaldo='$numero'";
	
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
			$query01="SELECT COUNT(*) AS total_empleados FROM `planilladevengo_aguinaldo` where numero_planilladevengo_aguinaldo='$numero'";
	
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