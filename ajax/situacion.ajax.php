

<?php

require_once "../modelos/conexion.php";

$id = $_POST["id"];
$idempleado_situacion = $_POST["idempleado_situacion"];
$dias_ausencia_situacion = $_POST["dias_ausencia_situacion"];
$horas_ausencia_situacion = $_POST["horas_ausencia_situacion"];
$consulta_isss_situacion = $_POST["consulta_isss_situacion"];
$incapacidad_situacion = $_POST["incapacidad_situacion"];
$ansp_situacion = $_POST["ansp_situacion"];
$vacaciones_situacion = $_POST["vacaciones_situacion"];
$permiso_situacion = $_POST["permiso_situacion"];
$hora_normales_situacion = $_POST["hora_normales_situacion"];
$tiempo_compensatorio_situacion = $_POST["tiempo_compensatorio_situacion"];
$recuperar_tiempo_situacion = $_POST["recuperar_tiempo_situacion"];
$comodin_situacion = $_POST["comodin_situacion"];
$cubierto_situacion = $_POST["cubierto_situacion"];
$nuevo_servicio_situacion = $_POST["nuevo_servicio_situacion"];
$fin_servicio_situacion = $_POST["fin_servicio_situacion"];
$ubicacion_situacion = $_POST["ubicacion_situacion"];
$servicio_eventual_situacion = $_POST["servicio_eventual_situacion"];
$inactivos_situacion = $_POST["inactivos_situacion"];
$activo_situacion = $_POST["activo_situacion"];
$liquidado_situacion = $_POST["liquidado_situacion"];
$inicial_situacion = $_POST["inicial_situacion"];
$hora_extra_situacion = $_POST["hora_extra_situacion"];
$vacante_situacion = $_POST["vacante_situacion"];
$posicion_situacion = $_POST["posicion_situacion"];
$fecha_situacion = $_POST["fecha_situacion"];
$accion = $_POST["accion"];
$motivo_horas_extras = $_POST["motivo_horas_extras"];
$horas_no_cubiertas = $_POST["horas_no_cubiertas"];
$solicitado_situacion = $_POST["solicitado_situacion"];








function getContent()
{
	$query = "SHOW COLUMNS FROM situacion";
	$stmt = Conexion::conectar()->prepare($query);
	$stmt->execute();
	return $stmt->fetchAll();

	$stmt->close();

	$stmt = null;
}





switch ($accion) {
	case "consultar":

		function consultar_situacion($e)
		{
			$query01 = "SELECT * FROM `situacion`  WHERE idempleado_situacion='$e'";
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};
		$data01 = consultar_situacion($idempleado_situacion);
		$datos_html = "";
		$datos_html .= '  <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
		<thead>
		  <tr>
			<th style="width:90px">Fecha</th>
			<th>D.AUS</th>
			<th>H.AUS</th>
			<th>C.ISSS</th>
			<th>INCAP</th>
			<th>ANSP</th>
			<th>VACAC</th>
			<th>PERMI</th>
			<th>H.EXT</th>
			<th>H.NOR</th>
			<th>T.COMP</th>
			<th>R.TIEMP</th>
			<th>D. No Sueldo</th>
			<th>Acciones</th>

		  </tr> 

		</thead>

		<tbody>';
		$nombre_empleado=$idempleado_situacion;
		foreach ($data01 as $value) {
			

			$datos_html .= '<tr>
			<td style="width:90px">' . $value["fecha_situacion"] . '</td>
			<td>' . $value["dias_ausencia_situacion"] . '</td>
			<td>' . $value["horas_ausencia_situacion"] . '</td>
			<td>' . $value["consulta_isss_situacion"] . '</td>
			<td>' . $value["incapacidad_situacion"] . '</td>
			<td>' . $value["ansp_situacion"] . '</td>
			<td>' . $value["vacaciones_situacion"] . '</td>
			<td>' . $value["permiso_situacion"] . '</td>
			<td>' . $value["hora_extra_situacion"] . '</td>
			<td>' . $value["hora_normales_situacion"] . '</td>
			<td>' . $value["tiempo_compensatorio_situacion"] . '</td>
			<td>' . $value["recuperar_tiempo_situacion"] . '</td>
			<td>' . $value["dias_no_sueldo"] . '</td>
			<td>
			  <div class="btn-group">
				<button class="btn btn-warning btnEditarsituacion" id="' . $value["id"] . '" data-toggle="modal" data-target="#modalAgregarsituacion"><i class="fa fa-pencil"></i></button>
				<button class="btn btn-danger btnEliminarsituacion" id="' . $value["id"] . '"  Codigo="' . $value["id"] . '"><i class="fa fa-times"></i></button>
			  </div>  
			</td>
		  </tr>';
		}
		$datos_html .= '</tbody></table>';

		
		function consultar_ubicacion2($x)
		{
			$query01 = "SELECT `id`, `idagente_transacciones_agente`, `fecha_transacciones_agente`, `hora_transacciones_agente`, `tipo_movimiento_transacciones_agente`, `nueva_ubicacion_transacciones_agente`, `ubicacion_anterior_transacciones_agente`, `fecha_desde_transacciones_agente`, `fecha_hasta_transacciones_agente`, `presento_incapacidad_transacciones_agente`, `comentarios_transacciones_agente`, `turno_transacciones_agente`, `horario_desde_transacciones_agente`, `horario_hasta_transacciones_agente` 
			FROM `transacciones_agente` WHERE  idagente_transacciones_agente='$x' 
			order by id desc
			limit 1";
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};
		$data_empleado = consultar_ubicacion2($nombre_empleado);
		$obtener_ubicacion="";
		foreach ($data_empleado as $value) {
			$obtener_ubicacion.=$value["nueva_ubicacion_transacciones_agente"];
		}
		

		echo $datos_html.",".$obtener_ubicacion;


		break;
	case "insertar":
		/* ****************** */
		/* CAPTURA NOMBRE DE LAS COLUMNAS Y CAMPOS DEL IMPUT */
		
		$namecolumnas_situacion = "";
		$namecampos_situacion = "";
		$descontar_tipohora=$_POST["descontar_tipohora"];
		$cubrir_situacion=$_POST["cubrir_situacion"];
		$fecha_situacion=$_POST["fecha_situacion"];
		$hora_extra_situacion=$_POST["hora_extra_situacion"];
		$hora_normales_situacion=$_POST["hora_normales_situacion"];
		$tiempo_compensatorio_situacion=$_POST["tiempo_compensatorio_situacion"];
		$valor_hora_ausensia="";
		

		$data = getContent();
		foreach ($data as $row) {
			$namecolumnas_situacion .= $row['Field'] . ",";
			$namecampos_situacion .= ":" . $row['Field'] . ",";
		}
		$stmt = Conexion::conectar()->prepare("INSERT INTO situacion(" . trim($namecolumnas_situacion, ",") . ") VALUES (" . trim($namecampos_situacion, ",") . ")");

		foreach ($data as $row) {
			$stmt->bindParam(":" . $row['Field'], $_POST["" . $row['Field'] . ""], PDO::PARAM_STR);
		}
		$respuesta="";
		if ($stmt->execute()) {
			$respuesta.="ok";
			$codigo_empleado = explode("-", $cubrir_situacion);
			$codigo_empleadoc=$codigo_empleado[0];
			if($hora_extra_situacion>0 && $cubrir_situacion != ""){

				if(!empty($hora_extra_situacion)){
					$valor_hora_ausensia=$hora_extra_situacion;
				}
				if(!empty($hora_normales_situacion)){
					$valor_hora_ausensia=$hora_normales_situacion;
				}
				if(!empty($tiempo_compensatorio_situacion)){
					$valor_hora_ausensia=$tiempo_compensatorio_situacion;
				}

				$insertar_haus="INSERT INTO `situacion`(`horas_ausencia_situacion`, `fecha_situacion`, `idempleado_situacion`) VALUES  ('$valor_hora_ausensia','$fecha_situacion','$codigo_empleadoc')";
				$sql_haus = Conexion::conectar()->prepare($insertar_haus);
				$sql_haus->execute();
			}
			/* return "ok"; */
		} else {
			$respuesta.="error";
			/* return "error"; */
		}
		echo $respuesta;
		/* $stmt->close(); */
		$stmt = null;


		/* ***************** */
		break;
	case "modificar":

		/* ***************** */

		$namecolumnas_situacion = "";
		$namecampos_situacion = "";

		
		$descontar_tipohora=$_POST["descontar_tipohora"];
		$cubrir_situacion=$_POST["cubrir_situacion"];
		$fecha_situacion=$_POST["fecha_situacion"];
		$hora_extra_situacion=$_POST["hora_extra_situacion"];
		$hora_normales_situacion=$_POST["hora_normales_situacion"];
		$tiempo_compensatorio_situacion=$_POST["tiempo_compensatorio_situacion"];
		$valor_hora_ausensia="";

		
		/* *************************** */
		$codigo_empleado = explode("-", $cubrir_situacion);
		$codigo_empleadoc=$codigo_empleado[0];
		if($hora_extra_situacion>0 || $cubrir_situacion != ""){

			function consultar_situacion($id1)
			{
				$query01="SELECT * FROM situacion WHERE id='$id1'";
				
				$sql = Conexion::conectar()->prepare($query01);
				$sql->execute();
				return $sql->fetchAll();
			};
			$data_planilla = consultar_situacion($id);
			$fecha_anterior="";
			$horas_ausencia_situacion_old="";
			$empleado_cubrir="";
			foreach ($data_planilla as $value) {
				$fecha_anterior.=$value["fecha_situacion"];

				if(!empty($value["hora_extra_situacion"])){
					$horas_ausencia_situacion_old.=$value["hora_extra_situacion"];
				}
				if(!empty($value["hora_normales_situacion"])){
					$horas_ausencia_situacion_old.=$value["hora_normales_situacion"];
				}
				if(!empty($value["tiempo_compensatorio_situacion"])){
					$horas_ausencia_situacion_old.=$value["tiempo_compensatorio_situacion"];
				}

				$empleado_cubrir.=$value["cubrir_situacion"];
			}

			$codigo_empleado_old = explode("-", $empleado_cubrir);
			$codigo_empleadoc_old=$codigo_empleado_old[0];

			$eliminar_haus="DELETE FROM `situacion` WHERE horas_ausencia_situacion='$horas_ausencia_situacion_old' and fecha_situacion='$fecha_anterior' and idempleado_situacion='$codigo_empleadoc_old'";
			echo $eliminar_haus;
			$sql_haus = Conexion::conectar()->prepare($eliminar_haus);
			$sql_haus->execute();


			if(!empty($hora_extra_situacion)){
				$valor_hora_ausensia=$hora_extra_situacion;
			}
			if(!empty($hora_normales_situacion)){
				$valor_hora_ausensia=$hora_extra_situacion;
			}
			if(!empty($tiempo_compensatorio_situacion)){
				$valor_hora_ausensia=$hora_extra_situacion;
			}
			$insertar_haus="INSERT INTO `situacion`(`horas_ausencia_situacion`, `fecha_situacion`, `idempleado_situacion`) VALUES  ('$valor_hora_ausensia','$fecha_situacion','$codigo_empleadoc')";
			$sql_haus = Conexion::conectar()->prepare($insertar_haus);
			$sql_haus->execute();
		}
		/* ****************************** */
		$data = getContent();
		$test = "";
		foreach ($data as $row) {
			$namecolumnas_situacion .= $row['Field'] . "=" . ":" . $row['Field'] . ",";
			$test .= $row['Field'] . "='" . $_POST["" . $row['Field'] . ""] . "',";
		}

		$query01 = "UPDATE situacion SET " . trim($test, ",") . " WHERE id LIKE $id";
		
		$sql = Conexion::conectar()->prepare($query01);
		$sql->execute();


		return $sql->fetchAll();
		$sql->close();
		$sql = null;





		/* ***************** */


		break;
	case "eliminar":


			function consultar_situacion($id1)
			{
				$query01="SELECT * FROM situacion WHERE id='$id1'";				
				$sql = Conexion::conectar()->prepare($query01);
				$sql->execute();
				return $sql->fetchAll();
			};
			$data_planilla = consultar_situacion($id);
			$fecha_anterior="";
			$horas_ausencia_situacion_old="";
			$empleado_cubrir="";
			foreach ($data_planilla as $value) {
				$fecha_anterior.=$value["fecha_situacion"];

				if(!empty($value["hora_extra_situacion"])){
					$horas_ausencia_situacion_old.=$value["hora_extra_situacion"];
				}
				if(!empty($value["hora_normales_situacion"])){
					$horas_ausencia_situacion_old.=$value["hora_normales_situacion"];
				}
				if(!empty($value["tiempo_compensatorio_situacion"])){
					$horas_ausencia_situacion_old.=$value["tiempo_compensatorio_situacion"];
				}
				$empleado_cubrir.=$value["cubrir_situacion"];
			}

			$codigo_empleado_old = explode("-", $empleado_cubrir);
			$codigo_empleadoc_old=$codigo_empleado_old[0];

			$eliminar_haus="DELETE FROM `situacion` WHERE horas_ausencia_situacion='$horas_ausencia_situacion_old' and fecha_situacion='$fecha_anterior' and idempleado_situacion='$codigo_empleadoc_old'";
			echo $eliminar_haus;
			$sql_haus = Conexion::conectar()->prepare($eliminar_haus);
			$sql_haus->execute();


		
		/* ****************************** */
		/* ********************* */
		$query = "DELETE FROM `situacion` WHERE id=$id";
		$stmt = Conexion::conectar()->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
		$stmt = null;
		/* ********************* */
		break;
	case "obtenerdata":
		/* ************ */
		function consultar_situacion2($e)
		{
			$query01 = "SELECT * FROM `situacion`  WHERE id='$e'";
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};
		$data01 = consultar_situacion2($id);
		$datos = "";
		$nombre_empleado="";
		foreach ($data01 as $value) {
			$nombre_empleado.=$value["idempleado_situacion"];
			$datos .= $value["id"] . ',' . $value["idempleado_situacion"] . ',' . $value["dias_ausencia_situacion"] . ',' . $value["horas_ausencia_situacion"] . ',' . $value["consulta_isss_situacion"] . ',' . $value["incapacidad_situacion"] . ',' . $value["ansp_situacion"] . ',' . $value["vacaciones_situacion"] . ',' . $value["permiso_situacion"] . ',' . $value["hora_normales_situacion"] . ',' . $value["tiempo_compensatorio_situacion"] . ',' . $value["recuperar_tiempo_situacion"] . ',' . $value["comodin_situacion"] . ',' . $value["cubierto_situacion"] . ',' . $value["nuevo_servicio_situacion"] . ',' . $value["fin_servicio_situacion"] . ',' . $value["ubicacion_situacion"] . ',' . $value["servicio_eventual_situacion"] . ',' . $value["inactivos_situacion"] . ',' . $value["activo_situacion"] . ',' . $value["liquidado_situacion"] . ',' . $value["inicial_situacion"] . ',' . $value["hora_extra_situacion"] . ',' . $value["vacante_situacion"] . ',' . $value["posicion_situacion"] . ',' . $value["fecha_situacion"] . ',' . $value["motivo_horas_extras"] . ',' . $value["horas_no_cubiertas"]. ',' . $value["cubrir_situacion"]. ',' . $value["solicitado_situacion"]. ',' . $value["idcliente_situacion"].  ',' .$value["codigocliente_situacion"].  ',' .$value["nombrecliente_situacion"].  ',' .$value["hora_inicio_situacion"].  ',' .$value["hora_fin_situacion"].  ',' .$value["numero_planilla_admin"].  ',' .$value["dias_tra_incapacidad"].  ',' .$value["dias_no_sueldo"];
		}

		function consultar_ubicacion($x)
		{
			$query01 = "SELECT `id`, `idagente_transacciones_agente`, `fecha_transacciones_agente`, `hora_transacciones_agente`, `tipo_movimiento_transacciones_agente`, `nueva_ubicacion_transacciones_agente`, `ubicacion_anterior_transacciones_agente`, `fecha_desde_transacciones_agente`, `fecha_hasta_transacciones_agente`, `presento_incapacidad_transacciones_agente`, `comentarios_transacciones_agente`, `turno_transacciones_agente`, `horario_desde_transacciones_agente`, `horario_hasta_transacciones_agente` FROM `transacciones_agente` WHERE  idagente_transacciones_agente='$x'";
			$sql = Conexion::conectar()->prepare($query01);
			$sql->execute();
			return $sql->fetchAll();
		};
		$data02 = consultar_ubicacion($nombre_empleado);
		$obtener_ubicacion="";
		foreach ($data02 as $value) {
			$obtener_ubicacion.=$value["nueva_ubicacion_transacciones_agente"];
		}


		echo $datos.",".$obtener_ubicacion;
		/* ************ */
		break;
	default:
		echo $accion;
}








?>