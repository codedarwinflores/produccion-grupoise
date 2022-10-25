<?php

require_once "../controladores/portacionarma.controlador.php";
require_once "../modelos/portacionarma.modelo.php";

class Ajaxportacionarma{

	/*=============================================
	EDITAR REGISTRO
	=============================================*/	

	public $idportacionarma;

	public function ajaxEditarportacionarma(){

		$item = "id";
		$valor = $this->idportacionarma;

		$respuesta = Controladorportacionarma::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}


	/*=============================================
	VALIDAR NO REPETIR 
	=============================================*/	

	public $validarportacionarma;

	public function ajaxValidarportacionarma(){

		$item = "portacionarma";
		$valor = $this->validarportacionarma;

		$respuesta = Controladorportacionarma::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR 
=============================================*/
if(isset($_POST["idportacionarma"])){

	$editar = new Ajaxportacionarma();
	$editar -> idportacionarma = $_POST["idportacionarma"];
	$editar -> ajaxEditarportacionarma();

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