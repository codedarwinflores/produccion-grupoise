

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


$fecha_planilladevengo_admin="";
if ( isset($_POST["fecha_planilladevengo_admin"]) ) {
    $fecha_planilladevengo_admin = $_POST["fecha_planilladevengo_admin"];
}


$accion="";
if ( isset($_POST["accion01"]) ) {
    $accion = $_POST["accion01"];
}


$numero_planilladevengo_admin1="";
if ( isset($_POST["numero_planilladevengo_admin"]) ) {
	$numero_planilladevengo_admin1 = $_POST["numero_planilladevengo_admin"];

}


$codigo_empleado_planilladevengo_admin="";
if ( isset($_POST["codigo_empleado_planilladevengo_admin"]) ) {
    	$codigo_empleado_planilladevengo_admin = $_POST["codigo_empleado_planilladevengo_admin"];
		/* ********VALIDAR SI VA A AGREGAR O ACTUALIZAR************ */
		function validarempleado($e,$numero)
		{
					$query01 = "SELECT count(*) as valor FROM planilladevengo_admin WHERE codigo_empleado_planilladevengo_admin='$e' and numero_planilladevengo_admin=$numero";
					$sql = Conexion::conectar()->prepare($query01);
					$sql->execute();
					return $sql->fetchAll();
		}
		$existeempleado="";
		$data03 = validarempleado($codigo_empleado_planilladevengo_admin,$numero_planilladevengo_admin1);
		foreach ($data03 as $value) {
		$existeempleado.=$value["valor"];
		}
		if($existeempleado == "0"){
			$accion="insertar";
		}
		else{
			if($accion!=""){
				$accion="modificarexpres";
			}
			else{
				$accion="modificar";
			}
		}
		/* ********VALIDAR SI VA A AGREGAR O ACTUALIZAR************ */

}


function getContent()
{
	$query = "SHOW COLUMNS FROM planilladevengo_admin";
	$stmt = Conexion::conectar()->prepare($query);
	$stmt->execute();
	return $stmt->fetchAll();
	$stmt->close();
	$stmt = null;
}

function getContent_insert()
{
	$query = "SHOW COLUMNS FROM planilladevengo_admin WHERE Field NOT IN ('id')";
	$stmt = Conexion::conectar()->prepare($query);
	$stmt->execute();
	return $stmt->fetchAll();
	$stmt->close();
	$stmt = null;
}
function getContent_modificarexpres()
{
	$query = "SHOW COLUMNS FROM planilladevengo_admin WHERE Field NOT IN ('id') and Field NOT IN('numero_planilladevengo_admin')and Field NOT IN('fecha_planilladevengo_admin')and Field NOT IN('fecha_desde_planilladevengo_admin')and Field NOT IN('fecha_hasta_planilladevengo_admin')and 
	Field NOT IN('descripcion_planilladevengo_admin')and 
	Field NOT IN('dias_trabajo_planilladevengo_admin')and 
	Field NOT IN('sueldo_planilladevengo_admin')and 
	Field NOT IN('hora_extra_nocturna_planilladevengo_admin')and 
	Field NOT IN('hora_extra_domingo_planilladevengo_admin')and 
	Field NOT IN('hora_extra_domingo_nocturna_planilladevengo_admin')and 
	Field NOT IN('observacion_planilladevengo_admin')AND
	Field NOT IN('periodo_planilladevengo_admin')and
	Field NOT IN('tipo_planilladevengo_admin')and
	Field NOT IN('dias_incapacidad')and
	Field NOT IN('empleado_rango_desde')and
	Field NOT IN('empleado_rango_hasta')and
	Field NOT IN('septimo_admin')and
	Field NOT IN('dias_ausencia')and
	Field NOT IN('his_dias_trabajo_admin')and
	Field NOT IN('nombre_empleado_planilladevengo_admin')and
	Field NOT IN('id_empleado_planilladevengo_admin')and
	Field NOT IN('id_ubicacion_planilladevengo_admin')and
	Field NOT IN('codigo_ubicacion_planilladevengo_admin')and
	Field NOT IN('nombre_ubicacion_planilladevengo_admin')and
	Field NOT IN('fecha_gratificacion_admin')";
	$stmt = Conexion::conectar()->prepare($query);
	$stmt->execute();
	return $stmt->fetchAll();
	$stmt->close();
	$stmt = null;
}


function getContent_devengo_admin()
{
	$query = "SHOW COLUMNS FROM tbl_devengo_descuento_planilla_admin";
	$stmt = Conexion::conectar()->prepare($query);
	$stmt->execute();
	return $stmt->fetchAll();
	$stmt->close();
	$stmt = null;
}






switch ($accion) {
	case "lista":

		$tipo_planilladevengo_admin = $_POST["tipo_planilladevengo_admin"];
		$periodo_planilladevengo_admin = $_POST["periodo_planilladevengo_admin"];
		$numero_planilladevengo_admin = $_POST["numero_planilladevengo_admin"];
		$descripcion_planilladevengo_admin = $_POST["descripcion_planilladevengo_admin"];

		function situaciones($idempleado1,$fechadesde1,$fechahasta2) /* --SUMA DE DIAS AUSENCIA Y INCAPACIDAD */
		{
			$query01="SELECT sum(dias_ausencia_situacion) as sumaausencia, sum(incapacidad_situacion) as sumainca, sum(horas_ausencia_situacion) as sumahoraausencia, sum(hora_extra_situacion) as sumahoraextra, sum(dias_no_sueldo) as sumadias_no_sueldo FROM `situacion` WHERE  liquidado_situacion='No' and idempleado_situacion='$idempleado1'  and STR_TO_DATE(fecha_situacion, '%d-%m-%Y')  BETWEEN '$fechadesde1' AND '$fechahasta2' ";
			/* echo $query01; */
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};

		function situaciones_incapacidad($idempleado1,$fechadesde1,$fechahasta2) /* --SUMA DE DIAS AUSENCIA Y INCAPACIDAD */
		{
			$query01="SELECT sum(dias_ausencia_situacion) as sumaausencia, sum(incapacidad_situacion) as sumainca FROM `situacion` WHERE  liquidado_situacion='No' and idempleado_situacion='$idempleado1' and inicial_situacion='Inicial'  and STR_TO_DATE(fecha_situacion, '%d-%m-%Y')  BETWEEN '$fechadesde1' AND '$fechahasta2' ";
			/* echo $query01; */
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};

		function situaciones_dias_tra_inca($idempleado1,$fechadesde1,$fechahasta2) /* --SUMA DE DIAS AUSENCIA Y INCAPACIDAD */
		{
			$query01="SELECT sum(dias_tra_incapacidad) as sumadiastrabajados FROM `situacion` 
					 WHERE  situacion.incapacidad_situacion !='' and liquidado_situacion='No' and idempleado_situacion='$idempleado1' and inicial_situacion='Inicial'  and STR_TO_DATE(fecha_situacion, '%d-%m-%Y')  BETWEEN '$fechadesde1' AND '$fechahasta2' ";
			/* echo $query01; */
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};

		function situaciones_horas($idempleado1,$fechadesde1,$fechahasta2) /* --Horas ausencia */
		{
			$query01="SELECT sum(horas_ausencia_situacion) as horas_ausencia_situacion  FROM `situacion` 
					 WHERE  liquidado_situacion='No' and idempleado_situacion='$idempleado1'  and STR_TO_DATE(fecha_situacion, '%d-%m-%Y')  BETWEEN '$fechadesde1' AND '$fechahasta2'  and situacion.horas_ausencia_situacion !=''";
			/* echo $query01; */
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};


		function horas_cubiertar_extras($codigo_empleado1) /* --se busca horas ausencia que han sido cubiertas situaciones */
		{
			$query01="SELECT sum(hora_extra_situacion) as hora_extra_situacion FROM `situacion` WHERE cubrir_situacion LIKE '%$codigo_empleado1%' and situacion.hora_extra_situacion != ''";
	
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};
		function horas_cubiertar_normal($codigo_empleado1) /* --se busca horas ausencia que han sido cubiertas situaciones */
		{
			$query01="SELECT sum(hora_normales_situacion) as hora_normales_situacion FROM `situacion` WHERE cubrir_situacion LIKE '%$codigo_empleado1%' and situacion.hora_normales_situacion != ''";
			/* echo $query01; */
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};

		function recibo($idempleado1,$fechadesde1,$fechahasta2) /* -- */
		{

			$query01="SELECT `id`, `fecha_descuento_recibo`, `empleado_recibo`, `descuento_recibo`, `numero_recibo`, `valor_recibo`, `observacion_recibo`, `fecha_hecho_recibo`, `hora_hecho_recibo`, `numero_planilla_liquidado`, `liquidado_recibo`, `anular_recibo`, `user_recibo` FROM `recibos` WHERE liquidado_recibo='No' and anular_recibo='No' and anular_recibo='No' and empleado_recibo='$idempleado1'  and STR_TO_DATE(fecha_descuento_recibo, '%d-%m-%Y')  BETWEEN '$fechadesde1' AND '$fechahasta2' ";
		
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};

		function bonoubicacion($codigoempleado1) /* -- */
		{

			$query01="SELECT tbl_ubicaciones_agentes_asignados.id as idubicacionagente, tbl_clientes_ubicaciones.* FROM `tbl_ubicaciones_agentes_asignados`,tbl_clientes_ubicaciones WHERE tbl_ubicaciones_agentes_asignados.idubicacion_agente=tbl_clientes_ubicaciones.id and tbl_ubicaciones_agentes_asignados.codigo_agente='$codigoempleado1'  group by tbl_ubicaciones_agentes_asignados.codigo_agente";
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};

		
		function bonopornofaltar($codigoempleado1) /* -- */
		{
			$query01="SELECT tbl_ubicaciones_agentes_asignados.id as idubicacionagente, tbl_devengo_ubicacion.* FROM `tbl_ubicaciones_agentes_asignados`,tbl_devengo_ubicacion WHERE tbl_ubicaciones_agentes_asignados.idubicacion_agente=tbl_devengo_ubicacion.idubicacion_devengo and tbl_ubicaciones_agentes_asignados.codigo_agente='$codigoempleado1' group by tbl_ubicaciones_agentes_asignados.codigo_agente";
	
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};

		function data_situaciones($idempleado1,$fechadesde1,$fechahasta2) /* --ID DE REGISTROS A MODIFICAR */
		{

			$query01="SELECT*FROM `situacion` WHERE  liquidado_situacion='No' and idempleado_situacion='$idempleado1'  and STR_TO_DATE(fecha_situacion, '%d-%m-%Y')  BETWEEN '$fechadesde1' AND '$fechahasta2' ";
			/* echo $query01; */
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};  

		
		/* ***CONSULTAR DEVENGO02***** */
		function consultar_devengo2($iddevengo1)
		{
			$query01 = "SELECT `id`, `codigo`, `descripcion`, `porcentaje`, `tipo`, `cargo_abono`, `cuenta_contable`, `isss_devengo`, `afp_devengo`, `renta_devengo` FROM `tbl_devengo_descuento` WHERE id='$iddevengo1'";
			
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};
		/* *************** */

		/* ******************** */
		function devengo_anticipo($idempleado1)
		{
			$query01 = "SELECT * FROM `tbl_devengo_descuento_planilla` WHERE idempleado_devengo='$idempleado1' and codigo_devengo_descuento_planilla='0022' order by codigo_planilla_devengo DESC limit 1";
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};
		/* *************** */

		
		/* ***Devegos y descuentos del empleado con tipo***** */
		function consultar_devengo_empleado($periodo1,$fechadesde1,$fechahasta2,$idempleado1)
		{
			/* $query01 = "SELECT tbl_empleados_devengos_descuentos.id AS id, `id_empleado`, `id_tipo_devengo_descuento`, `valor`, `fecha_caducidad`, `referencia`, `tipodescuento` ,tbl_devengo_descuento.*
			FROM `tbl_empleados_devengos_descuentos` , tbl_devengo_descuento 
			WHERE tipodescuento='$periodo1' and id_empleado='$idempleado1' and tbl_empleados_devengos_descuentos.id_tipo_devengo_descuento=tbl_devengo_descuento.id and  fecha_caducidad BETWEEN '$fechadesde1' AND '$fechahasta2'";
			 */
			$query01 = "SELECT tbl_empleados_devengos_descuentos.id AS id, `id_empleado`, `id_tipo_devengo_descuento`, `valor`, `fecha_caducidad`, `referencia`, `tipodescuento` ,tbl_devengo_descuento.* FROM `tbl_empleados_devengos_descuentos` , tbl_devengo_descuento WHERE id_empleado='$idempleado1' and tbl_empleados_devengos_descuentos.id_tipo_devengo_descuento=tbl_devengo_descuento.id and  fecha_caducidad >= '$fechadesde1'";
			/* echo $query01; */
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};
		/* *************** */

		
		/* ***Devegos y descuentos del empleado sin tipo***** */
		function consultar_devengo_emple_sintipo($periodo1,$fechadesde1,$fechahasta2,$idempleado1)
		{
			$query01 = "SELECT tbl_empleados_devengos_descuentos.id AS id, `id_empleado`, `id_tipo_devengo_descuento`, `valor`, `fecha_caducidad`, `referencia`, `tipodescuento` ,tbl_devengo_descuento.* FROM `tbl_empleados_devengos_descuentos` , tbl_devengo_descuento WHERE id_empleado='$idempleado1' and tbl_empleados_devengos_descuentos.id_tipo_devengo_descuento=tbl_devengo_descuento.id and  fecha_caducidad BETWEEN '$fechadesde1' AND '$fechahasta2'";
			
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};
		/* *************** */

		function afp($e)
						{
							$query01="SELECT*FROM afp WHERE codigo='$e'";
							$sql = Conexion::conectar()->prepare($query01);
							$sql->execute();
							return $sql->fetchAll();
						};
					


		/* ********************* */

		function configuracion()
			{
				$query01="SELECT*FROM configuracion";
				$sql = Conexion::conectar()->prepare($query01);
				$sql->execute();
				return $sql->fetchAll();
			};
			$data_configuracion = configuracion();
			$porcentaje_isss="";
			$tope_isss=0;
			$dias_maximo_incapacidad=0;
			$porcentaje_dias_incapacidad=0;
			foreach ($data_configuracion as $valueconfig) {
				$porcentaje_isss.=floatval($valueconfig["porcentaje_isss"]);
				$tope_isss.=$valueconfig["tope_isss"];
				$dias_maximo_incapacidad.=$valueconfig["dias_maximo_incapacidad"];
				$porcentaje_dias_incapacidad.=$valueconfig["porcentaje_dias_incapacidad"];

			}


		/* ************************ */
		function isr($salario,$periodo)
			{
				$query01="SELECT isr.id as idisr, `codigo`, `nombre_rango`, `periodo_pago`, `salario_desde`, `salario_hasta`, `base_1`, `tasa_sobre_excedente`, `base_2`, periodo_de_pago.id as idperiodo FROM `isr`, periodo_de_pago WHERE isr.periodo_pago=periodo_de_pago.id and nombre_periodo='$periodo' and '$salario'>=salario_desde and '$salario'<=salario_hasta";
				
				$sql = Conexion::conectar()->prepare($query01);
				$sql->execute();
				return $sql->fetchAll();
			};
		/* ************************ */

		/* ************************ */
		function cargo_empleado($id1)
			{
				$query01="SELECT `id`, `descripcion`, `nivel`, `codigo_contable`, `personal_asignado`, `pago_feriados`, `calculo` FROM `cargos_desempenados` WHERE id='$id1'";
				$sql = Conexion::conectar()->prepare($query01);
				$sql->execute();
				return $sql->fetchAll();
			};
		/* ************************ */

		
		/* ************************ */
		function viatico_permanente($id_tipo_devengo1,$id_empleado1)
			{
				$query01="SELECT `id`, `id_empleado`, `id_tipo_devengo_descuento`, `valor`, `fecha_caducidad`, `referencia`, `tipodescuento` FROM `tbl_empleados_devengos_descuentos` WHERE id_empleado='$id_empleado1' and id_tipo_devengo_descuento='$id_tipo_devengo1'";
			
				$sql = Conexion::conectar()->prepare($query01);
				$sql->execute();
				return $sql->fetchAll();
			};
		/* ************************ */

		
		/* ************************ */
		function dias_feriados()
			{
				$query01="SELECT `id`, `num_dias`, `fecha_desde`, `fecha_hasta` FROM `dias_feriados` ";
				$sql = Conexion::conectar()->prepare($query01);
				$sql->execute();
				return $sql->fetchAll();
			};
		/* ************************ */

		
		/* ************************ */
		function ausencia_dias_feriados($idempleado1)
			{
				$query01="SELECT `id`, `empleado_ausencia`, `fecha_feriado` FROM `ausenciadiasferiados` WHERE empleado_ausencia='$idempleado1' ";
				
				$sql = Conexion::conectar()->prepare($query01);
				$sql->execute();
				return $sql->fetchAll();
			};
		/* ************************ */


		/* consulta maestra lista*/
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
			FROM `tbl_empleados` where estado='2' ";
		
			/* echo $query01; */
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};
		$newDate = date("Y-m-d", strtotime($fecha_planilladevengo_admin));
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
		$values_situacion="";
		$id_situaciones="";
		$idrecibo="";
		foreach ($data01 as $value) {




			/* *******suma de dias en SITUACION */
				$codigo_empleado=$value["codigo_empleado"];
				$idcargo_empleado=$value["nivel_cargo"];
				$salario_empleado=$value["sueldo"];
				$idempleado=$value["idempleado"];
				$hora_extra_diurna=$value["hora_extra_diurna"];


				$fechadesde02 = date("Y-m-d", strtotime($_POST["fechaperiodo1"]));
				$mes = date("m", strtotime($_POST["fechaperiodo1"]));
				$anio = date("Y", strtotime($_POST["fechaperiodo1"]));
				$fecha_desde_format=$anio."-".$mes."-"."01";
				$fechahasta02= date("Y-m-d", strtotime($_POST["fechaperiodo2"]));

				$datasituacion = situaciones($codigo_empleado,$fecha_desde_format,$fechahasta02);
				$datasituacion_inca = situaciones_incapacidad($codigo_empleado,$fecha_desde_format,$fechahasta02);
				$datasituacion_dias_tra = situaciones_dias_tra_inca($codigo_empleado,$fecha_desde_format,$fechahasta02);

				$dias_ausencia_situ="";
				$dias_incapacidad_situ="";
				$dias_tra_inca="";

				$horas_ausencia="";
				$horas_extras="";

				foreach ($datasituacion as $valuesituacion) {
					$dias_ausencia_situ.=floatval($valuesituacion["sumaausencia"])+floatval($valuesituacion["sumadias_no_sueldo"]);
					/* $dias_incapacidad_situ.=$valuesituacion["sumainca"]; */
					$horas_ausencia.=$valuesituacion["sumahoraausencia"];
					$horas_extras.=$valuesituacion["sumahoraextra"];
				}
				/* situaciones incapacidad */
				foreach ($datasituacion_inca as $valuesituacion) {
					$dias_incapacidad_situ.=$valuesituacion["sumainca"];
				}
				/* situaciones dias trabajados de incapacidad */
				foreach ($datasituacion_dias_tra as $valuesituacion) {
					$dias_tra_inca.=$valuesituacion["sumadiastrabajados"];
				}

			/* **************************** */
				/* REGISTROS A MODIFICAR DE SITUACIONES */
				$data_situaciones2 = data_situaciones($codigo_empleado,$fecha_desde_format,$fechahasta02);
				$fecha_ausencia="";
				$fecha_incapacidad="";
				$dias_ausen="";
				$dias_inca="";
				foreach ($data_situaciones2 as $valuedata_situacion) {
					$iddata_situacion=$valuedata_situacion["id"];
					$values_situacion.="";
					$id_situaciones.="$iddata_situacion,";

					$dias_ausen.=$valuedata_situacion["dias_ausencia_situacion"];
					$dias_inca.=$valuedata_situacion["incapacidad_situacion"];

			
					if(!empty($valuedata_situacion["dias_ausencia_situacion"])){
						$fecha_ausencia.=$valuedata_situacion["fecha_situacion"]."-";
					}
					if(!empty($valuedata_situacion["incapacidad_situacion"])){
						$fecha_incapacidad.=$valuedata_situacion["fecha_situacion"]."-";
					}
				}
				$comentario_obser="";
				if(!empty($dias_ausen)){
					$comentario_obser.="Fechas dias ausencia:".trim($fecha_ausencia, "-")."\n";
				}
				if(!empty($dias_inca)){
					$comentario_obser.="Fechas dias Incapacidad:".trim($fecha_incapacidad, "-");
					
				}
				$observacion=$comentario_obser;
			/* **************************** */

			/* ********DEVENGO EMPLEADOS********* */

				
				$datadevengoempleado = consultar_devengo_empleado($periodo_planilladevengo_admin,$fecha_desde_format,$fechahasta02,$idempleado);
				$valordevengoempleado="";
				$iddevengo="";
				$valorisss="";
				$valorafp="";
				$valorrenta="";
				$viaticos_empleados="0";
			
				foreach ($datadevengoempleado as $valuesdevengoempleado) {
					$tipodescuento=$valuesdevengoempleado["tipodescuento"];
					if($tipodescuento==$periodo_planilladevengo_admin || $tipodescuento=="Siempre"){

						$iddevengo=$valuesdevengoempleado["id_tipo_devengo_descuento"];	
						$isss=$valuesdevengoempleado["isss_devengo"];
						$afp=$valuesdevengoempleado["afp_devengo"];
						$renta=$valuesdevengoempleado["renta_devengo"];

						if($isss=="Si"){
							$valorisss=floatval($valuesdevengoempleado["valor"]);
						}
						if($afp=="Si"){
							$valorafp=floatval($valuesdevengoempleado["valor"]);
						}
						if($renta=="Si"){
							$valorrenta=floatval($valuesdevengoempleado["valor"]);
						}
						$valordevengoempleado=$valuesdevengoempleado["valor"];
						
						if($iddevengo=="2"){
							$viaticos_empleados.=$valuesdevengoempleado["valor"];
						}
					}
				}

		
			/* ************************************* */

			/* ************************** */
			$fechaEnvio= date("Y-m-d", strtotime($value["fecha_contratacion"]));
			$fechaActual = date("Y-m-d", strtotime($fecha_planilladevengo_admin));
			$datetime1 = date_create($fechaEnvio);
			$datetime2 = date_create($fechaActual);
			$contador = date_diff($datetime1, $datetime2);
			/* lunes-viernes */
			$workingDays = 0;
			$startTimestamp = strtotime($fechaEnvio);
			$endTimestamp = strtotime($fechaActual);
			for ($i = $startTimestamp; $i <= $endTimestamp; $i = $i + (60 * 60 * 24)) {
				if (date("N", $i) <= 5) $workingDays = $workingDays + 1;
			}
			/* *********** */
			/* ****sabado-domingo */
			$weekendDays = 0;
			$startTimestamp = strtotime($fechaEnvio);
			$endTimestamp = strtotime($fechaActual);
			for ($i = $startTimestamp; $i <= $endTimestamp; $i = $i + (60 * 60 * 24)) {
				if (date("N", $i) > 5) $weekendDays = $weekendDays + 1;
			}
			/* ********** */
			$dias_trabajo= floatval($workingDays)+floatval($weekendDays);
			$differenceFormat = '%a';
			/* $dias_trabajo=$contador->format($differenceFormat); */
			$tiempotrabajo="";
			if($dias_trabajo>='15'){
				$dias_trabajo_planilladevengo_admin='15';
				$tiempotrabajo="viejo";
			}
			else{
				$dias_trabajo_planilladevengo_admin=$dias_trabajo;
				$tiempotrabajo="nuevo";
			}
		   
			$sueldo_diario=floatval($value["sueldo_diario"]);
			$dias_incapacidad=floatval($dias_incapacidad_situ);
			$dias_ausencia=floatval($dias_ausencia_situ);
			$total_dias_trabajados = floatval($dias_trabajo_planilladevengo_admin)-$dias_incapacidad-$dias_ausencia;

			if($total_dias_trabajados<=0){
				$total_dias_trabajados=0;
			}
			
			$sueldo_total=$total_dias_trabajados*$sueldo_diario;
			

			/* ********PORCENTAJES ISSS AFP RENTA****** */
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

			/* *********AFP******* */

			$data_afp = afp($tipo_afp);
			$porcentaje_afp=0;
				foreach ($data_afp as $valueafp) {
					$porcentaje_afp.=floatval($valueafp["porcentaje"]);
				}
				/*--------------------------------  */

					
				$calcularporcentaje_afp=$porcentaje_afp/100;/* --afp */
				$calcularporcentaje_isss=$porcentaje_isss/100;
				$pensionado_empleado=$value["pensionado_empleado"];
				$renta_final=0;
				$salario_isss=0;
				$salario_afp=0;

				$descuento_isss=0;
				$descuento_afp=0;
				if($pensionado_empleado=="Si"){
					$renta_final=floatval($valorrenta)+floatval($sueldo_total);/* sujeto renta si  es pensionado */
	
				}
				else{
					
					$salario_isss=floatval($valorisss)+$sueldo_total;/* sujeto iss */
					$salario_afp=floatval($valorafp)+$sueldo_total;/* sujeto afp */

					$descuento_isss=$salario_isss*$calcularporcentaje_isss;/* descuento isss */
					$descuento_afp=$salario_afp*$calcularporcentaje_afp;/* descuento afp */

					$salario_renta=floatval($valorrenta)+$sueldo_total;
					$sujeto_renta=$salario_renta-$descuento_isss-$descuento_afp;
					$renta_final=$sujeto_renta;/* sujeto renta si no es pensionado */
				}
	
			/* ********************* */
				$dataisr = isr($renta_final,$periodo_pago);
				$porcentaje_base1=0;
				$porcentaje_base2=0;
				$tasa_sobre_excedente=0;
				foreach ($dataisr as $valueisr) {
					$porcentaje_base1=floatval($valueisr["base_1"]);
					$porcentaje_base2=floatval($valueisr["base_2"]);
					$tasa_sobre_excedente=floatval($valueisr["tasa_sobre_excedente"]);
				}

				$porcentaje_tasa_excedente=$tasa_sobre_excedente/100;
				$renta_menos_base2=$renta_final-$porcentaje_base2;
				$tasa_por_exedente=$renta_menos_base2*$porcentaje_tasa_excedente;
				$descuento_renta=$tasa_por_exedente+$porcentaje_base1;/* descuento renta */


			/* echo $porcentaje_isss.",".$porcentaje_afp.",".$porcentaje_base1.",".$porcentaje_base2.",".$tasa_sobre_excedente; */
			/* **********************  */

			/* VERIFICA LAS HORAS DE AUSENCIA CUBIERTAS O NO CUBIERTAS O SI FUERON CUBIERTAS DE MANERA DE HORA NORMAL*/
			$horas_no_cubiertas="";
			$horas_cubiertas_extras=0;
			$horas_cubiertas_normal=0;
			$total_horas_ausencia=0;
			$suma_horas=0;
			$total_horas_cubiertas_extras="";
			$total_horas_cubiertas_normal="";


			/* ----------HORAS EXTRAS------------------ */
			$data_hora_cubi = horas_cubiertar_extras($codigo_empleado);	
			foreach ($data_hora_cubi as $value_horas_cubi) {
				$horas_cubiertas_extras= floatval($value_horas_cubi["hora_extra_situacion"]);
				$total_horas_cubiertas_extras.=$value_horas_cubi["hora_extra_situacion"];
			}
			/* ----------HORAS NORMALES------------------ */
			$data_hora_normales = horas_cubiertar_normal($codigo_empleado);	
			foreach ($data_hora_normales as $value_horas_cubi) {
				$horas_cubiertas_normal= floatval($value_horas_cubi["hora_normales_situacion"]);
				$total_horas_cubiertas_normal.=$value_horas_cubi["hora_normales_situacion"];
			}

			/* ---------HORAS AUSENCIA TOTAL------------- */
			$data_hora_aus = situaciones_horas($codigo_empleado,$fecha_desde_format,$fechahasta02);
			foreach ($data_hora_aus as $value_horas_aus) {
				$horas_ausencia_situacion = $value_horas_aus["horas_ausencia_situacion"];
				$total_horas_ausencia .= $value_horas_aus["horas_ausencia_situacion"];
			
				/* --------------------- */

			}


			/* ------------------------------ */
						/* HORAS EXTRAS CUBIERTAS DE AUSENCIAS */
						if($total_horas_cubiertas_extras>0){

												$datadevengo = consultar_devengo2("23");
												$codigo_devengo="";
												$descipcion_devengo="";
												$isss_devengo="";
												$afp_devengo="";
												$renta_devengo="";
												$id_devengo="";
												$suma_resta="";
												foreach ($datadevengo as $valuedevengo) {
													$id_devengo.=$valuedevengo["id"];
													$codigo_devengo.=$valuedevengo["codigo"];
													$descipcion_devengo.=$valuedevengo["descripcion"];
													$isss_devengo.=$valuedevengo["isss_devengo"];
													$afp_devengo.=$valuedevengo["afp_devengo"];
													$renta_devengo.=$valuedevengo["renta_devengo"];
													$suma_resta.=$valuedevengo["tipo"];
												}

														$total_valor_horas_aus=floatval($hora_extra_diurna)*floatval($total_horas_cubiertas_extras);

														$codigo_devengo_descuento_planilla=$codigo_devengo;
														$descripcion_devengo_descuento_planilla=$descipcion_devengo;
														$tipo_devengo_descuento_planilla=$id_devengo;
														$isss_devengo_devengo_descuento_planilla=$isss_devengo;
														$afp_devengo_devengo_descuento_planilla=$afp_devengo;
														$renta_devengo_devengo_descuento_planilla=$renta_devengo;
														$idempleado_devengo=$value["idempleado"];
														$valor_devengo_planilla=$total_valor_horas_aus;
														$tipo_valor=$suma_resta;
														$codigo_planilla_devengo=$numero_planilladevengo_admin;
														
														$values_devengo.="('$codigo_devengo_descuento_planilla', '$descripcion_devengo_descuento_planilla', '$tipo_devengo_descuento_planilla', '$isss_devengo_devengo_descuento_planilla', '$afp_devengo_devengo_descuento_planilla', '$renta_devengo_devengo_descuento_planilla', '$idempleado_devengo', '$valor_devengo_planilla', '$tipo_valor', '$codigo_planilla_devengo','','','','','','','$total_horas_cubiertas_extras','$hora_extra_diurna'),";

						}
			/* ------------------------------ */

				/* ------------------------------ */
					/* HORAS NORMALES CUBIERTAS DE AUSENCIAS */
					if($total_horas_cubiertas_normal>0){

									$datadevengo = consultar_devengo2("23");
									$codigo_devengo="";
									$descipcion_devengo="";
									$isss_devengo="";
									$afp_devengo="";
									$renta_devengo="";
									$id_devengo="";
									$suma_resta="";
									foreach ($datadevengo as $valuedevengo) {
										$id_devengo.=$valuedevengo["id"];
										$codigo_devengo.=$valuedevengo["codigo"];
										$descipcion_devengo.=$valuedevengo["descripcion"];
										$isss_devengo.=$valuedevengo["isss_devengo"];
										$afp_devengo.=$valuedevengo["afp_devengo"];
										$renta_devengo.=$valuedevengo["renta_devengo"];
										$suma_resta.=$valuedevengo["tipo"];
									}

									$sueldo_viatico=floatval($salario_empleado)+floatval($viaticos_empleados);
									$sueldo_diario02=floatval($sueldo_viatico)/15;
									$sueldo_dia_pagar=floatval($sueldo_diario02)/12;
									
									$total_valor_horas_aus=floatval($sueldo_dia_pagar)*floatval($total_horas_cubiertas_normal);
								


									$codigo_devengo_descuento_planilla=$codigo_devengo;
									$descripcion_devengo_descuento_planilla=$descipcion_devengo;
									$tipo_devengo_descuento_planilla=$id_devengo;
									$isss_devengo_devengo_descuento_planilla=$isss_devengo;
									$afp_devengo_devengo_descuento_planilla=$afp_devengo;
									$renta_devengo_devengo_descuento_planilla=$renta_devengo;
									$idempleado_devengo=$value["idempleado"];
									$valor_devengo_planilla=$total_valor_horas_aus;
									$tipo_valor=$suma_resta;
									$codigo_planilla_devengo=$numero_planilladevengo_admin;

									$values_devengo.="('$codigo_devengo_descuento_planilla', '$descripcion_devengo_descuento_planilla', '$tipo_devengo_descuento_planilla', '$isss_devengo_devengo_descuento_planilla', '$afp_devengo_devengo_descuento_planilla', '$renta_devengo_devengo_descuento_planilla', '$idempleado_devengo', '$valor_devengo_planilla', '$tipo_valor', '$codigo_planilla_devengo','','','','','','','$total_horas_cubiertas_normal','$sueldo_dia_pagar'),";
									

					}
				/* ------------------------------ */

			/* HORAS AUSENCIAS NO CUBIERTAS*/
			$suma_horas=floatval($total_horas_cubiertas_extras)+floatval($total_horas_cubiertas_normal);
			$horas_no_cubiertas=floatval($total_horas_ausencia)-floatval($suma_horas);
				if($horas_no_cubiertas>0){
						$datadevengo = consultar_devengo2("23");
						$codigo_devengo="";
						$descipcion_devengo="";
						$isss_devengo="";
						$afp_devengo="";
						$renta_devengo="";
						$id_devengo="";
						$suma_resta="";
						foreach ($datadevengo as $valuedevengo) {
							$id_devengo.=$valuedevengo["id"];
							$codigo_devengo.=$valuedevengo["codigo"];
							$descipcion_devengo.=$valuedevengo["descripcion"];
							$isss_devengo.=$valuedevengo["isss_devengo"];
							$afp_devengo.=$valuedevengo["afp_devengo"];
							$renta_devengo.=$valuedevengo["renta_devengo"];
							$suma_resta.=$valuedevengo["tipo"];
						}

						$sueldo_viatico=floatval($salario_empleado)+floatval($viaticos_empleados);
						$sueldo_diario02=floatval($sueldo_viatico)/15;
						$sueldo_dia_pagar=floatval($sueldo_diario02)/12;
						$total_valor_horas_aus=floatval($sueldo_dia_pagar)*floatval($horas_no_cubiertas);

						$codigo_devengo_descuento_planilla=$codigo_devengo;
						$descripcion_devengo_descuento_planilla=$descipcion_devengo;
						$tipo_devengo_descuento_planilla=$id_devengo;
						$isss_devengo_devengo_descuento_planilla=$isss_devengo;
						$afp_devengo_devengo_descuento_planilla=$afp_devengo;
						$renta_devengo_devengo_descuento_planilla=$renta_devengo;
						$idempleado_devengo=$value["idempleado"];
						$valor_devengo_planilla=$total_valor_horas_aus;
						$tipo_valor=$suma_resta;
						$codigo_planilla_devengo=$numero_planilladevengo_admin;

						$values_devengo.="('$codigo_devengo_descuento_planilla', '$descripcion_devengo_descuento_planilla', '$tipo_devengo_descuento_planilla', '$isss_devengo_devengo_descuento_planilla', '$afp_devengo_devengo_descuento_planilla', '$renta_devengo_devengo_descuento_planilla', '$idempleado_devengo', '$valor_devengo_planilla', '$tipo_valor', '$codigo_planilla_devengo','','','','','','','$horas_no_cubiertas','$sueldo_dia_pagar'),";

				}
			/* --------------------- */

			/* DIAS TRABAJADOS EN INCAPACIDAD */

			if($dias_tra_inca>0){
				$datadevengo = consultar_devengo2("31");
				$codigo_devengo="";
				$descipcion_devengo="";
				$isss_devengo="";
				$afp_devengo="";
				$renta_devengo="";
				$id_devengo="";
				$suma_resta="";
				foreach ($datadevengo as $valuedevengo) {
					$id_devengo.=$valuedevengo["id"];
					$codigo_devengo.=$valuedevengo["codigo"];
					$descipcion_devengo.=$valuedevengo["descripcion"];
					$isss_devengo.=$valuedevengo["isss_devengo"];
					$afp_devengo.=$valuedevengo["afp_devengo"];
					$renta_devengo.=$valuedevengo["renta_devengo"];
					$suma_resta.=$valuedevengo["tipo"];
				}
				$valor_devengo_incapacidad=floatval($sueldo_diario)*floatval($dias_tra_inca);
				
				$codigo_devengo_descuento_planilla=$codigo_devengo;
				$descripcion_devengo_descuento_planilla=$descipcion_devengo;
				$tipo_devengo_descuento_planilla=$id_devengo;
				$isss_devengo_devengo_descuento_planilla=$isss_devengo;
				$afp_devengo_devengo_descuento_planilla=$afp_devengo;
				$renta_devengo_devengo_descuento_planilla=$renta_devengo;
				$idempleado_devengo=$value["idempleado"];
				$valor_devengo_planilla=$valor_devengo_incapacidad;
				$tipo_valor=$suma_resta;
				$codigo_planilla_devengo=$numero_planilladevengo_admin;
				$values_devengo.="('$codigo_devengo_descuento_planilla', '$descripcion_devengo_descuento_planilla', '$tipo_devengo_descuento_planilla', '$isss_devengo_devengo_descuento_planilla', '$afp_devengo_devengo_descuento_planilla', '$renta_devengo_devengo_descuento_planilla', '$idempleado_devengo', '$valor_devengo_planilla', '$tipo_valor', '$codigo_planilla_devengo','','','$dias_tra_inca','$sueldo_diario','','','',''),";
			}
			/* DIAS INCAPACIDAD */
			if($dias_incapacidad>0){

					$datadevengo = consultar_devengo2("33");
					$codigo_devengo="";
					$descipcion_devengo="";
					$isss_devengo="";
					$afp_devengo="";
					$renta_devengo="";
					$id_devengo="";
					$suma_resta="";
					foreach ($datadevengo as $valuedevengo) {
						$id_devengo.=$valuedevengo["id"];
						$codigo_devengo.=$valuedevengo["codigo"];
						$descipcion_devengo.=$valuedevengo["descripcion"];
						$isss_devengo.=$valuedevengo["isss_devengo"];
						$afp_devengo.=$valuedevengo["afp_devengo"];
						$renta_devengo.=$valuedevengo["renta_devengo"];
						$suma_resta.=$valuedevengo["tipo"];
					}

					$valor_devengo_incapacidad=0;
					$sueldo_porcentaje=0;
					if($dias_incapacidad>=$dias_maximo_incapacidad){
						$sueldo_porcentaje=$sueldo_diario*$porcentaje_dias_incapacidad;
						$valor_devengo_incapacidad=$sueldo_porcentaje*$dias_maximo_incapacidad;

					}
					else{
						$sueldo_porcentaje=$sueldo_diario*$porcentaje_dias_incapacidad;
						$valor_devengo_incapacidad=$sueldo_porcentaje*$dias_incapacidad;
					}

					$codigo_devengo_descuento_planilla=$codigo_devengo;
					$descripcion_devengo_descuento_planilla=$descipcion_devengo;
					$tipo_devengo_descuento_planilla=$id_devengo;
					$isss_devengo_devengo_descuento_planilla=$isss_devengo;
					$afp_devengo_devengo_descuento_planilla=$afp_devengo;
					$renta_devengo_devengo_descuento_planilla=$renta_devengo;
					$idempleado_devengo=$value["idempleado"];
					$valor_devengo_planilla=$valor_devengo_incapacidad;
					$tipo_valor=$suma_resta;
					$codigo_planilla_devengo=$numero_planilladevengo_admin;

					$values_devengo.="('$codigo_devengo_descuento_planilla', '$descripcion_devengo_descuento_planilla', '$tipo_devengo_descuento_planilla', '$isss_devengo_devengo_descuento_planilla', '$afp_devengo_devengo_descuento_planilla', '$renta_devengo_devengo_descuento_planilla', '$idempleado_devengo', '$valor_devengo_planilla', '$tipo_valor', '$codigo_planilla_devengo','','','','','$dias_maximo_incapacidad','$sueldo_porcentaje','',''),";

			}
			
			if(empty($iddevengo)){
			}
			else{
				/* ******Datos del devengo********* */
				foreach ($datadevengoempleado as $valuesdevengoempleado) {
					$tipodescuento=$valuesdevengoempleado["tipodescuento"];
					if($tipodescuento==$periodo_planilladevengo_admin || $tipodescuento=="Siempre"){
						$iddevengo=$valuesdevengoempleado["id_tipo_devengo_descuento"];	
						$valordevengoempleado=$valuesdevengoempleado["valor"];

						/* ************* */

							$datadevengo = consultar_devengo2($iddevengo);
							$codigo_devengo="";
							$descipcion_devengo="";
							$isss_devengo="";
							$afp_devengo="";
							$renta_devengo="";
							$id_devengo="";
							$suma_resta="";
							foreach ($datadevengo as $valuedevengo) {
								$id_devengo.=$valuedevengo["id"];
								$codigo_devengo.=$valuedevengo["codigo"];
								$descipcion_devengo.=$valuedevengo["descripcion"];
								$isss_devengo.=$valuedevengo["isss_devengo"];
								$afp_devengo.=$valuedevengo["afp_devengo"];
								$renta_devengo.=$valuedevengo["renta_devengo"];
								$suma_resta.=$valuedevengo["tipo"];

							}

							
							$codigo_devengo_descuento_planilla=$codigo_devengo;
							$descripcion_devengo_descuento_planilla=$descipcion_devengo;
							$tipo_devengo_descuento_planilla=$id_devengo;
							$isss_devengo_devengo_descuento_planilla=$isss_devengo;
							$afp_devengo_devengo_descuento_planilla=$afp_devengo;
							$renta_devengo_devengo_descuento_planilla=$renta_devengo;
							$idempleado_devengo=$value["idempleado"];
							$valor_devengo_planilla=$valordevengoempleado;
							$tipo_valor=$suma_resta;
							$codigo_planilla_devengo=$numero_planilladevengo_admin;

							$values_devengo.="('$codigo_devengo_descuento_planilla', '$descripcion_devengo_descuento_planilla', '$tipo_devengo_descuento_planilla', '$isss_devengo_devengo_descuento_planilla', '$afp_devengo_devengo_descuento_planilla', '$renta_devengo_devengo_descuento_planilla', '$idempleado_devengo', '$valor_devengo_planilla', '$tipo_valor', '$codigo_planilla_devengo','','','','','','','',''),";

						/* ************ */


					}
				}
				/* **************************** */
			}


			/* DEVENGO QUINCENAL PLANILLA ANTICIPO */

			/* ************* */

			$datadevengo_anticipo = devengo_anticipo($idempleado);
			foreach ($datadevengo_anticipo as $valuedevengo_anticipo) {
				$devengoquincenal=$valuedevengo_anticipo["valor_devengo_planilla"];
				if($devengoquincenal>0){
						/* ************* */
						$datadevengo = consultar_devengo2('25');
						$codigo_devengo="";
						$descipcion_devengo="";
						$isss_devengo="";
						$afp_devengo="";
						$renta_devengo="";
						$id_devengo="";
						$suma_resta="";
						foreach ($datadevengo as $valuedevengo) {
							$id_devengo.=$valuedevengo["id"];
							$codigo_devengo.=$valuedevengo["codigo"];
							$descipcion_devengo.=$valuedevengo["descripcion"];
							$isss_devengo.=$valuedevengo["isss_devengo"];
							$afp_devengo.=$valuedevengo["afp_devengo"];
							$renta_devengo.=$valuedevengo["renta_devengo"];
							$suma_resta.=$valuedevengo["tipo"];

						}

						
						$codigo_devengo_descuento_planilla=$codigo_devengo;
						$descripcion_devengo_descuento_planilla=$descipcion_devengo;
						$tipo_devengo_descuento_planilla=$id_devengo;
						$isss_devengo_devengo_descuento_planilla=$isss_devengo;
						$afp_devengo_devengo_descuento_planilla=$afp_devengo;
						$renta_devengo_devengo_descuento_planilla=$renta_devengo;
						$idempleado_devengo=$value["idempleado"];
						$valor_devengo_planilla=$devengoquincenal;
						$tipo_valor=$suma_resta;
						$codigo_planilla_devengo=$numero_planilladevengo_admin;
						$values_devengo.="('$codigo_devengo_descuento_planilla', '$descripcion_devengo_descuento_planilla', '$tipo_devengo_descuento_planilla', '$isss_devengo_devengo_descuento_planilla', '$afp_devengo_devengo_descuento_planilla', '$renta_devengo_devengo_descuento_planilla', '$idempleado_devengo', '$valor_devengo_planilla', '$tipo_valor', '$codigo_planilla_devengo','','','','','','','',''),";

					/* ************ */

				}

			}

			
			/* ************************************ */
			/* DEVENGO POR DIAS FERIADOS TRABAJADOS */

			$data_viatico_permanente= viatico_permanente('2',$idempleado);	
			$valor_viatico_permanente="";		
			foreach ($data_viatico_permanente as $value_viatico) {
				$valor_viatico_permanente.=$value_viatico["valor"];		
			}


			/* ***** VALIDAR SI ESTAMOS EN EL MES DE DIAS FERIADOS Y BUSCAR SI EMPLEADO A ESTA AUSENTE EN LOS DIAS FERIADOS */
			$data_ausencia_dias_feriados= ausencia_dias_feriados($idempleado);	
			$restar_dias_feriados=0;	
			$fecha_feriado_ausencia="";	
			foreach ($data_ausencia_dias_feriados as $value_ausencia_dias_feriados) {
				$fecha_feriado_ausencia.=$value_ausencia_dias_feriados["fecha_feriado"];	
			}
			
			$data_dias_feriados= dias_feriados();	
			foreach ($data_dias_feriados as $value_dias_feriados) {
				$fecha_desde=$value_dias_feriados["fecha_desde"];		
				$fecha_hasta=$value_dias_feriados["fecha_hasta"];	

				$fecha_desde_mes=date("m", strtotime($fecha_desde));	
				$fechaActual_mes = date("m", strtotime($fecha_planilladevengo_admin));
				if($fechaActual_mes==$fecha_desde_mes){

					$fecha_desde_mes_feriado=$value_dias_feriados["fecha_desde"];
					$fecha_hasta_mes_feriado=$value_dias_feriados["fecha_hasta"];
					$resultado_dias=0;
					if ($fecha_feriado_ausencia >= $fecha_desde && $fecha_feriado_ausencia <= $fecha_hasta){
						$resultado_dias=$resultado_dias+1;
					}		
					/* CONTAR LOS DIAS FERIADOS */
					$feriado_desde= date("Y-m-d", strtotime($fecha_desde_mes_feriado));
					$feriado_hasta = date("Y-m-d", strtotime($fecha_hasta_mes_feriado));
					/* lunes-viernes */
					$workingDays = 0;
					$startTimestamp = strtotime($feriado_desde);
					$endTimestamp = strtotime($feriado_hasta);
					for ($i = $startTimestamp; $i <= $endTimestamp; $i = $i + (60 * 60 * 24)) {
						if (date("N", $i) <= 5) $workingDays = $workingDays + 1;
					}
					/* *********** */
					/* ****sabado-domingo */
					$weekendDays = 0;
					$startTimestamp = strtotime($feriado_desde);
					$endTimestamp = strtotime($feriado_hasta);
					for ($i = $startTimestamp; $i <= $endTimestamp; $i = $i + (60 * 60 * 24)) {
						if (date("N", $i) > 5) $weekendDays = $weekendDays + 1;
					}

					$dias_festivos= floatval($workingDays)+floatval($weekendDays);
					$restar_dias_feriados.=floatval($dias_festivos)-floatval($resultado_dias);
					/* echo $restar_dias_feriados.'restar_dias_feriados'; */
					/* *********************** */
					
				}
				
			}
			/* ******************************************************** */

			if($restar_dias_feriados>0){
				
					$data_cargo= cargo_empleado($idcargo_empleado);		
					foreach ($data_cargo as $valu_cargo) {
							$pago_feriados=$valu_cargo["pago_feriados"];
							$calculo=$valu_cargo["calculo"];
							if($pago_feriados=="Si"){
								$ecuacion_dias=0;
								$valordias=0;
								if($calculo=="Sueldo+Tfijo"){
									$salario_mas_viatico=floatval($salario_empleado)+floatval($valor_viatico_permanente);
									$valordias=floatval($salario_mas_viatico)/15;
									$ecuacion_dias=$valordias*floatval($restar_dias_feriados);
								}
								else{
									$valordias=floatval($salario_empleado)/15;
									$ecuacion_dias=floatval($valordias)*floatval($restar_dias_feriados);
								}
								/* ******************* */
									$datadevengo = consultar_devengo2('0021');
									$codigo_devengo="";
									$descipcion_devengo="";
									$isss_devengo="";
									$afp_devengo="";
									$renta_devengo="";
									$id_devengo="";
									$suma_resta="";
									foreach ($datadevengo as $valuedevengo) {
										$id_devengo.=$valuedevengo["id"];
										$codigo_devengo.=$valuedevengo["codigo"];
										$descipcion_devengo.=$valuedevengo["descripcion"];
										$isss_devengo.=$valuedevengo["isss_devengo"];
										$afp_devengo.=$valuedevengo["afp_devengo"];
										$renta_devengo.=$valuedevengo["renta_devengo"];
										$suma_resta.=$valuedevengo["tipo"];

									}
									$codigo_devengo_descuento_planilla=$codigo_devengo;
									$descripcion_devengo_descuento_planilla=$descipcion_devengo;
									$tipo_devengo_descuento_planilla=$id_devengo;
									$isss_devengo_devengo_descuento_planilla=$isss_devengo;
									$afp_devengo_devengo_descuento_planilla=$afp_devengo;
									$renta_devengo_devengo_descuento_planilla=$renta_devengo;
									$idempleado_devengo=$value["idempleado"];
									$valor_devengo_planilla= bcdiv($ecuacion_dias, '1', 2);
									$tipo_valor=$suma_resta;
									$codigo_planilla_devengo=$numero_planilladevengo_admin;

									$values_devengo.="('$codigo_devengo_descuento_planilla', '$descripcion_devengo_descuento_planilla', '$tipo_devengo_descuento_planilla', '$isss_devengo_devengo_descuento_planilla', '$afp_devengo_devengo_descuento_planilla', '$renta_devengo_devengo_descuento_planilla', '$idempleado_devengo', '$valor_devengo_planilla', '$tipo_valor', '$codigo_planilla_devengo','$restar_dias_feriados','$valordias','','','','','',''),";

								/* ******************* */
									
							}
					}
			
			}
			/* ********************************************* */

			/* *************BONO POR UBICACION*************** */
				$databonoubicacion = bonoubicacion($codigo_empleado);			
				foreach ($databonoubicacion as $valubonoubicacion) {
						$bono=$valubonoubicacion["bonos"];
					/* ******************* */
						$datadevengo = consultar_devengo2('0061');
						$codigo_devengo="";
						$descipcion_devengo="";
						$isss_devengo="";
						$afp_devengo="";
						$renta_devengo="";
						$id_devengo="";
						$suma_resta="";
						foreach ($datadevengo as $valuedevengo) {
							$id_devengo.=$valuedevengo["id"];
							$codigo_devengo.=$valuedevengo["codigo"];
							$descipcion_devengo.=$valuedevengo["descripcion"];
							$isss_devengo.=$valuedevengo["isss_devengo"];
							$afp_devengo.=$valuedevengo["afp_devengo"];
							$renta_devengo.=$valuedevengo["renta_devengo"];
							$suma_resta.=$valuedevengo["tipo"];

						}
						$codigo_devengo_descuento_planilla=$codigo_devengo;
						$descripcion_devengo_descuento_planilla=$descipcion_devengo;
						$tipo_devengo_descuento_planilla=$id_devengo;
						$isss_devengo_devengo_descuento_planilla=$isss_devengo;
						$afp_devengo_devengo_descuento_planilla=$afp_devengo;
						$renta_devengo_devengo_descuento_planilla=$renta_devengo;
						$idempleado_devengo=$value["idempleado"];
						$valor_devengo_planilla= bcdiv($bono, '1', 2);
						$tipo_valor=$suma_resta;
						$codigo_planilla_devengo=$numero_planilladevengo_admin;

						$values_devengo.="('$codigo_devengo_descuento_planilla', '$descripcion_devengo_descuento_planilla', '$tipo_devengo_descuento_planilla', '$isss_devengo_devengo_descuento_planilla', '$afp_devengo_devengo_descuento_planilla', '$renta_devengo_devengo_descuento_planilla', '$idempleado_devengo', '$valor_devengo_planilla', '$tipo_valor', '$codigo_planilla_devengo','','','','','','','',''),";

					/* ******************* */
				}
			/* ********************************************* */

			
			/* *************BONO POR NO FALTAR*************** */
			$databonopornofaltar = bonopornofaltar($codigo_empleado);			
			foreach ($databonopornofaltar as $valubonopornofaltar) {
				$bono=$valubonopornofaltar["valor_devengo_ubicacion"];
				$periodo=$valubonopornofaltar["periodo_devengo_ubicacion"];
				if($periodo=="Siempre"){
					$periodo=$periodo_planilladevengo_admin;
				}
				
				if($periodo==$periodo_planilladevengo_admin){
						$fecha_planilladevengo_admin01 = date("Y-m-d", strtotime($fecha_planilladevengo_admin));
						$fecha_gratificacion_admin= date("Y-m-d", strtotime($_POST["fecha_gratificacion_admin"]));
						$datasituacion = situaciones($codigo_empleado,$fecha_gratificacion_admin,$fecha_planilladevengo_admin01);
						$dias_ausencia_situ_bono="vacio";
						foreach ($datasituacion as $valuesituacion) {
							$dias_ausencia_situ_bono.=$valuesituacion["sumaausencia"];
						}
						
						if($tiempotrabajo=="viejo"){

							if($dias_ausencia_situ_bono=="vacio"){
								/* ******************* */
								$datadevengo = consultar_devengo2('0020');
								$codigo_devengo="";
								$descipcion_devengo="";
								$isss_devengo="";
								$afp_devengo="";
								$renta_devengo="";
								$id_devengo="";
								$suma_resta="";
								foreach ($datadevengo as $valuedevengo) {
									$id_devengo.=$valuedevengo["id"];
									$codigo_devengo.=$valuedevengo["codigo"];
									$descipcion_devengo.=$valuedevengo["descripcion"];
									$isss_devengo.=$valuedevengo["isss_devengo"];
									$afp_devengo.=$valuedevengo["afp_devengo"];
									$renta_devengo.=$valuedevengo["renta_devengo"];
									$suma_resta.=$valuedevengo["tipo"];

								}
								$codigo_devengo_descuento_planilla=$codigo_devengo;
								$descripcion_devengo_descuento_planilla=$descipcion_devengo;
								$tipo_devengo_descuento_planilla=$id_devengo;
								$isss_devengo_devengo_descuento_planilla=$isss_devengo;
								$afp_devengo_devengo_descuento_planilla=$afp_devengo;
								$renta_devengo_devengo_descuento_planilla=$renta_devengo;
								$idempleado_devengo=$value["idempleado"];
								$valor_devengo_planilla= bcdiv($bono, '1', 2);
								$tipo_valor=$suma_resta;
								$codigo_planilla_devengo=$numero_planilladevengo_admin;

								$values_devengo.="('$codigo_devengo_descuento_planilla', '$descripcion_devengo_descuento_planilla', '$tipo_devengo_descuento_planilla', '$isss_devengo_devengo_descuento_planilla', '$afp_devengo_devengo_descuento_planilla', '$renta_devengo_devengo_descuento_planilla', '$idempleado_devengo', '$valor_devengo_planilla', '$tipo_valor', '$codigo_planilla_devengo','','','','','','','',''),";
					 		/* ******************* */
							}
						}


						if($tiempotrabajo=="nuevo"){

							if($dias_ausencia_situ_bono=="vacio"){

								$calculobono=floatval($bono)/30*floatval($total_dias_trabajados);
								/* ******************* */
								$datadevengo = consultar_devengo2('0020');
								$codigo_devengo="";
								$descipcion_devengo="";
								$isss_devengo="";
								$afp_devengo="";
								$renta_devengo="";
								$id_devengo="";
								$suma_resta="";
								foreach ($datadevengo as $valuedevengo) {
									$id_devengo.=$valuedevengo["id"];
									$codigo_devengo.=$valuedevengo["codigo"];
									$descipcion_devengo.=$valuedevengo["descripcion"];
									$isss_devengo.=$valuedevengo["isss_devengo"];
									$afp_devengo.=$valuedevengo["afp_devengo"];
									$renta_devengo.=$valuedevengo["renta_devengo"];
									$suma_resta.=$valuedevengo["tipo"];

								}
								$codigo_devengo_descuento_planilla=$codigo_devengo;
								$descripcion_devengo_descuento_planilla=$descipcion_devengo;
								$tipo_devengo_descuento_planilla=$id_devengo;
								$isss_devengo_devengo_descuento_planilla=$isss_devengo;
								$afp_devengo_devengo_descuento_planilla=$afp_devengo;
								$renta_devengo_devengo_descuento_planilla=$renta_devengo;
								$idempleado_devengo=$value["idempleado"];
								$valor_devengo_planilla= bcdiv($calculobono, '1', 2);
								$tipo_valor=$suma_resta;
								$codigo_planilla_devengo=$numero_planilladevengo_admin;

							
								$values_devengo.="('$codigo_devengo_descuento_planilla', '$descripcion_devengo_descuento_planilla', '$tipo_devengo_descuento_planilla', '$isss_devengo_devengo_descuento_planilla', '$afp_devengo_devengo_descuento_planilla', '$renta_devengo_devengo_descuento_planilla', '$idempleado_devengo', '$valor_devengo_planilla', '$tipo_valor', '$codigo_planilla_devengo','','','','','','','',''),";

							/* ******************* */
							}
						}
				}

			}
		 /* ********************************************* */

			/* *********RECIBO DESCUENTO***************** */
			$datarecibo = recibo($idempleado,$fecha_desde_format,$fechahasta02);
			foreach ($datarecibo as $valuerecibo) {

				/* ************************ */
				$iddevengo=$valuerecibo["descuento_recibo"];
				$valorrecibo=$valuerecibo["valor_recibo"];
				$idrecibo.=$valuerecibo["id"].",";
						$datadevengo = consultar_devengo2($iddevengo);
						$codigo_devengo="";
						$descipcion_devengo="";
						$isss_devengo="";
						$afp_devengo="";
						$renta_devengo="";
						$id_devengo="";
						$suma_resta="";
						foreach ($datadevengo as $valuedevengo) {
							$id_devengo.=$valuedevengo["id"];
							$codigo_devengo.=$valuedevengo["codigo"];
							$descipcion_devengo.=$valuedevengo["descripcion"];
							$isss_devengo.=$valuedevengo["isss_devengo"];
							$afp_devengo.=$valuedevengo["afp_devengo"];
							$renta_devengo.=$valuedevengo["renta_devengo"];
							$suma_resta.=$valuedevengo["tipo"];
						}
						$codigo_devengo_descuento_planilla=$codigo_devengo;
						$descripcion_devengo_descuento_planilla=$descipcion_devengo;
						$tipo_devengo_descuento_planilla=$id_devengo;
						$isss_devengo_devengo_descuento_planilla=$isss_devengo;
						$afp_devengo_devengo_descuento_planilla=$afp_devengo;
						$renta_devengo_devengo_descuento_planilla=$renta_devengo;
						$idempleado_devengo=$value["idempleado"];
						$valor_devengo_planilla=$valorrecibo;
						$tipo_valor=$suma_resta;
						$codigo_planilla_devengo=$numero_planilladevengo_admin;

						$values_devengo.="('$codigo_devengo_descuento_planilla', '$descripcion_devengo_descuento_planilla', '$tipo_devengo_descuento_planilla', '$isss_devengo_devengo_descuento_planilla', '$afp_devengo_devengo_descuento_planilla', '$renta_devengo_devengo_descuento_planilla', '$idempleado_devengo', '$valor_devengo_planilla', '$tipo_valor', '$codigo_planilla_devengo','','','','','','','',''),";


				/* ************************ */
				
			}
			/* ******************** */

			$numero_planilladevengo_admin=$numero_planilladevengo_admin;
			$fecha_planilladevengo_admin=$fecha_planilladevengo_admin;
			$fecha_desde_planilladevengo_admin=$_POST["fechaperiodo1"];
			$fecha_hasta_planilladevengo_admin=$_POST["fechaperiodo2"];
			$descripcion_planilladevengo_admin=$descripcion_planilladevengo_admin;
			$codigo_empleado_planilladevengo_admin=$value["codigo_empleado"];
			$nombre_empleado_planilladevengo_admin=$value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"];
			$id_empleado_planilladevengo_admin=$value["idempleado"];
			$sueldo_planilladevengo_admin=bcdiv($sueldo_total, '1', 2); ;
			$sueldo="0";
			$devengo="0";
			$totaldevengo=$sueldo+$devengo;
			$total_devengo_admin_planilladevengo_admin=$totaldevengo;
			$total_liquidado_planilladevengo_admin=$totaldevengo;
			$codigo_ubicacion_planilladevengo_admin="";
			$nombre_ubicacion_planilladevengo_admin="";
			$id_ubicacion_planilladevengo_admin="";
			$periodo_planilladevengo_admin=$periodo_planilladevengo_admin;
			$tipo_planilladevengo_admin=$tipo_planilladevengo_admin;
			$empleado_rango_desde=$empleado_rango_desde;
			$empleado_rango_hasta=$empleado_rango_hasta;
			$observacion_planilladevengo_admin=$observacion;
			$fecha_gratificacion_admin=$_POST["fecha_gratificacion_admin"];
			/* ---------------- */
			if($salario_isss>=$tope_isss){
				$salario_isss=$salario_isss;
			}
			$descuento_isss_planilladevengo_admin=  bcdiv($descuento_isss, '1', 2); 
			$descuento_afp_planilladevengo_admin=  bcdiv($descuento_afp, '1', 2); 
			$descuento_renta_planilladevengo_admin=  bcdiv($descuento_renta, '1', 2);
			$sueldo_renta_planilladevengo_admin=  bcdiv($renta_final, '1', 2);
			$sueldo_isss_planilladevengo_admin= bcdiv($salario_isss, '1', 2); 
			$sueldo_afp_planilladevengo_admin=  bcdiv($salario_afp, '1', 2);
			$hora_extra_diurna_planilladevengo_admin=$horas_extras;




			$values_consulta.="('$numero_planilladevengo_admin','$fecha_planilladevengo_admin','$fecha_desde_planilladevengo_admin','$fecha_hasta_planilladevengo_admin','$descripcion_planilladevengo_admin','$codigo_empleado_planilladevengo_admin','$nombre_empleado_planilladevengo_admin','$id_empleado_planilladevengo_admin','$sueldo_planilladevengo_admin','$total_devengo_admin_planilladevengo_admin','$total_liquidado_planilladevengo_admin','$codigo_ubicacion_planilladevengo_admin','$nombre_ubicacion_planilladevengo_admin','$id_ubicacion_planilladevengo_admin','$periodo_planilladevengo_admin','$tipo_planilladevengo_admin','$empleado_rango_desde','$empleado_rango_hasta','$total_dias_trabajados','$dias_incapacidad','$dias_ausencia','$dias_trabajo_planilladevengo_admin','$descuento_isss_planilladevengo_admin','$descuento_afp_planilladevengo_admin','$descuento_renta_planilladevengo_admin','$sueldo_renta_planilladevengo_admin','$sueldo_isss_planilladevengo_admin','$sueldo_afp_planilladevengo_admin','$observacion_planilladevengo_admin','$fecha_gratificacion_admin','$hora_extra_diurna_planilladevengo_admin'),";

			$datos_html .= ' <tr class="btnEditarabase" pensionado_empleado="'.$value["pensionado_empleado"].'" hora_extra_nocturna_domingo="'.$value["hora_extra_nocturna_domingo"].'"   hora_extra_domingo="'.$value["hora_extra_domingo"].'"  hora_extra_nocturna="'.$value["hora_extra_nocturna"].'" hora_extra_diurna="'.$value["hora_extra_diurna"].'"    salario_por_hora="'.$value["salario_por_hora"].'"  sueldo="'.$value["sueldo"].'"  idempleado="'.$value["idempleado"].'" codigo="'.$value["codigo_empleado"].'"  nombre="'.$value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"].'">
			<td>'.$value["codigo_empleado"].'</td>
			<td>'.$value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"].' </td>';
			$datos_html .='<td><div class="btn btn-danger eliminarempleado" numero_planilla="'.$numero_planilladevengo_admin.'" idempleado="'.$value["idempleado"].'"><i class="fa fa-times"></i></div></td>';
			$datos_html .= '</tr>';
		}
		$datos_html .= '</tbody></table>';
		/* echo trim($values_consulta, ","); */

		/* echo $datos_html; */
		function consultar_planilla($numero_planilladevengo_admin1)
			{
				$query01="SELECT `id`, `numero_planilladevengo_admin`, `fecha_planilladevengo_admin`, `fecha_desde_planilladevengo_admin`, `fecha_hasta_planilladevengo_admin`, `descripcion_planilladevengo_admin`, `codigo_empleado_planilladevengo_admin`, `nombre_empleado_planilladevengo_admin`, `id_empleado_planilladevengo_admin`, `dias_trabajo_planilladevengo_admin`, `sueldo_planilladevengo_admin`, `hora_extra_diurna_planilladevengo_admin`, `hora_extra_nocturna_planilladevengo_admin`, `hora_extra_domingo_planilladevengo_admin`, `hora_extra_domingo_nocturna_planilladevengo_admin`, `otro_devengo_admin_planilladevengo_admin`, `total_devengo_admin_planilladevengo_admin`, `descuento_isss_planilladevengo_admin`, `descuento_afp_planilladevengo_admin`, `descuento_renta_planilladevengo_admin`, `otro_descuento_planilladevengo_admin`, `total_descuento_planilladevengo_admin`, `total_liquidado_planilladevengo_admin`, `sueldo_renta_planilladevengo_admin`, `sueldo_isss_planilladevengo_admin`, `sueldo_afp_planilladevengo_admin`, `departamento_planilladevengo_admin`, `codigo_ubicacion_planilladevengo_admin`, `nombre_ubicacion_planilladevengo_admin`, `id_ubicacion_planilladevengo_admin`, `observacion_planilladevengo_admin`, `periodo_planilladevengo_admin`, `tipo_planilladevengo_admin`, `dias_incapacidad`, `empleado_rango_desde`, `empleado_rango_hasta`, COUNT(*) as registro FROM `planilladevengo_admin` WHERE numero_planilladevengo_admin='$numero_planilladevengo_admin1'";
				$sql = Conexion::conectar()->prepare($query01);
				$sql->execute();
				return $sql->fetchAll();
			};
		$data_planilla = consultar_planilla($numero_planilladevengo_admin);
		$registro="";
		foreach ($data_planilla as $value) {
			$registro.=$value["registro"];
		}

		if($registro == 0){


			$insertar_recibo="UPDATE `recibos` SET  `liquidado_recibo`='Si',`numero_planilla_liquidado`='$numero_planilladevengo_admin' WHERE id in  (".trim($idrecibo, ",").")";
			$sql_recibo= Conexion::conectar()->prepare($insertar_recibo);
			$sql_recibo->execute();
			
			$insertar_situacion="UPDATE `situacion` SET  `liquidado_situacion`='Si',`numero_planilla_admin`='$numero_planilladevengo_admin' WHERE id in  (".trim($id_situaciones, ",").")";
			$sql_situacion = Conexion::conectar()->prepare($insertar_situacion);
			$sql_situacion->execute();

			
			$insertar_devengo="INSERT INTO `tbl_devengo_descuento_planilla_admin`(`codigo_devengo_descuento_planilla`, `descripcion_devengo_descuento_planilla`, `tipo_devengo_descuento_planilla`, `isss_devengo_devengo_descuento_planilla`, `afp_devengo_devengo_descuento_planilla`, `renta_devengo_devengo_descuento_planilla`,`idempleado_devengo`, `valor_devengo_planilla`, `tipo_valor`, `codigo_planilla_devengo`,dias_Feriados,valor_dias_Feriados,dias_tra_inca_admin,pago_dias_tra_inca_admin,dias_incapacidad_admin,pago_dias_incapacidad_admin,horas_tardes,precio_horas_tardes) VALUES  ".trim($values_devengo, ",")."";
			$sql_devengo = Conexion::conectar()->prepare($insertar_devengo);
			$sql_devengo->execute();


			$insertar="INSERT INTO `planilladevengo_admin`(`numero_planilladevengo_admin`, `fecha_planilladevengo_admin`, `fecha_desde_planilladevengo_admin`, `fecha_hasta_planilladevengo_admin`, `descripcion_planilladevengo_admin`, `codigo_empleado_planilladevengo_admin`, `nombre_empleado_planilladevengo_admin`, `id_empleado_planilladevengo_admin`, `sueldo_planilladevengo_admin`,  `total_devengo_admin_planilladevengo_admin`, `total_liquidado_planilladevengo_admin`, `codigo_ubicacion_planilladevengo_admin`, `nombre_ubicacion_planilladevengo_admin`, `id_ubicacion_planilladevengo_admin`, `periodo_planilladevengo_admin`, `tipo_planilladevengo_admin`, `empleado_rango_desde`, `empleado_rango_hasta`,dias_trabajo_planilladevengo_admin,dias_incapacidad,dias_ausencia,his_dias_trabajo_admin,descuento_isss_planilladevengo_admin,descuento_afp_planilladevengo_admin,descuento_renta_planilladevengo_admin,sueldo_renta_planilladevengo_admin,sueldo_isss_planilladevengo_admin,sueldo_afp_planilladevengo_admin,observacion_planilladevengo_admin,fecha_gratificacion_admin,hora_extra_diurna_planilladevengo_admin) value ".trim($values_consulta, ",")."";
			$sql = Conexion::conectar()->prepare($insertar);
			if ($sql->execute()) {
				$data_planilla = consultar_planilla($numero_planilladevengo_admin);
				$id="";
				foreach ($data_planilla as $value) {
					$id.=$value["id"];
					
				}
				echo $numero_planilladevengo_admin;
			} else {
				
			}
			$sql = null;
		}
		else{
			/* echo $datos_html; */
		}
	break;
	case "listaconempleado":/* principal */

		$tipo_planilladevengo_admin = $_POST["tipo_planilladevengo_admin"];
		$periodo_planilladevengo_admin = $_POST["periodo_planilladevengo_admin"];
		$numero_planilladevengo_admin = $_POST["numero_planilladevengo_admin"];
		$descripcion_planilladevengo_admin = $_POST["descripcion_planilladevengo_admin"];

		
		

		function situaciones($idempleado1,$fechadesde1,$fechahasta2) /* --SUMA DE DIAS AUSENCIA Y INCAPACIDAD */
		{
			$query01="SELECT sum(dias_ausencia_situacion) as sumaausencia, sum(incapacidad_situacion) as sumainca, sum(horas_ausencia_situacion) as sumahoraausencia, sum(hora_extra_situacion) as sumahoraextra, sum(dias_no_sueldo) as sumadias_no_sueldo FROM `situacion` WHERE  liquidado_situacion='No' and idempleado_situacion='$idempleado1'  and STR_TO_DATE(fecha_situacion, '%d-%m-%Y')  BETWEEN '$fechadesde1' AND '$fechahasta2' ";
			/* echo $query01; */
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};

		function situaciones_incapacidad($idempleado1,$fechadesde1,$fechahasta2) /* --SUMA DE DIAS AUSENCIA Y INCAPACIDAD */
		{
			$query01="SELECT sum(dias_ausencia_situacion) as sumaausencia, sum(incapacidad_situacion) as sumainca FROM `situacion` WHERE  liquidado_situacion='No' and idempleado_situacion='$idempleado1' and inicial_situacion='Inicial'  and STR_TO_DATE(fecha_situacion, '%d-%m-%Y')  BETWEEN '$fechadesde1' AND '$fechahasta2' ";
			/* echo $query01; */
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};

		function situaciones_dias_tra_inca($idempleado1,$fechadesde1,$fechahasta2) /* --SUMA DE DIAS AUSENCIA Y INCAPACIDAD */
		{
			$query01="SELECT sum(dias_tra_incapacidad) as sumadiastrabajados FROM `situacion` 
					 WHERE  situacion.incapacidad_situacion !='' and liquidado_situacion='No' and idempleado_situacion='$idempleado1' and inicial_situacion='Inicial'  and STR_TO_DATE(fecha_situacion, '%d-%m-%Y')  BETWEEN '$fechadesde1' AND '$fechahasta2' ";
			/* echo $query01; */
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};

		function situaciones_horas($idempleado1,$fechadesde1,$fechahasta2) /* --Horas ausencia */
		{
			$query01="SELECT sum(horas_ausencia_situacion) as horas_ausencia_situacion  FROM `situacion` 
					 WHERE  liquidado_situacion='No' and idempleado_situacion='$idempleado1'  and STR_TO_DATE(fecha_situacion, '%d-%m-%Y')  BETWEEN '$fechadesde1' AND '$fechahasta2'  and situacion.horas_ausencia_situacion !=''";
			/* echo $query01; */
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};


		function horas_cubiertar_extras($codigo_empleado1) /* --se busca horas ausencia que han sido cubiertas situaciones */
		{
			$query01="SELECT sum(hora_extra_situacion) as hora_extra_situacion FROM `situacion` WHERE cubrir_situacion LIKE '%$codigo_empleado1%' and situacion.hora_extra_situacion != ''";
	
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};
		function horas_cubiertar_normal($codigo_empleado1) /* --se busca horas ausencia que han sido cubiertas situaciones */
		{
			$query01="SELECT sum(hora_normales_situacion) as hora_normales_situacion FROM `situacion` WHERE cubrir_situacion LIKE '%$codigo_empleado1%' and situacion.hora_normales_situacion != ''";
			/* echo $query01; */
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};

		function recibo($idempleado1,$fechadesde1,$fechahasta2) /* -- */
		{

			$query01="SELECT `id`, `fecha_descuento_recibo`, `empleado_recibo`, `descuento_recibo`, `numero_recibo`, `valor_recibo`, `observacion_recibo`, `fecha_hecho_recibo`, `hora_hecho_recibo`, `numero_planilla_liquidado`, `liquidado_recibo`, `anular_recibo`, `user_recibo` FROM `recibos` WHERE liquidado_recibo='No' and anular_recibo='No' and anular_recibo='No' and empleado_recibo='$idempleado1'  and STR_TO_DATE(fecha_descuento_recibo, '%d-%m-%Y')  BETWEEN '$fechadesde1' AND '$fechahasta2' ";
		
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};

		function bonoubicacion($codigoempleado1) /* -- */
		{

			$query01="SELECT tbl_ubicaciones_agentes_asignados.id as idubicacionagente, tbl_clientes_ubicaciones.* FROM `tbl_ubicaciones_agentes_asignados`,tbl_clientes_ubicaciones WHERE tbl_ubicaciones_agentes_asignados.idubicacion_agente=tbl_clientes_ubicaciones.id and tbl_ubicaciones_agentes_asignados.codigo_agente='$codigoempleado1'  group by tbl_ubicaciones_agentes_asignados.codigo_agente";
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};

		
		function bonopornofaltar($codigoempleado1) /* -- */
		{
			$query01="SELECT tbl_ubicaciones_agentes_asignados.id as idubicacionagente, tbl_devengo_ubicacion.* FROM `tbl_ubicaciones_agentes_asignados`,tbl_devengo_ubicacion WHERE tbl_ubicaciones_agentes_asignados.idubicacion_agente=tbl_devengo_ubicacion.idubicacion_devengo and tbl_ubicaciones_agentes_asignados.codigo_agente='$codigoempleado1'  group by tbl_ubicaciones_agentes_asignados.codigo_agente";
			
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};

		function data_situaciones($idempleado1,$fechadesde1,$fechahasta2) /* --ID DE REGISTROS A MODIFICAR */
		{

			$query01="SELECT*FROM `situacion` WHERE  liquidado_situacion='No' and idempleado_situacion='$idempleado1'  and STR_TO_DATE(fecha_situacion, '%d-%m-%Y')  BETWEEN '$fechadesde1' AND '$fechahasta2' ";
			/* echo $query01; */
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};  

		
		/* ***CONSULTAR DEVENGO02***** */
		function consultar_devengo2($iddevengo1)
		{
			$query01 = "SELECT `id`, `codigo`, `descripcion`, `porcentaje`, `tipo`, `cargo_abono`, `cuenta_contable`, `isss_devengo`, `afp_devengo`, `renta_devengo` FROM `tbl_devengo_descuento` WHERE id='$iddevengo1'";
			
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};
		/* *************** */

		/* ******************** */
		function devengo_anticipo($idempleado1)
		{
			$query01 = "SELECT * FROM `tbl_devengo_descuento_planilla` WHERE idempleado_devengo='$idempleado1' and codigo_devengo_descuento_planilla='0022' order by codigo_planilla_devengo DESC limit 1";
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};
		/* *************** */

		
		/* ***Devegos y descuentos del empleado con tipo***** */
		function consultar_devengo_empleado($periodo1,$fechadesde1,$fechahasta2,$idempleado1)
		{
			/* $query01 = "SELECT tbl_empleados_devengos_descuentos.id AS id, `id_empleado`, `id_tipo_devengo_descuento`, `valor`, `fecha_caducidad`, `referencia`, `tipodescuento` ,tbl_devengo_descuento.*
			FROM `tbl_empleados_devengos_descuentos` , tbl_devengo_descuento 
			WHERE tipodescuento='$periodo1' and id_empleado='$idempleado1' and tbl_empleados_devengos_descuentos.id_tipo_devengo_descuento=tbl_devengo_descuento.id and  fecha_caducidad BETWEEN '$fechadesde1' AND '$fechahasta2'";
			 */
			$query01 = "SELECT tbl_empleados_devengos_descuentos.id AS id, `id_empleado`, `id_tipo_devengo_descuento`, `valor`, `fecha_caducidad`, `referencia`, `tipodescuento` ,tbl_devengo_descuento.* FROM `tbl_empleados_devengos_descuentos` , tbl_devengo_descuento WHERE id_empleado='$idempleado1' and tbl_empleados_devengos_descuentos.id_tipo_devengo_descuento=tbl_devengo_descuento.id and  fecha_caducidad >= '$fechadesde1'";
			/* echo $query01; */
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};
		/* *************** */

		
		/* ***Devegos y descuentos del empleado sin tipo***** */
		function consultar_devengo_emple_sintipo($periodo1,$fechadesde1,$fechahasta2,$idempleado1)
		{
			$query01 = "SELECT tbl_empleados_devengos_descuentos.id AS id, `id_empleado`, `id_tipo_devengo_descuento`, `valor`, `fecha_caducidad`, `referencia`, `tipodescuento` ,tbl_devengo_descuento.* FROM `tbl_empleados_devengos_descuentos` , tbl_devengo_descuento WHERE id_empleado='$idempleado1' and tbl_empleados_devengos_descuentos.id_tipo_devengo_descuento=tbl_devengo_descuento.id and  fecha_caducidad BETWEEN '$fechadesde1' AND '$fechahasta2'";
			
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};
		/* *************** */

		function afp($e)
						{
							$query01="SELECT*FROM afp WHERE codigo='$e'";
							$sql = Conexion::conectar()->prepare($query01);
							$sql->execute();
							return $sql->fetchAll();
						};
					


		/* ********************* */

		function configuracion()
			{
				$query01="SELECT*FROM configuracion";
				$sql = Conexion::conectar()->prepare($query01);
				$sql->execute();
				return $sql->fetchAll();
			};
			$data_configuracion = configuracion();
			$porcentaje_isss="";
			$tope_isss=0;
			$dias_maximo_incapacidad=0;
			$porcentaje_dias_incapacidad=0;
			foreach ($data_configuracion as $valueconfig) {
				$porcentaje_isss.=floatval($valueconfig["porcentaje_isss"]);
				$tope_isss.=$valueconfig["tope_isss"];
				$dias_maximo_incapacidad.=$valueconfig["dias_maximo_incapacidad"];
				$porcentaje_dias_incapacidad.=$valueconfig["porcentaje_dias_incapacidad"];

			}


		/* ************************ */
		function isr($salario,$periodo)
			{
				$query01="SELECT isr.id as idisr, `codigo`, `nombre_rango`, `periodo_pago`, `salario_desde`, `salario_hasta`, `base_1`, `tasa_sobre_excedente`, `base_2`, periodo_de_pago.id as idperiodo FROM `isr`, periodo_de_pago WHERE isr.periodo_pago=periodo_de_pago.id and nombre_periodo='$periodo' and '$salario'>=salario_desde and '$salario'<=salario_hasta";
				
				$sql = Conexion::conectar()->prepare($query01);
				$sql->execute();
				return $sql->fetchAll();
			};
		/* ************************ */

		/* ************************ */
		function cargo_empleado($id1)
			{
				$query01="SELECT `id`, `descripcion`, `nivel`, `codigo_contable`, `personal_asignado`, `pago_feriados`, `calculo` FROM `cargos_desempenados` WHERE id='$id1'";
				$sql = Conexion::conectar()->prepare($query01);
				$sql->execute();
				return $sql->fetchAll();
			};
		/* ************************ */

		
		/* ************************ */
		function viatico_permanente($id_tipo_devengo1,$id_empleado1)
			{
				$query01="SELECT `id`, `id_empleado`, `id_tipo_devengo_descuento`, `valor`, `fecha_caducidad`, `referencia`, `tipodescuento` FROM `tbl_empleados_devengos_descuentos` WHERE id_empleado='$id_empleado1' and id_tipo_devengo_descuento='$id_tipo_devengo1'";
			
				$sql = Conexion::conectar()->prepare($query01);
				$sql->execute();
				return $sql->fetchAll();
			};
		/* ************************ */

		
		/* ************************ */
		function dias_feriados()
			{
				$query01="SELECT `id`, `num_dias`, `fecha_desde`, `fecha_hasta` FROM `dias_feriados` ";
				$sql = Conexion::conectar()->prepare($query01);
				$sql->execute();
				return $sql->fetchAll();
			};
		/* ************************ */

		
		/* ************************ */
		function ausencia_dias_feriados($idempleado1)
			{
				$query01="SELECT `id`, `empleado_ausencia`, `fecha_feriado` FROM `ausenciadiasferiados` WHERE empleado_ausencia='$idempleado1' ";
				
				$sql = Conexion::conectar()->prepare($query01);
				$sql->execute();
				return $sql->fetchAll();
			};
		/* ************************ */




		/* consulta maestra listaconempleado si filtramos por empleados */
		function consultar($e,$dia1,$dia2,$empleado_rango_desde1,$empleado_rango_hasta1)
		{
			$query01="SELECT DATE_FORMAT(DATE(NOW()), '%m-%d')as fecha_actual,DATE_FORMAT(tbl_empleados.fecha_contratacion, '%m-%d') as fechacontracion, tbl_empleados.id as idempleado, tbl_empleados.*
			FROM `tbl_empleados` 
			WHERE tbl_empleados.id >= '$empleado_rango_desde1' and tbl_empleados.id <= '$empleado_rango_hasta1'GROUP by tbl_empleados.id";
			
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};
		$newDate = date("Y-m-d", strtotime($fecha_planilladevengo_admin));
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
		$values_situacion="";
		$id_situaciones="";
		$idrecibo="";
	
		foreach ($data01 as $value) {




			/* *******suma de dias en SITUACION */
				$codigo_empleado=$value["codigo_empleado"];
				$idcargo_empleado=$value["nivel_cargo"];
				$salario_empleado=$value["sueldo"];
				$idempleado=$value["idempleado"];
				$hora_extra_diurna=$value["hora_extra_diurna"];


				$fechadesde02 = date("Y-m-d", strtotime($_POST["fechaperiodo1"]));
				$mes = date("m", strtotime($_POST["fechaperiodo1"]));
				$anio = date("Y", strtotime($_POST["fechaperiodo1"]));
				$fecha_desde_format=$anio."-".$mes."-"."01";
				$fechahasta02= date("Y-m-d", strtotime($_POST["fechaperiodo2"]));

				$datasituacion = situaciones($codigo_empleado,$fecha_desde_format,$fechahasta02);
				$datasituacion_inca = situaciones_incapacidad($codigo_empleado,$fecha_desde_format,$fechahasta02);
				$datasituacion_dias_tra = situaciones_dias_tra_inca($codigo_empleado,$fecha_desde_format,$fechahasta02);

				$dias_ausencia_situ="";
				$dias_incapacidad_situ="";
				$dias_tra_inca="";

				$horas_ausencia="";
				$horas_extras="";

				foreach ($datasituacion as $valuesituacion) {
					$dias_ausencia_situ.=floatval($valuesituacion["sumaausencia"])+floatval($valuesituacion["sumadias_no_sueldo"]);
					/* $dias_incapacidad_situ.=$valuesituacion["sumainca"]; */
					$horas_ausencia.=$valuesituacion["sumahoraausencia"];
					$horas_extras.=$valuesituacion["sumahoraextra"];
				}
				/* situaciones incapacidad */
				foreach ($datasituacion_inca as $valuesituacion) {
					$dias_incapacidad_situ.=$valuesituacion["sumainca"];
				}
				/* situaciones dias trabajados de incapacidad */
				foreach ($datasituacion_dias_tra as $valuesituacion) {
					$dias_tra_inca.=$valuesituacion["sumadiastrabajados"];
				}

			/* **************************** */
				/* REGISTROS A MODIFICAR DE SITUACIONES */
				$data_situaciones2 = data_situaciones($codigo_empleado,$fecha_desde_format,$fechahasta02);
				$fecha_ausencia="";
				$fecha_incapacidad="";
				$dias_ausen="";
				$dias_inca="";
				foreach ($data_situaciones2 as $valuedata_situacion) {
					$iddata_situacion=$valuedata_situacion["id"];
					$values_situacion.="";
					$id_situaciones.="$iddata_situacion,";

					$dias_ausen.=$valuedata_situacion["dias_ausencia_situacion"];
					$dias_inca.=$valuedata_situacion["incapacidad_situacion"];

			
					if(!empty($valuedata_situacion["dias_ausencia_situacion"])){
						$fecha_ausencia.=$valuedata_situacion["fecha_situacion"]."-";
					}
					if(!empty($valuedata_situacion["incapacidad_situacion"])){
						$fecha_incapacidad.=$valuedata_situacion["fecha_situacion"]."-";
					}
				}
				$comentario_obser="";
				if(!empty($dias_ausen)){
					$comentario_obser.="Fechas dias ausencia:".trim($fecha_ausencia, "-")."\n";
				}
				if(!empty($dias_inca)){
					$comentario_obser.="Fechas dias Incapacidad:".trim($fecha_incapacidad, "-");
					
				}
				$observacion=$comentario_obser;
			/* **************************** */

			/* ********DEVENGO EMPLEADOS********* */

				
				$datadevengoempleado = consultar_devengo_empleado($periodo_planilladevengo_admin,$fecha_desde_format,$fechahasta02,$idempleado);
				$valordevengoempleado="";
				$iddevengo="";
				$valorisss="";
				$valorafp="";
				$valorrenta="";
				$viaticos_empleados="0";
			
				foreach ($datadevengoempleado as $valuesdevengoempleado) {
					$tipodescuento=$valuesdevengoempleado["tipodescuento"];
					if($tipodescuento==$periodo_planilladevengo_admin || $tipodescuento=="Siempre"){

						$iddevengo=$valuesdevengoempleado["id_tipo_devengo_descuento"];	
						$isss=$valuesdevengoempleado["isss_devengo"];
						$afp=$valuesdevengoempleado["afp_devengo"];
						$renta=$valuesdevengoempleado["renta_devengo"];

						if($isss=="Si"){
							$valorisss=floatval($valuesdevengoempleado["valor"]);
						}
						if($afp=="Si"){
							$valorafp=floatval($valuesdevengoempleado["valor"]);
						}
						if($renta=="Si"){
							$valorrenta=floatval($valuesdevengoempleado["valor"]);
						}
						$valordevengoempleado=$valuesdevengoempleado["valor"];
						
						if($iddevengo=="2"){
							$viaticos_empleados.=$valuesdevengoempleado["valor"];
						}
					}
				}

		
			/* ************************************* */

			/* ************************** */
			$fechaEnvio= date("Y-m-d", strtotime($value["fecha_contratacion"]));
			$fechaActual = date("Y-m-d", strtotime($fecha_planilladevengo_admin));
			$datetime1 = date_create($fechaEnvio);
			$datetime2 = date_create($fechaActual);
			$contador = date_diff($datetime1, $datetime2);
			/* lunes-viernes */
			$workingDays = 0;
			$startTimestamp = strtotime($fechaEnvio);
			$endTimestamp = strtotime($fechaActual);
			for ($i = $startTimestamp; $i <= $endTimestamp; $i = $i + (60 * 60 * 24)) {
				if (date("N", $i) <= 5) $workingDays = $workingDays + 1;
			}
			/* *********** */
			/* ****sabado-domingo */
			$weekendDays = 0;
			$startTimestamp = strtotime($fechaEnvio);
			$endTimestamp = strtotime($fechaActual);
			for ($i = $startTimestamp; $i <= $endTimestamp; $i = $i + (60 * 60 * 24)) {
				if (date("N", $i) > 5) $weekendDays = $weekendDays + 1;
			}
			/* ********** */
			$dias_trabajo= floatval($workingDays)+floatval($weekendDays);
			$differenceFormat = '%a';
			/* $dias_trabajo=$contador->format($differenceFormat); */
			$tiempotrabajo="";
			if($dias_trabajo>='15'){
				$dias_trabajo_planilladevengo_admin='15';
				$tiempotrabajo="viejo";
			}
			else{
				$dias_trabajo_planilladevengo_admin=$dias_trabajo;
				$tiempotrabajo="nuevo";
			}
		   
			$sueldo_diario=floatval($value["sueldo_diario"]);
			$dias_incapacidad=floatval($dias_incapacidad_situ);
			$dias_ausencia=floatval($dias_ausencia_situ);
			$total_dias_trabajados = floatval($dias_trabajo_planilladevengo_admin)-$dias_incapacidad-$dias_ausencia;

			if($total_dias_trabajados<=0){
				$total_dias_trabajados=0;
			}
			
			$sueldo_total=$total_dias_trabajados*$sueldo_diario;
			

			/* ********PORCENTAJES ISSS AFP RENTA****** */
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

			/* *********AFP******* */

			$data_afp = afp($tipo_afp);
			$porcentaje_afp=0;
				foreach ($data_afp as $valueafp) {
					$porcentaje_afp.=floatval($valueafp["porcentaje"]);
				}
				/*--------------------------------  */

					
				$calcularporcentaje_afp=$porcentaje_afp/100;/* --afp */
				$calcularporcentaje_isss=$porcentaje_isss/100;
				$pensionado_empleado=$value["pensionado_empleado"];
				$renta_final=0;
				$salario_isss=0;
				$salario_afp=0;

				$descuento_isss=0;
				$descuento_afp=0;
				if($pensionado_empleado=="Si"){
					$renta_final=floatval($valorrenta)+floatval($sueldo_total);/* sujeto renta si  es pensionado */
	
				}
				else{
					
					$salario_isss=floatval($valorisss)+$sueldo_total;/* sujeto iss */
					$salario_afp=floatval($valorafp)+$sueldo_total;/* sujeto afp */

					$descuento_isss=$salario_isss*$calcularporcentaje_isss;/* descuento isss */
					$descuento_afp=$salario_afp*$calcularporcentaje_afp;/* descuento afp */

					$salario_renta=floatval($valorrenta)+$sueldo_total;
					$sujeto_renta=$salario_renta-$descuento_isss-$descuento_afp;
					$renta_final=$sujeto_renta;/* sujeto renta si no es pensionado */
				}
	
			/* ********************* */
				$dataisr = isr($renta_final,$periodo_pago);
				$porcentaje_base1=0;
				$porcentaje_base2=0;
				$tasa_sobre_excedente=0;
				foreach ($dataisr as $valueisr) {
					$porcentaje_base1=floatval($valueisr["base_1"]);
					$porcentaje_base2=floatval($valueisr["base_2"]);
					$tasa_sobre_excedente=floatval($valueisr["tasa_sobre_excedente"]);
				}

				$porcentaje_tasa_excedente=$tasa_sobre_excedente/100;
				$renta_menos_base2=$renta_final-$porcentaje_base2;
				$tasa_por_exedente=$renta_menos_base2*$porcentaje_tasa_excedente;
				$descuento_renta=$tasa_por_exedente+$porcentaje_base1;/* descuento renta */


			/* echo $porcentaje_isss.",".$porcentaje_afp.",".$porcentaje_base1.",".$porcentaje_base2.",".$tasa_sobre_excedente; */
			/* **********************  */

			/* VERIFICA LAS HORAS DE AUSENCIA CUBIERTAS O NO CUBIERTAS O SI FUERON CUBIERTAS DE MANERA DE HORA NORMAL*/
			$horas_no_cubiertas="";
			$horas_cubiertas_extras=0;
			$horas_cubiertas_normal=0;
			$total_horas_ausencia=0;
			$suma_horas=0;
			$total_horas_cubiertas_extras="";
			$total_horas_cubiertas_normal="";


			/* ----------HORAS EXTRAS------------------ */
			$data_hora_cubi = horas_cubiertar_extras($codigo_empleado);	
			foreach ($data_hora_cubi as $value_horas_cubi) {
				$horas_cubiertas_extras= floatval($value_horas_cubi["hora_extra_situacion"]);
				$total_horas_cubiertas_extras.=$value_horas_cubi["hora_extra_situacion"];
			}
			/* ----------HORAS NORMALES------------------ */
			$data_hora_normales = horas_cubiertar_normal($codigo_empleado);	
			foreach ($data_hora_normales as $value_horas_cubi) {
				$horas_cubiertas_normal= floatval($value_horas_cubi["hora_normales_situacion"]);
				$total_horas_cubiertas_normal.=$value_horas_cubi["hora_normales_situacion"];
			}

			/* ---------HORAS AUSENCIA TOTAL------------- */
			$data_hora_aus = situaciones_horas($codigo_empleado,$fecha_desde_format,$fechahasta02);
			foreach ($data_hora_aus as $value_horas_aus) {
				$horas_ausencia_situacion = $value_horas_aus["horas_ausencia_situacion"];
				$total_horas_ausencia .= $value_horas_aus["horas_ausencia_situacion"];
			
				/* --------------------- */

			}


			/* ------------------------------ */
						/* HORAS EXTRAS CUBIERTAS DE AUSENCIAS */
						if($total_horas_cubiertas_extras>0){

												$datadevengo = consultar_devengo2("23");
												$codigo_devengo="";
												$descipcion_devengo="";
												$isss_devengo="";
												$afp_devengo="";
												$renta_devengo="";
												$id_devengo="";
												$suma_resta="";
												foreach ($datadevengo as $valuedevengo) {
													$id_devengo.=$valuedevengo["id"];
													$codigo_devengo.=$valuedevengo["codigo"];
													$descipcion_devengo.=$valuedevengo["descripcion"];
													$isss_devengo.=$valuedevengo["isss_devengo"];
													$afp_devengo.=$valuedevengo["afp_devengo"];
													$renta_devengo.=$valuedevengo["renta_devengo"];
													$suma_resta.=$valuedevengo["tipo"];
												}

														$total_valor_horas_aus=floatval($hora_extra_diurna)*floatval($total_horas_cubiertas_extras);

														$codigo_devengo_descuento_planilla=$codigo_devengo;
														$descripcion_devengo_descuento_planilla=$descipcion_devengo;
														$tipo_devengo_descuento_planilla=$id_devengo;
														$isss_devengo_devengo_descuento_planilla=$isss_devengo;
														$afp_devengo_devengo_descuento_planilla=$afp_devengo;
														$renta_devengo_devengo_descuento_planilla=$renta_devengo;
														$idempleado_devengo=$value["idempleado"];
														$valor_devengo_planilla=$total_valor_horas_aus;
														$tipo_valor=$suma_resta;
														$codigo_planilla_devengo=$numero_planilladevengo_admin;
														
														$values_devengo.="('$codigo_devengo_descuento_planilla', '$descripcion_devengo_descuento_planilla', '$tipo_devengo_descuento_planilla', '$isss_devengo_devengo_descuento_planilla', '$afp_devengo_devengo_descuento_planilla', '$renta_devengo_devengo_descuento_planilla', '$idempleado_devengo', '$valor_devengo_planilla', '$tipo_valor', '$codigo_planilla_devengo','','','','','','','$total_horas_cubiertas_extras','$hora_extra_diurna'),";

						}
			/* ------------------------------ */

				/* ------------------------------ */
					/* HORAS NORMALES CUBIERTAS DE AUSENCIAS */
					if($total_horas_cubiertas_normal>0){

									$datadevengo = consultar_devengo2("23");
									$codigo_devengo="";
									$descipcion_devengo="";
									$isss_devengo="";
									$afp_devengo="";
									$renta_devengo="";
									$id_devengo="";
									$suma_resta="";
									foreach ($datadevengo as $valuedevengo) {
										$id_devengo.=$valuedevengo["id"];
										$codigo_devengo.=$valuedevengo["codigo"];
										$descipcion_devengo.=$valuedevengo["descripcion"];
										$isss_devengo.=$valuedevengo["isss_devengo"];
										$afp_devengo.=$valuedevengo["afp_devengo"];
										$renta_devengo.=$valuedevengo["renta_devengo"];
										$suma_resta.=$valuedevengo["tipo"];
									}

									$sueldo_viatico=floatval($salario_empleado)+floatval($viaticos_empleados);
									$sueldo_diario02=floatval($sueldo_viatico)/15;
									$sueldo_dia_pagar=floatval($sueldo_diario02)/12;
									
									$total_valor_horas_aus=floatval($sueldo_dia_pagar)*floatval($total_horas_cubiertas_normal);
								


									$codigo_devengo_descuento_planilla=$codigo_devengo;
									$descripcion_devengo_descuento_planilla=$descipcion_devengo;
									$tipo_devengo_descuento_planilla=$id_devengo;
									$isss_devengo_devengo_descuento_planilla=$isss_devengo;
									$afp_devengo_devengo_descuento_planilla=$afp_devengo;
									$renta_devengo_devengo_descuento_planilla=$renta_devengo;
									$idempleado_devengo=$value["idempleado"];
									$valor_devengo_planilla=$total_valor_horas_aus;
									$tipo_valor=$suma_resta;
									$codigo_planilla_devengo=$numero_planilladevengo_admin;

									$values_devengo.="('$codigo_devengo_descuento_planilla', '$descripcion_devengo_descuento_planilla', '$tipo_devengo_descuento_planilla', '$isss_devengo_devengo_descuento_planilla', '$afp_devengo_devengo_descuento_planilla', '$renta_devengo_devengo_descuento_planilla', '$idempleado_devengo', '$valor_devengo_planilla', '$tipo_valor', '$codigo_planilla_devengo','','','','','','','$total_horas_cubiertas_normal','$sueldo_dia_pagar'),";
									

					}
				/* ------------------------------ */

			/* HORAS AUSENCIAS NO CUBIERTAS*/
			$suma_horas=floatval($total_horas_cubiertas_extras)+floatval($total_horas_cubiertas_normal);
			$horas_no_cubiertas=floatval($total_horas_ausencia)-floatval($suma_horas);
				if($horas_no_cubiertas>0){
						$datadevengo = consultar_devengo2("23");
						$codigo_devengo="";
						$descipcion_devengo="";
						$isss_devengo="";
						$afp_devengo="";
						$renta_devengo="";
						$id_devengo="";
						$suma_resta="";
						foreach ($datadevengo as $valuedevengo) {
							$id_devengo.=$valuedevengo["id"];
							$codigo_devengo.=$valuedevengo["codigo"];
							$descipcion_devengo.=$valuedevengo["descripcion"];
							$isss_devengo.=$valuedevengo["isss_devengo"];
							$afp_devengo.=$valuedevengo["afp_devengo"];
							$renta_devengo.=$valuedevengo["renta_devengo"];
							$suma_resta.=$valuedevengo["tipo"];
						}

						$sueldo_viatico=floatval($salario_empleado)+floatval($viaticos_empleados);
						$sueldo_diario02=floatval($sueldo_viatico)/15;
						$sueldo_dia_pagar=floatval($sueldo_diario02)/12;
						$total_valor_horas_aus=floatval($sueldo_dia_pagar)*floatval($horas_no_cubiertas);

						$codigo_devengo_descuento_planilla=$codigo_devengo;
						$descripcion_devengo_descuento_planilla=$descipcion_devengo;
						$tipo_devengo_descuento_planilla=$id_devengo;
						$isss_devengo_devengo_descuento_planilla=$isss_devengo;
						$afp_devengo_devengo_descuento_planilla=$afp_devengo;
						$renta_devengo_devengo_descuento_planilla=$renta_devengo;
						$idempleado_devengo=$value["idempleado"];
						$valor_devengo_planilla=$total_valor_horas_aus;
						$tipo_valor=$suma_resta;
						$codigo_planilla_devengo=$numero_planilladevengo_admin;

						$values_devengo.="('$codigo_devengo_descuento_planilla', '$descripcion_devengo_descuento_planilla', '$tipo_devengo_descuento_planilla', '$isss_devengo_devengo_descuento_planilla', '$afp_devengo_devengo_descuento_planilla', '$renta_devengo_devengo_descuento_planilla', '$idempleado_devengo', '$valor_devengo_planilla', '$tipo_valor', '$codigo_planilla_devengo','','','','','','','$horas_no_cubiertas','$sueldo_dia_pagar'),";

				}
			/* --------------------- */

			/* DIAS TRABAJADOS EN INCAPACIDAD */

			if($dias_tra_inca>0){
				$datadevengo = consultar_devengo2("31");
				$codigo_devengo="";
				$descipcion_devengo="";
				$isss_devengo="";
				$afp_devengo="";
				$renta_devengo="";
				$id_devengo="";
				$suma_resta="";
				foreach ($datadevengo as $valuedevengo) {
					$id_devengo.=$valuedevengo["id"];
					$codigo_devengo.=$valuedevengo["codigo"];
					$descipcion_devengo.=$valuedevengo["descripcion"];
					$isss_devengo.=$valuedevengo["isss_devengo"];
					$afp_devengo.=$valuedevengo["afp_devengo"];
					$renta_devengo.=$valuedevengo["renta_devengo"];
					$suma_resta.=$valuedevengo["tipo"];
				}
				$valor_devengo_incapacidad=floatval($sueldo_diario)*floatval($dias_tra_inca);
				
				$codigo_devengo_descuento_planilla=$codigo_devengo;
				$descripcion_devengo_descuento_planilla=$descipcion_devengo;
				$tipo_devengo_descuento_planilla=$id_devengo;
				$isss_devengo_devengo_descuento_planilla=$isss_devengo;
				$afp_devengo_devengo_descuento_planilla=$afp_devengo;
				$renta_devengo_devengo_descuento_planilla=$renta_devengo;
				$idempleado_devengo=$value["idempleado"];
				$valor_devengo_planilla=$valor_devengo_incapacidad;
				$tipo_valor=$suma_resta;
				$codigo_planilla_devengo=$numero_planilladevengo_admin;
				$values_devengo.="('$codigo_devengo_descuento_planilla', '$descripcion_devengo_descuento_planilla', '$tipo_devengo_descuento_planilla', '$isss_devengo_devengo_descuento_planilla', '$afp_devengo_devengo_descuento_planilla', '$renta_devengo_devengo_descuento_planilla', '$idempleado_devengo', '$valor_devengo_planilla', '$tipo_valor', '$codigo_planilla_devengo','','','$dias_tra_inca','$sueldo_diario','','','',''),";
			}
			/* DIAS INCAPACIDAD */
			if($dias_incapacidad>0){

					$datadevengo = consultar_devengo2("33");
					$codigo_devengo="";
					$descipcion_devengo="";
					$isss_devengo="";
					$afp_devengo="";
					$renta_devengo="";
					$id_devengo="";
					$suma_resta="";
					foreach ($datadevengo as $valuedevengo) {
						$id_devengo.=$valuedevengo["id"];
						$codigo_devengo.=$valuedevengo["codigo"];
						$descipcion_devengo.=$valuedevengo["descripcion"];
						$isss_devengo.=$valuedevengo["isss_devengo"];
						$afp_devengo.=$valuedevengo["afp_devengo"];
						$renta_devengo.=$valuedevengo["renta_devengo"];
						$suma_resta.=$valuedevengo["tipo"];
					}

					$valor_devengo_incapacidad=0;
					$sueldo_porcentaje=0;
					if($dias_incapacidad>=$dias_maximo_incapacidad){
						$sueldo_porcentaje=$sueldo_diario*$porcentaje_dias_incapacidad;
						$valor_devengo_incapacidad=$sueldo_porcentaje*$dias_maximo_incapacidad;

					}
					else{
						$sueldo_porcentaje=$sueldo_diario*$porcentaje_dias_incapacidad;
						$valor_devengo_incapacidad=$sueldo_porcentaje*$dias_incapacidad;
					}

					$codigo_devengo_descuento_planilla=$codigo_devengo;
					$descripcion_devengo_descuento_planilla=$descipcion_devengo;
					$tipo_devengo_descuento_planilla=$id_devengo;
					$isss_devengo_devengo_descuento_planilla=$isss_devengo;
					$afp_devengo_devengo_descuento_planilla=$afp_devengo;
					$renta_devengo_devengo_descuento_planilla=$renta_devengo;
					$idempleado_devengo=$value["idempleado"];
					$valor_devengo_planilla=$valor_devengo_incapacidad;
					$tipo_valor=$suma_resta;
					$codigo_planilla_devengo=$numero_planilladevengo_admin;

					$values_devengo.="('$codigo_devengo_descuento_planilla', '$descripcion_devengo_descuento_planilla', '$tipo_devengo_descuento_planilla', '$isss_devengo_devengo_descuento_planilla', '$afp_devengo_devengo_descuento_planilla', '$renta_devengo_devengo_descuento_planilla', '$idempleado_devengo', '$valor_devengo_planilla', '$tipo_valor', '$codigo_planilla_devengo','','','','','$dias_maximo_incapacidad','$sueldo_porcentaje','',''),";

			}
			
			if(empty($iddevengo)){
			}
			else{
				/* ******Datos del devengo********* */
				foreach ($datadevengoempleado as $valuesdevengoempleado) {
					$tipodescuento=$valuesdevengoempleado["tipodescuento"];
					if($tipodescuento==$periodo_planilladevengo_admin || $tipodescuento=="Siempre"){
						$iddevengo=$valuesdevengoempleado["id_tipo_devengo_descuento"];	
						$valordevengoempleado=$valuesdevengoempleado["valor"];

						/* ************* */

							$datadevengo = consultar_devengo2($iddevengo);
							$codigo_devengo="";
							$descipcion_devengo="";
							$isss_devengo="";
							$afp_devengo="";
							$renta_devengo="";
							$id_devengo="";
							$suma_resta="";
							foreach ($datadevengo as $valuedevengo) {
								$id_devengo.=$valuedevengo["id"];
								$codigo_devengo.=$valuedevengo["codigo"];
								$descipcion_devengo.=$valuedevengo["descripcion"];
								$isss_devengo.=$valuedevengo["isss_devengo"];
								$afp_devengo.=$valuedevengo["afp_devengo"];
								$renta_devengo.=$valuedevengo["renta_devengo"];
								$suma_resta.=$valuedevengo["tipo"];

							}

							
							$codigo_devengo_descuento_planilla=$codigo_devengo;
							$descripcion_devengo_descuento_planilla=$descipcion_devengo;
							$tipo_devengo_descuento_planilla=$id_devengo;
							$isss_devengo_devengo_descuento_planilla=$isss_devengo;
							$afp_devengo_devengo_descuento_planilla=$afp_devengo;
							$renta_devengo_devengo_descuento_planilla=$renta_devengo;
							$idempleado_devengo=$value["idempleado"];
							$valor_devengo_planilla=$valordevengoempleado;
							$tipo_valor=$suma_resta;
							$codigo_planilla_devengo=$numero_planilladevengo_admin;

							$values_devengo.="('$codigo_devengo_descuento_planilla', '$descripcion_devengo_descuento_planilla', '$tipo_devengo_descuento_planilla', '$isss_devengo_devengo_descuento_planilla', '$afp_devengo_devengo_descuento_planilla', '$renta_devengo_devengo_descuento_planilla', '$idempleado_devengo', '$valor_devengo_planilla', '$tipo_valor', '$codigo_planilla_devengo','','','','','','','',''),";

						/* ************ */


					}
				}
				/* **************************** */
			}


			/* DEVENGO QUINCENAL PLANILLA ANTICIPO */

			/* ************* */

			$datadevengo_anticipo = devengo_anticipo($idempleado);
			foreach ($datadevengo_anticipo as $valuedevengo_anticipo) {
				$devengoquincenal=$valuedevengo_anticipo["valor_devengo_planilla"];
				if($devengoquincenal>0){
						/* ************* */
						$datadevengo = consultar_devengo2('25');
						$codigo_devengo="";
						$descipcion_devengo="";
						$isss_devengo="";
						$afp_devengo="";
						$renta_devengo="";
						$id_devengo="";
						$suma_resta="";
						foreach ($datadevengo as $valuedevengo) {
							$id_devengo.=$valuedevengo["id"];
							$codigo_devengo.=$valuedevengo["codigo"];
							$descipcion_devengo.=$valuedevengo["descripcion"];
							$isss_devengo.=$valuedevengo["isss_devengo"];
							$afp_devengo.=$valuedevengo["afp_devengo"];
							$renta_devengo.=$valuedevengo["renta_devengo"];
							$suma_resta.=$valuedevengo["tipo"];

						}

						
						$codigo_devengo_descuento_planilla=$codigo_devengo;
						$descripcion_devengo_descuento_planilla=$descipcion_devengo;
						$tipo_devengo_descuento_planilla=$id_devengo;
						$isss_devengo_devengo_descuento_planilla=$isss_devengo;
						$afp_devengo_devengo_descuento_planilla=$afp_devengo;
						$renta_devengo_devengo_descuento_planilla=$renta_devengo;
						$idempleado_devengo=$value["idempleado"];
						$valor_devengo_planilla=$devengoquincenal;
						$tipo_valor=$suma_resta;
						$codigo_planilla_devengo=$numero_planilladevengo_admin;
						$values_devengo.="('$codigo_devengo_descuento_planilla', '$descripcion_devengo_descuento_planilla', '$tipo_devengo_descuento_planilla', '$isss_devengo_devengo_descuento_planilla', '$afp_devengo_devengo_descuento_planilla', '$renta_devengo_devengo_descuento_planilla', '$idempleado_devengo', '$valor_devengo_planilla', '$tipo_valor', '$codigo_planilla_devengo','','','','','','','',''),";

					/* ************ */

				}

			}

			
			/* ************************************ */
			/* DEVENGO POR DIAS FERIADOS TRABAJADOS */

			$data_viatico_permanente= viatico_permanente('2',$idempleado);	
			$valor_viatico_permanente="";		
			foreach ($data_viatico_permanente as $value_viatico) {
				$valor_viatico_permanente.=$value_viatico["valor"];		
			}


			/* ***** VALIDAR SI ESTAMOS EN EL MES DE DIAS FERIADOS Y BUSCAR SI EMPLEADO A ESTA AUSENTE EN LOS DIAS FERIADOS */
			$data_ausencia_dias_feriados= ausencia_dias_feriados($idempleado);	
			$restar_dias_feriados=0;	
			$fecha_feriado_ausencia="";	
			foreach ($data_ausencia_dias_feriados as $value_ausencia_dias_feriados) {
				$fecha_feriado_ausencia.=$value_ausencia_dias_feriados["fecha_feriado"];	
			}
			
			$data_dias_feriados= dias_feriados();	
			foreach ($data_dias_feriados as $value_dias_feriados) {
				$fecha_desde=$value_dias_feriados["fecha_desde"];		
				$fecha_hasta=$value_dias_feriados["fecha_hasta"];	

				$fecha_desde_mes=date("m", strtotime($fecha_desde));	
				$fechaActual_mes = date("m", strtotime($fecha_planilladevengo_admin));
				if($fechaActual_mes==$fecha_desde_mes){

					$fecha_desde_mes_feriado=$value_dias_feriados["fecha_desde"];
					$fecha_hasta_mes_feriado=$value_dias_feriados["fecha_hasta"];
					$resultado_dias=0;
					if ($fecha_feriado_ausencia >= $fecha_desde && $fecha_feriado_ausencia <= $fecha_hasta){
						$resultado_dias=$resultado_dias+1;
					}		
					/* CONTAR LOS DIAS FERIADOS */
					$feriado_desde= date("Y-m-d", strtotime($fecha_desde_mes_feriado));
					$feriado_hasta = date("Y-m-d", strtotime($fecha_hasta_mes_feriado));
					/* lunes-viernes */
					$workingDays = 0;
					$startTimestamp = strtotime($feriado_desde);
					$endTimestamp = strtotime($feriado_hasta);
					for ($i = $startTimestamp; $i <= $endTimestamp; $i = $i + (60 * 60 * 24)) {
						if (date("N", $i) <= 5) $workingDays = $workingDays + 1;
					}
					/* *********** */
					/* ****sabado-domingo */
					$weekendDays = 0;
					$startTimestamp = strtotime($feriado_desde);
					$endTimestamp = strtotime($feriado_hasta);
					for ($i = $startTimestamp; $i <= $endTimestamp; $i = $i + (60 * 60 * 24)) {
						if (date("N", $i) > 5) $weekendDays = $weekendDays + 1;
					}

					$dias_festivos= floatval($workingDays)+floatval($weekendDays);
					$restar_dias_feriados.=floatval($dias_festivos)-floatval($resultado_dias);
					/* echo $restar_dias_feriados.'restar_dias_feriados'; */
					/* *********************** */
					
				}
				
			}
			/* ******************************************************** */

			if($restar_dias_feriados>0){
				
					$data_cargo= cargo_empleado($idcargo_empleado);		
					foreach ($data_cargo as $valu_cargo) {
							$pago_feriados=$valu_cargo["pago_feriados"];
							$calculo=$valu_cargo["calculo"];
							if($pago_feriados=="Si"){
								$ecuacion_dias=0;
								$valordias=0;
								if($calculo=="Sueldo+Tfijo"){
									$salario_mas_viatico=floatval($salario_empleado)+floatval($valor_viatico_permanente);
									$valordias=floatval($salario_mas_viatico)/15;
									$ecuacion_dias=$valordias*floatval($restar_dias_feriados);
								}
								else{
									$valordias=floatval($salario_empleado)/15;
									$ecuacion_dias=floatval($valordias)*floatval($restar_dias_feriados);
								}
								/* ******************* */
									$datadevengo = consultar_devengo2('0021');
									$codigo_devengo="";
									$descipcion_devengo="";
									$isss_devengo="";
									$afp_devengo="";
									$renta_devengo="";
									$id_devengo="";
									$suma_resta="";
									foreach ($datadevengo as $valuedevengo) {
										$id_devengo.=$valuedevengo["id"];
										$codigo_devengo.=$valuedevengo["codigo"];
										$descipcion_devengo.=$valuedevengo["descripcion"];
										$isss_devengo.=$valuedevengo["isss_devengo"];
										$afp_devengo.=$valuedevengo["afp_devengo"];
										$renta_devengo.=$valuedevengo["renta_devengo"];
										$suma_resta.=$valuedevengo["tipo"];

									}
									$codigo_devengo_descuento_planilla=$codigo_devengo;
									$descripcion_devengo_descuento_planilla=$descipcion_devengo;
									$tipo_devengo_descuento_planilla=$id_devengo;
									$isss_devengo_devengo_descuento_planilla=$isss_devengo;
									$afp_devengo_devengo_descuento_planilla=$afp_devengo;
									$renta_devengo_devengo_descuento_planilla=$renta_devengo;
									$idempleado_devengo=$value["idempleado"];
									$valor_devengo_planilla= bcdiv($ecuacion_dias, '1', 2);
									$tipo_valor=$suma_resta;
									$codigo_planilla_devengo=$numero_planilladevengo_admin;

									$values_devengo.="('$codigo_devengo_descuento_planilla', '$descripcion_devengo_descuento_planilla', '$tipo_devengo_descuento_planilla', '$isss_devengo_devengo_descuento_planilla', '$afp_devengo_devengo_descuento_planilla', '$renta_devengo_devengo_descuento_planilla', '$idempleado_devengo', '$valor_devengo_planilla', '$tipo_valor', '$codigo_planilla_devengo','$restar_dias_feriados','$valordias','','','','','',''),";

								/* ******************* */
									
							}
					}
			
			}
			/* ********************************************* */

			/* *************BONO POR UBICACION*************** */
				$databonoubicacion = bonoubicacion($codigo_empleado);			
				foreach ($databonoubicacion as $valubonoubicacion) {
						$bono=$valubonoubicacion["bonos"];
					/* ******************* */
						$datadevengo = consultar_devengo2('0061');
						$codigo_devengo="";
						$descipcion_devengo="";
						$isss_devengo="";
						$afp_devengo="";
						$renta_devengo="";
						$id_devengo="";
						$suma_resta="";
						foreach ($datadevengo as $valuedevengo) {
							$id_devengo.=$valuedevengo["id"];
							$codigo_devengo.=$valuedevengo["codigo"];
							$descipcion_devengo.=$valuedevengo["descripcion"];
							$isss_devengo.=$valuedevengo["isss_devengo"];
							$afp_devengo.=$valuedevengo["afp_devengo"];
							$renta_devengo.=$valuedevengo["renta_devengo"];
							$suma_resta.=$valuedevengo["tipo"];

						}
						$codigo_devengo_descuento_planilla=$codigo_devengo;
						$descripcion_devengo_descuento_planilla=$descipcion_devengo;
						$tipo_devengo_descuento_planilla=$id_devengo;
						$isss_devengo_devengo_descuento_planilla=$isss_devengo;
						$afp_devengo_devengo_descuento_planilla=$afp_devengo;
						$renta_devengo_devengo_descuento_planilla=$renta_devengo;
						$idempleado_devengo=$value["idempleado"];
						$valor_devengo_planilla= bcdiv($bono, '1', 2);
						$tipo_valor=$suma_resta;
						$codigo_planilla_devengo=$numero_planilladevengo_admin;

						$values_devengo.="('$codigo_devengo_descuento_planilla', '$descripcion_devengo_descuento_planilla', '$tipo_devengo_descuento_planilla', '$isss_devengo_devengo_descuento_planilla', '$afp_devengo_devengo_descuento_planilla', '$renta_devengo_devengo_descuento_planilla', '$idempleado_devengo', '$valor_devengo_planilla', '$tipo_valor', '$codigo_planilla_devengo','','','','','','','',''),";

					/* ******************* */
				}
			/* ********************************************* */

			
			/* *************BONO POR NO FALTAR*************** */
			$databonopornofaltar = bonopornofaltar($codigo_empleado);			
			foreach ($databonopornofaltar as $valubonopornofaltar) {
				$bono=$valubonopornofaltar["valor_devengo_ubicacion"];
				$periodo=$valubonopornofaltar["periodo_devengo_ubicacion"];
				if($periodo=="Siempre"){
					$periodo=$periodo_planilladevengo_admin;
				}
				
				if($periodo==$periodo_planilladevengo_admin){
						$fecha_planilladevengo_admin01 = date("Y-m-d", strtotime($fecha_planilladevengo_admin));
						$fecha_gratificacion_admin= date("Y-m-d", strtotime($_POST["fecha_gratificacion_admin"]));
						$datasituacion = situaciones($codigo_empleado,$fecha_gratificacion_admin,$fecha_planilladevengo_admin01);
						$dias_ausencia_situ_bono="vacio";
						foreach ($datasituacion as $valuesituacion) {
							$dias_ausencia_situ_bono.=$valuesituacion["sumaausencia"];
						}
						
						if($tiempotrabajo=="viejo"){

							if($dias_ausencia_situ_bono=="vacio"){
								/* ******************* */
								$datadevengo = consultar_devengo2('0020');
								$codigo_devengo="";
								$descipcion_devengo="";
								$isss_devengo="";
								$afp_devengo="";
								$renta_devengo="";
								$id_devengo="";
								$suma_resta="";
								foreach ($datadevengo as $valuedevengo) {
									$id_devengo.=$valuedevengo["id"];
									$codigo_devengo.=$valuedevengo["codigo"];
									$descipcion_devengo.=$valuedevengo["descripcion"];
									$isss_devengo.=$valuedevengo["isss_devengo"];
									$afp_devengo.=$valuedevengo["afp_devengo"];
									$renta_devengo.=$valuedevengo["renta_devengo"];
									$suma_resta.=$valuedevengo["tipo"];

								}
								$codigo_devengo_descuento_planilla=$codigo_devengo;
								$descripcion_devengo_descuento_planilla=$descipcion_devengo;
								$tipo_devengo_descuento_planilla=$id_devengo;
								$isss_devengo_devengo_descuento_planilla=$isss_devengo;
								$afp_devengo_devengo_descuento_planilla=$afp_devengo;
								$renta_devengo_devengo_descuento_planilla=$renta_devengo;
								$idempleado_devengo=$value["idempleado"];
								$valor_devengo_planilla= bcdiv($bono, '1', 2);
								$tipo_valor=$suma_resta;
								$codigo_planilla_devengo=$numero_planilladevengo_admin;

								$values_devengo.="('$codigo_devengo_descuento_planilla', '$descripcion_devengo_descuento_planilla', '$tipo_devengo_descuento_planilla', '$isss_devengo_devengo_descuento_planilla', '$afp_devengo_devengo_descuento_planilla', '$renta_devengo_devengo_descuento_planilla', '$idempleado_devengo', '$valor_devengo_planilla', '$tipo_valor', '$codigo_planilla_devengo','','','','','','','',''),";
					 		/* ******************* */
							}
						}


						if($tiempotrabajo=="nuevo"){

							if($dias_ausencia_situ_bono=="vacio"){

								$calculobono=floatval($bono)/30*floatval($total_dias_trabajados);
								/* ******************* */
								$datadevengo = consultar_devengo2('0020');
								$codigo_devengo="";
								$descipcion_devengo="";
								$isss_devengo="";
								$afp_devengo="";
								$renta_devengo="";
								$id_devengo="";
								$suma_resta="";
								foreach ($datadevengo as $valuedevengo) {
									$id_devengo.=$valuedevengo["id"];
									$codigo_devengo.=$valuedevengo["codigo"];
									$descipcion_devengo.=$valuedevengo["descripcion"];
									$isss_devengo.=$valuedevengo["isss_devengo"];
									$afp_devengo.=$valuedevengo["afp_devengo"];
									$renta_devengo.=$valuedevengo["renta_devengo"];
									$suma_resta.=$valuedevengo["tipo"];

								}
								$codigo_devengo_descuento_planilla=$codigo_devengo;
								$descripcion_devengo_descuento_planilla=$descipcion_devengo;
								$tipo_devengo_descuento_planilla=$id_devengo;
								$isss_devengo_devengo_descuento_planilla=$isss_devengo;
								$afp_devengo_devengo_descuento_planilla=$afp_devengo;
								$renta_devengo_devengo_descuento_planilla=$renta_devengo;
								$idempleado_devengo=$value["idempleado"];
								$valor_devengo_planilla= bcdiv($calculobono, '1', 2);
								$tipo_valor=$suma_resta;
								$codigo_planilla_devengo=$numero_planilladevengo_admin;

							
								$values_devengo.="('$codigo_devengo_descuento_planilla', '$descripcion_devengo_descuento_planilla', '$tipo_devengo_descuento_planilla', '$isss_devengo_devengo_descuento_planilla', '$afp_devengo_devengo_descuento_planilla', '$renta_devengo_devengo_descuento_planilla', '$idempleado_devengo', '$valor_devengo_planilla', '$tipo_valor', '$codigo_planilla_devengo','','','','','','','',''),";

							/* ******************* */
							}
						}
				}

			}
		 /* ********************************************* */

			/* *********RECIBO DESCUENTO***************** */
			$datarecibo = recibo($idempleado,$fecha_desde_format,$fechahasta02);
			foreach ($datarecibo as $valuerecibo) {

				/* ************************ */
				$iddevengo=$valuerecibo["descuento_recibo"];
				$valorrecibo=$valuerecibo["valor_recibo"];
				$idrecibo.=$valuerecibo["id"].",";
						$datadevengo = consultar_devengo2($iddevengo);
						$codigo_devengo="";
						$descipcion_devengo="";
						$isss_devengo="";
						$afp_devengo="";
						$renta_devengo="";
						$id_devengo="";
						$suma_resta="";
						foreach ($datadevengo as $valuedevengo) {
							$id_devengo.=$valuedevengo["id"];
							$codigo_devengo.=$valuedevengo["codigo"];
							$descipcion_devengo.=$valuedevengo["descripcion"];
							$isss_devengo.=$valuedevengo["isss_devengo"];
							$afp_devengo.=$valuedevengo["afp_devengo"];
							$renta_devengo.=$valuedevengo["renta_devengo"];
							$suma_resta.=$valuedevengo["tipo"];
						}
						$codigo_devengo_descuento_planilla=$codigo_devengo;
						$descripcion_devengo_descuento_planilla=$descipcion_devengo;
						$tipo_devengo_descuento_planilla=$id_devengo;
						$isss_devengo_devengo_descuento_planilla=$isss_devengo;
						$afp_devengo_devengo_descuento_planilla=$afp_devengo;
						$renta_devengo_devengo_descuento_planilla=$renta_devengo;
						$idempleado_devengo=$value["idempleado"];
						$valor_devengo_planilla=$valorrecibo;
						$tipo_valor=$suma_resta;
						$codigo_planilla_devengo=$numero_planilladevengo_admin;

						$values_devengo.="('$codigo_devengo_descuento_planilla', '$descripcion_devengo_descuento_planilla', '$tipo_devengo_descuento_planilla', '$isss_devengo_devengo_descuento_planilla', '$afp_devengo_devengo_descuento_planilla', '$renta_devengo_devengo_descuento_planilla', '$idempleado_devengo', '$valor_devengo_planilla', '$tipo_valor', '$codigo_planilla_devengo','','','','','','','',''),";


				/* ************************ */
				
			}
			/* ******************** */

			$numero_planilladevengo_admin=$numero_planilladevengo_admin;
			$fecha_planilladevengo_admin=$fecha_planilladevengo_admin;
			$fecha_desde_planilladevengo_admin=$_POST["fechaperiodo1"];
			$fecha_hasta_planilladevengo_admin=$_POST["fechaperiodo2"];
			$descripcion_planilladevengo_admin=$descripcion_planilladevengo_admin;
			$codigo_empleado_planilladevengo_admin=$value["codigo_empleado"];
			$nombre_empleado_planilladevengo_admin=$value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"];
			$id_empleado_planilladevengo_admin=$value["idempleado"];
			$sueldo_planilladevengo_admin=bcdiv($sueldo_total, '1', 2); ;
			$sueldo="0";
			$devengo="0";
			$totaldevengo=$sueldo+$devengo;
			$total_devengo_admin_planilladevengo_admin=$totaldevengo;
			$total_liquidado_planilladevengo_admin=$totaldevengo;
			$codigo_ubicacion_planilladevengo_admin="";
			$nombre_ubicacion_planilladevengo_admin="";
			$id_ubicacion_planilladevengo_admin="";
			$periodo_planilladevengo_admin=$periodo_planilladevengo_admin;
			$tipo_planilladevengo_admin=$tipo_planilladevengo_admin;
			$empleado_rango_desde=$empleado_rango_desde;
			$empleado_rango_hasta=$empleado_rango_hasta;
			$observacion_planilladevengo_admin=$observacion;
			$fecha_gratificacion_admin=$_POST["fecha_gratificacion_admin"];
			/* ---------------- */
			if($salario_isss>=$tope_isss){
				$salario_isss=$salario_isss;
			}
			$descuento_isss_planilladevengo_admin=  bcdiv($descuento_isss, '1', 2); 
			$descuento_afp_planilladevengo_admin=  bcdiv($descuento_afp, '1', 2); 
			$descuento_renta_planilladevengo_admin=  bcdiv($descuento_renta, '1', 2);
			$sueldo_renta_planilladevengo_admin=  bcdiv($renta_final, '1', 2);
			$sueldo_isss_planilladevengo_admin= bcdiv($salario_isss, '1', 2); 
			$sueldo_afp_planilladevengo_admin=  bcdiv($salario_afp, '1', 2);
			$hora_extra_diurna_planilladevengo_admin=$horas_extras;




			$values_consulta.="('$numero_planilladevengo_admin','$fecha_planilladevengo_admin','$fecha_desde_planilladevengo_admin','$fecha_hasta_planilladevengo_admin','$descripcion_planilladevengo_admin','$codigo_empleado_planilladevengo_admin','$nombre_empleado_planilladevengo_admin','$id_empleado_planilladevengo_admin','$sueldo_planilladevengo_admin','$total_devengo_admin_planilladevengo_admin','$total_liquidado_planilladevengo_admin','$codigo_ubicacion_planilladevengo_admin','$nombre_ubicacion_planilladevengo_admin','$id_ubicacion_planilladevengo_admin','$periodo_planilladevengo_admin','$tipo_planilladevengo_admin','$empleado_rango_desde','$empleado_rango_hasta','$total_dias_trabajados','$dias_incapacidad','$dias_ausencia','$dias_trabajo_planilladevengo_admin','$descuento_isss_planilladevengo_admin','$descuento_afp_planilladevengo_admin','$descuento_renta_planilladevengo_admin','$sueldo_renta_planilladevengo_admin','$sueldo_isss_planilladevengo_admin','$sueldo_afp_planilladevengo_admin','$observacion_planilladevengo_admin','$fecha_gratificacion_admin','$hora_extra_diurna_planilladevengo_admin'),";

			$datos_html .= ' <tr class="btnEditarabase" pensionado_empleado="'.$value["pensionado_empleado"].'" hora_extra_nocturna_domingo="'.$value["hora_extra_nocturna_domingo"].'"   hora_extra_domingo="'.$value["hora_extra_domingo"].'"  hora_extra_nocturna="'.$value["hora_extra_nocturna"].'" hora_extra_diurna="'.$value["hora_extra_diurna"].'"    salario_por_hora="'.$value["salario_por_hora"].'"  sueldo="'.$value["sueldo"].'"  idempleado="'.$value["idempleado"].'" codigo="'.$value["codigo_empleado"].'"  nombre="'.$value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"].'">
			<td>'.$value["codigo_empleado"].'</td>
			<td>'.$value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"].' </td>';
			$datos_html .='<td><div class="btn btn-danger eliminarempleado" numero_planilla="'.$numero_planilladevengo_admin.'" idempleado="'.$value["idempleado"].'"><i class="fa fa-times"></i></div></td>';
			$datos_html .= '</tr>';
		}

		$datos_html .= '</tbody></table>';
		/* echo trim($values_consulta, ","); */


		/* echo $datos_html; */
		function consultar_planilla($numero_planilladevengo_admin1)
			{
			
				$query01="SELECT `id`, `numero_planilladevengo_admin`, `fecha_planilladevengo_admin`, `fecha_desde_planilladevengo_admin`, `fecha_hasta_planilladevengo_admin`, `descripcion_planilladevengo_admin`, `codigo_empleado_planilladevengo_admin`, `nombre_empleado_planilladevengo_admin`, `id_empleado_planilladevengo_admin`, `dias_trabajo_planilladevengo_admin`, `sueldo_planilladevengo_admin`, `hora_extra_diurna_planilladevengo_admin`, `hora_extra_nocturna_planilladevengo_admin`, `hora_extra_domingo_planilladevengo_admin`, `hora_extra_domingo_nocturna_planilladevengo_admin`, `otro_devengo_admin_planilladevengo_admin`, `total_devengo_admin_planilladevengo_admin`, `descuento_isss_planilladevengo_admin`, `descuento_afp_planilladevengo_admin`, `descuento_renta_planilladevengo_admin`, `otro_descuento_planilladevengo_admin`, `total_descuento_planilladevengo_admin`, `total_liquidado_planilladevengo_admin`, `sueldo_renta_planilladevengo_admin`, `sueldo_isss_planilladevengo_admin`, `sueldo_afp_planilladevengo_admin`, `departamento_planilladevengo_admin`, `codigo_ubicacion_planilladevengo_admin`, `nombre_ubicacion_planilladevengo_admin`, `id_ubicacion_planilladevengo_admin`, `observacion_planilladevengo_admin`, `periodo_planilladevengo_admin`, `tipo_planilladevengo_admin`, `dias_incapacidad`, `empleado_rango_desde`, `empleado_rango_hasta`, COUNT(*) as registro FROM `planilladevengo_admin` WHERE numero_planilladevengo_admin='$numero_planilladevengo_admin1'";
				$sql = Conexion::conectar()->prepare($query01);
				$sql->execute();
				return $sql->fetchAll();
			};
		$data_planilla = consultar_planilla($numero_planilladevengo_admin);
		$registro="";
		foreach ($data_planilla as $value) {
			$registro.=$value["registro"];
		}
		if($registro == 0){

			$insertar_recibo="UPDATE `recibos` SET  `liquidado_recibo`='Si',`numero_planilla_liquidado`='$numero_planilladevengo_admin' WHERE id in  (".trim($idrecibo, ",").")";
			$sql_recibo= Conexion::conectar()->prepare($insertar_recibo);
			$sql_recibo->execute();
			
			$insertar_situacion="UPDATE `situacion` SET  `liquidado_situacion`='Si',`numero_planilla_admin`='$numero_planilladevengo_admin' WHERE id in  (".trim($id_situaciones, ",").")";
			$sql_situacion = Conexion::conectar()->prepare($insertar_situacion);
			$sql_situacion->execute();

			
			$insertar_devengo="INSERT INTO `tbl_devengo_descuento_planilla_admin`(`codigo_devengo_descuento_planilla`, `descripcion_devengo_descuento_planilla`, `tipo_devengo_descuento_planilla`, `isss_devengo_devengo_descuento_planilla`, `afp_devengo_devengo_descuento_planilla`, `renta_devengo_devengo_descuento_planilla`,`idempleado_devengo`, `valor_devengo_planilla`, `tipo_valor`, `codigo_planilla_devengo`,dias_Feriados,valor_dias_Feriados,dias_tra_inca_admin,pago_dias_tra_inca_admin,dias_incapacidad_admin,pago_dias_incapacidad_admin,horas_tardes,precio_horas_tardes) VALUES  ".trim($values_devengo, ",")."";
			$sql_devengo = Conexion::conectar()->prepare($insertar_devengo);
			$sql_devengo->execute();


			$insertar="INSERT INTO `planilladevengo_admin`(`numero_planilladevengo_admin`, `fecha_planilladevengo_admin`, `fecha_desde_planilladevengo_admin`, `fecha_hasta_planilladevengo_admin`, `descripcion_planilladevengo_admin`, `codigo_empleado_planilladevengo_admin`, `nombre_empleado_planilladevengo_admin`, `id_empleado_planilladevengo_admin`, `sueldo_planilladevengo_admin`,  `total_devengo_admin_planilladevengo_admin`, `total_liquidado_planilladevengo_admin`, `codigo_ubicacion_planilladevengo_admin`, `nombre_ubicacion_planilladevengo_admin`, `id_ubicacion_planilladevengo_admin`, `periodo_planilladevengo_admin`, `tipo_planilladevengo_admin`, `empleado_rango_desde`, `empleado_rango_hasta`,dias_trabajo_planilladevengo_admin,dias_incapacidad,dias_ausencia,his_dias_trabajo_admin,descuento_isss_planilladevengo_admin,descuento_afp_planilladevengo_admin,descuento_renta_planilladevengo_admin,sueldo_renta_planilladevengo_admin,sueldo_isss_planilladevengo_admin,sueldo_afp_planilladevengo_admin,observacion_planilladevengo_admin,fecha_gratificacion_admin,hora_extra_diurna_planilladevengo_admin) value ".trim($values_consulta, ",")."";
		
			$sql = Conexion::conectar()->prepare($insertar);
			if ($sql->execute()) {
				/* echo "OK"; */
				echo $numero_planilladevengo_admin;
			} else {
				/* echo "error"; */
			}
			$sql = null;
		}
		else{
		/* 	echo $datos_html; */
		}
	break;
	case "listaconempleado_backup":

		$tipo_planilladevengo_admin = $_POST["tipo_planilladevengo_admin"];
		$periodo_planilladevengo_admin = $_POST["periodo_planilladevengo_admin"];
		$numero_planilladevengo_admin = $_POST["numero_planilladevengo_admin"];
		$descripcion_planilladevengo_admin = $_POST["descripcion_planilladevengo_admin"];


		function consultar($e,$dia1,$dia2,$empleado_rango_desde1,$empleado_rango_hasta1)
		{
			/* $query01="SELECT * FROM tbl_empleados 
					  WHERE YEAR(fecha_contratacion)<YEAR(NOW()) and DAY(fecha_contratacion)=DAY(NOW()) AND MONTH(fecha_contratacion)=MONTH(NOW()) AND DAY(fecha_contratacion) BETWEEN '16' AND '31'  and tbl_empleados.fecha_contratacion < '$e'"; */

			/* 			$query01 = "SELECT tbl_empleados.id as idempleado, tbl_empleados.*, tbl_empleados_devengos_descuentos.* , 				tbl_devengo_descuento.* 
						FROM `tbl_empleados` , tbl_empleados_devengos_descuentos,tbl_devengo_descuento WHERE tbl_empleados.id=tbl_empleados_devengos_descuentos.id_empleado and tbl_devengo_descuento.id = tbl_empleados_devengos_descuentos.id_tipo_devengo_descuento and tbl_devengo_descuento.codigo='0022' and tbl_empleados_devengos_descuentos.valor is NOT null  and tbl_empleados.fecha_contratacion < '$e' and YEAR(fecha_contratacion)<YEAR(NOW()) AND  DATE_FORMAT(DATE(NOW()), '%m-%d') >= DATE_FORMAT(tbl_empleados.fecha_contratacion, '%m-%d') AND MONTH(fecha_contratacion)=MONTH(NOW()) AND DAY(fecha_contratacion) BETWEEN '$dia1' AND '$dia2' "; */

			$query01="SELECT DATE_FORMAT(DATE(NOW()), '%m-%d')as fecha_actual,DATE_FORMAT(tbl_empleados.fecha_contratacion, '%m-%d') as fechacontracion, tbl_empleados.id as idempleado, tbl_empleados.*, tbl_empleados_devengos_descuentos.* , tbl_devengo_descuento.*
			FROM `tbl_empleados` , tbl_empleados_devengos_descuentos,tbl_devengo_descuento 
			WHERE tbl_empleados.id=tbl_empleados_devengos_descuentos.id_empleado and tbl_devengo_descuento.id = tbl_empleados_devengos_descuentos.id_tipo_devengo_descuento and tbl_devengo_descuento.codigo='0022' and tbl_empleados_devengos_descuentos.valor is NOT null    and tbl_empleados.id >= '$empleado_rango_desde1' and tbl_empleados.id <= '$empleado_rango_hasta1' GROUP by tbl_empleados.id";

			/* echo $query01; */
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};
		$newDate = date("Y-m-d", strtotime($fecha_planilladevengo_admin));
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
		foreach ($data01 as $value) {

			
			$numero_planilladevengo_admin=$numero_planilladevengo_admin;
			$fecha_planilladevengo_admin=$fecha_planilladevengo_admin;
			$fecha_desde_planilladevengo_admin=$_POST["fechaperiodo1"];
			$fecha_hasta_planilladevengo_admin=$_POST["fechaperiodo2"];
			$descripcion_planilladevengo_admin=$descripcion_planilladevengo_admin;
			$codigo_empleado_planilladevengo_admin=$value["codigo_empleado"];
			$nombre_empleado_planilladevengo_admin=$value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"];
			$id_empleado_planilladevengo_admin=$value["idempleado"];
			$sueldo_planilladevengo_admin="0";
			$sueldo="0";
			$devengo=$value["valor"];
			$totaldevengo=$sueldo+$devengo;
			$total_devengo_admin_planilladevengo_admin=$totaldevengo;
			$total_liquidado_planilladevengo_admin=$totaldevengo;
			$codigo_ubicacion_planilladevengo_admin="";
			$nombre_ubicacion_planilladevengo_admin="";
			$id_ubicacion_planilladevengo_admin="";
			$periodo_planilladevengo_admin=$periodo_planilladevengo_admin;
			$tipo_planilladevengo_admin=$tipo_planilladevengo_admin;
			$empleado_rango_desde=$empleado_rango_desde;
			$empleado_rango_hasta=$empleado_rango_hasta;

			$values_consulta.="('$numero_planilladevengo_admin','$fecha_planilladevengo_admin','$fecha_desde_planilladevengo_admin','$fecha_hasta_planilladevengo_admin','$descripcion_planilladevengo_admin','$codigo_empleado_planilladevengo_admin','$nombre_empleado_planilladevengo_admin','$id_empleado_planilladevengo_admin','$sueldo_planilladevengo_admin','$total_devengo_admin_planilladevengo_admin','$total_liquidado_planilladevengo_admin','$codigo_ubicacion_planilladevengo_admin','$nombre_ubicacion_planilladevengo_admin','$id_ubicacion_planilladevengo_admin','$periodo_planilladevengo_admin','$tipo_planilladevengo_admin','$empleado_rango_desde','$empleado_rango_hasta'),";

			$datos_html .= ' <tr class="btnEditarabase" hora_extra_nocturna_domingo="'.$value["hora_extra_nocturna_domingo"].'"   hora_extra_domingo="'.$value["hora_extra_domingo"].'"  hora_extra_nocturna="'.$value["hora_extra_nocturna"].'" hora_extra_diurna="'.$value["hora_extra_diurna"].'"   salario_por_hora="'.$value["salario_por_hora"].'"  sueldo="'.$value["sueldo"].'"  idempleado="'.$value["idempleado"].'" codigo="'.$value["codigo_empleado"].'"  nombre="'.$value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"].'">
			<td>'.$value["codigo_empleado"].'</td>
			<td>'.$value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"].' </td>';
			$datos_html .='<td><div class="btn btn-danger eliminarempleado" numero_planilla="'.$numero_planilladevengo_admin.'" idempleado="'.$value["idempleado"].'"><i class="fa fa-times"></i></div></td>';
			$datos_html .= '</tr>';

		}
		$datos_html .= '</tbody></table>';
		/* echo trim($values_consulta, ","); */


		/* echo $datos_html; */
		function consultar_planilla($numero_planilladevengo_admin1)
			{
			
				$query01="SELECT `id`, `numero_planilladevengo_admin`, `fecha_planilladevengo_admin`, `fecha_desde_planilladevengo_admin`, `fecha_hasta_planilladevengo_admin`, `descripcion_planilladevengo_admin`, `codigo_empleado_planilladevengo_admin`, `nombre_empleado_planilladevengo_admin`, `id_empleado_planilladevengo_admin`, `dias_trabajo_planilladevengo_admin`, `sueldo_planilladevengo_admin`, `hora_extra_diurna_planilladevengo_admin`, `hora_extra_nocturna_planilladevengo_admin`, `hora_extra_domingo_planilladevengo_admin`, `hora_extra_domingo_nocturna_planilladevengo_admin`, `otro_devengo_admin_planilladevengo_admin`, `total_devengo_admin_planilladevengo_admin`, `descuento_isss_planilladevengo_admin`, `descuento_afp_planilladevengo_admin`, `descuento_renta_planilladevengo_admin`, `otro_descuento_planilladevengo_admin`, `total_descuento_planilladevengo_admin`, `total_liquidado_planilladevengo_admin`, `sueldo_renta_planilladevengo_admin`, `sueldo_isss_planilladevengo_admin`, `sueldo_afp_planilladevengo_admin`, `departamento_planilladevengo_admin`, `codigo_ubicacion_planilladevengo_admin`, `nombre_ubicacion_planilladevengo_admin`, `id_ubicacion_planilladevengo_admin`, `observacion_planilladevengo_admin`, `periodo_planilladevengo_admin`, `tipo_planilladevengo_admin`, `dias_incapacidad`, `empleado_rango_desde`, `empleado_rango_hasta`, COUNT(*) as registro FROM `planilladevengo_admin` WHERE numero_planilladevengo_admin='$numero_planilladevengo_admin1'";
				$sql = Conexion::conectar()->prepare($query01);
				$sql->execute();
				return $sql->fetchAll();
			};
		$data_planilla = consultar_planilla($numero_planilladevengo_admin);
		$registro="";
		foreach ($data_planilla as $value) {
			$registro.=$value["registro"];
		}
		if($registro == 0){

			
            $insertar_devengo="INSERT INTO `tbl_devengo_descuento_planilla_admin`(`codigo_devengo_descuento_planilla`, `descripcion_devengo_descuento_planilla`, `tipo_devengo_descuento_planilla`, `isss_devengo_devengo_descuento_planilla`, `afp_devengo_devengo_descuento_planilla`, `renta_devengo_devengo_descuento_planilla`,`idempleado_devengo`, `valor_devengo_planilla`, `tipo_valor`, `codigo_planilla_devengo`) VALUES  ".trim($values_devengo, ",")."";
			$sql_devengo = Conexion::conectar()->prepare($insertar_devengo);
			$sql_devengo->execute();


			$insertar="INSERT INTO `planilladevengo_admin`(`numero_planilladevengo_admin`, `fecha_planilladevengo_admin`, `fecha_desde_planilladevengo_admin`, `fecha_hasta_planilladevengo_admin`, `descripcion_planilladevengo_admin`, `codigo_empleado_planilladevengo_admin`, `nombre_empleado_planilladevengo_admin`, `id_empleado_planilladevengo_admin`, `sueldo_planilladevengo_admin`,  `total_devengo_admin_planilladevengo_admin`, `total_liquidado_planilladevengo_admin`, `codigo_ubicacion_planilladevengo_admin`, `nombre_ubicacion_planilladevengo_admin`, `id_ubicacion_planilladevengo_admin`, `periodo_planilladevengo_admin`, `tipo_planilladevengo_admin`, `empleado_rango_desde`, `empleado_rango_hasta`) value ".trim($values_consulta, ",")."";
			$sql = Conexion::conectar()->prepare($insertar);
			if ($sql->execute()) {
				/* echo "OK"; */
				echo $numero_planilladevengo_admin;
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
		
		$tipo_planilladevengo_admin = $_POST["tipo_planilladevengo_admin"];
		$periodo_planilladevengo_admin = $_POST["periodo_planilladevengo_admin"];
		$numero_planilladevengo_admin = $_POST["numero_planilladevengo_admin"];
		$descripcion_planilladevengo_admin = $_POST["descripcion_planilladevengo_admin"];
		function consultar($e,$dia1,$dia2,$numero_planilladevengo_admin1)
		{

			/* $query01="SELECT  tbl_empleados.id as idempleado, tbl_empleados.*, tbl_empleados_devengos_descuentos.* , tbl_devengo_descuento.*
			FROM `tbl_empleados` , tbl_empleados_devengos_descuentos,tbl_devengo_descuento, planilladevengo_admin
			WHERE tbl_empleados.id=tbl_empleados_devengos_descuentos.id_empleado and tbl_devengo_descuento.id = tbl_empleados_devengos_descuentos.id_tipo_devengo_descuento and planilladevengo_admin.id_empleado_planilladevengo_admin=tbl_empleados.id and planilladevengo_admin.numero_planilladevengo_admin=$numero_planilladevengo_admin1 group by tbl_empleados.id"; */

			$query01="SELECT  tbl_empleados.id as idempleado, tbl_empleados.*
			FROM `tbl_empleados` , planilladevengo_admin
			WHERE   planilladevengo_admin.id_empleado_planilladevengo_admin=tbl_empleados.id and planilladevengo_admin.numero_planilladevengo_admin=$numero_planilladevengo_admin1 group by tbl_empleados.id ";

			
		

			/* echo $query01; */
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};
		$newDate = date("Y-m-d", strtotime($fecha_planilladevengo_admin));
		$fechaperiodo1_total = date("Y-m-d", strtotime($_POST["fechaperiodo1"]));
		$fechaperiodo2_total= date("Y-m-d", strtotime($_POST["fechaperiodo2"]));
		$fechaperiodo1 = date("d",strtotime($_POST["fechaperiodo1"]));
		$fechaperiodo2 = date("d",strtotime($_POST["fechaperiodo2"]));
		$data01 = consultar($newDate,$fechaperiodo1,$fechaperiodo2,$numero_planilladevengo_admin);
		$datos_html = "";
		$datos_html .= '  <table class="table table-bordered table-striped dt-responsive tablas1" width="100%" id="tbl_byKeyboard">
		<thead>
		<tr>
			<th style="width:90px">Códigos</th>
			<th>Nombre Empleado</th>
			<th>Acciones</th>
		</tr> 
		</thead>
		<tbody>';
		$datos_html .="<tr id='visiondelempleado'>
					<td></td>
					<td></td>
					<td></td>
						</tr>";

		$values_consulta="";
		foreach ($data01 as $value) {

			$pensionado=$value["pensionado_empleado"];
			if($pensionado==""){
				$pensionado="No";
			}
			else{
				$pensionado=$value["pensionado_empleado"];
			}

	
			$datos_html .= ' <tr class="btnEditarabase" pensionado_empleado="'.$pensionado.'" hora_extra_nocturna_domingo="'.$value["hora_extra_nocturna_domingo"].'"   hora_extra_domingo="'.$value["hora_extra_domingo"].'"  hora_extra_nocturna="'.$value["hora_extra_nocturna"].'" hora_extra_diurna="'.$value["hora_extra_diurna"].'"   sueldo_diario="'.$value["sueldo_diario"].'"  fecha_contratacion="'.$value["fecha_contratacion"].'"  salario_por_hora="'.$value["salario_por_hora"].'"  sueldo="'.$value["sueldo"].'"  idempleado="'.$value["idempleado"].'" codigo="'.$value["codigo_empleado"].'"  nombre="'.$value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"].'">
			<td>'.$value["codigo_empleado"].'</td>
			<td>'.$value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"].' </td>';
			$datos_html .='<td><div class="btn btn-danger eliminarempleado" numero_planilla="'.$numero_planilladevengo_admin.'" idempleado="'.$value["idempleado"].'"><i class="fa fa-times"></i></div></td>';
			$datos_html .= '</tr>';
		}
		$datos_html .= '</tbody></table>';
		/* echo trim($values_consulta, ","); */

		echo $datos_html;
		
	break;
	case "empleadosnoprocesados":
		
		$tipo_planilladevengo_admin = $_POST["tipo_planilladevengo_admin"];
		$periodo_planilladevengo_admin = $_POST["periodo_planilladevengo_admin"];
		$numero_planilladevengo_admin = $_POST["numero_planilladevengo_admin"];
		$descripcion_planilladevengo_admin = $_POST["descripcion_planilladevengo_admin"];

		function consultarnoprocesados($numero_planilladevengo_admin1)
		{


			/* $query01="SELECT*FROM planilladevengo_admin
			WHERE planilladevengo_admin.numero_planilladevengo_admin='$numero_planilladevengo_admin1'  and total_liquidado_planilladevengo_admin='0' or total_liquidado_planilladevengo_admin='' or total_liquidado_planilladevengo_admin='NaN'"; */
			$query01="SELECT*FROM planilladevengo_admin
			WHERE planilladevengo_admin.numero_planilladevengo_admin='$numero_planilladevengo_admin1'";
		
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};

		function consultar($e,$dia1,$dia2,$numero_planilladevengo_admin1,$idempleado1)
		{

			/* $query01="SELECT  tbl_empleados.id as idempleado, tbl_empleados.*, tbl_empleados_devengos_descuentos.* , tbl_devengo_descuento.*
			FROM `tbl_empleados` , tbl_empleados_devengos_descuentos,tbl_devengo_descuento, planilladevengo_admin
			WHERE tbl_empleados.id=tbl_empleados_devengos_descuentos.id_empleado and tbl_devengo_descuento.id = tbl_empleados_devengos_descuentos.id_tipo_devengo_descuento and planilladevengo_admin.id_empleado_planilladevengo_admin=tbl_empleados.id and planilladevengo_admin.numero_planilladevengo_admin=$numero_planilladevengo_admin1 group by tbl_empleados.id"; */

			$query01="SELECT  tbl_empleados.id as idempleado, tbl_empleados.*
			FROM `tbl_empleados` , planilladevengo_admin
			WHERE   planilladevengo_admin.id_empleado_planilladevengo_admin=tbl_empleados.id and planilladevengo_admin.numero_planilladevengo_admin=$numero_planilladevengo_admin1  and id_empleado_planilladevengo_admin='$idempleado1' group by tbl_empleados.id ";
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};
		$newDate = date("Y-m-d", strtotime($fecha_planilladevengo_admin));
		$fechaperiodo1_total = date("Y-m-d", strtotime($_POST["fechaperiodo1"]));
		$fechaperiodo2_total= date("Y-m-d", strtotime($_POST["fechaperiodo2"]));
		$fechaperiodo1 = date("d",strtotime($_POST["fechaperiodo1"]));
		$fechaperiodo2 = date("d",strtotime($_POST["fechaperiodo2"]));


		$datos_html = "";
		$datos_html .= '  <table class="table table-bordered table-striped dt-responsive tablas1" width="100%" id="tbl_byKeyboard">
		<thead>
		<tr>
			<th style="width:90px">Códigos</th>
			<th>Nombre Empleado</th>
			<th>Acciones</th>
		</tr> 
		</thead>
		<tbody>';
		$datos_html .="<tr id='visiondelempleado'>
					<td></td>
					<td></td>
					<td></td>
						</tr>";
		$data_noprocesada = consultarnoprocesados($numero_planilladevengo_admin);
		foreach ($data_noprocesada as $value_noprocesada) {
			$total_liquidado_planilladevengo_admin=$value_noprocesada["total_liquidado_planilladevengo_admin"];
		
			if($total_liquidado_planilladevengo_admin=="0"){

				/* --------------- */
				$data01 = consultar($newDate,$fechaperiodo1,$fechaperiodo2,$numero_planilladevengo_admin,$value_noprocesada["id_empleado_planilladevengo_admin"]);
			$values_consulta="";
			foreach ($data01 as $value) {
				$pensionado=$value["pensionado_empleado"];
				if($pensionado==""){
					$pensionado="No";
				}
				else{
					$pensionado=$value["pensionado_empleado"];
				}

		
				$datos_html .= ' <tr class="btnEditarabase" pensionado_empleado="'.$pensionado.'" hora_extra_nocturna_domingo="'.$value["hora_extra_nocturna_domingo"].'"   hora_extra_domingo="'.$value["hora_extra_domingo"].'"  hora_extra_nocturna="'.$value["hora_extra_nocturna"].'" hora_extra_diurna="'.$value["hora_extra_diurna"].'"   sueldo_diario="'.$value["sueldo_diario"].'"  fecha_contratacion="'.$value["fecha_contratacion"].'"  salario_por_hora="'.$value["salario_por_hora"].'"  sueldo="'.$value["sueldo"].'"  idempleado="'.$value["idempleado"].'" codigo="'.$value["codigo_empleado"].'"  nombre="'.$value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"].'">
				<td>'.$value["codigo_empleado"].'</td>
				<td>'.$value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"].' </td>';
				$datos_html .='<td><div class="btn btn-danger eliminarempleado" numero_planilla="'.$numero_planilladevengo_admin.'" idempleado="'.$value["idempleado"].'"><i class="fa fa-times"></i></div></td>';
				$datos_html .= '</tr>';
			}

				/* --------------- */
				
			}
			if($total_liquidado_planilladevengo_admin==""){

				/* ------------------- */
				$data01 = consultar($newDate,$fechaperiodo1,$fechaperiodo2,$numero_planilladevengo_admin,$value_noprocesada["id_empleado_planilladevengo_admin"]);
			$values_consulta="";
			foreach ($data01 as $value) {
				$pensionado=$value["pensionado_empleado"];
				if($pensionado==""){
					$pensionado="No";
				}
				else{
					$pensionado=$value["pensionado_empleado"];
				}

		
				$datos_html .= ' <tr class="btnEditarabase" pensionado_empleado="'.$pensionado.'" hora_extra_nocturna_domingo="'.$value["hora_extra_nocturna_domingo"].'"   hora_extra_domingo="'.$value["hora_extra_domingo"].'"  hora_extra_nocturna="'.$value["hora_extra_nocturna"].'" hora_extra_diurna="'.$value["hora_extra_diurna"].'"   sueldo_diario="'.$value["sueldo_diario"].'"  fecha_contratacion="'.$value["fecha_contratacion"].'"  salario_por_hora="'.$value["salario_por_hora"].'"  sueldo="'.$value["sueldo"].'"  idempleado="'.$value["idempleado"].'" codigo="'.$value["codigo_empleado"].'"  nombre="'.$value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"].'">
				<td>'.$value["codigo_empleado"].'</td>
				<td>'.$value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"].' </td>';
				$datos_html .='<td><div class="btn btn-danger eliminarempleado" numero_planilla="'.$numero_planilladevengo_admin.'" idempleado="'.$value["idempleado"].'"><i class="fa fa-times"></i></div></td>';
				$datos_html .= '</tr>';
			}
			/* ---------------------- */
			
			}
			if($total_liquidado_planilladevengo_admin=="NaN"){
				/* --------------------- */
				$data01 = consultar($newDate,$fechaperiodo1,$fechaperiodo2,$numero_planilladevengo_admin,$value_noprocesada["id_empleado_planilladevengo_admin"]);
				$values_consulta="";
				foreach ($data01 as $value) {
					$pensionado=$value["pensionado_empleado"];
					if($pensionado==""){
						$pensionado="No";
					}
					else{
						$pensionado=$value["pensionado_empleado"];
					}
	
			
					$datos_html .= ' <tr class="btnEditarabase" pensionado_empleado="'.$pensionado.'" hora_extra_nocturna_domingo="'.$value["hora_extra_nocturna_domingo"].'"   hora_extra_domingo="'.$value["hora_extra_domingo"].'"  hora_extra_nocturna="'.$value["hora_extra_nocturna"].'" hora_extra_diurna="'.$value["hora_extra_diurna"].'"   sueldo_diario="'.$value["sueldo_diario"].'"  fecha_contratacion="'.$value["fecha_contratacion"].'"  salario_por_hora="'.$value["salario_por_hora"].'"  sueldo="'.$value["sueldo"].'"  idempleado="'.$value["idempleado"].'" codigo="'.$value["codigo_empleado"].'"  nombre="'.$value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"].'">
					<td>'.$value["codigo_empleado"].'</td>
					<td>'.$value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"].' </td>';
					$datos_html .='<td><div class="btn btn-danger eliminarempleado" numero_planilla="'.$numero_planilladevengo_admin.'" idempleado="'.$value["idempleado"].'"><i class="fa fa-times"></i></div></td>';
					$datos_html .= '</tr>';
				}

				/* --------------------- */
			}


			/* $data01 = consultar($newDate,$fechaperiodo1,$fechaperiodo2,$numero_planilladevengo_admin,$value_noprocesada["id_empleado_planilladevengo_admin"]);
			$values_consulta="";
			foreach ($data01 as $value) {
				$pensionado=$value["pensionado_empleado"];
				if($pensionado==""){
					$pensionado="No";
				}
				else{
					$pensionado=$value["pensionado_empleado"];
				}

		
				$datos_html .= ' <tr class="btnEditarabase" pensionado_empleado="'.$pensionado.'" hora_extra_nocturna_domingo="'.$value["hora_extra_nocturna_domingo"].'"   hora_extra_domingo="'.$value["hora_extra_domingo"].'"  hora_extra_nocturna="'.$value["hora_extra_nocturna"].'" hora_extra_diurna="'.$value["hora_extra_diurna"].'"   sueldo_diario="'.$value["sueldo_diario"].'"  fecha_contratacion="'.$value["fecha_contratacion"].'"  salario_por_hora="'.$value["salario_por_hora"].'"  sueldo="'.$value["sueldo"].'"  idempleado="'.$value["idempleado"].'" codigo="'.$value["codigo_empleado"].'"  nombre="'.$value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"].'">
				<td>'.$value["codigo_empleado"].'</td>
				<td>'.$value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"].' </td>';
				$datos_html .='<td><div class="btn btn-danger eliminarempleado" numero_planilla="'.$numero_planilladevengo_admin.'" idempleado="'.$value["idempleado"].'"><i class="fa fa-times"></i></div></td>';
				$datos_html .= '</tr>';
			} */
		}
		$datos_html .= '</tbody></table>';
		/* echo trim($values_consulta, ","); */


		echo $datos_html;
		
	break;
	case "addempleadonuevo_backup":

		$tipo_planilladevengo_admin = $_POST["tipo_planilladevengo_admin"];
		$periodo_planilladevengo_admin = $_POST["periodo_planilladevengo_admin"];
		$numero_planilladevengo_admin = $_POST["numero_planilladevengo_admin"];
		$descripcion_planilladevengo_admin = $_POST["descripcion_planilladevengo_admin"];

		$idempleado = $_POST["idempleado"];



		function situaciones($idempleado1,$fechadesde1,$fechahasta2) /* --SUMA DE DIAS AUSENCIA Y INCAPACIDAD */
		{

			$query01="SELECT sum(dias_ausencia_situacion) as sumaausencia, sum(incapacidad_situacion) as sumainca
					 FROM `situacion` 
					 WHERE  liquidado_situacion='No' and idempleado_situacion='$idempleado1'  and STR_TO_DATE(fecha_situacion, '%d-%m-%Y')  BETWEEN '$fechadesde1' AND '$fechahasta2' ";
			/* echo $query01; */
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};

		function data_situaciones($idempleado1,$fechadesde1,$fechahasta2) /* --ID DE REGISTROS A MODIFICAR */
		{

			$query01="SELECT*FROM `situacion` 
					 WHERE  liquidado_situacion='No' and idempleado_situacion='$idempleado1'  and STR_TO_DATE(fecha_situacion, '%d-%m-%Y')  BETWEEN '$fechadesde1' AND '$fechahasta2' ";
			/* echo $query01; */
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};  

		function consultar($e,$dia1,$dia2,$idempleado1)
		{
			
			$query01="SELECT DATE_FORMAT(DATE(NOW()), '%m-%d')as fecha_actual,DATE_FORMAT(tbl_empleados.fecha_contratacion, '%m-%d') as fechacontracion, tbl_empleados.id as idempleado, tbl_empleados.*
			FROM `tbl_empleados` where id='$idempleado1'";
			/* echo $query01; */
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};
		$newDate = date("Y-m-d", strtotime($fecha_planilladevengo_admin));
		$fechaperiodo1_total = date("Y-m-d", strtotime($_POST["fechaperiodo1"]));
		$fechaperiodo2_total= date("Y-m-d", strtotime($_POST["fechaperiodo2"]));
		$fechaperiodo1 = date("d",strtotime($_POST["fechaperiodo1"]));
		$fechaperiodo2 = date("d",strtotime($_POST["fechaperiodo2"]));
		$data01 = consultar($newDate,$fechaperiodo1,$fechaperiodo2,$idempleado);


		$values_consulta="";
		$values_devengo="";
		$values_situacion="";
		$id_situaciones="";
		foreach ($data01 as $value) {

			/* *******suma de dias en SITUACION */
				$codigo_empleado=$value["codigo_empleado"];
				$fechadesde02 = date("Y-m-d", strtotime($_POST["fechaperiodo1"]));
				$mes = date("m", strtotime($_POST["fechaperiodo1"]));
				$anio = date("Y", strtotime($_POST["fechaperiodo1"]));
				$fecha_desde_format=$anio."-".$mes."-"."01";

				$fechahasta02= date("Y-m-d", strtotime($_POST["fechaperiodo2"]));
				$datasituacion = situaciones($codigo_empleado,$fecha_desde_format,$fechahasta02);
				$dias_ausencia_situ="";
				$dias_incapacidad_situ="";
				foreach ($datasituacion as $valuesituacion) {
					$dias_ausencia_situ.=$valuesituacion["sumaausencia"];
					$dias_incapacidad_situ.=$valuesituacion["sumainca"];
				}
			/* **************************** */
				/* REGISTROS A MODIFICAR DE SITUACIONES */
				$data_situaciones2 = data_situaciones($codigo_empleado,$fecha_desde_format,$fechahasta02);
				foreach ($data_situaciones2 as $valuedata_situacion) {
					$iddata_situacion=$valuedata_situacion["id"];
					$values_situacion.="";
					$id_situaciones.="$iddata_situacion,";
					
				}
			/* **************************** */
			$fechaEnvio= date("Y-m-d", strtotime($value["fecha_contratacion"]));
			$fechaActual = date("Y-m-d", strtotime($fecha_planilladevengo_admin));
			$datetime1 = date_create($fechaEnvio);
			$datetime2 = date_create($fechaActual);
			$contador = date_diff($datetime1, $datetime2);
			$differenceFormat = '%a';

			$dias_trabajo=$contador->format($differenceFormat);
			if($dias_trabajo>='15'){
				$dias_trabajo_planilladevengo_admin='15';
			}
			else{
				$dias_trabajo_planilladevengo_admin=$dias_trabajo;
			}
			$sueldo_diario=floatval($value["sueldo_diario"]);
			$dias_incapacidad=floatval($dias_incapacidad_situ);
			$dias_ausencia=floatval($dias_ausencia_situ);

			$total_dias_trabajados = floatval($dias_trabajo_planilladevengo_admin)-$dias_incapacidad-$dias_ausencia;
			
			if($total_dias_trabajados<=0){
				$total_dias_trabajados=0;
			}
			$sueldo_total=$total_dias_trabajados*$sueldo_diario;

			$numero_planilladevengo_admin=$numero_planilladevengo_admin;
			$fecha_planilladevengo_admin=$fecha_planilladevengo_admin;
			$fecha_desde_planilladevengo_admin=$_POST["fechaperiodo1"];
			$fecha_hasta_planilladevengo_admin=$_POST["fechaperiodo2"];
			$descripcion_planilladevengo_admin=$descripcion_planilladevengo_admin;
			$codigo_empleado_planilladevengo_admin=$value["codigo_empleado"];
			$nombre_empleado_planilladevengo_admin=$value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"];
			$id_empleado_planilladevengo_admin=$value["idempleado"];
			$sueldo_planilladevengo_admin=$sueldo_total;
			$sueldo="0";
			$devengo="0";
			$totaldevengo=$sueldo+$devengo;
			$total_devengo_admin_planilladevengo_admin=$totaldevengo;
			$total_liquidado_planilladevengo_admin=$totaldevengo;
			$codigo_ubicacion_planilladevengo_admin="";
			$nombre_ubicacion_planilladevengo_admin="";
			$id_ubicacion_planilladevengo_admin="";
			$periodo_planilladevengo_admin=$periodo_planilladevengo_admin;
			$tipo_planilladevengo_admin=$tipo_planilladevengo_admin;
			$empleado_rango_desde=$empleado_rango_desde;
			$empleado_rango_hasta=$empleado_rango_hasta;

			$values_consulta.="('$numero_planilladevengo_admin','$fecha_planilladevengo_admin','$fecha_desde_planilladevengo_admin','$fecha_hasta_planilladevengo_admin','$descripcion_planilladevengo_admin','$codigo_empleado_planilladevengo_admin','$nombre_empleado_planilladevengo_admin','$id_empleado_planilladevengo_admin','$sueldo_planilladevengo_admin','$total_devengo_admin_planilladevengo_admin','$total_liquidado_planilladevengo_admin','$codigo_ubicacion_planilladevengo_admin','$nombre_ubicacion_planilladevengo_admin','$id_ubicacion_planilladevengo_admin','$periodo_planilladevengo_admin','$tipo_planilladevengo_admin','$empleado_rango_desde','$empleado_rango_hasta','$total_dias_trabajados','$dias_incapacidad','$dias_ausencia','$dias_trabajo_planilladevengo_admin'),";
		
		}

		/* echo $datos_html; */
		function consultar_planilla($idempleado1)
			{
				$query01="SELECT `id`, `numero_planilladevengo_admin`, `fecha_planilladevengo_admin`, `fecha_desde_planilladevengo_admin`, `fecha_hasta_planilladevengo_admin`, `descripcion_planilladevengo_admin`, `codigo_empleado_planilladevengo_admin`, `nombre_empleado_planilladevengo_admin`, `id_empleado_planilladevengo_admin`, `dias_trabajo_planilladevengo_admin`, `sueldo_planilladevengo_admin`, `hora_extra_diurna_planilladevengo_admin`, `hora_extra_nocturna_planilladevengo_admin`, `hora_extra_domingo_planilladevengo_admin`, `hora_extra_domingo_nocturna_planilladevengo_admin`, `otro_devengo_admin_planilladevengo_admin`, `total_devengo_admin_planilladevengo_admin`, `descuento_isss_planilladevengo_admin`, `descuento_afp_planilladevengo_admin`, `descuento_renta_planilladevengo_admin`, `otro_descuento_planilladevengo_admin`, `total_descuento_planilladevengo_admin`, `total_liquidado_planilladevengo_admin`, `sueldo_renta_planilladevengo_admin`, `sueldo_isss_planilladevengo_admin`, `sueldo_afp_planilladevengo_admin`, `departamento_planilladevengo_admin`, `codigo_ubicacion_planilladevengo_admin`, `nombre_ubicacion_planilladevengo_admin`, `id_ubicacion_planilladevengo_admin`, `observacion_planilladevengo_admin`, `periodo_planilladevengo_admin`, `tipo_planilladevengo_admin`, `dias_incapacidad`, `empleado_rango_desde`, `empleado_rango_hasta`, COUNT(*) as registro FROM `planilladevengo_admin` WHERE id_empleado_planilladevengo_admin='$idempleado1'";
				$sql = Conexion::conectar()->prepare($query01);
				$sql->execute();
				return $sql->fetchAll();
			};
		$data_planilla = consultar_planilla($idempleado);
		$registro="";
		foreach ($data_planilla as $value) {
			$registro.=$value["registro"];
		}

		if($registro == 0){

			$insertar_situacion="UPDATE `situacion` SET  `liquidado_situacion`='Si',`numero_planilla_admin`='$numero_planilladevengo_admin' WHERE id in  (".trim($id_situaciones, ",").")";
			$sql_situacion = Conexion::conectar()->prepare($insertar_situacion);
			$sql_situacion->execute();

			$insertar="INSERT INTO `planilladevengo_admin`(`numero_planilladevengo_admin`, `fecha_planilladevengo_admin`, `fecha_desde_planilladevengo_admin`, `fecha_hasta_planilladevengo_admin`, `descripcion_planilladevengo_admin`, `codigo_empleado_planilladevengo_admin`, `nombre_empleado_planilladevengo_admin`, `id_empleado_planilladevengo_admin`, `sueldo_planilladevengo_admin`,  `total_devengo_admin_planilladevengo_admin`, `total_liquidado_planilladevengo_admin`, `codigo_ubicacion_planilladevengo_admin`, `nombre_ubicacion_planilladevengo_admin`, `id_ubicacion_planilladevengo_admin`, `periodo_planilladevengo_admin`, `tipo_planilladevengo_admin`, `empleado_rango_desde`, `empleado_rango_hasta`,dias_trabajo_planilladevengo_admin,dias_incapacidad,dias_ausencia,his_dias_trabajo_admin) value ".trim($values_consulta, ",")."";
			$sql = Conexion::conectar()->prepare($insertar);
			if ($sql->execute()) {

				$data_planilla = consultar_planilla($numero_planilladevengo_admin);
				$id="";
				foreach ($data_planilla as $value) {
					$id.=$value["id"];
					
				}
				echo $numero_planilladevengo_admin;
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
	case "cargarrecibos":
		function recibo($idempleado1) /* -- */
		{

			$query01="SELECT recibos.*, recibos.id as idrecibo ,tbl_devengo_descuento.id as iddevengo, tbl_devengo_descuento.* FROM `recibos`,tbl_devengo_descuento where recibos.descuento_recibo=tbl_devengo_descuento.id and liquidado_recibo='No' and empleado_recibo='$idempleado1'";
		
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};
		$idempleado=$_POST["idempleado"];
		$data01 = recibo($idempleado);
		$html="<option>Seleccione Recibo</option>";
        foreach ($data01 as $value){
			$html.= '<option idrecibo="'.$value["idrecibo"].'" valorrecibo="'.$value["valor_recibo"].'" tipo_valor="'.$value["tipo"].'" renta_devengo="'.$value["renta_devengo"].'" afp_devengo="'.$value["afp_devengo"].'" isss_devengo="'.$value["isss_devengo"].'"  descripcion="'.$value["descripcion"].'" codigo="'.$value["codigo"].'" value="'.$value["iddevengo"].'">'.$value["descripcion"].'-'.$value["numero_recibo"].'-'.$value["valor_recibo"].'</option>';                     
            }
			echo $html;
	break;
	case "addempleadonuevo2":/* principal */

		$tipo_planilladevengo_admin = $_POST["tipo_planilladevengo_admin"];
		$periodo_planilladevengo_admin = $_POST["periodo_planilladevengo_admin"];
		$numero_planilladevengo_admin = $_POST["numero_planilladevengo_admin"];
		$descripcion_planilladevengo_admin = $_POST["descripcion_planilladevengo_admin"];



		function situaciones($idempleado1,$fechadesde1,$fechahasta2) /* --SUMA DE DIAS AUSENCIA Y INCAPACIDAD */
		{
			$query01="SELECT sum(dias_ausencia_situacion) as sumaausencia, sum(incapacidad_situacion) as sumainca, sum(horas_ausencia_situacion) as sumahoraausencia, sum(hora_extra_situacion) as sumahoraextra, sum(dias_no_sueldo) as sumadias_no_sueldo FROM `situacion` WHERE  liquidado_situacion='No' and idempleado_situacion='$idempleado1'  and STR_TO_DATE(fecha_situacion, '%d-%m-%Y')  BETWEEN '$fechadesde1' AND '$fechahasta2' ";
			/* echo $query01; */
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};

		function situaciones_incapacidad($idempleado1,$fechadesde1,$fechahasta2) /* --SUMA DE DIAS AUSENCIA Y INCAPACIDAD */
		{
			$query01="SELECT sum(dias_ausencia_situacion) as sumaausencia, sum(incapacidad_situacion) as sumainca FROM `situacion` WHERE  liquidado_situacion='No' and idempleado_situacion='$idempleado1' and inicial_situacion='Inicial'  and STR_TO_DATE(fecha_situacion, '%d-%m-%Y')  BETWEEN '$fechadesde1' AND '$fechahasta2' ";
			/* echo $query01; */
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};

		function situaciones_dias_tra_inca($idempleado1,$fechadesde1,$fechahasta2) /* --SUMA DE DIAS AUSENCIA Y INCAPACIDAD */
		{
			$query01="SELECT sum(dias_tra_incapacidad) as sumadiastrabajados FROM `situacion` 
					 WHERE  situacion.incapacidad_situacion !='' and liquidado_situacion='No' and idempleado_situacion='$idempleado1' and inicial_situacion='Inicial'  and STR_TO_DATE(fecha_situacion, '%d-%m-%Y')  BETWEEN '$fechadesde1' AND '$fechahasta2' ";
			/* echo $query01; */
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};

		function situaciones_horas($idempleado1,$fechadesde1,$fechahasta2) /* --Horas ausencia */
		{
			$query01="SELECT sum(horas_ausencia_situacion) as horas_ausencia_situacion  FROM `situacion` 
					 WHERE  liquidado_situacion='No' and idempleado_situacion='$idempleado1'  and STR_TO_DATE(fecha_situacion, '%d-%m-%Y')  BETWEEN '$fechadesde1' AND '$fechahasta2'  and situacion.horas_ausencia_situacion !=''";
			/* echo $query01; */
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};


		function horas_cubiertar_extras($codigo_empleado1) /* --se busca horas ausencia que han sido cubiertas situaciones */
		{
			$query01="SELECT sum(hora_extra_situacion) as hora_extra_situacion FROM `situacion` WHERE cubrir_situacion LIKE '%$codigo_empleado1%' and situacion.hora_extra_situacion != ''";
	
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};
		function horas_cubiertar_normal($codigo_empleado1) /* --se busca horas ausencia que han sido cubiertas situaciones */
		{
			$query01="SELECT sum(hora_normales_situacion) as hora_normales_situacion FROM `situacion` WHERE cubrir_situacion LIKE '%$codigo_empleado1%' and situacion.hora_normales_situacion != ''";
			/* echo $query01; */
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};

		function recibo($idempleado1,$fechadesde1,$fechahasta2) /* -- */
		{

			$query01="SELECT `id`, `fecha_descuento_recibo`, `empleado_recibo`, `descuento_recibo`, `numero_recibo`, `valor_recibo`, `observacion_recibo`, `fecha_hecho_recibo`, `hora_hecho_recibo`, `numero_planilla_liquidado`, `liquidado_recibo`, `anular_recibo`, `user_recibo` FROM `recibos` WHERE liquidado_recibo='No' and anular_recibo='No' and anular_recibo='No' and empleado_recibo='$idempleado1'  and STR_TO_DATE(fecha_descuento_recibo, '%d-%m-%Y')  BETWEEN '$fechadesde1' AND '$fechahasta2' ";
		
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};

		function bonoubicacion($codigoempleado1) /* -- */
		{

			$query01="SELECT tbl_ubicaciones_agentes_asignados.id as idubicacionagente, tbl_clientes_ubicaciones.* FROM `tbl_ubicaciones_agentes_asignados`,tbl_clientes_ubicaciones WHERE tbl_ubicaciones_agentes_asignados.idubicacion_agente=tbl_clientes_ubicaciones.id and tbl_ubicaciones_agentes_asignados.codigo_agente='$codigoempleado1'  group by tbl_ubicaciones_agentes_asignados.codigo_agente";
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};

		
		function bonopornofaltar($codigoempleado1) /* -- */
		{
			$query01="SELECT tbl_ubicaciones_agentes_asignados.id as idubicacionagente, tbl_devengo_ubicacion.* FROM `tbl_ubicaciones_agentes_asignados`,tbl_devengo_ubicacion WHERE tbl_ubicaciones_agentes_asignados.idubicacion_agente=tbl_devengo_ubicacion.idubicacion_devengo and tbl_ubicaciones_agentes_asignados.codigo_agente='$codigoempleado1'  group by tbl_ubicaciones_agentes_asignados.codigo_agente";
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};

		function data_situaciones($idempleado1,$fechadesde1,$fechahasta2) /* --ID DE REGISTROS A MODIFICAR */
		{

			$query01="SELECT*FROM `situacion` WHERE  liquidado_situacion='No' and idempleado_situacion='$idempleado1'  and STR_TO_DATE(fecha_situacion, '%d-%m-%Y')  BETWEEN '$fechadesde1' AND '$fechahasta2' ";
			/* echo $query01; */
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};  

		
		/* ***CONSULTAR DEVENGO02***** */
		function consultar_devengo2($iddevengo1)
		{
			$query01 = "SELECT `id`, `codigo`, `descripcion`, `porcentaje`, `tipo`, `cargo_abono`, `cuenta_contable`, `isss_devengo`, `afp_devengo`, `renta_devengo` FROM `tbl_devengo_descuento` WHERE id='$iddevengo1'";
			
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};
		/* *************** */

		/* ******************** */
		function devengo_anticipo($idempleado1)
		{
			$query01 = "SELECT * FROM `tbl_devengo_descuento_planilla` WHERE idempleado_devengo='$idempleado1' and codigo_devengo_descuento_planilla='0022' order by codigo_planilla_devengo DESC limit 1";
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};
		/* *************** */

		
		/* ***Devegos y descuentos del empleado con tipo***** */
		function consultar_devengo_empleado($periodo1,$fechadesde1,$fechahasta2,$idempleado1)
		{
			/* $query01 = "SELECT tbl_empleados_devengos_descuentos.id AS id, `id_empleado`, `id_tipo_devengo_descuento`, `valor`, `fecha_caducidad`, `referencia`, `tipodescuento` ,tbl_devengo_descuento.*
			FROM `tbl_empleados_devengos_descuentos` , tbl_devengo_descuento 
			WHERE tipodescuento='$periodo1' and id_empleado='$idempleado1' and tbl_empleados_devengos_descuentos.id_tipo_devengo_descuento=tbl_devengo_descuento.id and  fecha_caducidad BETWEEN '$fechadesde1' AND '$fechahasta2'";
			 */
			$query01 = "SELECT tbl_empleados_devengos_descuentos.id AS id, `id_empleado`, `id_tipo_devengo_descuento`, `valor`, `fecha_caducidad`, `referencia`, `tipodescuento` ,tbl_devengo_descuento.* FROM `tbl_empleados_devengos_descuentos` , tbl_devengo_descuento WHERE id_empleado='$idempleado1' and tbl_empleados_devengos_descuentos.id_tipo_devengo_descuento=tbl_devengo_descuento.id and  fecha_caducidad >= '$fechadesde1'";
			/* echo $query01; */
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};
		/* *************** */

		
		/* ***Devegos y descuentos del empleado sin tipo***** */
		function consultar_devengo_emple_sintipo($periodo1,$fechadesde1,$fechahasta2,$idempleado1)
		{
			$query01 = "SELECT tbl_empleados_devengos_descuentos.id AS id, `id_empleado`, `id_tipo_devengo_descuento`, `valor`, `fecha_caducidad`, `referencia`, `tipodescuento` ,tbl_devengo_descuento.* FROM `tbl_empleados_devengos_descuentos` , tbl_devengo_descuento WHERE id_empleado='$idempleado1' and tbl_empleados_devengos_descuentos.id_tipo_devengo_descuento=tbl_devengo_descuento.id and  fecha_caducidad BETWEEN '$fechadesde1' AND '$fechahasta2'";
			
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};
		/* *************** */

		function afp($e)
						{
							$query01="SELECT*FROM afp WHERE codigo='$e'";
							$sql = Conexion::conectar()->prepare($query01);
							$sql->execute();
							return $sql->fetchAll();
						};
					


		/* ********************* */

		function configuracion()
			{
				$query01="SELECT*FROM configuracion";
				$sql = Conexion::conectar()->prepare($query01);
				$sql->execute();
				return $sql->fetchAll();
			};
			$data_configuracion = configuracion();
			$porcentaje_isss="";
			$tope_isss=0;
			$dias_maximo_incapacidad=0;
			$porcentaje_dias_incapacidad=0;
			foreach ($data_configuracion as $valueconfig) {
				$porcentaje_isss.=floatval($valueconfig["porcentaje_isss"]);
				$tope_isss.=$valueconfig["tope_isss"];
				$dias_maximo_incapacidad.=$valueconfig["dias_maximo_incapacidad"];
				$porcentaje_dias_incapacidad.=$valueconfig["porcentaje_dias_incapacidad"];

			}


		/* ************************ */
		function isr($salario,$periodo)
			{
				$query01="SELECT isr.id as idisr, `codigo`, `nombre_rango`, `periodo_pago`, `salario_desde`, `salario_hasta`, `base_1`, `tasa_sobre_excedente`, `base_2`, periodo_de_pago.id as idperiodo FROM `isr`, periodo_de_pago WHERE isr.periodo_pago=periodo_de_pago.id and nombre_periodo='$periodo' and '$salario'>=salario_desde and '$salario'<=salario_hasta";
				
				$sql = Conexion::conectar()->prepare($query01);
				$sql->execute();
				return $sql->fetchAll();
			};
		/* ************************ */

		/* ************************ */
		function cargo_empleado($id1)
			{
				$query01="SELECT `id`, `descripcion`, `nivel`, `codigo_contable`, `personal_asignado`, `pago_feriados`, `calculo` FROM `cargos_desempenados` WHERE id='$id1'";
				$sql = Conexion::conectar()->prepare($query01);
				$sql->execute();
				return $sql->fetchAll();
			};
		/* ************************ */

		
		/* ************************ */
		function viatico_permanente($id_tipo_devengo1,$id_empleado1)
			{
				$query01="SELECT `id`, `id_empleado`, `id_tipo_devengo_descuento`, `valor`, `fecha_caducidad`, `referencia`, `tipodescuento` FROM `tbl_empleados_devengos_descuentos` WHERE id_empleado='$id_empleado1' and id_tipo_devengo_descuento='$id_tipo_devengo1'";
			
				$sql = Conexion::conectar()->prepare($query01);
				$sql->execute();
				return $sql->fetchAll();
			};
		/* ************************ */

		
		/* ************************ */
		function dias_feriados()
			{
				$query01="SELECT `id`, `num_dias`, `fecha_desde`, `fecha_hasta` FROM `dias_feriados` ";
				$sql = Conexion::conectar()->prepare($query01);
				$sql->execute();
				return $sql->fetchAll();
			};
		/* ************************ */

		
		/* ************************ */
		function ausencia_dias_feriados($idempleado1)
			{
				$query01="SELECT `id`, `empleado_ausencia`, `fecha_feriado` FROM `ausenciadiasferiados` WHERE empleado_ausencia='$idempleado1' ";
				
				$sql = Conexion::conectar()->prepare($query01);
				$sql->execute();
				return $sql->fetchAll();
			};
		/* ************************ */




		/* consulta maestra  addempleadonuevo*/
		function consultar($idempleado,$dia1,$dia2)
		{
			/* $query01="SELECT * FROM tbl_empleados 
					  WHERE YEAR(fecha_contratacion)<YEAR(NOW()) and DAY(fecha_contratacion)=DAY(NOW()) AND MONTH(fecha_contratacion)=MONTH(NOW()) AND DAY(fecha_contratacion) BETWEEN '16' AND '31'  and tbl_empleados.fecha_contratacion < '$e'"; */

			/* 			$query01 = "SELECT tbl_empleados.id as idempleado, tbl_empleados.*, tbl_empleados_devengos_descuentos.* , 				tbl_devengo_descuento.* 
						FROM `tbl_empleados` , tbl_empleados_devengos_descuentos,tbl_devengo_descuento WHERE tbl_empleados.id=tbl_empleados_devengos_descuentos.id_empleado and tbl_devengo_descuento.id = tbl_empleados_devengos_descuentos.id_tipo_devengo_descuento and tbl_devengo_descuento.codigo='0022' and tbl_empleados_devengos_descuentos.valor is NOT null  and tbl_empleados.fecha_contratacion < '$e' and YEAR(fecha_contratacion)<YEAR(NOW()) AND  DATE_FORMAT(DATE(NOW()), '%m-%d') >= DATE_FORMAT(tbl_empleados.fecha_contratacion, '%m-%d') AND MONTH(fecha_contratacion)=MONTH(NOW()) AND DAY(fecha_contratacion) BETWEEN '$dia1' AND '$dia2' "; */

			/* 	$query01="SELECT DATE_FORMAT(DATE(NOW()), '%m-%d')as fecha_actual,DATE_FORMAT(tbl_empleados.fecha_contratacion, '%m-%d') as fechacontracion, tbl_empleados.id as idempleado, tbl_empleados.*, tbl_empleados_devengos_descuentos.* , tbl_devengo_descuento.*, tbl_clientes_ubicaciones.id as idubicacion, tbl_clientes_ubicaciones.*
			FROM `tbl_empleados` , tbl_empleados_devengos_descuentos,tbl_devengo_descuento , tbl_clientes_ubicaciones,tbl_ubicaciones_agentes_asignados
			WHERE tbl_empleados.id=tbl_empleados_devengos_descuentos.id_empleado and tbl_devengo_descuento.id = tbl_empleados_devengos_descuentos.id_tipo_devengo_descuento and tbl_devengo_descuento.codigo='0022' and tbl_empleados_devengos_descuentos.valor is NOT null  and tbl_empleados.fecha_contratacion < '$e' and tbl_empleados.codigo_empleado=tbl_ubicaciones_agentes_asignados.codigo_agente and  tbl_ubicaciones_agentes_asignados.idubicacion_agente=tbl_clientes_ubicaciones.id"; */

			$query01="SELECT DATE_FORMAT(DATE(NOW()), '%m-%d')as fecha_actual,DATE_FORMAT(tbl_empleados.fecha_contratacion, '%m-%d') as fechacontracion, tbl_empleados.id as idempleado, tbl_empleados.*
			FROM `tbl_empleados` where id='$idempleado'";
		

			/* echo $query01; */
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};
		$newDate = date("Y-m-d", strtotime($fecha_planilladevengo_admin));
		$fechaperiodo1_total = date("Y-m-d", strtotime($_POST["fechaperiodo1"]));
		$fechaperiodo2_total= date("Y-m-d", strtotime($_POST["fechaperiodo2"]));
		$fechaperiodo1 = date("d",strtotime($_POST["fechaperiodo1"]));
		$fechaperiodo2 = date("d",strtotime($_POST["fechaperiodo2"]));
		$idempleadousar=$_POST["idempleado"];
		$data01 = consultar($idempleadousar,$fechaperiodo1,$fechaperiodo2);


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
		$values_situacion="";
		$id_situaciones="";
		$idrecibo="";
		
		

		foreach ($data01 as $value) {




			/* *******suma de dias en SITUACION */
				$codigo_empleado=$value["codigo_empleado"];
				$idcargo_empleado=$value["nivel_cargo"];
				$salario_empleado=$value["sueldo"];
				$idempleado=$value["idempleado"];
				$hora_extra_diurna=$value["hora_extra_diurna"];


				$fechadesde02 = date("Y-m-d", strtotime($_POST["fechaperiodo1"]));
				$mes = date("m", strtotime($_POST["fechaperiodo1"]));
				$anio = date("Y", strtotime($_POST["fechaperiodo1"]));
				$fecha_desde_format=$anio."-".$mes."-"."01";
				$fechahasta02= date("Y-m-d", strtotime($_POST["fechaperiodo2"]));

				$datasituacion = situaciones($codigo_empleado,$fecha_desde_format,$fechahasta02);
				$datasituacion_inca = situaciones_incapacidad($codigo_empleado,$fecha_desde_format,$fechahasta02);
				$datasituacion_dias_tra = situaciones_dias_tra_inca($codigo_empleado,$fecha_desde_format,$fechahasta02);

				$dias_ausencia_situ="";
				$dias_incapacidad_situ="";
				$dias_tra_inca="";

				$horas_ausencia="";
				$horas_extras="";

				foreach ($datasituacion as $valuesituacion) {
					$dias_ausencia_situ.=floatval($valuesituacion["sumaausencia"])+floatval($valuesituacion["sumadias_no_sueldo"]);
					/* $dias_incapacidad_situ.=$valuesituacion["sumainca"]; */
					$horas_ausencia.=$valuesituacion["sumahoraausencia"];
					$horas_extras.=$valuesituacion["sumahoraextra"];
				}
				/* situaciones incapacidad */
				foreach ($datasituacion_inca as $valuesituacion) {
					$dias_incapacidad_situ.=$valuesituacion["sumainca"];
				}
				/* situaciones dias trabajados de incapacidad */
				foreach ($datasituacion_dias_tra as $valuesituacion) {
					$dias_tra_inca.=$valuesituacion["sumadiastrabajados"];
				}

			/* **************************** */
				/* REGISTROS A MODIFICAR DE SITUACIONES */
				$data_situaciones2 = data_situaciones($codigo_empleado,$fecha_desde_format,$fechahasta02);
				$fecha_ausencia="";
				$fecha_incapacidad="";
				$dias_ausen="";
				$dias_inca="";
				foreach ($data_situaciones2 as $valuedata_situacion) {
					$iddata_situacion=$valuedata_situacion["id"];
					$values_situacion.="";
					$id_situaciones.="$iddata_situacion,";

					$dias_ausen.=$valuedata_situacion["dias_ausencia_situacion"];
					$dias_inca.=$valuedata_situacion["incapacidad_situacion"];

			
					if(!empty($valuedata_situacion["dias_ausencia_situacion"])){
						$fecha_ausencia.=$valuedata_situacion["fecha_situacion"]."-";
					}
					if(!empty($valuedata_situacion["incapacidad_situacion"])){
						$fecha_incapacidad.=$valuedata_situacion["fecha_situacion"]."-";
					}
				}
				$comentario_obser="";
				if(!empty($dias_ausen)){
					$comentario_obser.="Fechas dias ausencia:".trim($fecha_ausencia, "-")."\n";
				}
				if(!empty($dias_inca)){
					$comentario_obser.="Fechas dias Incapacidad:".trim($fecha_incapacidad, "-");
					
				}
				$observacion=$comentario_obser;
			/* **************************** */

			/* ********DEVENGO EMPLEADOS********* */

				
				$datadevengoempleado = consultar_devengo_empleado($periodo_planilladevengo_admin,$fecha_desde_format,$fechahasta02,$idempleado);
				$valordevengoempleado="";
				$iddevengo="";
				$valorisss="";
				$valorafp="";
				$valorrenta="";
				$viaticos_empleados="0";
			
				foreach ($datadevengoempleado as $valuesdevengoempleado) {
					$tipodescuento=$valuesdevengoempleado["tipodescuento"];
					if($tipodescuento==$periodo_planilladevengo_admin || $tipodescuento=="Siempre"){

						$iddevengo=$valuesdevengoempleado["id_tipo_devengo_descuento"];	
						$isss=$valuesdevengoempleado["isss_devengo"];
						$afp=$valuesdevengoempleado["afp_devengo"];
						$renta=$valuesdevengoempleado["renta_devengo"];

						if($isss=="Si"){
							$valorisss=floatval($valuesdevengoempleado["valor"]);
						}
						if($afp=="Si"){
							$valorafp=floatval($valuesdevengoempleado["valor"]);
						}
						if($renta=="Si"){
							$valorrenta=floatval($valuesdevengoempleado["valor"]);
						}
						$valordevengoempleado=$valuesdevengoempleado["valor"];
						
						if($iddevengo=="2"){
							$viaticos_empleados.=$valuesdevengoempleado["valor"];
						}
					}
				}

		
			/* ************************************* */

			/* ************************** */
			$fechaEnvio= date("Y-m-d", strtotime($value["fecha_contratacion"]));
			$fechaActual = date("Y-m-d", strtotime($fecha_planilladevengo_admin));
			$datetime1 = date_create($fechaEnvio);
			$datetime2 = date_create($fechaActual);
			$contador = date_diff($datetime1, $datetime2);
			/* lunes-viernes */
			$workingDays = 0;
			$startTimestamp = strtotime($fechaEnvio);
			$endTimestamp = strtotime($fechaActual);
			for ($i = $startTimestamp; $i <= $endTimestamp; $i = $i + (60 * 60 * 24)) {
				if (date("N", $i) <= 5) $workingDays = $workingDays + 1;
			}
			/* *********** */
			/* ****sabado-domingo */
			$weekendDays = 0;
			$startTimestamp = strtotime($fechaEnvio);
			$endTimestamp = strtotime($fechaActual);
			for ($i = $startTimestamp; $i <= $endTimestamp; $i = $i + (60 * 60 * 24)) {
				if (date("N", $i) > 5) $weekendDays = $weekendDays + 1;
			}
			/* ********** */
			$dias_trabajo= floatval($workingDays)+floatval($weekendDays);
			$differenceFormat = '%a';
			/* $dias_trabajo=$contador->format($differenceFormat); */
			$tiempotrabajo="";
			if($dias_trabajo>='15'){
				$dias_trabajo_planilladevengo_admin='15';
				$tiempotrabajo="viejo";
			}
			else{
				$dias_trabajo_planilladevengo_admin=$dias_trabajo;
				$tiempotrabajo="nuevo";
			}
		   
			$sueldo_diario=floatval($value["sueldo_diario"]);
			$dias_incapacidad=floatval($dias_incapacidad_situ);
			$dias_ausencia=floatval($dias_ausencia_situ);
			$total_dias_trabajados = floatval($dias_trabajo_planilladevengo_admin)-$dias_incapacidad-$dias_ausencia;

			if($total_dias_trabajados<=0){
				$total_dias_trabajados=0;
			}
			
			$sueldo_total=$total_dias_trabajados*$sueldo_diario;
			

			/* ********PORCENTAJES ISSS AFP RENTA****** */
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

			/* *********AFP******* */

			$data_afp = afp($tipo_afp);
			$porcentaje_afp=0;
				foreach ($data_afp as $valueafp) {
					$porcentaje_afp.=floatval($valueafp["porcentaje"]);
				}
				/*--------------------------------  */

					
				$calcularporcentaje_afp=$porcentaje_afp/100;/* --afp */
				$calcularporcentaje_isss=$porcentaje_isss/100;
				$pensionado_empleado=$value["pensionado_empleado"];
				$renta_final=0;
				$salario_isss=0;
				$salario_afp=0;

				$descuento_isss=0;
				$descuento_afp=0;
				if($pensionado_empleado=="Si"){
					$renta_final=floatval($valorrenta)+floatval($sueldo_total);/* sujeto renta si  es pensionado */
	
				}
				else{
					
					$salario_isss=floatval($valorisss)+$sueldo_total;/* sujeto iss */
					$salario_afp=floatval($valorafp)+$sueldo_total;/* sujeto afp */

					$descuento_isss=$salario_isss*$calcularporcentaje_isss;/* descuento isss */
					$descuento_afp=$salario_afp*$calcularporcentaje_afp;/* descuento afp */

					$salario_renta=floatval($valorrenta)+$sueldo_total;
					$sujeto_renta=$salario_renta-$descuento_isss-$descuento_afp;
					$renta_final=$sujeto_renta;/* sujeto renta si no es pensionado */
				}
	
			/* ********************* */
				$dataisr = isr($renta_final,$periodo_pago);
				$porcentaje_base1=0;
				$porcentaje_base2=0;
				$tasa_sobre_excedente=0;
				foreach ($dataisr as $valueisr) {
					$porcentaje_base1=floatval($valueisr["base_1"]);
					$porcentaje_base2=floatval($valueisr["base_2"]);
					$tasa_sobre_excedente=floatval($valueisr["tasa_sobre_excedente"]);
				}

				$porcentaje_tasa_excedente=$tasa_sobre_excedente/100;
				$renta_menos_base2=$renta_final-$porcentaje_base2;
				$tasa_por_exedente=$renta_menos_base2*$porcentaje_tasa_excedente;
				$descuento_renta=$tasa_por_exedente+$porcentaje_base1;/* descuento renta */


			/* echo $porcentaje_isss.",".$porcentaje_afp.",".$porcentaje_base1.",".$porcentaje_base2.",".$tasa_sobre_excedente; */
			/* **********************  */

			/* VERIFICA LAS HORAS DE AUSENCIA CUBIERTAS O NO CUBIERTAS O SI FUERON CUBIERTAS DE MANERA DE HORA NORMAL*/
			$horas_no_cubiertas="";
			$horas_cubiertas_extras=0;
			$horas_cubiertas_normal=0;
			$total_horas_ausencia=0;
			$suma_horas=0;
			$total_horas_cubiertas_extras="";
			$total_horas_cubiertas_normal="";


			/* ----------HORAS EXTRAS------------------ */
			$data_hora_cubi = horas_cubiertar_extras($codigo_empleado);	
			foreach ($data_hora_cubi as $value_horas_cubi) {
				$horas_cubiertas_extras= floatval($value_horas_cubi["hora_extra_situacion"]);
				$total_horas_cubiertas_extras.=$value_horas_cubi["hora_extra_situacion"];
			}
			/* ----------HORAS NORMALES------------------ */
			$data_hora_normales = horas_cubiertar_normal($codigo_empleado);	
			foreach ($data_hora_normales as $value_horas_cubi) {
				$horas_cubiertas_normal= floatval($value_horas_cubi["hora_normales_situacion"]);
				$total_horas_cubiertas_normal.=$value_horas_cubi["hora_normales_situacion"];
			}

			/* ---------HORAS AUSENCIA TOTAL------------- */
			$data_hora_aus = situaciones_horas($codigo_empleado,$fecha_desde_format,$fechahasta02);
			foreach ($data_hora_aus as $value_horas_aus) {
				$horas_ausencia_situacion = $value_horas_aus["horas_ausencia_situacion"];
				$total_horas_ausencia .= $value_horas_aus["horas_ausencia_situacion"];
			
				/* --------------------- */

			}


			/* ------------------------------ */
						/* HORAS EXTRAS CUBIERTAS DE AUSENCIAS */
						if($total_horas_cubiertas_extras>0){

												$datadevengo = consultar_devengo2("23");
												$codigo_devengo="";
												$descipcion_devengo="";
												$isss_devengo="";
												$afp_devengo="";
												$renta_devengo="";
												$id_devengo="";
												$suma_resta="";
												foreach ($datadevengo as $valuedevengo) {
													$id_devengo.=$valuedevengo["id"];
													$codigo_devengo.=$valuedevengo["codigo"];
													$descipcion_devengo.=$valuedevengo["descripcion"];
													$isss_devengo.=$valuedevengo["isss_devengo"];
													$afp_devengo.=$valuedevengo["afp_devengo"];
													$renta_devengo.=$valuedevengo["renta_devengo"];
													$suma_resta.=$valuedevengo["tipo"];
												}

														$total_valor_horas_aus=floatval($hora_extra_diurna)*floatval($total_horas_cubiertas_extras);

														$codigo_devengo_descuento_planilla=$codigo_devengo;
														$descripcion_devengo_descuento_planilla=$descipcion_devengo;
														$tipo_devengo_descuento_planilla=$id_devengo;
														$isss_devengo_devengo_descuento_planilla=$isss_devengo;
														$afp_devengo_devengo_descuento_planilla=$afp_devengo;
														$renta_devengo_devengo_descuento_planilla=$renta_devengo;
														$idempleado_devengo=$value["idempleado"];
														$valor_devengo_planilla=$total_valor_horas_aus;
														$tipo_valor=$suma_resta;
														$codigo_planilla_devengo=$numero_planilladevengo_admin;
														
														$values_devengo.="('$codigo_devengo_descuento_planilla', '$descripcion_devengo_descuento_planilla', '$tipo_devengo_descuento_planilla', '$isss_devengo_devengo_descuento_planilla', '$afp_devengo_devengo_descuento_planilla', '$renta_devengo_devengo_descuento_planilla', '$idempleado_devengo', '$valor_devengo_planilla', '$tipo_valor', '$codigo_planilla_devengo','','','','','','','$total_horas_cubiertas_extras','$hora_extra_diurna'),";

						}
			/* ------------------------------ */

				/* ------------------------------ */
					/* HORAS NORMALES CUBIERTAS DE AUSENCIAS */
					if($total_horas_cubiertas_normal>0){

									$datadevengo = consultar_devengo2("23");
									$codigo_devengo="";
									$descipcion_devengo="";
									$isss_devengo="";
									$afp_devengo="";
									$renta_devengo="";
									$id_devengo="";
									$suma_resta="";
									foreach ($datadevengo as $valuedevengo) {
										$id_devengo.=$valuedevengo["id"];
										$codigo_devengo.=$valuedevengo["codigo"];
										$descipcion_devengo.=$valuedevengo["descripcion"];
										$isss_devengo.=$valuedevengo["isss_devengo"];
										$afp_devengo.=$valuedevengo["afp_devengo"];
										$renta_devengo.=$valuedevengo["renta_devengo"];
										$suma_resta.=$valuedevengo["tipo"];
									}

									$sueldo_viatico=floatval($salario_empleado)+floatval($viaticos_empleados);
									$sueldo_diario02=floatval($sueldo_viatico)/15;
									$sueldo_dia_pagar=floatval($sueldo_diario02)/12;
									
									$total_valor_horas_aus=floatval($sueldo_dia_pagar)*floatval($total_horas_cubiertas_normal);
								


									$codigo_devengo_descuento_planilla=$codigo_devengo;
									$descripcion_devengo_descuento_planilla=$descipcion_devengo;
									$tipo_devengo_descuento_planilla=$id_devengo;
									$isss_devengo_devengo_descuento_planilla=$isss_devengo;
									$afp_devengo_devengo_descuento_planilla=$afp_devengo;
									$renta_devengo_devengo_descuento_planilla=$renta_devengo;
									$idempleado_devengo=$value["idempleado"];
									$valor_devengo_planilla=$total_valor_horas_aus;
									$tipo_valor=$suma_resta;
									$codigo_planilla_devengo=$numero_planilladevengo_admin;

									$values_devengo.="('$codigo_devengo_descuento_planilla', '$descripcion_devengo_descuento_planilla', '$tipo_devengo_descuento_planilla', '$isss_devengo_devengo_descuento_planilla', '$afp_devengo_devengo_descuento_planilla', '$renta_devengo_devengo_descuento_planilla', '$idempleado_devengo', '$valor_devengo_planilla', '$tipo_valor', '$codigo_planilla_devengo','','','','','','','$total_horas_cubiertas_normal','$sueldo_dia_pagar'),";
									

					}
				/* ------------------------------ */

			/* HORAS AUSENCIAS NO CUBIERTAS*/
			$suma_horas=floatval($total_horas_cubiertas_extras)+floatval($total_horas_cubiertas_normal);
			$horas_no_cubiertas=floatval($total_horas_ausencia)-floatval($suma_horas);
				if($horas_no_cubiertas>0){
						$datadevengo = consultar_devengo2("23");
						$codigo_devengo="";
						$descipcion_devengo="";
						$isss_devengo="";
						$afp_devengo="";
						$renta_devengo="";
						$id_devengo="";
						$suma_resta="";
						foreach ($datadevengo as $valuedevengo) {
							$id_devengo.=$valuedevengo["id"];
							$codigo_devengo.=$valuedevengo["codigo"];
							$descipcion_devengo.=$valuedevengo["descripcion"];
							$isss_devengo.=$valuedevengo["isss_devengo"];
							$afp_devengo.=$valuedevengo["afp_devengo"];
							$renta_devengo.=$valuedevengo["renta_devengo"];
							$suma_resta.=$valuedevengo["tipo"];
						}

						$sueldo_viatico=floatval($salario_empleado)+floatval($viaticos_empleados);
						$sueldo_diario02=floatval($sueldo_viatico)/15;
						$sueldo_dia_pagar=floatval($sueldo_diario02)/12;
						$total_valor_horas_aus=floatval($sueldo_dia_pagar)*floatval($horas_no_cubiertas);

						$codigo_devengo_descuento_planilla=$codigo_devengo;
						$descripcion_devengo_descuento_planilla=$descipcion_devengo;
						$tipo_devengo_descuento_planilla=$id_devengo;
						$isss_devengo_devengo_descuento_planilla=$isss_devengo;
						$afp_devengo_devengo_descuento_planilla=$afp_devengo;
						$renta_devengo_devengo_descuento_planilla=$renta_devengo;
						$idempleado_devengo=$value["idempleado"];
						$valor_devengo_planilla=$total_valor_horas_aus;
						$tipo_valor=$suma_resta;
						$codigo_planilla_devengo=$numero_planilladevengo_admin;

						$values_devengo.="('$codigo_devengo_descuento_planilla', '$descripcion_devengo_descuento_planilla', '$tipo_devengo_descuento_planilla', '$isss_devengo_devengo_descuento_planilla', '$afp_devengo_devengo_descuento_planilla', '$renta_devengo_devengo_descuento_planilla', '$idempleado_devengo', '$valor_devengo_planilla', '$tipo_valor', '$codigo_planilla_devengo','','','','','','','$horas_no_cubiertas','$sueldo_dia_pagar'),";

				}
			/* --------------------- */

			/* DIAS TRABAJADOS EN INCAPACIDAD */

			if($dias_tra_inca>0){
				$datadevengo = consultar_devengo2("31");
				$codigo_devengo="";
				$descipcion_devengo="";
				$isss_devengo="";
				$afp_devengo="";
				$renta_devengo="";
				$id_devengo="";
				$suma_resta="";
				foreach ($datadevengo as $valuedevengo) {
					$id_devengo.=$valuedevengo["id"];
					$codigo_devengo.=$valuedevengo["codigo"];
					$descipcion_devengo.=$valuedevengo["descripcion"];
					$isss_devengo.=$valuedevengo["isss_devengo"];
					$afp_devengo.=$valuedevengo["afp_devengo"];
					$renta_devengo.=$valuedevengo["renta_devengo"];
					$suma_resta.=$valuedevengo["tipo"];
				}
				$valor_devengo_incapacidad=floatval($sueldo_diario)*floatval($dias_tra_inca);
				
				$codigo_devengo_descuento_planilla=$codigo_devengo;
				$descripcion_devengo_descuento_planilla=$descipcion_devengo;
				$tipo_devengo_descuento_planilla=$id_devengo;
				$isss_devengo_devengo_descuento_planilla=$isss_devengo;
				$afp_devengo_devengo_descuento_planilla=$afp_devengo;
				$renta_devengo_devengo_descuento_planilla=$renta_devengo;
				$idempleado_devengo=$value["idempleado"];
				$valor_devengo_planilla=$valor_devengo_incapacidad;
				$tipo_valor=$suma_resta;
				$codigo_planilla_devengo=$numero_planilladevengo_admin;
				$values_devengo.="('$codigo_devengo_descuento_planilla', '$descripcion_devengo_descuento_planilla', '$tipo_devengo_descuento_planilla', '$isss_devengo_devengo_descuento_planilla', '$afp_devengo_devengo_descuento_planilla', '$renta_devengo_devengo_descuento_planilla', '$idempleado_devengo', '$valor_devengo_planilla', '$tipo_valor', '$codigo_planilla_devengo','','','$dias_tra_inca','$sueldo_diario','','','',''),";
			}
			/* DIAS INCAPACIDAD */
			if($dias_incapacidad>0){

					$datadevengo = consultar_devengo2("33");
					$codigo_devengo="";
					$descipcion_devengo="";
					$isss_devengo="";
					$afp_devengo="";
					$renta_devengo="";
					$id_devengo="";
					$suma_resta="";
					foreach ($datadevengo as $valuedevengo) {
						$id_devengo.=$valuedevengo["id"];
						$codigo_devengo.=$valuedevengo["codigo"];
						$descipcion_devengo.=$valuedevengo["descripcion"];
						$isss_devengo.=$valuedevengo["isss_devengo"];
						$afp_devengo.=$valuedevengo["afp_devengo"];
						$renta_devengo.=$valuedevengo["renta_devengo"];
						$suma_resta.=$valuedevengo["tipo"];
					}

					$valor_devengo_incapacidad=0;
					$sueldo_porcentaje=0;
					if($dias_incapacidad>=$dias_maximo_incapacidad){
						$sueldo_porcentaje=$sueldo_diario*$porcentaje_dias_incapacidad;
						$valor_devengo_incapacidad=$sueldo_porcentaje*$dias_maximo_incapacidad;

					}
					else{
						$sueldo_porcentaje=$sueldo_diario*$porcentaje_dias_incapacidad;
						$valor_devengo_incapacidad=$sueldo_porcentaje*$dias_incapacidad;
					}

					$codigo_devengo_descuento_planilla=$codigo_devengo;
					$descripcion_devengo_descuento_planilla=$descipcion_devengo;
					$tipo_devengo_descuento_planilla=$id_devengo;
					$isss_devengo_devengo_descuento_planilla=$isss_devengo;
					$afp_devengo_devengo_descuento_planilla=$afp_devengo;
					$renta_devengo_devengo_descuento_planilla=$renta_devengo;
					$idempleado_devengo=$value["idempleado"];
					$valor_devengo_planilla=$valor_devengo_incapacidad;
					$tipo_valor=$suma_resta;
					$codigo_planilla_devengo=$numero_planilladevengo_admin;

					$values_devengo.="('$codigo_devengo_descuento_planilla', '$descripcion_devengo_descuento_planilla', '$tipo_devengo_descuento_planilla', '$isss_devengo_devengo_descuento_planilla', '$afp_devengo_devengo_descuento_planilla', '$renta_devengo_devengo_descuento_planilla', '$idempleado_devengo', '$valor_devengo_planilla', '$tipo_valor', '$codigo_planilla_devengo','','','','','$dias_maximo_incapacidad','$sueldo_porcentaje','',''),";

			}
			
			if(empty($iddevengo)){
			}
			else{
				/* ******Datos del devengo********* */
				foreach ($datadevengoempleado as $valuesdevengoempleado) {
					$tipodescuento=$valuesdevengoempleado["tipodescuento"];
					if($tipodescuento==$periodo_planilladevengo_admin || $tipodescuento=="Siempre"){
						$iddevengo=$valuesdevengoempleado["id_tipo_devengo_descuento"];	
						$valordevengoempleado=$valuesdevengoempleado["valor"];

						/* ************* */

							$datadevengo = consultar_devengo2($iddevengo);
							$codigo_devengo="";
							$descipcion_devengo="";
							$isss_devengo="";
							$afp_devengo="";
							$renta_devengo="";
							$id_devengo="";
							$suma_resta="";
							foreach ($datadevengo as $valuedevengo) {
								$id_devengo.=$valuedevengo["id"];
								$codigo_devengo.=$valuedevengo["codigo"];
								$descipcion_devengo.=$valuedevengo["descripcion"];
								$isss_devengo.=$valuedevengo["isss_devengo"];
								$afp_devengo.=$valuedevengo["afp_devengo"];
								$renta_devengo.=$valuedevengo["renta_devengo"];
								$suma_resta.=$valuedevengo["tipo"];

							}

							
							$codigo_devengo_descuento_planilla=$codigo_devengo;
							$descripcion_devengo_descuento_planilla=$descipcion_devengo;
							$tipo_devengo_descuento_planilla=$id_devengo;
							$isss_devengo_devengo_descuento_planilla=$isss_devengo;
							$afp_devengo_devengo_descuento_planilla=$afp_devengo;
							$renta_devengo_devengo_descuento_planilla=$renta_devengo;
							$idempleado_devengo=$value["idempleado"];
							$valor_devengo_planilla=$valordevengoempleado;
							$tipo_valor=$suma_resta;
							$codigo_planilla_devengo=$numero_planilladevengo_admin;

							$values_devengo.="('$codigo_devengo_descuento_planilla', '$descripcion_devengo_descuento_planilla', '$tipo_devengo_descuento_planilla', '$isss_devengo_devengo_descuento_planilla', '$afp_devengo_devengo_descuento_planilla', '$renta_devengo_devengo_descuento_planilla', '$idempleado_devengo', '$valor_devengo_planilla', '$tipo_valor', '$codigo_planilla_devengo','','','','','','','',''),";

						/* ************ */


					}
				}
				/* **************************** */
			}


			/* DEVENGO QUINCENAL PLANILLA ANTICIPO */

			/* ************* */

			$datadevengo_anticipo = devengo_anticipo($idempleado);
			foreach ($datadevengo_anticipo as $valuedevengo_anticipo) {
				$devengoquincenal=$valuedevengo_anticipo["valor_devengo_planilla"];
				if($devengoquincenal>0){
						/* ************* */
						$datadevengo = consultar_devengo2('25');
						$codigo_devengo="";
						$descipcion_devengo="";
						$isss_devengo="";
						$afp_devengo="";
						$renta_devengo="";
						$id_devengo="";
						$suma_resta="";
						foreach ($datadevengo as $valuedevengo) {
							$id_devengo.=$valuedevengo["id"];
							$codigo_devengo.=$valuedevengo["codigo"];
							$descipcion_devengo.=$valuedevengo["descripcion"];
							$isss_devengo.=$valuedevengo["isss_devengo"];
							$afp_devengo.=$valuedevengo["afp_devengo"];
							$renta_devengo.=$valuedevengo["renta_devengo"];
							$suma_resta.=$valuedevengo["tipo"];

						}

						
						$codigo_devengo_descuento_planilla=$codigo_devengo;
						$descripcion_devengo_descuento_planilla=$descipcion_devengo;
						$tipo_devengo_descuento_planilla=$id_devengo;
						$isss_devengo_devengo_descuento_planilla=$isss_devengo;
						$afp_devengo_devengo_descuento_planilla=$afp_devengo;
						$renta_devengo_devengo_descuento_planilla=$renta_devengo;
						$idempleado_devengo=$value["idempleado"];
						$valor_devengo_planilla=$devengoquincenal;
						$tipo_valor=$suma_resta;
						$codigo_planilla_devengo=$numero_planilladevengo_admin;
						$values_devengo.="('$codigo_devengo_descuento_planilla', '$descripcion_devengo_descuento_planilla', '$tipo_devengo_descuento_planilla', '$isss_devengo_devengo_descuento_planilla', '$afp_devengo_devengo_descuento_planilla', '$renta_devengo_devengo_descuento_planilla', '$idempleado_devengo', '$valor_devengo_planilla', '$tipo_valor', '$codigo_planilla_devengo','','','','','','','',''),";

					/* ************ */

				}

			}

			
			/* ************************************ */
			/* DEVENGO POR DIAS FERIADOS TRABAJADOS */

			$data_viatico_permanente= viatico_permanente('2',$idempleado);	
			$valor_viatico_permanente="";		
			foreach ($data_viatico_permanente as $value_viatico) {
				$valor_viatico_permanente.=$value_viatico["valor"];		
			}


			/* ***** VALIDAR SI ESTAMOS EN EL MES DE DIAS FERIADOS Y BUSCAR SI EMPLEADO A ESTA AUSENTE EN LOS DIAS FERIADOS */
			$data_ausencia_dias_feriados= ausencia_dias_feriados($idempleado);	
			$restar_dias_feriados=0;	
			$fecha_feriado_ausencia="";	
			foreach ($data_ausencia_dias_feriados as $value_ausencia_dias_feriados) {
				$fecha_feriado_ausencia.=$value_ausencia_dias_feriados["fecha_feriado"];	
			}
			
			$data_dias_feriados= dias_feriados();	
			foreach ($data_dias_feriados as $value_dias_feriados) {
				$fecha_desde=$value_dias_feriados["fecha_desde"];		
				$fecha_hasta=$value_dias_feriados["fecha_hasta"];	

				$fecha_desde_mes=date("m", strtotime($fecha_desde));	
				$fechaActual_mes = date("m", strtotime($fecha_planilladevengo_admin));
				if($fechaActual_mes==$fecha_desde_mes){

					$fecha_desde_mes_feriado=$value_dias_feriados["fecha_desde"];
					$fecha_hasta_mes_feriado=$value_dias_feriados["fecha_hasta"];
					$resultado_dias=0;
					if ($fecha_feriado_ausencia >= $fecha_desde && $fecha_feriado_ausencia <= $fecha_hasta){
						$resultado_dias=$resultado_dias+1;
					}		
					/* CONTAR LOS DIAS FERIADOS */
					$feriado_desde= date("Y-m-d", strtotime($fecha_desde_mes_feriado));
					$feriado_hasta = date("Y-m-d", strtotime($fecha_hasta_mes_feriado));
					/* lunes-viernes */
					$workingDays = 0;
					$startTimestamp = strtotime($feriado_desde);
					$endTimestamp = strtotime($feriado_hasta);
					for ($i = $startTimestamp; $i <= $endTimestamp; $i = $i + (60 * 60 * 24)) {
						if (date("N", $i) <= 5) $workingDays = $workingDays + 1;
					}
					/* *********** */
					/* ****sabado-domingo */
					$weekendDays = 0;
					$startTimestamp = strtotime($feriado_desde);
					$endTimestamp = strtotime($feriado_hasta);
					for ($i = $startTimestamp; $i <= $endTimestamp; $i = $i + (60 * 60 * 24)) {
						if (date("N", $i) > 5) $weekendDays = $weekendDays + 1;
					}

					$dias_festivos= floatval($workingDays)+floatval($weekendDays);
					$restar_dias_feriados.=floatval($dias_festivos)-floatval($resultado_dias);
					/* echo $restar_dias_feriados.'restar_dias_feriados'; */
					/* *********************** */
					
				}
				
			}
			/* ******************************************************** */

			if($restar_dias_feriados>0){
				
					$data_cargo= cargo_empleado($idcargo_empleado);		
					foreach ($data_cargo as $valu_cargo) {
							$pago_feriados=$valu_cargo["pago_feriados"];
							$calculo=$valu_cargo["calculo"];
							if($pago_feriados=="Si"){
								$ecuacion_dias=0;
								$valordias=0;
								if($calculo=="Sueldo+Tfijo"){
									$salario_mas_viatico=floatval($salario_empleado)+floatval($valor_viatico_permanente);
									$valordias=floatval($salario_mas_viatico)/15;
									$ecuacion_dias=$valordias*floatval($restar_dias_feriados);
								}
								else{
									$valordias=floatval($salario_empleado)/15;
									$ecuacion_dias=floatval($valordias)*floatval($restar_dias_feriados);
								}
								/* ******************* */
									$datadevengo = consultar_devengo2('0021');
									$codigo_devengo="";
									$descipcion_devengo="";
									$isss_devengo="";
									$afp_devengo="";
									$renta_devengo="";
									$id_devengo="";
									$suma_resta="";
									foreach ($datadevengo as $valuedevengo) {
										$id_devengo.=$valuedevengo["id"];
										$codigo_devengo.=$valuedevengo["codigo"];
										$descipcion_devengo.=$valuedevengo["descripcion"];
										$isss_devengo.=$valuedevengo["isss_devengo"];
										$afp_devengo.=$valuedevengo["afp_devengo"];
										$renta_devengo.=$valuedevengo["renta_devengo"];
										$suma_resta.=$valuedevengo["tipo"];

									}
									$codigo_devengo_descuento_planilla=$codigo_devengo;
									$descripcion_devengo_descuento_planilla=$descipcion_devengo;
									$tipo_devengo_descuento_planilla=$id_devengo;
									$isss_devengo_devengo_descuento_planilla=$isss_devengo;
									$afp_devengo_devengo_descuento_planilla=$afp_devengo;
									$renta_devengo_devengo_descuento_planilla=$renta_devengo;
									$idempleado_devengo=$value["idempleado"];
									$valor_devengo_planilla= bcdiv($ecuacion_dias, '1', 2);
									$tipo_valor=$suma_resta;
									$codigo_planilla_devengo=$numero_planilladevengo_admin;

									$values_devengo.="('$codigo_devengo_descuento_planilla', '$descripcion_devengo_descuento_planilla', '$tipo_devengo_descuento_planilla', '$isss_devengo_devengo_descuento_planilla', '$afp_devengo_devengo_descuento_planilla', '$renta_devengo_devengo_descuento_planilla', '$idempleado_devengo', '$valor_devengo_planilla', '$tipo_valor', '$codigo_planilla_devengo','$restar_dias_feriados','$valordias','','','','','',''),";

								/* ******************* */
									
							}
					}
			
			}
			/* ********************************************* */

			/* *************BONO POR UBICACION*************** */
				$databonoubicacion = bonoubicacion($codigo_empleado);			
				foreach ($databonoubicacion as $valubonoubicacion) {
						$bono=$valubonoubicacion["bonos"];
					/* ******************* */
						$datadevengo = consultar_devengo2('0061');
						$codigo_devengo="";
						$descipcion_devengo="";
						$isss_devengo="";
						$afp_devengo="";
						$renta_devengo="";
						$id_devengo="";
						$suma_resta="";
						foreach ($datadevengo as $valuedevengo) {
							$id_devengo.=$valuedevengo["id"];
							$codigo_devengo.=$valuedevengo["codigo"];
							$descipcion_devengo.=$valuedevengo["descripcion"];
							$isss_devengo.=$valuedevengo["isss_devengo"];
							$afp_devengo.=$valuedevengo["afp_devengo"];
							$renta_devengo.=$valuedevengo["renta_devengo"];
							$suma_resta.=$valuedevengo["tipo"];

						}
						$codigo_devengo_descuento_planilla=$codigo_devengo;
						$descripcion_devengo_descuento_planilla=$descipcion_devengo;
						$tipo_devengo_descuento_planilla=$id_devengo;
						$isss_devengo_devengo_descuento_planilla=$isss_devengo;
						$afp_devengo_devengo_descuento_planilla=$afp_devengo;
						$renta_devengo_devengo_descuento_planilla=$renta_devengo;
						$idempleado_devengo=$value["idempleado"];
						$valor_devengo_planilla= bcdiv($bono, '1', 2);
						$tipo_valor=$suma_resta;
						$codigo_planilla_devengo=$numero_planilladevengo_admin;

						$values_devengo.="('$codigo_devengo_descuento_planilla', '$descripcion_devengo_descuento_planilla', '$tipo_devengo_descuento_planilla', '$isss_devengo_devengo_descuento_planilla', '$afp_devengo_devengo_descuento_planilla', '$renta_devengo_devengo_descuento_planilla', '$idempleado_devengo', '$valor_devengo_planilla', '$tipo_valor', '$codigo_planilla_devengo','','','','','','','',''),";

					/* ******************* */
				}
			/* ********************************************* */

			
			/* *************BONO POR NO FALTAR*************** */
			$databonopornofaltar = bonopornofaltar($codigo_empleado);			
			foreach ($databonopornofaltar as $valubonopornofaltar) {
				$bono=$valubonopornofaltar["valor_devengo_ubicacion"];
				$periodo=$valubonopornofaltar["periodo_devengo_ubicacion"];
				if($periodo=="Siempre"){
					$periodo=$periodo_planilladevengo_admin;
				}
				
				if($periodo==$periodo_planilladevengo_admin){
						$fecha_planilladevengo_admin01 = date("Y-m-d", strtotime($fecha_planilladevengo_admin));
						$fecha_gratificacion_admin= date("Y-m-d", strtotime($_POST["fecha_gratificacion_admin"]));
						$datasituacion = situaciones($codigo_empleado,$fecha_gratificacion_admin,$fecha_planilladevengo_admin01);
						$dias_ausencia_situ_bono="vacio";
						foreach ($datasituacion as $valuesituacion) {
							$dias_ausencia_situ_bono.=$valuesituacion["sumaausencia"];
						}
						
						if($tiempotrabajo=="viejo"){

							if($dias_ausencia_situ_bono=="vacio"){
								/* ******************* */
								$datadevengo = consultar_devengo2('0020');
								$codigo_devengo="";
								$descipcion_devengo="";
								$isss_devengo="";
								$afp_devengo="";
								$renta_devengo="";
								$id_devengo="";
								$suma_resta="";
								foreach ($datadevengo as $valuedevengo) {
									$id_devengo.=$valuedevengo["id"];
									$codigo_devengo.=$valuedevengo["codigo"];
									$descipcion_devengo.=$valuedevengo["descripcion"];
									$isss_devengo.=$valuedevengo["isss_devengo"];
									$afp_devengo.=$valuedevengo["afp_devengo"];
									$renta_devengo.=$valuedevengo["renta_devengo"];
									$suma_resta.=$valuedevengo["tipo"];

								}
								$codigo_devengo_descuento_planilla=$codigo_devengo;
								$descripcion_devengo_descuento_planilla=$descipcion_devengo;
								$tipo_devengo_descuento_planilla=$id_devengo;
								$isss_devengo_devengo_descuento_planilla=$isss_devengo;
								$afp_devengo_devengo_descuento_planilla=$afp_devengo;
								$renta_devengo_devengo_descuento_planilla=$renta_devengo;
								$idempleado_devengo=$value["idempleado"];
								$valor_devengo_planilla= bcdiv($bono, '1', 2);
								$tipo_valor=$suma_resta;
								$codigo_planilla_devengo=$numero_planilladevengo_admin;

								$values_devengo.="('$codigo_devengo_descuento_planilla', '$descripcion_devengo_descuento_planilla', '$tipo_devengo_descuento_planilla', '$isss_devengo_devengo_descuento_planilla', '$afp_devengo_devengo_descuento_planilla', '$renta_devengo_devengo_descuento_planilla', '$idempleado_devengo', '$valor_devengo_planilla', '$tipo_valor', '$codigo_planilla_devengo','','','','','','','',''),";
					 		/* ******************* */
							}
						}


						if($tiempotrabajo=="nuevo"){

							if($dias_ausencia_situ_bono=="vacio"){

								$calculobono=floatval($bono)/30*floatval($total_dias_trabajados);
								/* ******************* */
								$datadevengo = consultar_devengo2('0020');
								$codigo_devengo="";
								$descipcion_devengo="";
								$isss_devengo="";
								$afp_devengo="";
								$renta_devengo="";
								$id_devengo="";
								$suma_resta="";
								foreach ($datadevengo as $valuedevengo) {
									$id_devengo.=$valuedevengo["id"];
									$codigo_devengo.=$valuedevengo["codigo"];
									$descipcion_devengo.=$valuedevengo["descripcion"];
									$isss_devengo.=$valuedevengo["isss_devengo"];
									$afp_devengo.=$valuedevengo["afp_devengo"];
									$renta_devengo.=$valuedevengo["renta_devengo"];
									$suma_resta.=$valuedevengo["tipo"];

								}
								$codigo_devengo_descuento_planilla=$codigo_devengo;
								$descripcion_devengo_descuento_planilla=$descipcion_devengo;
								$tipo_devengo_descuento_planilla=$id_devengo;
								$isss_devengo_devengo_descuento_planilla=$isss_devengo;
								$afp_devengo_devengo_descuento_planilla=$afp_devengo;
								$renta_devengo_devengo_descuento_planilla=$renta_devengo;
								$idempleado_devengo=$value["idempleado"];
								$valor_devengo_planilla= bcdiv($calculobono, '1', 2);
								$tipo_valor=$suma_resta;
								$codigo_planilla_devengo=$numero_planilladevengo_admin;

							
								$values_devengo.="('$codigo_devengo_descuento_planilla', '$descripcion_devengo_descuento_planilla', '$tipo_devengo_descuento_planilla', '$isss_devengo_devengo_descuento_planilla', '$afp_devengo_devengo_descuento_planilla', '$renta_devengo_devengo_descuento_planilla', '$idempleado_devengo', '$valor_devengo_planilla', '$tipo_valor', '$codigo_planilla_devengo','','','','','','','',''),";

							/* ******************* */
							}
						}
				}

			}
		 /* ********************************************* */

			/* *********RECIBO DESCUENTO***************** */
			$datarecibo = recibo($idempleado,$fecha_desde_format,$fechahasta02);
			foreach ($datarecibo as $valuerecibo) {

				/* ************************ */
				$iddevengo=$valuerecibo["descuento_recibo"];
				$valorrecibo=$valuerecibo["valor_recibo"];
				$idrecibo.=$valuerecibo["id"].",";
						$datadevengo = consultar_devengo2($iddevengo);
						$codigo_devengo="";
						$descipcion_devengo="";
						$isss_devengo="";
						$afp_devengo="";
						$renta_devengo="";
						$id_devengo="";
						$suma_resta="";
						foreach ($datadevengo as $valuedevengo) {
							$id_devengo.=$valuedevengo["id"];
							$codigo_devengo.=$valuedevengo["codigo"];
							$descipcion_devengo.=$valuedevengo["descripcion"];
							$isss_devengo.=$valuedevengo["isss_devengo"];
							$afp_devengo.=$valuedevengo["afp_devengo"];
							$renta_devengo.=$valuedevengo["renta_devengo"];
							$suma_resta.=$valuedevengo["tipo"];
						}
						$codigo_devengo_descuento_planilla=$codigo_devengo;
						$descripcion_devengo_descuento_planilla=$descipcion_devengo;
						$tipo_devengo_descuento_planilla=$id_devengo;
						$isss_devengo_devengo_descuento_planilla=$isss_devengo;
						$afp_devengo_devengo_descuento_planilla=$afp_devengo;
						$renta_devengo_devengo_descuento_planilla=$renta_devengo;
						$idempleado_devengo=$value["idempleado"];
						$valor_devengo_planilla=$valorrecibo;
						$tipo_valor=$suma_resta;
						$codigo_planilla_devengo=$numero_planilladevengo_admin;

						$values_devengo.="('$codigo_devengo_descuento_planilla', '$descripcion_devengo_descuento_planilla', '$tipo_devengo_descuento_planilla', '$isss_devengo_devengo_descuento_planilla', '$afp_devengo_devengo_descuento_planilla', '$renta_devengo_devengo_descuento_planilla', '$idempleado_devengo', '$valor_devengo_planilla', '$tipo_valor', '$codigo_planilla_devengo','','','','','','','',''),";


				/* ************************ */
				
			}
			/* ******************** */

			$numero_planilladevengo_admin=$numero_planilladevengo_admin;
			$fecha_planilladevengo_admin=$fecha_planilladevengo_admin;
			$fecha_desde_planilladevengo_admin=$_POST["fechaperiodo1"];
			$fecha_hasta_planilladevengo_admin=$_POST["fechaperiodo2"];
			$descripcion_planilladevengo_admin=$descripcion_planilladevengo_admin;
			$codigo_empleado_planilladevengo_admin=$value["codigo_empleado"];
			$nombre_empleado_planilladevengo_admin=$value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"];
			$id_empleado_planilladevengo_admin=$value["idempleado"];
			$sueldo_planilladevengo_admin=bcdiv($sueldo_total, '1', 2); ;
			$sueldo="0";
			$devengo="0";
			$totaldevengo=$sueldo+$devengo;
			$total_devengo_admin_planilladevengo_admin=$totaldevengo;
			$total_liquidado_planilladevengo_admin=$totaldevengo;
			$codigo_ubicacion_planilladevengo_admin="";
			$nombre_ubicacion_planilladevengo_admin="";
			$id_ubicacion_planilladevengo_admin="";
			$periodo_planilladevengo_admin=$periodo_planilladevengo_admin;
			$tipo_planilladevengo_admin=$tipo_planilladevengo_admin;
			$empleado_rango_desde=$empleado_rango_desde;
			$empleado_rango_hasta=$empleado_rango_hasta;
			$observacion_planilladevengo_admin=$observacion;
			$fecha_gratificacion_admin=$_POST["fecha_gratificacion_admin"];
			/* ---------------- */
			if($salario_isss>=$tope_isss){
				$salario_isss=$salario_isss;
			}
			$descuento_isss_planilladevengo_admin=  bcdiv($descuento_isss, '1', 2); 
			$descuento_afp_planilladevengo_admin=  bcdiv($descuento_afp, '1', 2); 
			$descuento_renta_planilladevengo_admin=  bcdiv($descuento_renta, '1', 2);
			$sueldo_renta_planilladevengo_admin=  bcdiv($renta_final, '1', 2);
			$sueldo_isss_planilladevengo_admin= bcdiv($salario_isss, '1', 2); 
			$sueldo_afp_planilladevengo_admin=  bcdiv($salario_afp, '1', 2);
			$hora_extra_diurna_planilladevengo_admin=$horas_extras;




			$values_consulta.="('$numero_planilladevengo_admin','$fecha_planilladevengo_admin','$fecha_desde_planilladevengo_admin','$fecha_hasta_planilladevengo_admin','$descripcion_planilladevengo_admin','$codigo_empleado_planilladevengo_admin','$nombre_empleado_planilladevengo_admin','$id_empleado_planilladevengo_admin','$sueldo_planilladevengo_admin','$total_devengo_admin_planilladevengo_admin','$total_liquidado_planilladevengo_admin','$codigo_ubicacion_planilladevengo_admin','$nombre_ubicacion_planilladevengo_admin','$id_ubicacion_planilladevengo_admin','$periodo_planilladevengo_admin','$tipo_planilladevengo_admin','$empleado_rango_desde','$empleado_rango_hasta','$total_dias_trabajados','$dias_incapacidad','$dias_ausencia','$dias_trabajo_planilladevengo_admin','$descuento_isss_planilladevengo_admin','$descuento_afp_planilladevengo_admin','$descuento_renta_planilladevengo_admin','$sueldo_renta_planilladevengo_admin','$sueldo_isss_planilladevengo_admin','$sueldo_afp_planilladevengo_admin','$observacion_planilladevengo_admin','$fecha_gratificacion_admin','$hora_extra_diurna_planilladevengo_admin'),";

			$datos_html .= ' <tr class="btnEditarabase" pensionado_empleado="'.$value["pensionado_empleado"].'" hora_extra_nocturna_domingo="'.$value["hora_extra_nocturna_domingo"].'"   hora_extra_domingo="'.$value["hora_extra_domingo"].'"  hora_extra_nocturna="'.$value["hora_extra_nocturna"].'" hora_extra_diurna="'.$value["hora_extra_diurna"].'"    salario_por_hora="'.$value["salario_por_hora"].'"  sueldo="'.$value["sueldo"].'"  idempleado="'.$value["idempleado"].'" codigo="'.$value["codigo_empleado"].'"  nombre="'.$value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"].'">
			<td>'.$value["codigo_empleado"].'</td>
			<td>'.$value["primer_nombre"].' '.$value["segundo_nombre"].' '.$value["tercer_nombre"].' '.$value["primer_apellido"].' '.$value["segundo_apellido"].' '.$value["apellido_casada"].' </td>';
			$datos_html .='<td><div class="btn btn-danger eliminarempleado" numero_planilla="'.$numero_planilladevengo_admin.'" idempleado="'.$value["idempleado"].'"><i class="fa fa-times"></i></div></td>';
			$datos_html .= '</tr>';
		}
		$datos_html .= '</tbody></table>';
		/* echo trim($values_consulta, ","); */

		/* echo $datos_html; */
		function consultar_planilla($numero_planilla_admin1, $idempleado1)
			{
				$query01="SELECT `id`, `numero_planilladevengo_admin`, `fecha_planilladevengo_admin`, `fecha_desde_planilladevengo_admin`, `fecha_hasta_planilladevengo_admin`, `descripcion_planilladevengo_admin`, `codigo_empleado_planilladevengo_admin`, `nombre_empleado_planilladevengo_admin`, `id_empleado_planilladevengo_admin`, `dias_trabajo_planilladevengo_admin`, `sueldo_planilladevengo_admin`, `hora_extra_diurna_planilladevengo_admin`, `hora_extra_nocturna_planilladevengo_admin`, `hora_extra_domingo_planilladevengo_admin`, `hora_extra_domingo_nocturna_planilladevengo_admin`, `otro_devengo_admin_planilladevengo_admin`, `total_devengo_admin_planilladevengo_admin`, `descuento_isss_planilladevengo_admin`, `descuento_afp_planilladevengo_admin`, `descuento_renta_planilladevengo_admin`, `otro_descuento_planilladevengo_admin`, `total_descuento_planilladevengo_admin`, `total_liquidado_planilladevengo_admin`, `sueldo_renta_planilladevengo_admin`, `sueldo_isss_planilladevengo_admin`, `sueldo_afp_planilladevengo_admin`, `departamento_planilladevengo_admin`, `codigo_ubicacion_planilladevengo_admin`, `nombre_ubicacion_planilladevengo_admin`, `id_ubicacion_planilladevengo_admin`, `observacion_planilladevengo_admin`, `periodo_planilladevengo_admin`, `tipo_planilladevengo_admin`, `dias_incapacidad`, `empleado_rango_desde`, `empleado_rango_hasta`, COUNT(*) as registro FROM `planilladevengo_admin` WHERE numero_planilladevengo_admin='$numero_planilla_admin1' and id_empleado_planilladevengo_admin='$idempleado1'";
				$sql = Conexion::conectar()->prepare($query01);
				$sql->execute();
				return $sql->fetchAll();
			};

		$idempleadousar = $_POST["idempleado"];
		$data_planilla = consultar_planilla($numero_planilladevengo_admin,$idempleadousar);
		$registro="";
		foreach ($data_planilla as $value) {
			$registro.=$value["registro"];
		}

		if($registro == 0){




			$insertar_recibo="UPDATE `recibos` SET  `liquidado_recibo`='Si',`numero_planilla_liquidado`='$numero_planilladevengo_admin' WHERE id in  (".trim($idrecibo, ",").")";
			$sql_recibo= Conexion::conectar()->prepare($insertar_recibo);
			$sql_recibo->execute();
			
			$insertar_situacion="UPDATE `situacion` SET  `liquidado_situacion`='Si',`numero_planilla_admin`='$numero_planilladevengo_admin' WHERE id in  (".trim($id_situaciones, ",").")";
			$sql_situacion = Conexion::conectar()->prepare($insertar_situacion);
			$sql_situacion->execute();

			
			$insertar_devengo="INSERT INTO `tbl_devengo_descuento_planilla_admin`(`codigo_devengo_descuento_planilla`, `descripcion_devengo_descuento_planilla`, `tipo_devengo_descuento_planilla`, `isss_devengo_devengo_descuento_planilla`, `afp_devengo_devengo_descuento_planilla`, `renta_devengo_devengo_descuento_planilla`,`idempleado_devengo`, `valor_devengo_planilla`, `tipo_valor`, `codigo_planilla_devengo`,dias_Feriados,valor_dias_Feriados,dias_tra_inca_admin,pago_dias_tra_inca_admin,dias_incapacidad_admin,pago_dias_incapacidad_admin,horas_tardes,precio_horas_tardes) VALUES  ".trim($values_devengo, ",")."";
			$sql_devengo = Conexion::conectar()->prepare($insertar_devengo);
			$sql_devengo->execute();


			$insertar="INSERT INTO `planilladevengo_admin`(`numero_planilladevengo_admin`, `fecha_planilladevengo_admin`, `fecha_desde_planilladevengo_admin`, `fecha_hasta_planilladevengo_admin`, `descripcion_planilladevengo_admin`, `codigo_empleado_planilladevengo_admin`, `nombre_empleado_planilladevengo_admin`, `id_empleado_planilladevengo_admin`, `sueldo_planilladevengo_admin`,  `total_devengo_admin_planilladevengo_admin`, `total_liquidado_planilladevengo_admin`, `codigo_ubicacion_planilladevengo_admin`, `nombre_ubicacion_planilladevengo_admin`, `id_ubicacion_planilladevengo_admin`, `periodo_planilladevengo_admin`, `tipo_planilladevengo_admin`, `empleado_rango_desde`, `empleado_rango_hasta`,dias_trabajo_planilladevengo_admin,dias_incapacidad,dias_ausencia,his_dias_trabajo_admin,descuento_isss_planilladevengo_admin,descuento_afp_planilladevengo_admin,descuento_renta_planilladevengo_admin,sueldo_renta_planilladevengo_admin,sueldo_isss_planilladevengo_admin,sueldo_afp_planilladevengo_admin,observacion_planilladevengo_admin,fecha_gratificacion_admin,hora_extra_diurna_planilladevengo_admin) value ".trim($values_consulta, ",")."";
		
			$sql = Conexion::conectar()->prepare($insertar);

			if ($sql->execute()) {

				$idempleadousar = $_POST["idempleado"];
				$data_planilla = consultar_planilla($numero_planilladevengo_admin,$idempleadousar);
				$id="";
				foreach ($data_planilla as $value) {
					$id.=$value["id"];
					
				}
				/* echo $numero_planilladevengo_admin; */
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
		$stmt = Conexion::conectar()->prepare("INSERT INTO planilladevengo_admin(" . trim($namecolumnas_situacion, ",") . ") VALUES (" . trim($namecampos_situacion, ",") . ")");

		echo "INSERT INTO planilladevengo_admin(" . trim($namecolumnas_situacion, ",") . ") VALUES (" . trim($namecampos_situacion, ",") . ")";

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

		$codigo_empleado_planilladevengo_admin = $_POST["codigo_empleado_planilladevengo_admin"];
		$numero_planilladevengo_admin = $_POST["numero_planilladevengo_admin"];

		function validarempleado01($e,$numero_planilladevengo_admin1)
		{
					$query01 = "SELECT * FROM planilladevengo_admin WHERE codigo_empleado_planilladevengo_admin='$e' and numero_planilladevengo_admin=$numero_planilladevengo_admin1";
					echo $query01;
					$sql = Conexion::conectar()->prepare($query01);
					$sql->execute();
					return $sql->fetchAll();
		}
		$existeempleado="";
		$data03 = validarempleado01($codigo_empleado_planilladevengo_admin,$numero_planilladevengo_admin);
		foreach ($data03 as $value) {
		$existeempleado.=$value["id"];
		}


		$query01 = "UPDATE planilladevengo_admin SET " . trim($test, ",") . " WHERE id LIKE $existeempleado and numero_planilladevengo_admin=$numero_planilladevengo_admin";
		

		$sql = Conexion::conectar()->prepare($query01);
		$sql->execute();
		return $sql->fetchAll();
		$sql->close();
		$sql = null;






		/* ***************** */


	break;
	case "modificarexpres":
		/* ***************** */
	
		$namecolumnas_situacion = "";
		$namecampos_situacion = "";
		$data = getContent_modificarexpres();
		$test = "";
		foreach ($data as $row) {
			$namecolumnas_situacion .= $row['Field'] . "=" . ":" . $row['Field'] . ",";
			$test .= $row['Field'] . "='" . $_POST["" . $row['Field'] . ""] . "',";
		}

		$codigo_empleado_planilladevengo_admin = $_POST["codigo_empleado_planilladevengo_admin"];
		$numero_planilladevengo_admin = $_POST["numero_planilladevengo_admin"];

		function validarempleado01($e,$numero_planilladevengo_admin1)
		{
					$query01 = "SELECT * FROM planilladevengo_admin WHERE codigo_empleado_planilladevengo_admin='$e' and numero_planilladevengo_admin=$numero_planilladevengo_admin1";
					
					$sql = Conexion::conectar()->prepare($query01);
					$sql->execute();
					return $sql->fetchAll();
		}
		$existeempleado="";
		$data03 = validarempleado01($codigo_empleado_planilladevengo_admin,$numero_planilladevengo_admin);
		foreach ($data03 as $value) {
		$existeempleado.=$value["id"];
		}


		$query01 = "UPDATE planilladevengo_admin SET " . trim($test, ",") . " WHERE id LIKE $existeempleado and numero_planilladevengo_admin=$numero_planilladevengo_admin";
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
		/* 	$query01 = "SELECT * FROM `planilladevengo_admin`  WHERE codigo_empleado_planilladevengo_admin='$e'"; */
		/* 		$query01="SELECT tbl_empleados.id as idempleado, tbl_clientes_ubicaciones.id as idubicacion, tbl_clientes_ubicaciones.* , tbl_empleados_devengos_descuentos.* , tbl_clientes_ubicaciones.* ,  tbl_empleados.*,SUM(tbl_empleados_devengos_descuentos.valor) as valorempleado
		FROM tbl_empleados,tbl_ubicaciones_agentes_asignados,tbl_empleados_devengos_descuentos, tbl_clientes_ubicaciones
		WHERE tbl_empleados.codigo_empleado=tbl_ubicaciones_agentes_asignados.codigo_agente and tbl_empleados.id=tbl_empleados_devengos_descuentos.id_empleado and tbl_ubicaciones_agentes_asignados.idubicacion_agente=tbl_clientes_ubicaciones.id and  tbl_empleados.codigo_empleado='$e' and tbl_empleados_devengos_descuentos.id_tipo_devengo_descuento=2"; */
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
					$result['numero_planilladevengo_admin'] = $value['numero_planilladevengo_admin'];
					$result['fecha_planilladevengo_admin'] = $value['fecha_planilladevengo_admin'];
					$result['fecha_desde_planilladevengo_admin'] = $value['fecha_desde_planilladevengo_admin'];
					$result['fecha_hasta_planilladevengo_admin'] = $value['fecha_hasta_planilladevengo_admin'];
					$result['descripcion_planilladevengo_admin'] = $value['descripcion_planilladevengo_admin'];
					$result['codigo_empleado_planilladevengo_admin'] = $value['codigo_empleado_planilladevengo_admin'];
					$result['nombre_empleado_planilladevengo_admin'] = $value['nombre_empleado_planilladevengo_admin'];
					$result['id_empleado_planilladevengo_admin'] = $value['id_empleado_planilladevengo_admin'];
					$result['dias_trabajo_planilladevengo_admin'] = $value['dias_trabajo_planilladevengo_admin'];
					$result['sueldo_planilladevengo_admin'] = $value['sueldo_planilladevengo_admin'];
					$result['hora_extra_diurna_planilladevengo_admin'] = $value['hora_extra_diurna_planilladevengo_admin'];
					$result['hora_extra_nocturna_planilladevengo_admin'] = $value['hora_extra_nocturna_planilladevengo_admin'];
					$result['hora_extra_domingo_planilladevengo_admin'] = $value['hora_extra_domingo_planilladevengo_admin'];
					$result['hora_extra_domingo_nocturna_planilladevengo_admin'] = $value['hora_extra_domingo_nocturna_planilladevengo_admin'];
					$result['otro_devengo_admin_planilladevengo_admin'] = $value['otro_devengo_admin_planilladevengo_admin'];
					$result['total_devengo_admin_planilladevengo_admin'] = $value['total_devengo_admin_planilladevengo_admin'];
					$result['descuento_isss_planilladevengo_admin	'] = $value['descuento_isss_planilladevengo_admin	'];
					$result['descuento_afp_planilladevengo_admin'] = $value['descuento_afp_planilladevengo_admin'];
					$result['descuento_renta_planilladevengo_admin'] = $value['descuento_renta_planilladevengo_admin'];
					$result['otro_descuento_planilladevengo_admin'] = $value['otro_descuento_planilladevengo_admin'];
					$result['total_descuento_planilladevengo_admin'] = $value['total_descuento_planilladevengo_admin'];
					$result['total_liquidado_planilladevengo_admin'] = $value['total_liquidado_planilladevengo_admin'];
					$result['sueldo_renta_planilladevengo_admin'] = $value['sueldo_renta_planilladevengo_admin'];
					$result['sueldo_isss_planilladevengo_admin'] = $value['sueldo_isss_planilladevengo_admin'];
					$result['sueldo_afp_planilladevengo_admin'] = $value['sueldo_afp_planilladevengo_admin'];
					$result['departamento_planilladevengo_admin'] = $value['departamento_planilladevengo_admin'];
					$result['codigo_ubicacion_planilladevengo_admin'] = $value['codigo_ubicacion_planilladevengo_admin'];
					$result['nombre_ubicacion_planilladevengo_admin'] = $value['nombre_ubicacion_planilladevengo_admin'];
					$result['id_ubicacion_planilladevengo_admin'] = $value['id_ubicacion_planilladevengo_admin'];
					$result['observacion_planilladevengo_admin'] = $value['observacion_planilladevengo_admin'];
					$result['periodo_planilladevengo_admin'] = $value['periodo_planilladevengo_admin'];
					$result['tipo_planilladevengo_admin'] = $value['tipo_planilladevengo_admin'];
					$result['dias_incapacidad'] = $value['dias_incapacidad'];

				} */

				/* echo json_encode($result); */

		
			/* ************ */
	break;
	case "obtenerdatatotal":

		$numero_planilladevengo_admin=$_POST["numero_planilladevengo_admin"];
		/* ************ */
		function consultar_situacion2($e,$numero_planilladevengo_admin1)
		{
		/* 	$query01 = "SELECT * FROM `planilladevengo_admin`  WHERE codigo_empleado_planilladevengo_admin='$e'"; */
		$query01="SELECT * FROM `planilladevengo_admin` WHERE id_empleado_planilladevengo_admin=$e and numero_planilladevengo_admin=$numero_planilladevengo_admin1";


			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			$outp = $sql->fetchAll();
			echo json_encode($outp);
		};
		$data01 = consultar_situacion2($consultarempleado,$numero_planilladevengo_admin);
		$result = [];


		
			/* ************ */
	break;
	case "consultard":
		/* ************ */
		function consultar_situacion2($e,$x,$z)
		{
			$query01="SELECT*FROM tbl_devengo_descuento_planilla_admin WHERE idempleado_devengo='$e' and codigo_planilla_devengo='$z' and tipo_valor LIKE '%$x%'";
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
			<td class="subtotal2" isss="'.$value["isss_devengo_devengo_descuento_planilla"].'" afp="'.$value["afp_devengo_devengo_descuento_planilla"].'" renta="'.$value["renta_devengo_devengo_descuento_planilla"].'"  >'. bcdiv($value["valor_devengo_planilla"], '1', 3).'</td>
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
			$query01="SELECT*FROM tbl_devengo_descuento_planilla_admin WHERE idempleado_devengo='$e' and codigo_planilla_devengo='$z' and tipo_valor LIKE '%$x%'";
	
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
		
				$data = getContent_devengo_admin();
				foreach ($data as $row) {
					$namecolumnas_situacion .= $row['Field'] . ",";
					$namecampos_situacion .= ":" . $row['Field'] . ",";
				}
				$stmt = Conexion::conectar()->prepare("INSERT INTO tbl_devengo_descuento_planilla_admin(" . trim($namecolumnas_situacion, ",") . ") VALUES (" . trim($namecampos_situacion, ",") . ")");

				
				$campos="";
				foreach ($data as $row) {
					$stmt->bindParam(":" . $row['Field'], $_POST["" . $row['Field'] . ""], PDO::PARAM_STR);
					$campos.= $_POST["" . $row['Field'] . ""].',';
					
				}

						/* 		echo "INSERT INTO tbl_devengo_admin_descuento_planilla(" . trim($namecolumnas_situacion, ",") . ") VALUES (" . trim($campos, ",") . ")";
				*/


				
				$respuesta = "";
				if ($stmt->execute()) {

					$codigo_planilla_devengo=$_POST["codigo_planilla_devengo"];
					$idrecibo=$_POST["idrecibo"];
					if($idrecibo=="no"){

					}
					else{
						$insertar_recibo="UPDATE `recibos` SET  `liquidado_recibo`='Si',`numero_planilla_liquidado`='$codigo_planilla_devengo' WHERE id='$idrecibo'";
						$sql_recibo= Conexion::conectar()->prepare($insertar_recibo);
						$sql_recibo->execute();
					}

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
					$data = getContent_devengo_admin();
					$test = "";
					foreach ($data as $row) {
						$namecolumnas_situacion .= $row['Field'] . "=" . ":" . $row['Field'] . ",";
						$test .= $row['Field'] . "='" . $_POST["" . $row['Field'] . ""] . "',";
					}
			
					$query01 = "UPDATE tbl_devengo_descuento_planilla_admin SET " . trim($test, ",") . " WHERE id LIKE $id";
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
		/* 	$query01 = "SELECT * FROM `planilladevengo_admin`  WHERE codigo_empleado_planilladevengo_admin='$e'"; */
			$query01="SELECT*FROM tbl_devengo_descuento_planilla_admin WHERE id='$e'";
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
		/* 	$query01 = "SELECT * FROM `planilladevengo_admin`  WHERE codigo_empleado_planilladevengo_admin='$e'"; */
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


		
		/* ****************** */

		function consultardevengo($id1)
		{
			$query01="SELECT * FROM `tbl_devengo_descuento_planilla_admin` WHERE id=$id1";
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
			
		};
		$data01 = consultardevengo($consultarempleado);
		$tipo_devengo_descuento_planilla="";/* --id devengo */
		$codigo_planilla_devengo="";/* -- */
		$idempleado_devengo="";/* -- */
		$valor_devengo_planilla="";

		foreach ($data01 as $value) {
		$tipo_devengo_descuento_planilla.=$value["tipo_devengo_descuento_planilla"];
		$codigo_planilla_devengo.=$value["codigo_planilla_devengo"];
		$idempleado_devengo.=$value["idempleado_devengo"];
		$valor_devengo_planilla.=$value["valor_devengo_planilla"];
		}

		
		$insertar_recibo="UPDATE `recibos` SET  `liquidado_recibo`='No',`numero_planilla_liquidado`='' WHERE `numero_planilla_liquidado`='$codigo_planilla_devengo' and empleado_recibo='$idempleado_devengo' and descuento_recibo='$tipo_devengo_descuento_planilla' and valor_recibo	='$valor_devengo_planilla'";
		/* echo $insertar_recibo; */
		$sql_recibo= Conexion::conectar()->prepare($insertar_recibo);
		$sql_recibo->execute();


		$query = "DELETE FROM `tbl_devengo_descuento_planilla_admin` WHERE id=$consultarempleado";
		echo $query;
		$stmt = Conexion::conectar()->prepare($query);
		$stmt->execute();
		/* ****************** */
		/* 		$query = "DELETE FROM `planilladevengo_admin` WHERE id_empleado_planilladevengo_admin=$idempleado";
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
		/* 	$query01 = "SELECT * FROM `planilladevengo_admin`  WHERE codigo_empleado_planilladevengo_admin='$e'"; */
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
		/* 	$query01 = "SELECT * FROM `planilladevengo_admin`  WHERE codigo_empleado_planilladevengo_admin='$e'"; */
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

				function planilla_vacacion($e)
				{
					$query01="SELECT*FROM planilladevengo_vacacion WHERE id_empleado_planilladevengo_vacacion='$e' and numero_planilladevengo_vacacion = (SELECT MAX(numero_planilladevengo_vacacion) FROM planilladevengo_vacacion)";
					$sql = Conexion::conectar()->prepare($query01);
					$sql->execute();
					return $sql->fetchAll();
				};
				$data_planilla = planilla_vacacion($consultarempleado);
				$validar=0;
				foreach ($data_planilla as $value_planilla) {
					$validar.=$value_planilla["id"];
				}

				if($validar==0){
					echo $porcentaje_isss.",".$porcentaje_afp.",".$porcentaje_base1.",".$porcentaje_base2.",".$tasa_sobre_excedente.",".'no';

				}
				else{

					$porcentaje_isss=0;
					$porcentaje_afp=0;
					$porcentaje_base1=0;
					$porcentaje_base2=0;
					$tasa_sobre_excedente=0;

					echo $porcentaje_isss.",".$porcentaje_afp.",".$porcentaje_base1.",".$porcentaje_base2.",".$tasa_sobre_excedente.",".'si';

				}
			
			/* ************ */
	break;
	case "consultardevengosexistentes":
		
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
			$query01="SELECT `codigo_devengo_descuento_planilla`, `descripcion_devengo_descuento_planilla`, `tipo_devengo_descuento_planilla`, `isss_devengo_devengo_descuento_planilla`, `afp_devengo_devengo_descuento_planilla`, `renta_devengo_devengo_descuento_planilla`, `porcentaje_renta_devengo_descuento_planilla`, `porcentaje_isss_devengo_descuento_planilla`, `porcentaje_afp_devengo_descuento_planilla`, `idempleado_devengo`, `id`, `valor_devengo_planilla`, `tipo_valor`, `codigo_planilla_devengo` FROM `tbl_devengo_descuento_planilla_admin` WHERE codigo_devengo_descuento_planilla='$codigo1' and idempleado_devengo='$idempleados1' and codigo_planilla_devengo='$codigo_planilla1' and descripcion_devengo_descuento_planilla='vacio'";
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
		$data = getContent_devengo_admin();
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
		/* $query = "DELETE FROM `tbl_empleados_devengos_descuentos` WHERE id=$consultarempleado";
		echo $query;
		$stmt = Conexion::conectar()->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
		$stmt = null; */
		/* ********************* */

		/* ********************* */

		$numero_planilladevengo_admin=$_POST["numero_planilladevengo_admin"];
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
			$query01="SELECT `codigo_devengo_descuento_planilla`, `descripcion_devengo_descuento_planilla`, `tipo_devengo_descuento_planilla`, `isss_devengo_devengo_descuento_planilla`, `afp_devengo_devengo_descuento_planilla`, `renta_devengo_devengo_descuento_planilla`, `porcentaje_renta_devengo_descuento_planilla`, `porcentaje_isss_devengo_descuento_planilla`, `porcentaje_afp_devengo_descuento_planilla`, `idempleado_devengo`, `id`, `valor_devengo_planilla`, `tipo_valor`, `codigo_planilla_devengo` FROM `tbl_devengo_descuento_planilla_admin` WHERE codigo_devengo_descuento_planilla='$codigo1' and idempleado_devengo='$idempleados1' and codigo_planilla_devengo='$codigo_planilla1' and descripcion_devengo_descuento_planilla='vacio'";
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};


		foreach ($data01 as $value) {

			$codigo=$value["codigo"];
			$idempleadodevengo=$value["id_empleado"];

			$dato1 = consultar_planilla($codigo,$idempleadodevengo,$numero_planilladevengo_admin);
			$codigo="";
			foreach ($dato1 as $value2) {
				$codigo.=$value["codigo_devengo_descuento_planilla"];
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
				$codigo_planilla_devengo=$numero_planilladevengo_admin;

				$values_devengo ="('$codigo_devengo_descuento_planilla', '$descripcion_devengo_descuento_planilla', '$tipo_devengo_descuento_planilla', '$isss_devengo_devengo_descuento_planilla', '$afp_devengo_devengo_descuento_planilla', '$renta_devengo_devengo_descuento_planilla', '$idempleado_devengo', '$valor_devengo_planilla', '$tipo_valor', '$codigo_planilla_devengo'),";

				$insertar_devengo="INSERT INTO `tbl_devengo_descuento_planilla_admin`(`codigo_devengo_descuento_planilla`, `descripcion_devengo_descuento_planilla`, `tipo_devengo_descuento_planilla`, `isss_devengo_devengo_descuento_planilla`, `afp_devengo_devengo_descuento_planilla`, `renta_devengo_devengo_descuento_planilla`,`idempleado_devengo`, `valor_devengo_planilla`, `tipo_valor`, `codigo_planilla_devengo`) VALUES  ".trim($values_devengo, ",")."";
				$sql_devengo = Conexion::conectar()->prepare($insertar_devengo);
				$sql_devengo->execute();

			}

		
		}
		/* ************ */

	break;
	case "valordevengo_admin":

			/* ************************ */
			function consultar($e)
			{
				$query01="SELECT*FROM tbl_devengo_descuento_planilla_admin WHERE idempleado_devengo='$e' and descripcion_devengo_descuento_planilla LIKE '%vacacion%'";
	
			
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
			$query01="SELECT*FROM planilladevengo_admin ORDER by id DESC
			LIMIT 1";
			
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
			
		};
		$data01 = consultar_situacion2();
		$correlativo_dato="";
		foreach ($data01 as $value) {
		
				$numero = $value["numero_planilladevengo_admin"];
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
		$numero_planilladevengo_admin=$_POST["numero_planilladevengo_admin"];
		$id_empleado_planilladevengo_admin=$_POST["id_empleado_planilladevengo_admin"];
		$query = "DELETE FROM `planilladevengo_admin` WHERE numero_planilladevengo_admin=$numero_planilladevengo_admin and id_empleado_planilladevengo_admin=$id_empleado_planilladevengo_admin";
		
		$stmt = Conexion::conectar()->prepare($query);
		$stmt->execute();

		/* ********************* */

		$query01 = "DELETE FROM `tbl_devengo_descuento_planilla_admin` WHERE codigo_planilla_devengo=$numero_planilladevengo_admin and idempleado_devengo=$id_empleado_planilladevengo_admin";
		$stmt01 = Conexion::conectar()->prepare($query01);
		$stmt01->execute();


		/* ****************** */

		function consultar_situacion2($id1)
		{
			$query01="SELECT * FROM `tbl_empleados` WHERE id=$id1";
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
			
		};
		$data01 = consultar_situacion2($id_empleado_planilladevengo_admin);
		$codigoempleado="";
		foreach ($data01 as $value) {
		$codigoempleado.=$value["codigo_empleado"];
	

		}

		
		$insertar_recibo="UPDATE `recibos` SET  `liquidado_recibo`='No',`numero_planilla_liquidado`='' WHERE `numero_planilla_liquidado`='$numero_planilladevengo_admin' and empleado_recibo='$id_empleado_planilladevengo_admin'";
		$sql_recibo= Conexion::conectar()->prepare($insertar_recibo);
		$sql_recibo->execute();

		
		$insertar_situacion="UPDATE `situacion` SET  `liquidado_situacion`='No',`numero_planilla_admin`='' WHERE numero_planilla_admin='$numero_planilladevengo_admin' and idempleado_situacion='$codigoempleado'";
		$sql_situacion = Conexion::conectar()->prepare($insertar_situacion);
		/* 		$sql_situacion->execute();
		*/
		if ($sql_situacion->execute()) {
			echo "Ok";
		}

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
		$numero_planilladevengo_admin=$_POST["numero_planilladevengo_admin"];

		$query = "DELETE FROM `planilladevengo_admin` WHERE numero_planilladevengo_admin=$numero_planilladevengo_admin ";
		echo $query;
		$stmt = Conexion::conectar()->prepare($query);
		$stmt->execute();

		/* ********************* */
		$query01 = "DELETE FROM `tbl_devengo_descuento_planilla_admin` WHERE codigo_planilla_devengo=$numero_planilladevengo_admin ";
		$stmt01 = Conexion::conectar()->prepare($query01);
		$stmt01->execute();
		/* ****************** */

		$insertar_situacion="UPDATE `situacion` SET  `liquidado_situacion`='No',`numero_planilla_admin`='' WHERE numero_planilla_admin='$numero_planilladevengo_admin'";
		$sql_situacion = Conexion::conectar()->prepare($insertar_situacion);
		$sql_situacion->execute();


		
		$insertar_recibo="UPDATE `recibos` SET  `liquidado_recibo`='No',`numero_planilla_liquidado`='' WHERE numero_planilla_liquidado='$numero_planilladevengo_admin'";
		$sql_recibo= Conexion::conectar()->prepare($insertar_recibo);
		$sql_recibo->execute();



		/* 		$query = "DELETE FROM `planilladevengo_vacacion` WHERE id_empleado_planilladevengo_vacacion=$idempleado";
		echo $query;
		$stmt = Conexion::conectar()->prepare($query);
		$stmt->execute(); */

		return $stmt->fetchAll();
		$stmt->close();
		$stmt = null;
		/* ********************* */
	break;
	case "departamentoempleado":
		$idempleado=$_POST["id"];

		function consultar_situacion2($id1)
		{
			$query01="SELECT * FROM `tbl_empleados` WHERE id=$id1";
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
			
		};
		$data01 = consultar_situacion2($idempleado);
		$id_departamento_empresa="";
		foreach ($data01 as $value) {
		$id_departamento_empresa.=$value["id_departamento_empresa"];
		}

		/* ************ */
		function depa($id)
		{
			$query01="SELECT*FROM  departamentos_empresa WHERE id='$id'";
	
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			$outp = $sql->fetchAll();
			echo json_encode($outp);
		};
		$data01 = depa($id_departamento_empresa);
		$result = [];
		/* ************ */
	break;
	case "ubicacionempleado1":
		
		/* ************ */
		$idempleado=$_POST["id"];

		function consultar_situacion2($id12)
		{
			$query01="SELECT * FROM `tbl_empleados` WHERE id=$id12";
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
			
		};
		$data01 = consultar_situacion2($idempleado);
		$codigo_empleado="";
		foreach ($data01 as $value) {
		$codigo_empleado.=$value["codigo_empleado"];
		}

		/* ************ */
		function depa($id)
		{
			$query01="SELECT tbl_ubicaciones_agentes_asignados.idubicacion_agente as idubicacion, tbl_ubicaciones_agentes_asignados.*,tbl_clientes_ubicaciones.* FROM `tbl_ubicaciones_agentes_asignados` ,tbl_clientes_ubicaciones
			WHERE tbl_ubicaciones_agentes_asignados.idubicacion_agente=tbl_clientes_ubicaciones.id and tbl_ubicaciones_agentes_asignados.codigo_agente='$id'";
	
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			$outp = $sql->fetchAll();
			echo json_encode($outp);
		};
		$data01 = depa($codigo_empleado);
		$result = [];
		/* ************ */
	break;
	case "diasferiado":
	
		$idempleado=$_POST["idempleado"];
		$fecha_planilladevengo_admin=$_POST["fecha_planilladevengo_admin"];
		/* ************************ */
		function viatico_permanente($id_tipo_devengo1,$id_empleado1)
			{
				$query01="SELECT `id`, `id_empleado`, `id_tipo_devengo_descuento`, `valor`, `fecha_caducidad`, `referencia`, `tipodescuento` FROM `tbl_empleados_devengos_descuentos` WHERE id_empleado='$id_empleado1' and id_tipo_devengo_descuento='$id_tipo_devengo1'";
			
				$sql = Conexion::conectar()->prepare($query01);
				$sql->execute();
				return $sql->fetchAll();
			};
			/* ************************ */
		function dias_feriados()
			{
				$query01="SELECT `id`, `num_dias`, `fecha_desde`, `fecha_hasta` FROM `dias_feriados` ";
				$sql = Conexion::conectar()->prepare($query01);
				$sql->execute();
				return $sql->fetchAll();
			};
		/* ************************ */
		
		/* ************************ */
		function ausencia_dias_feriados($idempleado1)
			{
				$query01="SELECT `id`, `empleado_ausencia`, `fecha_feriado` FROM `ausenciadiasferiados` WHERE empleado_ausencia='$idempleado1' ";
				
				$sql = Conexion::conectar()->prepare($query01);
				$sql->execute();
				return $sql->fetchAll();
			};
		/* ************************ */

		function cargo_empleado($id1)
			{
				$query01="SELECT `id`, `descripcion`, `nivel`, `codigo_contable`, `personal_asignado`, `pago_feriados`, `calculo` FROM `cargos_desempenados` WHERE id='$id1'";
				$sql = Conexion::conectar()->prepare($query01);
				$sql->execute();
				return $sql->fetchAll();
			};


		/* consulta maestra */
		function consultar($idemmpleados1)
		{
			$query01="SELECT DATE_FORMAT(DATE(NOW()), '%m-%d')as fecha_actual,DATE_FORMAT(tbl_empleados.fecha_contratacion, '%m-%d') as fechacontracion, tbl_empleados.id as idempleado, tbl_empleados.*
			FROM `tbl_empleados` where 
			id='$idemmpleados1'";
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};

			$data_consultar= consultar($idempleado);	
			foreach ($data_consultar as $value_empleado) {
				$idcargo_empleado=$value_empleado["nivel_cargo"];
				$salario_empleado=$value_empleado["sueldo"];

				/* DEVENGO POR DIAS FERIADOS TRABAJADOS */
				$data_viatico_permanente= viatico_permanente('2',$idempleado);	
				$valor_viatico_permanente="";		
				foreach ($data_viatico_permanente as $value_viatico) {
					$valor_viatico_permanente.=$value_viatico["valor"];		
				}


				/* ***** VALIDAR SI ESTAMOS EN EL MES DE DIAS FERIADOS Y BUSCAR SI EMPLEADO A ESTA AUSENTE EN LOS DIAS FERIADOS */
				$data_ausencia_dias_feriados= ausencia_dias_feriados($idempleado);	
				$restar_dias_feriados=0;	
				$fecha_feriado_ausencia="";	
				foreach ($data_ausencia_dias_feriados as $value_ausencia_dias_feriados) {
					$fecha_feriado_ausencia.=$value_ausencia_dias_feriados["fecha_feriado"];	
				}
				
				$data_dias_feriados= dias_feriados();	
				foreach ($data_dias_feriados as $value_dias_feriados) {
					$fecha_desde=$value_dias_feriados["fecha_desde"];		
					$fecha_hasta=$value_dias_feriados["fecha_hasta"];	

					$fecha_desde_mes=date("m", strtotime($fecha_desde));	
					$fechaActual_mes = date("m", strtotime($fecha_planilladevengo_admin));
					if($fechaActual_mes==$fecha_desde_mes){

						$fecha_desde_mes_feriado=$value_dias_feriados["fecha_desde"];
						$fecha_hasta_mes_feriado=$value_dias_feriados["fecha_hasta"];
						$resultado_dias=0;
						if ($fecha_feriado_ausencia >= $fecha_desde && $fecha_feriado_ausencia <= $fecha_hasta){
							$resultado_dias=$resultado_dias+1;
						}		
						/* CONTAR LOS DIAS FERIADOS */
						$feriado_desde= date("Y-m-d", strtotime($fecha_desde_mes_feriado));
						$feriado_hasta = date("Y-m-d", strtotime($fecha_hasta_mes_feriado));
						/* lunes-viernes */
						$workingDays = 0;
						$startTimestamp = strtotime($feriado_desde);
						$endTimestamp = strtotime($feriado_hasta);
						for ($i = $startTimestamp; $i <= $endTimestamp; $i = $i + (60 * 60 * 24)) {
							if (date("N", $i) <= 5) $workingDays = $workingDays + 1;
						}
						/* *********** */
						/* ****sabado-domingo */
						$weekendDays = 0;
						$startTimestamp = strtotime($feriado_desde);
						$endTimestamp = strtotime($feriado_hasta);
						for ($i = $startTimestamp; $i <= $endTimestamp; $i = $i + (60 * 60 * 24)) {
							if (date("N", $i) > 5) $weekendDays = $weekendDays + 1;
						}

						$dias_festivos= floatval($workingDays)+floatval($weekendDays);
						$restar_dias_feriados.=floatval($dias_festivos)-floatval($resultado_dias);
						/* echo $restar_dias_feriados.'restar_dias_feriados'; */
						/* *********************** */
						
					}
					
				}
				/* ******************************************************** */

				$data_cargo= cargo_empleado($idcargo_empleado);	
				$ecuacion_dias=0;	
				$valordias=0;
				foreach ($data_cargo as $valu_cargo) {
						$pago_feriados=$valu_cargo["pago_feriados"];
						$calculo=$valu_cargo["calculo"];
						if($pago_feriados=="Si"){
							if($calculo=="Sueldo+Tfijo"){
								$salario_mas_viatico=floatval($salario_empleado)+floatval($valor_viatico_permanente);
								$valordias.=floatval($salario_mas_viatico)/15;
								$ecuacion_dias=$valordias*floatval($restar_dias_feriados);
							}
							else{
								$valordias.=floatval($salario_empleado)/15;
								$ecuacion_dias=floatval($valordias)*floatval($restar_dias_feriados);
							}
						}
					}


				echo $restar_dias_feriados.'-'.$valordias;
			}
	
	break;
	case "onlydiastrabajados":
		/* ************ */
		$idempleado=$_POST["idempleado"];
		function empleadosplanilla($idempleado1)
		{
		/* 	$query01 = "SELECT * FROM `planilladevengo_admin`  WHERE codigo_empleado_planilladevengo_admin='$e'"; */
			$query01="SELECT*FROM `tbl_empleados` where id=$idempleado1";
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			$outp = $sql->fetchAll();
			echo json_encode($outp);
			
		};
		$data01 = empleadosplanilla($idempleado);
		$result = [];
			/* ************ */
	break;
	case "listadoempleados":
		/* ************ */
		$numero=$_POST["numero"];
		function empleadosplanilla($numero1)
		{
		/* 	$query01 = "SELECT * FROM `planilladevengo_admin`  WHERE codigo_empleado_planilladevengo_admin='$e'"; */
			$query01="SELECT tbl_empleados.id as id, planilladevengo_admin.*,tbl_empleados.* 
			FROM `tbl_empleados`,planilladevengo_admin 
			WHERE planilladevengo_admin.id_empleado_planilladevengo_admin=tbl_empleados.id and planilladevengo_admin.numero_planilladevengo_admin='$numero1'
			 group by tbl_empleados.id ";
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			$outp = $sql->fetchAll();
			echo json_encode($outp);
			
		};
		$data01 = empleadosplanilla($numero);
		$result = [];
			/* ************ */
	break;
	case "listaidempleados":
		/* ************ */
		$idempleado=$_POST["idempleado"];
		/* $correlativo=$_POST["correlativo"]; */
		function empleadosplanilla($idempleado1)
		{
		/* 	$query01 = "SELECT * FROM `planilladevengo_admin`  WHERE codigo_empleado_planilladevengo_admin='$e'"; */

		$query01="SELECT * FROM `tbl_empleados` WHERE tbl_empleados.id='$idempleado1' ";
			/* $query01="SELECT tbl_empleados.id as id, tbl_empleados.*, planilladevengo_admin.* FROM `tbl_empleados`, planilladevengo_admin WHERE planilladevengo_admin.id_empleado_planilladevengo_admin=tbl_empleados.id and tbl_empleados.id='$idempleado1' and planilladevengo_admin.numero_planilladevengo_admin='$correlativo1'"; */
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			$outp = $sql->fetchAll();
			echo json_encode($outp);
			
		};
		$data01 = empleadosplanilla($idempleado);
		$result = [];
			/* ************ */
	break;
	case "verificardatoingresado":
		/* ************ */
		$numero=$_POST["numero"];
		$idempleado=$_POST["idempleado"];
		function empleadosplanilla($numero1,$idempleado1)
		{
		/* 	$query01 = "SELECT * FROM `planilladevengo_admin`  WHERE codigo_empleado_planilladevengo_admin='$e'"; */
			$query01="SELECT tbl_empleados.id as id, planilladevengo_admin.*,tbl_empleados.* FROM `tbl_empleados`,planilladevengo_admin WHERE planilladevengo_admin.id_empleado_planilladevengo_admin=tbl_empleados.id and planilladevengo_admin.numero_planilladevengo_admin='$numero1' and tbl_empleados.id='$idempleado1' group by tbl_empleados.id ";
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			$outp = $sql->fetchAll();
			echo json_encode($outp);
			
		};
		$data01 = empleadosplanilla($numero,$idempleado);
		$result = [];
			/* ************ */
	break;
	case "guardartodo":
		$numeroplanilla=$_POST["numeroplanilla"];

		function salario_planilla($empleado1,$numeroplanilla1)
		{
			$query01="SELECT * FROM `planilladevengo_admin` 
			WHERE id_empleado_planilladevengo_admin='$empleado1' and numero_planilladevengo_admin='$numeroplanilla1' ";
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};

		function devengo_isss($empleado1,$numeroplanilla1)
						{
							$query01="SELECT SUM(valor_devengo_planilla) as sumaisss FROM `tbl_devengo_descuento_planilla_admin` 
							WHERE isss_devengo_devengo_descuento_planilla='Si' and idempleado_devengo='$empleado1' and tbl_devengo_descuento_planilla_admin.codigo_planilla_devengo='$numeroplanilla1' and  tbl_devengo_descuento_planilla_admin.tipo_valor LIKE '%suma%'";
							$sql = Conexion::conectar()->prepare($query01);
							$sql->execute();
							return $sql->fetchAll();
						};

						/* sacar los devengos renta */
				function devengo_renta($empleado1,$numeroplanilla1)
				{
					$query01="SELECT SUM(valor_devengo_planilla) as sumarenta FROM `tbl_devengo_descuento_planilla_admin` 
					WHERE renta_devengo_devengo_descuento_planilla='Si' and idempleado_devengo='$empleado1' and tbl_devengo_descuento_planilla_admin.codigo_planilla_devengo='$numeroplanilla1' and  tbl_devengo_descuento_planilla_admin.tipo_valor LIKE '%suma%'";
					$sql = Conexion::conectar()->prepare($query01);
					$sql->execute();
					return $sql->fetchAll();
				};
		/* sacar los devengos afp */
		function devengo_afp($empleado1,$numeroplanilla1)
		{
			$query01="SELECT SUM(valor_devengo_planilla) as sumaafp FROM `tbl_devengo_descuento_planilla_admin` 
			WHERE afp_devengo_devengo_descuento_planilla='Si' and idempleado_devengo='$empleado1' and tbl_devengo_descuento_planilla_admin.codigo_planilla_devengo='$numeroplanilla1' and  tbl_devengo_descuento_planilla_admin.tipo_valor LIKE '%suma%'";
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};

		

			function descuentos_total($empleado1,$numeroplanilla1)
				{
					$query01="SELECT SUM(valor_devengo_planilla) as sumadescuentos FROM `tbl_devengo_descuento_planilla_admin` 
					WHERE idempleado_devengo='$empleado1' and tbl_devengo_descuento_planilla_admin.codigo_planilla_devengo='$numeroplanilla1' and  tbl_devengo_descuento_planilla_admin.tipo_valor LIKE '%resta%'";
					$sql = Conexion::conectar()->prepare($query01);
					$sql->execute();
					return $sql->fetchAll();
				};


                /* sacar los descuentos */
				function devengos_total($empleado1,$numeroplanilla1)
				{
					$query01="SELECT SUM(valor_devengo_planilla) as sumaglobal FROM `tbl_devengo_descuento_planilla_admin` 
					WHERE idempleado_devengo='$empleado1' and tbl_devengo_descuento_planilla_admin.codigo_planilla_devengo='$numeroplanilla1' and  tbl_devengo_descuento_planilla_admin.tipo_valor LIKE '%suma%'";
					$sql = Conexion::conectar()->prepare($query01);
					$sql->execute();
					return $sql->fetchAll();
				};


                /* EMPLEADO */
					function empleado($e)
					{
						$query01="SELECT*FROM tbl_empleados WHERE id='$e'";
						$sql = Conexion::conectar()->prepare($query01);
						$sql->execute();
						return $sql->fetchAll();
					};


                    /* afp------- */
					function afp($e)
								{
									$query01="SELECT*FROM afp WHERE codigo='$e'";
									$sql = Conexion::conectar()->prepare($query01);
									$sql->execute();
									return $sql->fetchAll();
								};


                                /* configuracion */
					function configuracion()
					{
						$query01="SELECT*FROM configuracion";
						$sql = Conexion::conectar()->prepare($query01);
						$sql->execute();
						return $sql->fetchAll();
					};


                    
						function planilla_vacacion($e)
						{
							$query01="SELECT*FROM planilladevengo_vacacion WHERE id_empleado_planilladevengo_vacacion='$e' and numero_planilladevengo_vacacion = (SELECT MAX(numero_planilladevengo_vacacion) FROM planilladevengo_vacacion)";
							$sql = Conexion::conectar()->prepare($query01);
							$sql->execute();
							return $sql->fetchAll();
						};

                        /* ISR sirve para saber la renta */
				function isr($salario,$periodo)
				{
					$query01="SELECT isr.id as idisr, `codigo`, `nombre_rango`, `periodo_pago`, `salario_desde`, `salario_hasta`, `base_1`, `tasa_sobre_excedente`, `base_2`, periodo_de_pago.id as idperiodo 
							FROM `isr`, periodo_de_pago 
							WHERE isr.periodo_pago=periodo_de_pago.id and nombre_periodo='$periodo' and '$salario'>=salario_desde and '$salario'<=salario_hasta";
					$sql = Conexion::conectar()->prepare($query01);
					$sql->execute();
					return $sql->fetchAll();
				};


      
		function consulta_maestras($numeroplanilla1)
		{
			$query01="SELECT * FROM `planilladevengo_admin` WHERE numero_planilladevengo_admin='$numeroplanilla1' ";
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};
		$data_maestra = consulta_maestras($numeroplanilla);
		$respuesta="";
		foreach ($data_maestra as $value_master) {

				$consultarempleado = $value_master["id_empleado_planilladevengo_admin"];
				/* --------------------- */
				/* VARIABLES RECIBIDAS */
				/* $valor_devengo_planilla=$_POST["valor_devengo_planilla"]; */
			
						$data_salario_planilla = salario_planilla($consultarempleado,$numeroplanilla);
						$sueldo_planilladevengo_admin=0;
						$hora_extra_diurna_planilladevengo_admin=0;
						foreach ($data_salario_planilla as $value) {
							$sueldo_planilladevengo_admin.=floatval($value["sueldo_planilladevengo_admin"]);
							$hora_extra_diurna_planilladevengo_admin.=floatval($value["hora_extra_diurna_planilladevengo_admin"]);
						}

				/* sacar los devengos isss */
					
						$data_devengo_isss = devengo_isss($consultarempleado,$numeroplanilla);
						$sumaisss=0;
						foreach ($data_devengo_isss as $value) {
							$sumaisss.=floatval($value["sumaisss"]);
						}
				/* --------------------- */
				
				$data_devengo_renta = devengo_renta($consultarempleado,$numeroplanilla);
				$sumarenta=0;
				foreach ($data_devengo_renta as $value) {
					$sumarenta.=floatval($value["sumarenta"]);
				}
				/* --------------------- */
				
				$data_devengo_afp = devengo_afp($consultarempleado,$numeroplanilla);
				$sumaafp=0;
				foreach ($data_devengo_afp as $value) {
					$sumaafp.=floatval($value["sumaafp"]);
				}
				/* --------------------- */
				/* sacar los descuentos */
				
				$data_descuentos_total = descuentos_total($consultarempleado,$numeroplanilla);
				$sumadescuentos=0;
				foreach ($data_descuentos_total as $value) {
					$sumadescuentos.=floatval($value["sumadescuentos"]);
				}
				if(empty($sumadescuentos)){
					$sumadescuentos=0;
				}
				/* --------------------- */
					/* --------------------- */
				
				$data_devengos_total = devengos_total($consultarempleado,$numeroplanilla);
				$sumaglobal=0;
				foreach ($data_devengos_total as $value) {
					$sumaglobal.=floatval($value["sumaglobal"]);
				}
				/* --------------------- */


				/* operacion para saber porcentajes */
				
					$data01 = empleado($consultarempleado);
					$tipo_afp="";
					$periodo_pago="";
					$hora_extra_diurna=0;
					foreach ($data01 as $value) {
						$tipo_afp=$value["codigo_afp"];
						$periodo_pago=$value["periodo_pago"];
						$hora_extra_diurna=floatval($value["hora_extra_diurna"]);
					}
					
					/* converir el periodo de pago  */
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
					
					$data01 = afp($tipo_afp);
					$porcentaje_afp="";
					foreach ($data01 as $value) {
						$porcentaje_afp=$value["porcentaje"];
					}

					
					$data01 = configuracion();
					$porcentaje_isss="";
					$tope_isss="";
					foreach ($data01 as $value) {
						$porcentaje_isss=$value["porcentaje_isss"];
						$tope_isss=$value["tope_isss"];
					}
					
						/* saber si hay planilla vacacion */

						$data_planilla = planilla_vacacion($consultarempleado);
						$validar=0;
						foreach ($data_planilla as $value_planilla) {
							$validar.=$value_planilla["id"];
						}

					/* validar si hay o no vacacion */ /* aqui estan los porcentajes */
						if($validar==0){
							
						}
						else{
							$porcentaje_isss=0;
							$porcentaje_afp=0;
							
						}
				/*----------------------  */
				$convertir_porcentaje_isss =floatval($porcentaje_isss)/100;
				$convertir_porcentaje_afp =floatval($porcentaje_afp)/100;
				if(floatval($sumaisss)>floatval($tope_isss)){
					$sumaisss=$tope_isss;
				}
				/* Descuento ISSS: */
				$validar_salario_calculos=$sueldo_planilladevengo_admin;
				if($validar==0){}else{$validar_salario_calculos=0;}
				$sumaisss_salario=floatval($validar_salario_calculos)+floatval($sumaisss);
				$total_isss= floatval($sumaisss_salario)*$convertir_porcentaje_isss;/* descuento isss */
				$descuento_iss_final=floatval($sumaisss_salario)-floatval($total_isss);
				/* Descuento AFP: */
				$sumaafp_salario=floatval($validar_salario_calculos)+floatval($sumaafp);
				$total_afp=floatval($sumaafp_salario)*$convertir_porcentaje_afp;/* descuento afp */
				$descuento_afp_final=$sumaafp_salario-$total_afp;
				/* Descuento Renta: */
				$sumarenta_salario=floatval($validar_salario_calculos)+floatval($sumarenta);
				$total_descuento_renta=floatval($sumarenta_salario)-floatval($total_afp)-floatval($total_isss);
				if($total_descuento_renta==0){
					$total_descuento_renta=0;
				}

				
				$valor_renta_salario=floatval($sueldo_planilladevengo_admin)+floatval($total_descuento_renta);
				$data01 = isr($valor_renta_salario,$periodo_pago);
				$porcentaje_base1="";
				$porcentaje_base2="";
				$tasa_sobre_excedente="";
				foreach ($data01 as $value) {
					$porcentaje_base1=$value["base_1"];
					$porcentaje_base2=$value["base_2"];
					$tasa_sobre_excedente=$value["tasa_sobre_excedente"];

				}
				/* validar si hay o no vacacion */ /* aqui estan los porcentajes */
				if($validar==0){}
				else{
					$porcentaje_base1=0;
					$porcentaje_base2=0;
					$tasa_sobre_excedente=0;
				}
			/* 	$convertir_porcentaje_base1 =floatval($porcentaje_base1)/100;
				$convertir_porcentaje_base2 =floatval($porcentaje_base2)/100; */
				$convertir_tasa_sobre_excedente=floatval($tasa_sobre_excedente)/100;
				$sueldo_menos_base= floatval($total_descuento_renta)-floatval($porcentaje_base2);
				$tasa_por_exedente= floatval($sueldo_menos_base)*floatval($convertir_tasa_sobre_excedente);
				$descuento_renta=floatval($tasa_por_exedente)+floatval($porcentaje_base1);

				$total_horas_extras=floatval($hora_extra_diurna_planilladevengo_admin)*floatval($hora_extra_diurna);

				$total_salario_horas_devengos=floatval($sueldo_planilladevengo_admin)+floatval($sumaglobal)+floatval($total_horas_extras);

				$total_descuentos=floatval($total_isss)+floatval($total_afp)+floatval($descuento_renta)+floatval($sumadescuentos);/* guardar  */
				$valor_liquido_final=floatval($total_salario_horas_devengos)-floatval($total_descuentos);/* guardar  */


				$test = "total_liquidado_planilladevengo_admin". "='" . round($valor_liquido_final,2) . "',".
						"descuento_afp_planilladevengo_admin" . "='" . round($total_afp,2) . "',".
						"descuento_isss_planilladevengo_admin" . "='" . round($total_isss,2) . "',".
						"descuento_renta_planilladevengo_admin" . "='" . round($descuento_renta,2) . "',".
						"otro_devengo_admin_planilladevengo_admin" . "='" . round($sumaglobal,2) . "',".
						"otro_descuento_planilladevengo_admin" . "='" . round($sumadescuentos,2) . "',".
						"sueldo_isss_planilladevengo_admin" . "='" . round($sumaisss_salario,2) . "',".
						"sueldo_renta_planilladevengo_admin" . "='" . round($total_descuento_renta,2) . "',".
						"sueldo_afp_planilladevengo_admin" . "='" . round($sumaafp_salario,2) . "',".
						"total_descuento_planilladevengo_admin" . "='" . round($total_descuentos,2) . "',".
						"hora_extra_diurna_planilladevengo_admin" . "='" . round($hora_extra_diurna_planilladevengo_admin,2) . "',".
						"total_devengo_admin_planilladevengo_admin" . "='" . round($total_salario_horas_devengos,2) . "',";

				$existeempleado=$value_master["id"];
				$query01 = "UPDATE planilladevengo_admin SET " . trim($test, ",") . " WHERE id LIKE $existeempleado and numero_planilladevengo_admin='$numeroplanilla'";
				$sql = Conexion::conectar()->prepare($query01);
				$sql->execute();
				if($sql->execute()){
					$respuesta= "exito";
				}
				/* return $sql->fetchAll();
				$sql->close();
				$sql = null; */

	    }
		echo $respuesta;
	break;




	default:
		echo $accion."respuesta nula";
}



?>