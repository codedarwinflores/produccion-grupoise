<?php

require_once "../controladores/empleados.controlador.php";
require_once "../modelos/empleados.modelo.php";

class AjaxEmpleados
{

	/*=============================================
	EDITAR EMPLEADO
	=============================================*/

	public $idEmpleado;

	public function ajaxEditarEmpleado()
	{

		$item = "id";
		$valor = $this->idEmpleado;

		$respuesta = ControladorEmpleados::ctrMostrarEmpleados($item, $valor);

		echo json_encode($respuesta);
	}



	/*=============================================
	VALIDAR NO REPETIR EMPLEADO
	=============================================*/

	public $validarEmpleado;

	public function ajaxValidarEmpleado()
	{

		$item = "numero_documento_identidad";
		$valor = $this->validarEmpleado;

		$respuesta = ControladorEmpleados::ctrMostrarEmpleados($item, $valor);

		echo json_encode($respuesta);
	}
}

/*=============================================
EDITAR EMPLEADO
=============================================*/
if (isset($_POST["idEmpleado"])) {

	$editar = new AjaxEmpleados();
	$editar->idEmpleado = $_POST["idEmpleado"];
	$editar->ajaxEditarEmpleado();
}



/*=============================================
VALIDAR NO REPETIR EMPLEADO
=============================================*/

if (isset($_POST["validarEmpleado"])) {

	$valEmpleado = new AjaxEmpleados();
	$valEmpleado->validarEmpleado = $_POST["validarEmpleado"];
	$valEmpleado->ajaxValidarEmpleado();
}




/* EMPLEADOS AJAX VIEW */
if (isset($_GET['consult'])) {


	//INCLUIR CONEXION
	include_once "../modelos/conexion.php";
	$fechasFiltrar = "";

	/* FECHAS */
	if (isset($_POST['fechadesde']) || isset($_POST['fechahasta'])) {
		$fechadesde = $_POST['fechadesde'];
		$fechahasta = $_POST['fechahasta'];

		if (!empty($fechadesde) && !empty($fechahasta)) {
			$fechasFiltrar = " BETWEEN '" . $fechadesde . "' AND '" . $fechahasta . "'";
		}
	}

	$rrhh = "";
	if (isset($_POST['rrhh'])) {
		if (!empty($_POST['rrhh'])) {
			$rrhh = $_POST['rrhh'];
		}
	}
	/* STR_TO_DATE(CAMPO_DE_FECHA, '%d-%m-%Y') */
	if (isset($_POST['tipoagente'])) {
		if ($_POST['tipoagente'] == 2) {
			$estado_emp = "tbemp.estado IN (2)";
			if (!empty($fechadesde) && !empty($fechahasta)) {
				$fechasFiltrar = "and STR_TO_DATE(tbemp.fecha_contratacion, '%Y-%m-%d')" . $fechasFiltrar;
			}
		} else if ($_POST['tipoagente'] == 3) {
			$estado_emp = "tbemp.estado IN (3)";
			if (!empty($fechadesde) && !empty($fechahasta)) {
				$fechasFiltrar = "and STR_TO_DATE(ret.fecha_retiro, '%Y-%m-%d')" . $fechasFiltrar;
			}
		} else {
			if (!empty($fechadesde) && !empty($fechahasta)) {
				$fechasFiltrar = "and STR_TO_DATE(tbemp.fecha_contratacion, '%Y-%m-%d')" . $fechasFiltrar . " or STR_TO_DATE(ret.fecha_retiro, '%Y-%m-%d')" . $fechasFiltrar;
			}
			$estado_emp = "tbemp.estado IN (2,3)";
		}

		$_estado = $_POST['tipoagente'];
	}
	if (isset($_POST['reportado_a_pnc'])) {
		$reporte = $_POST['reportado_a_pnc'];
		if ($reporte == "Si" || $reporte == "No" && !empty($reporte)) {
			$repotePnc = "tbemp.reportado_a_pnc='" . $reporte . "'";
		} else {
			$repotePnc = "tbemp.reportado_a_pnc IN('SI','NO','')";
		}
	}

	/* 	echo $fechasFiltrar; */
	function empleadosplanilla($codigo)
	{
		$query01 = "SELECT tbemp.primer_nombre,tbemp.codigo_empleado,tbemp.primer_apellido,transacc.idagente_transacciones_agente,transacc.fecha_transacciones_agente,transacc.nueva_ubicacion_transacciones_agente FROM `tbl_empleados` tbemp INNER JOIN `transacciones_agente` transacc ON tbemp.codigo_empleado=transacc.idagente_transacciones_agente WHERE tbemp.codigo_empleado=$codigo and transacc.fecha_transacciones_agente=( SELECT MAX(fecha_transacciones_agente) FROM transacciones_agente WHERE idagente_transacciones_agente=tbemp.codigo_empleado)";
		$sql = Conexion::conectar()->prepare($query01);
		$sql->execute();
		$outp = $sql->fetchAll();
	};
	/* FUNCION PARA UBICAR LA UBICACIÓN DEL EMPLEADO */
	function ubicacion_empleado($codigo)
	{
		if (!empty($codigo)) {
			$query = "SELECT tbemp.primer_nombre,tbemp.codigo_empleado,tbemp.primer_apellido,transacc.idagente_transacciones_agente,transacc.fecha_transacciones_agente,transacc.nueva_ubicacion_transacciones_agente FROM `tbl_empleados` tbemp INNER JOIN `transacciones_agente` transacc ON tbemp.codigo_empleado=transacc.idagente_transacciones_agente WHERE tbemp.codigo_empleado=$codigo and transacc.fecha_transacciones_agente=( SELECT MAX(fecha_transacciones_agente) FROM transacciones_agente WHERE idagente_transacciones_agente=tbemp.codigo_empleado)";
			$sql = Conexion::conectar()->prepare($query);
			$sql->execute();
			$data = $sql->fetch(PDO::FETCH_ASSOC);



			/* $data = empleadosplanilla($codigo); */
			if ($data) {
				$fecha = $data['fecha_transacciones_agente'];
				$ubicacion = $data['nueva_ubicacion_transacciones_agente'];
				$response = array('fechat' => $fecha, 'ubicaciont' => $ubicacion);
				return $response;
			}
		}
		return
			$response = array('fechat' => "- - -", 'ubicaciont' => "- - -");
	};


	/* SACAR EL BONO DE ACUERDO A LA UBICACIÓN DEL EMPLEADO */
	function bonoEmpleado($codUbicacion)
	{
		$bono = 0.00;
		if ($codUbicacion != "" && !empty($codUbicacion)) {
			$bono = 0.0;
			$separada = explode("-", $codUbicacion);
			$codigo_u = $separada[0];
			/* SELECT tbl_clientes_ubicaciones.id AS idubicacionc, `id_cliente`, `codigo_cliente`, clientes.id AS idcliente, clientes.nombre AS nombrecliente, bono_unidad, codigo_ubicacion, estado_cliente_ubicacion FROM `tbl_clientes_ubicaciones`, clientes WHERE clientes.id = tbl_clientes_ubicaciones.id_cliente and codigo_ubicacion='A0002003' */


			$query = "SELECT tbl_clientes_ubicaciones.id AS idubicacionc, `id_cliente`, `codigo_cliente`, clientes.id AS idcliente, clientes.nombre AS nombrecliente,bono_unidad,codigo_ubicacion,estado_cliente_ubicacion FROM `tbl_clientes_ubicaciones`,clientes WHERE clientes.id = tbl_clientes_ubicaciones.id_cliente and codigo_ubicacion='" . $codigo_u . "'";
			$sql = Conexion::conectar()->prepare($query);
			$sql->execute();
			$data = $sql->fetch(PDO::FETCH_ASSOC);
			if ($data) {
				$bono_unidad = $data['bono_unidad'];
				return "$ " . number_format($bono_unidad, 2);
			}
		}


		return "$ " . number_format($bono, 2);
	}


	/* CONSULTAR UNIFORE */
	function ConsultarUniforme($idEmpleado)
	{

		if (!empty($idEmpleado) && $idEmpleado != null) {

			/* UNIFORME DESCUENTO */
			$query = "SELECT COUNT(codigo_empleado_descuento) as cant_empleados FROM `uniformedescuento` WHERE codigo_empleado_descuento=" . $idEmpleado;
			$sql = Conexion::conectar()->prepare($query);
			$sql->execute();
			$unidescuento = $sql->fetch(PDO::FETCH_ASSOC);

			/* UNIFORME REGALO */
			$queryy = "SELECT COUNT(idempleado) as cant_empleado FROM `regalo` WHERE idempleado=" . $idEmpleado;
			$sqll = Conexion::conectar()->prepare($queryy);
			$sqll->execute();
			$uniregalo = $sqll->fetch(PDO::FETCH_ASSOC);

			if ($unidescuento || $uniregalo) {
				if ($unidescuento['cant_empleados'] > 0 || $uniregalo['cant_empleado'] > 0) {
					return "SI";
				}
			}
		}

		return "NO";
	}

	/* CAMPO TRANS.p */
	function transpDevengo($idEmpleado)
	{

		if (!empty($idEmpleado) && $idEmpleado != null) {

			$query = "SELECT * FROM `tbl_empleados_devengos_descuentos` WHERE id_empleado=" . $idEmpleado . " and tipodescuento=2;";
			$sql = Conexion::conectar()->prepare($query);
			$sql->execute();
			$datos = $sql->fetch(PDO::FETCH_ASSOC);

			if ($datos) {
				$tipoDescuento = $datos['tipodescuento'];
				$valor = $datos['valor'];

				return ("Tipo: " . $tipoDescuento);
			}
		}

		return "- - -";
	}

	/* CALCULAR EDAD DEL EMPLEADO */
	function edad($fecha)
	{
		if (!empty($fecha)) {
			$nacimiento = new DateTime($fecha);
			$ahora = new DateTime(date("Y-m-d"));
			$diferencia = $ahora->diff($nacimiento);
			$edad = $diferencia->format("%y");
			return $edad;
		}

		return 0;
	}

	/* CALCULAR EDAD DEL EMPLEADO */
	function diasContratado($fechaContrato, $fechaRetiro)
	{
		if (!empty($fechaContrato) && !empty($fechaRetiro)) {
			$fecha1 = new DateTime($fechaContrato); // Fecha inicial
			$fecha2 = new DateTime($fechaRetiro); // Fecha final

			$intervalo = $fecha1->diff($fecha2);
			$dias = $intervalo->days;
			return $dias;
		}

		return 0;
	}


	/* FUNCIÓN PARA IMPRIMIR LOS DEPARTAMENTOS DE LA EMPRESA */
	function departamentos($depa1, $depa2)
	{
		if (is_numeric($depa1) && $depa2 == "uno") {
			$stm = "SELECT tblemp.primer_nombre,d_emp.codigo,d_emp.nombre FROM tbl_empleados tblemp LEFT JOIN departamentos_empresa d_emp ON tblemp.id_departamento_empresa=d_emp.id WHERE tblemp.id=" . $depa1;
		} else if (is_numeric($depa1) && is_numeric($depa2)) {
			$stm = "SELECT * FROM `departamentos_empresa` where id between " . $depa1 . " and " . $depa2;
		} else {
			$stm = "SELECT d_emp.id,d_emp.codigo, d_emp.nombre, COUNT(tblemp.id) AS cantidad_empleados FROM departamentos_empresa d_emp INNER JOIN tbl_empleados tblemp ON d_emp.id=tblemp.id_departamento_empresa GROUP BY d_emp.codigo, d_emp.nombre HAVING COUNT(tblemp.id) > 0 ";
		}

		$sqlquery = Conexion::conectar()->prepare($stm);
		$sqlquery->execute();

		if (is_numeric($depa1) && $depa2 == "uno") {
			return $sqlquery->fetch(PDO::FETCH_ASSOC);
		} else {

			return $sqlquery->fetchAll();
		}
	}
	/* FORMATEAR FECHA */
	function formatearFecha($fecha)
	{
		$timestamp = strtotime($fecha);
		return date('d/m/Y', $timestamp);
	}

	/* IMPRIMI TABLA DE ACUERDO A LA CONSULTA ENVIADA */

	function crearTablaEmpleados($cont, $campos, $tabla, $condicion, $array, $estado, $rrhh)
	{
?>
		<!-- <script>
			$(document).ready(function() {
				$(".exampless<?php echo $cont ?>").DataTable({
					serverSide: true,
				});
			});
		</script> -->

		<div class="contenedor-tabla">
			<table class="table table-bordered table-striped dt-responsive exampless<?php echo $cont ?> display responsive nowrap tablaedit" width="100%">

				<thead class="bg-info">
					<tr>
						<th>No.</th>
						<th>NOMBRES</th>
						<th>SUELDO</th>
						<th>TRANSP.</th>
						<th>U. ESP.</th>
						<th>F. INGRESO.</th>
						<th>F. CONTRATO.</th>
						<th>F. RETIRO.</th>
						<th>UBICACIÓN.</th>
						<th>F. UBICACIÓN</th>
						<th>DUI</th>
						<?php
						if ($rrhh != "rrhh") {
							if ($estado === "3" || $estado == "todos" || $estado == "") {
								echo "<th>DÍAS</th>";
							}
						?>

							<th>NUP</th>
							<th>AFP</th>
							<?php
							if ($estado === "3" || $estado == "todos" || $estado == "") {
								echo "	<th>M. RETIRO</th>";
							}
							?>

							<th>TIPO EMPLEADO.</th>
							<th>EDAD</th>
							<th>NACIMIENTO</th>
							<th>ISSS</th>
							<th>NIT</th>
							<th>BANCO</th>
							<th>CUENTA</th>
							<th>MOTIVO</th>
							<th>CON UNIFORME</th>
						<?php
						} else {
							echo '<th>Estado Actual</th>';
						}
						?>

					</tr>

				</thead>

				<tbody>

					<?php



					$empleadoBuscar = new ModeloEmpleados();
					$empleados = $empleadoBuscar->mostrarEmpleadoDb($campos, $tabla, $condicion, $array);
					$contEmp = 0;
					$badge = "dark";
					foreach ($empleados as $key => $value) {
						$contEmp++;
						//REPRESENTANDO EL ESTADO DEBERIA SER DESDE XML
						if ($value["estado"] == 1) {
							$nombreEstado = "Solicitud";
							$badge = "dark";
						} else if ($value["estado"] == 2) {
							$nombreEstado = "Contratado";
							$badge = "success";
						} else if ($value["estado"] == 3) {
							$nombreEstado = "Inactivo";
							$badge = "danger";
						} else if ($value["estado"] == 4) {
							$nombreEstado = "Incapacitado";
							$badge = "warning";
						} else {
							$nombreEstado = "Error";
							$badge = "defaul";
						}

						$ubicacionEmpleado01 = ubicacion_empleado($value["codigo_empleado"]);
						/* 				$fecha = $data['fecha_transacciones_agente'];
				$ubicacion = $data['nueva_ubicacion_transacciones_agente']; */

						$ubicacionEmpleado = empleadosplanilla($value["codigo_empleado"]);


					?>
						<tr>
							<th><?php echo $value["codigo_empleado"] ?></th>
							<td><?php echo $value["primer_nombre"] . ' ' . $value["segundo_nombre"] . ' ' . $value["tercer_nombre"] . ' ' . $value["primer_apellido"] . ' ' . $value["segundo_apellido"] . ' ' . $value["apellido_casada"] ?></td>
							<td><?php echo "$ " . $value["sueldo_que_devenga"] ?></td>
							<td><?php echo transpDevengo($value["id"]); ?></td>
							<td><?php echo bonoEmpleado($ubicacionEmpleado['fecha_transacciones_agente']); ?></td>
							<td><?php echo formatearFecha($value["fecha_ingreso"]) ?></td>
							<td><?php echo formatearFecha($value["fecha_contratacion"]) ?></td>
							<td><?php echo !empty($value['fecha_retiro']) ? formatearFecha($value['fecha_retiro']) : "- - -" ?></td>
							<td><?php echo $ubicacionEmpleado['nueva_ubicacion_transacciones_agente']; ?></td>
							<td><?php echo formatearFecha(formatearFecha($value["fecha_ingreso"])); ?></td>
							<td><?php echo $value["numero_documento_identidad"] ?></td>
							<?php

							if ($rrhh != "rrhh") {
								# code...

								if ($estado === "3" || $estado == "todos" || $estado == "") {

							?>
									<td><?php echo diasContratado($value['fecha_contratacion'], $value['fecha_retiro']) ?></td>

								<?php
								}
								?>
								<td><?php echo $value["nup"] ?></td>
								<td><?php echo $value["codigo_afp"] ?></td>
								<?php
								if ($estado === "3" || $estado == "todos" || $estado == "") {

								?>
									<td><?php echo !empty($value['motivo_inactivo']) ? $value['motivo_inactivo'] : "- - -" ?></td>
								<?php
								}
								?>
								<td><?php echo $value["descripcion"] ?></td>
								<td><?php echo edad($value["fecha_nacimiento"]) ?></td>
								<td><?php echo formatearFecha($value["fecha_nacimiento"]) ?></td>
								<td><?php echo $value["numero_isss"] ?></td>
								<td><?php echo $value["nit"] ?></td>
								<td><?php echo $value["codigo_bank"] . "-" . $value["nombre_bank"] ?></td>
								<td><?php echo $value["numero_cuenta"] ?></td>

								<td><?php echo !empty($value['observaciones_retiro']) ? $value['observaciones_retiro'] : "- - -" ?></td>
								<td><?php echo ConsultarUniforme($value["id"]) ?></td>
							<?php
							} else {
								echo '<td><label class="badge btn-' . $badge . '">' . $nombreEstado . '</label></td>';
							}
							?>

						</tr>

					<?php




						/* ******* */
					}

					?>

				</tbody>
				<tfoot>
					<tr>
						<td colspan="3">
							<h5><strong>Cantidad de Empleados:</strong></h5>
						</td>
						<td><button class="btn btn-primary" type="button">
								<span class="badge"><?php echo $contEmp ?></span>
							</button></td>
						<td colspan="19"></td>
					</tr>
				</tfoot>

			</table>
		</div>


	<?php
	}
	?>

	<style>
		.contenedor-tabla {
			width: 100%;
			max-height: 450px;
			overflow: auto;
			display: inline-block;

			/* border: black 3px groove; */
		}

		.tablaedit thead {
			position: sticky;
			top: 0;
		}
	</style>


	<?php

	/* FILTRAR POR DEPARTAMENTOS */
	$departamento1 = "";
	$departamento2 = "";
	if (isset($_POST["empleados"]) && is_numeric($_POST["empleados"]) && !empty($_POST["empleados"])) {
		/* FILTRAR SOLO POR EL EMPLEADO */
		$cont = 0;
		$departamento = departamentos($_POST['empleados'], "uno");
		echo "<div class='well'><h4><strong>Departamento: <span class='text-primary'>" . strval($departamento['codigo']) . " - " . $departamento['nombre'] . "</span></strong></h4></div>";
		$campos = "tbemp.*,cargo.id as cargoid,cargo.descripcion,bank.codigo as codigo_bank,bank.nombre as nombre_bank,d_emp.id as d_empid,d_emp.nombre as nombre_empresa,ret.fecha_retiro,ret.motivo_inactivo,ret.observaciones_retiro";


		$tabla = "`tbl_empleados` tbemp LEFT JOIN `departamentos_empresa` d_emp ON tbemp.id_departamento_empresa=d_emp.id LEFT JOIN `cargos_desempenados` cargo ON tbemp.nivel_cargo=cargo.id LEFT JOIN `bancos` bank ON tbemp.id_banco=bank.id LEFT JOIN retiro ret ON tbemp.id=ret.idempleado_retiro";

		$condicion = " tbemp.id=" . $_POST['empleados'] . " order by primer_nombre asc, primer_apellido asc";
		$array = [];
		$cont++;
		crearTablaEmpleados(
			$cont,
			$campos,
			$tabla,
			$condicion,
			$array,
			$_estado,
			$rrhh
		);
	} else	if (
		isset($_POST["departamento1"]) && isset($_POST["departamento2"]) && !empty($_POST["departamento1"]) && !empty($_POST["departamento2"] && $_POST["departamento1"] != "*" && $_POST["departamento2"] != "*")
	) {
		$depa1 = intval($_POST["departamento1"]);
		$depa2 = intval($_POST["departamento2"]);

		$departamentos = departamentos($depa1, $depa2);

		$cont = 0;


		foreach ($departamentos as $depa) {
			echo "<div class='well encabezadowell'><h4><strong>Departamento: <span class='text-primary'>" . $depa['codigo'] . " - " . $depa['nombre'] . "</span></strong></h4></div>";
			/* select tbemp.*, cargo.id,cargo.descripcion FROM `tbl_empleados` tbemp inner join cargos_desempenados cargo on tbemp.nivel_cargo=cargo.id; */
			$campos = "tbemp.*,cargo.id as cargoid,cargo.descripcion,bank.codigo as codigo_bank, bank.nombre as nombre_bank, d_emp.id as d_empid,d_emp.nombre as nombre_empresa,ret.fecha_retiro,ret.motivo_inactivo,ret.observaciones_retiro";


			$tabla = "`tbl_empleados` tbemp LEFT JOIN `departamentos_empresa` d_emp ON tbemp.id_departamento_empresa=d_emp.id LEFT JOIN `cargos_desempenados` cargo ON tbemp.nivel_cargo=cargo.id LEFT JOIN `bancos` bank ON tbemp.id_banco=bank.id LEFT JOIN retiro ret ON tbemp.id=ret.idempleado_retiro";

			$condicion = "tbemp.id_departamento_empresa=" . $depa['id'] . " and " . $estado_emp . "and " . $repotePnc . $fechasFiltrar . " order by primer_nombre asc,primer_apellido asc";
			$array = [];

			crearTablaEmpleados($cont, $campos, $tabla, $condicion, $array, $_estado, $rrhh);
			$cont++;
		}
	} else if ($_POST["departamento1"] === "*" || $_POST["departamento2"] === "*") {

		$depa1 = $_POST["departamento1"];
		$depa2 = $_POST["departamento2"];
		if ($depa1 === "*" && $depa2 === "*") {

			$departamentos = departamentos("todos", "todos");

			$cont = 0;

			foreach ($departamentos as $depa) {
				echo "<div class='well encabezadowell'><h4><strong>Departamento: <span class='text-primary'>" . $depa['codigo'] . " - " . $depa['nombre'] . "</span></strong></h4></div>";
				/* FILTRAR TODOS */
				$campos = "tbemp.*,cargo.id as cargoid,cargo.descripcion,bank.codigo as codigo_bank,bank.nombre as nombre_bank,d_emp.id as d_empid,d_emp.nombre as nombre_empresa,ret.fecha_retiro,ret.motivo_inactivo,ret.observaciones_retiro ";

				$tabla = "`tbl_empleados` tbemp LEFT JOIN `departamentos_empresa` d_emp ON tbemp.id_departamento_empresa=d_emp.id LEFT JOIN `cargos_desempenados` cargo ON tbemp.nivel_cargo=cargo.id LEFT JOIN `bancos` bank ON tbemp.id_banco=bank.id LEFT JOIN retiro ret ON tbemp.id=ret.idempleado_retiro";

				$condicion = "tbemp.id_departamento_empresa=" . $depa['id'] . " and " . $estado_emp . "and " . $repotePnc . $fechasFiltrar . " order by primer_nombre asc, primer_apellido asc";
				$array = [];
				$cont++;
				crearTablaEmpleados(
					$cont,
					$campos,
					$tabla,
					$condicion,
					$array,
					$_estado,
					$rrhh
				);
			}
		} else {

			/* CONDICIÓN SOLO POR UN DEPARTAMENTO */
			if ($depa1 != "*" && $depa2 === "*") {
				$depa2 = $depa1;
			} else if ($depa1 === "*" && $depa2 != "*") {
				$depa1 = $depa2;
			}

			$departamentos = departamentos($depa1, $depa2);
			$cont = 0;
			foreach ($departamentos as $depa) {
				echo "<div class='contenedor-tabla'><div class='well encabezadowell'><h4><strong>Departamento: <span class='text-primary'>" . $depa['codigo'] . " - " . $depa['nombre'] . "</span></strong></h4></div>";
				/* select tbemp.*, cargo.id,cargo.descripcion FROM `tbl_empleados` tbemp inner join cargos_desempenados cargo on tbemp.nivel_cargo=cargo.id; */
				$campos = "tbemp.*,cargo.id as cargoid,cargo.descripcion,bank.codigo as codigo_bank, bank.nombre as nombre_bank,d_emp.id as d_empid,d_emp.nombre as nombre_empresa, ret.fecha_retiro, ret.motivo_inactivo, ret.observaciones_retiro";
				$tabla = "`tbl_empleados` tbemp LEFT JOIN `departamentos_empresa` d_emp ON tbemp.id_departamento_empresa=d_emp.id LEFT JOIN `cargos_desempenados` cargo ON tbemp.nivel_cargo=cargo.id LEFT JOIN `bancos` bank ON tbemp.id_banco=bank.id LEFT JOIN retiro ret ON tbemp.id=ret.idempleado_retiro";
				$condicion = " tbemp.id_departamento_empresa=" . $depa['id'] . " and " . $estado_emp . "and " . $repotePnc . $fechasFiltrar . " order by primer_nombre asc,primer_apellido asc";
				$array = [];



				$cont++;
				crearTablaEmpleados($cont, $campos, $tabla, $condicion, $array, $_estado, $rrhh);
			}
		}
	}


	?>

<?php


}
