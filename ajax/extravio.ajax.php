<?php

require_once "../controladores/extravios.controlador.php";
require_once "../modelos/extravios.modelo.php";

class Ajaxextravios{

	/*=============================================
	EDITAR REGISTRO
	=============================================*/	

	public $idextravios;

	public function ajaxEditarextravios(){

		$item = "id";
		$valor = $this->idextravios;

		$respuesta = Controladorextravios::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}


	/*=============================================
	VALIDAR NO REPETIR 
	=============================================*/	

	public $validarextravios;

	public function ajaxValidarextravios(){

		$item = "extravios";
		$valor = $this->validarextravios;

		$respuesta = Controladorextravios::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR 
=============================================*/
if(isset($_POST["idextravios"])){

	$editar = new Ajaxextravios();
	$editar -> idextravios = $_POST["idextravios"];
	$editar -> ajaxEditarextravios();

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