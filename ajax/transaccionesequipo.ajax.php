<?php

require_once "../controladores/transaccionesequipo.controlador.php";
require_once "../modelos/transaccionesequipo.modelo.php";

class Ajaxtransaccionesequipo{

	/*=============================================
	EDITAR REGISTRO
	=============================================*/	

	public $idtransaccionesequipo;

	public function ajaxEditartransaccionesequipo(){

		$item = "id";
		$valor = $this->idtransaccionesequipo;

		$respuesta = Controladortransaccionesequipo::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}


	/*=============================================
	VALIDAR NO REPETIR 
	=============================================*/	

	public $validartransaccionesequipo;

	public function ajaxValidartransaccionesequipo(){

		$item = "transaccionesequipo";
		$valor = $this->validartransaccionesequipo;

		$respuesta = Controladortransaccionesequipo::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR 
=============================================*/
if(isset($_POST["idtransaccionesequipo"])){

	$editar = new Ajaxtransaccionesequipo();
	$editar -> idtransaccionesequipo = $_POST["idtransaccionesequipo"];
	$editar -> ajaxEditartransaccionesequipo();

}

/*=============================================
ACTIVAR USUARIO
=============================================*/	

if(isset($_POST["activarUsuario"])){

	$activarUsuario = new AjaxUsuarios();
	$activarUsuario -> activarUsuario = $_POST["activarUsuario"];
	$activarUsuario -> activarId = $_POST["activarId"];
	$activarUsuario -> ajaxActivarUsuario();

}

/*=============================================
VALIDAR NO REPETIR USUARIO
=============================================*/

if(isset( $_POST["validarUsuario"])){

	$valUsuario = new AjaxUsuarios();
	$valUsuario -> validarUsuario = $_POST["validarUsuario"];
	$valUsuario -> ajaxValidarUsuario();

}