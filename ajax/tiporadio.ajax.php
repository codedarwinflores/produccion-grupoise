<?php

require_once "../controladores/tiporadio.controlador.php";
require_once "../modelos/tiporadio.modelo.php";

class Ajaxtiporadio{

	/*=============================================
	EDITAR REGISTRO
	=============================================*/	

	public $idtiporadio;

	public function ajaxEditartiporadio(){

		$item = "id";
		$valor = $this->idtiporadio;

		$respuesta = Controladortiporadio::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}


	/*=============================================
	VALIDAR NO REPETIR 
	=============================================*/	

	public $validartiporadio;

	public function ajaxValidartiporadio(){

		$item = "tiporadio";
		$valor = $this->validartiporadio;

		$respuesta = Controladortiporadio::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR 
=============================================*/
if(isset($_POST["idtiporadio"])){

	$editar = new Ajaxtiporadio();
	$editar -> idtiporadio = $_POST["idtiporadio"];
	$editar -> ajaxEditartiporadio();

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