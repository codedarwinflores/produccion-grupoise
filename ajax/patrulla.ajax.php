<?php

require_once "../controladores/patrulla.controlador.php";
require_once "../modelos/patrulla.modelo.php";

class Ajaxpatrulla{

	/*=============================================
	EDITAR REGISTRO
	=============================================*/	

	public $idpatrulla;

	public function ajaxEditarpatrulla(){

		$item = "id";
		$valor = $this->idpatrulla;

		$respuesta = Controladorpatrulla::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}


	/*=============================================
	VALIDAR NO REPETIR 
	=============================================*/	

	public $validarpatrulla;

	public function ajaxValidarpatrulla(){

		$item = "patrulla";
		$valor = $this->validarpatrulla;

		$respuesta = Controladorpatrulla::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR 
=============================================*/
if(isset($_POST["idpatrulla"])){

	$editar = new Ajaxpatrulla();
	$editar -> idpatrulla = $_POST["idpatrulla"];
	$editar -> ajaxEditarpatrulla();

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