<?php

require_once "../controladores/isr.controlador.php";
require_once "../modelos/isr.modelo.php";

class Ajaxisr{

	/*=============================================
	EDITAR REGISTRO
	=============================================*/	

	public $idisr;

	public function ajaxEditarisr(){

		$item = "id";
		$valor = $this->idisr;

		$respuesta = Controladorisr::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}


	/*=============================================
	VALIDAR NO REPETIR 
	=============================================*/	

	public $validarisr;

	public function ajaxValidarisr(){

		$item = "isr";
		$valor = $this->validarisr;

		$respuesta = Controladorisr::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR 
=============================================*/
if(isset($_POST["idisr"])){

	$editar = new Ajaxisr();
	$editar -> idisr = $_POST["idisr"];
	$editar -> ajaxEditarisr();

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