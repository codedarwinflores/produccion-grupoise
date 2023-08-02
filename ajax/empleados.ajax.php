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
	require_once "../modelos/conexion.php";

	function ubicacion_empleado($codigo)
	{
		if (!empty($codigo)) {
			# code...


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
			$response = array('fechat' => "***", 'ubicaciont' => "***");
	};

	function edad($fecha)
	{
		$nacimiento = new DateTime($fecha);
		$ahora = new DateTime(date("Y-m-d"));
		$diferencia = $ahora->diff($nacimiento);
		$edad = $diferencia->format("%y");
		return $edad;
	}

	function departamentos($depa1, $depa2)
	{
		$stm = "SELECT * FROM `departamentos_empresa` where id between " . $depa1 . " and " . $depa2;
		$sqlquery = Conexion::conectar()->prepare($stm);
		$sqlquery->execute();
		return $sqlquery->fetchAll();
	}


?>




	<?php

	/* FILTRAR POR DEPARTAMENTOS */
	$departamento1 = "";
	$departamento2 = "";
	if (isset($_GET["empleados"]) && is_numeric($_GET["empleados"]) && !empty($_GET["empleados"])) {
		/* FILTRAR SOLO POR EL EMPLEADO */
		$campos = "tbemp.*, cargo.id,cargo.descripcion,bank.codigo as codigo_bank, bank.nombre as nombre_bank, d_emp.id,d_emp.nombre as nombre_empresa ";
		$tabla = " `tbl_empleados` tbemp INNER JOIN `departamentos_empresa` d_emp ON tbemp.id_departamento_empresa = d_emp.id INNER JOIN `cargos_desempenados` cargo ON tbemp.nivel_cargo = cargo.id INNER JOIN `bancos` bank ON tbemp.id_banco = bank.id ";
		$condicion = " tbemp.id=" . $_GET['empleados'] . " order by primer_nombre asc, primer_apellido asc";
		$array = [];
		$cont = 0;
		include('../vistas/modulos/empleados/empleado.php');
	} else	if (
		isset($_GET["departamento1"]) && isset($_GET["departamento2"]) && !empty($_GET["departamento1"]) && !empty($_GET["departamento2"] && $_GET["departamento1"] != "*" && $_GET["departamento2"] != "*")
	) {
		$depa1 = $_GET["departamento1"];
		$depa2 = $_GET["departamento2"];

		$departamentos = departamentos($depa1, $depa2);

		$cont = 0;


		foreach ($departamentos as $depa) {
			echo "<div class='well'><h4><strong>Departamento: <span class='text-primary'>" . $depa['nombre'] . "</span></strong></h4></div>";
			/* select tbemp.*, cargo.id,cargo.descripcion FROM `tbl_empleados` tbemp inner join cargos_desempenados cargo on tbemp.nivel_cargo=cargo.id; */
			$campos = "tbemp.*, cargo.id,cargo.descripcion,bank.codigo as codigo_bank, bank.nombre as nombre_bank, d_emp.id,d_emp.nombre as nombre_empresa ";
			$tabla = " `tbl_empleados` tbemp INNER JOIN `departamentos_empresa` d_emp ON tbemp.id_departamento_empresa = d_emp.id INNER JOIN `cargos_desempenados` cargo ON tbemp.nivel_cargo = cargo.id INNER JOIN `bancos` bank ON tbemp.id_banco = bank.id ";
			$condicion = " tbemp.id_departamento_empresa=" . $depa['id'] . " order by primer_nombre asc, primer_apellido asc";
			$array = [];

			include('../vistas/modulos/empleados/empleado.php');
			$cont++;
		}



		/* CONDICIÓN SOLO POR UN DEPARTAMENTO */
	} else if ($_GET["departamento1"] === "*" || $_GET["departamento2"] === "*") {



		$depa1 = $_GET["departamento1"];
		$depa2 = $_GET["departamento2"];
		if ($depa1 === "*" && $depa2 === "*") {
			# code...
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
				$campos = "tbemp.*, cargo.id,cargo.descripcion,bank.codigo as codigo_bank, bank.nombre as nombre_bank, d_emp.id,d_emp.nombre as nombre_empresa ";
				$tabla = " `tbl_empleados` tbemp INNER JOIN `departamentos_empresa` d_emp ON tbemp.id_departamento_empresa = d_emp.id INNER JOIN `cargos_desempenados` cargo ON tbemp.nivel_cargo = cargo.id INNER JOIN `bancos` bank ON tbemp.id_banco = bank.id ";
				$condicion = " tbemp.id_departamento_empresa=" . $depa['id'] . " order by primer_nombre asc, primer_apellido asc";
				$array = [];



				include_once('../vistas/modulos/empleados/empleado.php');
				$cont++;
			}
		}
	}





	?>





<?php


}
