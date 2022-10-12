<?php

require_once "../controladores/radio.controlador.php";
require_once "../modelos/radio.modelo.php";

class Ajaxradio{

	/*=============================================
	EDITAR REGISTRO
	=============================================*/	

	public $idradio;

	public function ajaxEditarradio(){

		$item = "id";
		$valor = $this->idradio;

		$respuesta = Controladorradio::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}


	/*=============================================
	VALIDAR NO REPETIR 
	=============================================*/	

	public $validarradio;

	public function ajaxValidarradio(){

		$item = "radio";
		$valor = $this->validarradio;

		$respuesta = Controladorradio::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR 
=============================================*/
if(isset($_POST["idradio"])){

	$editar = new Ajaxradio();
	$editar -> idradio = $_POST["idradio"];
	$editar -> ajaxEditarradio();

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