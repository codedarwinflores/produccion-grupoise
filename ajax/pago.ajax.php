<?php

require_once "../controladores/pago.controlador.php";
require_once "../modelos/pago.modelo.php";

class Ajaxpago{

	/*=============================================
	EDITAR REGISTRO
	=============================================*/	

	public $idpago;

	public function ajaxEditarpago(){

		$item = "id";
		$valor = $this->idpago;

		$respuesta = Controladorpago::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}


	/*=============================================
	VALIDAR NO REPETIR 
	=============================================*/	

	public $validarpago;

	public function ajaxValidarpago(){

		$item = "pago";
		$valor = $this->validarpago;

		$respuesta = Controladorpago::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR 
=============================================*/
if(isset($_POST["idpago"])){

	$editar = new Ajaxpago();
	$editar -> idpago = $_POST["idpago"];
	$editar -> ajaxEditarpago();

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