<?php

require_once "../controladores/empleados.controlador.php";
require_once "../modelos/empleados.modelo.php";

class AjaxEmpleados{

	/*=============================================
	EDITAR EMPLEADO
	=============================================*/	

	public $idEmpleado;

	public function ajaxEditarEmpleado(){

		$item = "id";
		$valor = $this->idEmpleado;

		$respuesta = ControladorEmpleados::ctrMostrarEmpleados($item, $valor);

		echo json_encode($respuesta);

	}

	

	/*=============================================
	VALIDAR NO REPETIR EMPLEADO
	=============================================*/	

	public $validarEmpleado;

	public function ajaxValidarEmpleado(){

		$item = "numero_documento_identidad";
		$valor = $this->validarEmpleado;

		$respuesta = ControladorEmpleados::ctrMostrarEmpleados($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR EMPLEADO
=============================================*/
if(isset($_POST["idEmpleado"])){

	$editar = new AjaxEmpleados();
	$editar -> idEmpleado = $_POST["idEmpleado"];
	$editar -> ajaxEditarEmpleado();

}



/*=============================================
VALIDAR NO REPETIR EMPLEADO
=============================================*/

if(isset( $_POST["validarEmpleado"])){

	$valEmpleado = new AjaxEmpleados();
	$valEmpleado -> validarEmpleado = $_POST["validarEmpleado"];
	$valEmpleado -> ajaxValidarEmpleado();

}