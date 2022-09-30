<?php

require_once "../controladores/afp.controlador.php";
require_once "../modelos/afp.modelo.php";

class AjaxAfp{

	/*=============================================
	EDITAR REGISTRO
	=============================================*/	

	public $idAfp;

	public function ajaxEditarAfp(){

		$item = "id";
		$valor = $this->idAfp;

		$respuesta = ControladorAfp::ctrMostrarAfp($item, $valor);

		echo json_encode($respuesta);

	}


	/*=============================================
	VALIDAR NO REPETIR 
	=============================================*/	

	public $validarAfp;

	public function ajaxValidarAfp(){

		$item = "Afp";
		$valor = $this->validarAfp;

		$respuesta = ControladorAfp::ctrMostrarAfp($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR 
=============================================*/
if(isset($_POST["idAfp"])){

	$editar = new AjaxAfp();
	$editar -> idAfp = $_POST["idAfp"];
	$editar -> ajaxEditarAfp();

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