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

	/* function cargos_desempenados($idcargo1)
	{
		include_once "../modelos/conexion.php";
		 $query = "SELECT * FROM `cargos_desempenados` WHERE id=$idcargo1";
		$sql = Conexion::conectar()->prepare($query);
		$sql->execute();
		return $sql->fetch(PDO::FETCH_ASSOC);

		$nivel_cargo = "";
		if (!empty($idcargo1) && intval($idcargo1)) {

			$query = "SELECT * FROM `cargos_desempenados` WHERE id=$idcargo1";
			$sql = Conexion::conectar()->prepare($query);
			$sql->execute();
			$resp = $sql->fetch(PDO::FETCH_ASSOC);
			$nivel_cargo = $resp['descripcion'];
			$sql = null;
		}

		echo  $nivel_cargo;
	}; */

	function edad($fecha)
	{
		$nacimiento = new DateTime($fecha);
		$ahora = new DateTime(date("Y-m-d"));
		$diferencia = $ahora->diff($nacimiento);
		$edad = $diferencia->format("%y");
		return $edad;
	}




?>

	<script>
		$(document).ready(function() {
			$('#example').DataTable({
				"order": [
					[2, "asc"]
				],
				"lengthMenu": [
					[5, 10, 25, 50, 100, -1],
					[5, 10, 25, 50, 100, "All"]
				]
			});
		});


		function imprimir(param) {
			window.open('./vistas/modulos/reportesexcel/reporteempleado.php?typeReport=' + param, '_self');
		}
	</script>



	<table class="table table-bordered table-striped dt-responsive " id="example" width="100%">

		<thead class="bg-info">
			<tr>
				<th>No.</th>
				<th>Estado</th>
				<th>Report Arma</th>
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
			/* select tbemp.*, cargo.id,cargo.descripcion FROM `tbl_empleados` tbemp inner join cargos_desempenados cargo on tbemp.nivel_cargo=cargo.id; */
			$campos = "tbemp.*, cargo.id,cargo.descripcion,bank.codigo as codigo_bank, bank.nombre as nombre_bank ";
			$tabla = " `tbl_empleados` tbemp inner join cargos_desempenados cargo on tbemp.nivel_cargo=cargo.id inner join bancos bank";
			$condicion = " 1 order by primer_nombre asc, primer_apellido asc";
			$array = [];


			$empleados = $empleadoBuscar->mostrarEmpleadoDb($campos, $tabla, $condicion, $array);

			$badge = "dark";
			foreach ($empleados as $key => $value) {

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

			?>
				<tr>
					<th><?php echo $value["codigo_empleado"] ?></th>
					<td><label class="badge btn-<?php echo $badge ?>"><?php echo $nombreEstado ?></label></td>
					<td><?php echo $value["reportado_a_pnc"] ?></td>
					<td><?php echo $value["primer_nombre"] . ' ' . $value["segundo_nombre"] . ' ' . $value["tercer_nombre"] . ' ' . $value["primer_apellido"] . ' ' . $value["segundo_apellido"] . ' ' . $value["apellido_casada"] . "Uniforme" ?></td>
					<td><?php echo $value["sueldo_que_devenga"] ?></td>
					<td><?php echo "Info_devengo"; ?></td>
					<td><?php echo "Bono Unidad" ?></td>
					<td><?php echo $value["fecha_ingreso"] ?></td>
					<td><?php echo $value["fecha_contratacion"] ?></td>
					<td>F.RETIRO</td>
					<td><?php echo "Ubicacion"; ?></td>
					<td><?php echo "fecha_ubi"; ?></td>
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
					<td>************</td>
				</tr>

			<?php




				/* ******* */
			}



			?>

		</tbody>

	</table>




<?php


}
