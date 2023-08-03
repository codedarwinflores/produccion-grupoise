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


/* EMPLEADOS AJAX VIEW API */

if (isset($_GET['consult'])) {


	//INCLUIR CONEXION
	include_once "../modelos/conexion.php";
	if (isset($_POST['tipoagente'])) {
		if ($_POST['tipoagente'] == 2) {
			$estado_emp = "tbemp.estado IN (2)";
		} else if ($_POST['tipoagente'] == 3) {
			$estado_emp = "tbemp.estado IN (3)";
		} else {
			$estado_emp = "tbemp.estado IN (2,3)";
		}
	}
	if (isset($_POST['reportado_a_pnc'])) {
		$reporte = $_POST['reportado_a_pnc'];
		if ($reporte == "Si" || $reporte == "No" && !empty($reporte)) {
			$repotePnc = "and reportado_a_pnc='" . $reporte . "'";
		} else {
			$repotePnc = "";
		}
	}

	/* FUNCION PARA UBICAR LA UBICACIÓN DEL EMPLEADO */
	function ubicacion_empleado($codigo)
	{

		if (!empty($codigo)) {

			$query = "SELECT tbemp.primer_nombre, tbemp.codigo_empleado, tbemp.primer_apellido, transacc.idagente_transacciones_agente, transacc.fecha_transacciones_agente, transacc.nueva_ubicacion_transacciones_agente FROM `tbl_empleados` tbemp INNER JOIN `transacciones_agente` transacc ON tbemp.codigo_empleado = transacc.idagente_transacciones_agente WHERE tbemp.codigo_empleado = " . $codigo . " and transacc.fecha_transacciones_agente = ( SELECT MAX(fecha_transacciones_agente) FROM transacciones_agente WHERE idagente_transacciones_agente = tbemp.codigo_empleado );";
			$sql = Conexion::conectar()->prepare($query);
			$sql->execute();
			$data = $sql->fetch(PDO::FETCH_ASSOC);

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


			$query = "SELECT tbl_clientes_ubicaciones.id AS idubicacionc, `id_cliente`, `codigo_cliente`, clientes.id AS idcliente, clientes.nombre AS nombrecliente, bono_unidad, codigo_ubicacion, estado_cliente_ubicacion FROM `tbl_clientes_ubicaciones`, clientes WHERE clientes.id = tbl_clientes_ubicaciones.id_cliente and codigo_ubicacion='" . $codigo_u . "'";
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


	function fechaRetiroEmpleado($idEmpleado)
	{

		if (!empty($idEmpleado) && $idEmpleado != null) {

			$query = "SELECT max(fecha_retiro) as fecha_retiro,motivo_inactivo FROM `retiro` where idempleado_retiro=" . intval($idEmpleado);
			$sql = Conexion::conectar()->prepare($query);
			$sql->execute();
			$datos = $sql->fetch(PDO::FETCH_ASSOC);

			$fecha = $datos['fecha_retiro'];
			$motivo = $datos['motivo_inactivo'];
			if ($fecha != null || !empty($fecha)) {

				$response = array("fecha_retiro" => $fecha, "motivo_inactivo" => $motivo);
				return $response;
			}
		}

		$response = array("fecha_retiro" => "- - -", "motivo_inactivo" => "- - -");

		return $response;
	}


	function ConsultarUniforme($idEmpleado)
	{

		if (!empty($idEmpleado) && $idEmpleado != null) {

			/* UNIFORME DESCUENTO */
			$query = "SELECT COUNT(codigo_empleado_descuento) as cant_empleados FROM `uniformedescuento` WHERE codigo_empleado_descuento=" . $idEmpleado;
			$sql = Conexion::conectar()->prepare($query);
			$sql->execute();
			$unidescuento = $sql->fetch(PDO::FETCH_ASSOC);

			/* UNIFORME REGALO */
			$queryy = "SELECT COUNT(idempleado) as cant_empleado FROM `regalo` WHERE idempleado =" . $idEmpleado;
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

			$query = "SELECT * FROM `tbl_empleados_devengos_descuentos` WHERE id_empleado = " . $idEmpleado . " and tipodescuento=2;";
			$sql = Conexion::conectar()->prepare($query);
			$sql->execute();
			$datos = $sql->fetch(PDO::FETCH_ASSOC);

			if ($datos) {
				$tipoDescuento = $datos['tipodescuento'];
				$valor = $datos['valor'];

				return ("Tipo: " . $tipoDescuento . " $ " . $valor);
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


	/* FUNCIÓN PARA IMPRIMIR LOS DEPARTAMENTOS DE LA EMPRESA */
	function departamentos($depa1, $depa2)
	{
		$stm = "SELECT * FROM `departamentos_empresa` where id between " . $depa1 . " and " . $depa2;
		$sqlquery = Conexion::conectar()->prepare($stm);
		$sqlquery->execute();
		return $sqlquery->fetchAll();
	}




	/* IMPRIMI TABLA DE ACUERDO A LA CONSULTA ENVIADA */

	function crearTablaEmpleados($cont, $campos, $tabla, $condicion, $array)
	{
?>
		<script>
			$(document).ready(function() {
				$('.examples<?php echo $cont ?>').DataTable({

					"order": [
						[2, "asc"]
					],
					"lengthMenu": [
						[5, 10, 25, 50, 100, -1],
						[5, 10, 25, 50, 100, "All"]
					],
				});
			});
		</script>
		<table class="table table-bordered table-striped dt-responsive examples<?php echo $cont ?>" width="100%">

			<thead class="bg-info">
				<tr>
					<th>No.</th>
					<th>Estado</th>
					<th>UNIFORME / REPORTE ARMA</th>
					<th>NOMBRE</th>
					<th>SUELDO</th>
					<th width="200">TRANSP.</th>
					<th>U. ESP.</th>
					<th width="150">F.INGRESO</th>
					<th width="150">F.CONT.</th>
					<th width="150">F.RETIRO</th>
					<th width="200">UBICACION</th>
					<th>F. UBICACION</th>
					<th>D.U.I.</th>
					<th>NUP</th>
					<th>AFP</th>
					<th>TIPO DE EMPLEADO</th>
					<th>EDAD</th>
					<th>NACIMIENTO</th>
					<th>ISSS</th>
					<th>NIT</th>
					<th>BANCO</th>
					<th>CUENTA</th>
					<th>MOTIVO</th>

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

					$ubicacionEmpleado = ubicacion_empleado($value["codigo_empleado"]);
					$retiro_datos = fechaRetiroEmpleado($value["id"]);

				?>
					<tr>
						<th><?php echo $value["codigo_empleado"] ?></th>
						<td><label class="badge btn-<?php echo $badge ?>"><?php echo $nombreEstado ?></label></td>
						<td><?php echo ConsultarUniforme($value["id"]) . "/" . $value['reportado_a_pnc'] ?></td>
						<td><?php echo $value["primer_nombre"] . ' ' . $value["segundo_nombre"] . ' ' . $value["tercer_nombre"] . ' ' . $value["primer_apellido"] . ' ' . $value["segundo_apellido"] . ' ' . $value["apellido_casada"] ?></td>
						<td><?php echo "$ " . $value["sueldo_que_devenga"] ?></td>
						<td><?php echo transpDevengo($value["id"]); ?></td>
						<td><?php echo bonoEmpleado($ubicacionEmpleado['ubicaciont']); ?></td>
						<td><?php echo $value["fecha_ingreso"] ?></td>
						<td><?php echo $value["fecha_contratacion"] ?></td>
						<td><?php echo $retiro_datos['fecha_retiro'] ?></td>
						<td><?php echo $ubicacionEmpleado['ubicaciont']; ?></td>
						<td><?php echo $ubicacionEmpleado['fechat']; ?></td>
						<td><?php echo $value["numero_documento_identidad"] ?></td>
						<td><?php echo $value["nup"] ?></td>
						<td><?php echo $value["codigo_afp"] ?></td>
						<td><?php echo $value["descripcion"] ?></td>
						<td><?php echo edad($value["fecha_nacimiento"]) ?></td>
						<td><?php echo $value["fecha_nacimiento"] ?></td>
						<td><?php echo $value["numero_isss"] ?></td>
						<td><?php echo $value["nit"] ?></td>
						<td><?php echo $value["codigo_bank"] . "-" . $value["nombre_bank"] ?></td>
						<td><?php echo $value["numero_cuenta"] ?></td>
						<td><?php echo $retiro_datos['motivo_inactivo'] ?></td>


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



	<?php
	}
	?>




	<?php

	/* FILTRAR POR DEPARTAMENTOS */
	$departamento1 = "";
	$departamento2 = "";
	if (isset($_POST["empleados"]) && is_numeric($_POST["empleados"]) && !empty($_POST["empleados"])) {
		/* FILTRAR SOLO POR EL EMPLEADO */
		$campos = "tbemp.*, cargo.id as cargoid,cargo.descripcion,bank.codigo as codigo_bank, bank.nombre as nombre_bank, d_emp.id as d_empid,d_emp.nombre as nombre_empresa ";
		$tabla = " `tbl_empleados` tbemp INNER JOIN `departamentos_empresa` d_emp ON tbemp.id_departamento_empresa = d_emp.id INNER JOIN `cargos_desempenados` cargo ON tbemp.nivel_cargo = cargo.id INNER JOIN `bancos` bank ON tbemp.id_banco = bank.id ";
		$condicion = " tbemp.id=" . $_POST['empleados'] . " order by primer_nombre asc, primer_apellido asc";
		$array = [];
		$cont = 0;
		crearTablaEmpleados(
			$cont,
			$campos,
			$tabla,
			$condicion,
			$array
		);
	} else	if (
		isset($_POST["departamento1"]) && isset($_POST["departamento2"]) && !empty($_POST["departamento1"]) && !empty($_POST["departamento2"] && $_POST["departamento1"] != "*" && $_POST["departamento2"] != "*")
	) {
		$depa1 = $_POST["departamento1"];
		$depa2 = $_POST["departamento2"];

		$departamentos = departamentos($depa1, $depa2);

		$cont = 0;


		foreach ($departamentos as $depa) {
			echo "<div class='well'><h4><strong>Departamento: <span class='text-primary'>" . $depa['nombre'] . "</span></strong></h4></div>";
			/* select tbemp.*, cargo.id,cargo.descripcion FROM `tbl_empleados` tbemp inner join cargos_desempenados cargo on tbemp.nivel_cargo=cargo.id; */
			$campos = "tbemp.*, cargo.id as cargoid,cargo.descripcion,bank.codigo as codigo_bank, bank.nombre as nombre_bank, d_emp.id as d_empid,d_emp.nombre as nombre_empresa ";
			$tabla = " `tbl_empleados` tbemp INNER JOIN `departamentos_empresa` d_emp ON tbemp.id_departamento_empresa = d_emp.id INNER JOIN `cargos_desempenados` cargo ON tbemp.nivel_cargo = cargo.id INNER JOIN `bancos` bank ON tbemp.id_banco = bank.id ";
			$condicion = " tbemp.id_departamento_empresa=" . $depa['id'] . " order by primer_nombre asc, primer_apellido asc";
			$array = [];

			crearTablaEmpleados($cont, $campos, $tabla, $condicion, $array);
			$cont++;
		}



		/* CONDICIÓN SOLO POR UN DEPARTAMENTO */
	} else if ($_POST["departamento1"] === "*" || $_POST["departamento2"] === "*") {

		$depa1 = $_POST["departamento1"];
		$depa2 = $_POST["departamento2"];
		if ($depa1 === "*" && $depa2 === "*") {
			/* FILTRAR TODOS */
			$campos = "tbemp.*, cargo.id as cargoid,cargo.descripcion,bank.codigo as codigo_bank, bank.nombre as nombre_bank, d_emp.id as d_empid,d_emp.nombre as nombre_empresa ";
			$tabla = " `tbl_empleados` tbemp INNER JOIN `departamentos_empresa` d_emp ON tbemp.id_departamento_empresa = d_emp.id INNER JOIN `cargos_desempenados` cargo ON tbemp.nivel_cargo = cargo.id INNER JOIN `bancos` bank ON tbemp.id_banco = bank.id ";
			$condicion = " " . $estado_emp . " " . $repotePnc . " order by primer_nombre asc, primer_apellido asc";
			$array = [];
			$cont = 0;
			crearTablaEmpleados(
				$cont,
				$campos,
				$tabla,
				$condicion,
				$array
			);
		} else {

			if ($depa1 != "*" && $depa2 === "*") {
				$depa2 = $depa1;
			} else if ($depa1 === "*" && $depa2 != "*") {
				$depa1 = $depa2;
			}

			$departamentos = departamentos($depa1, $depa2);

			$cont = 0;

			foreach ($departamentos as $depa) {
				echo "<div class='well'><h4><strong>Departamento: <span class='text-primary'>" . $depa['nombre'] . "</span></strong></h4></div>";
				/* select tbemp.*, cargo.id,cargo.descripcion FROM `tbl_empleados` tbemp inner join cargos_desempenados cargo on tbemp.nivel_cargo=cargo.id; */
				$campos = "tbemp.*, cargo.id as cargoid,cargo.descripcion,bank.codigo as codigo_bank, bank.nombre as nombre_bank, d_emp.id as d_empid,d_emp.nombre as nombre_empresa ";
				$tabla = " `tbl_empleados` tbemp INNER JOIN `departamentos_empresa` d_emp ON tbemp.id_departamento_empresa = d_emp.id INNER JOIN `cargos_desempenados` cargo ON tbemp.nivel_cargo = cargo.id INNER JOIN `bancos` bank ON tbemp.id_banco = bank.id ";
				$condicion = " tbemp.id_departamento_empresa=" . $depa['id'] . " order by primer_nombre asc, primer_apellido asc";
				$array = [];



				$cont++;
				crearTablaEmpleados($cont, $campos, $tabla, $condicion, $array);
			}
		}
	}





	?>





<?php


}
