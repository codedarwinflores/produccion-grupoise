<?php

require_once "../controladores/paises.controlador.php";
require_once "../modelos/paises.modelo.php";

class AjaxPaises{

	/*=============================================
	EDITAR REGISTRO
	=============================================*/	

	public $idPaises;

	public function ajaxEditarPaises(){

		$item = "id";
		$valor = $this->idPaises;

		$respuesta = ControladorPaises::ctrMostrarPaises($item, $valor);

		echo json_encode($respuesta);

	}


	/*=============================================
	VALIDAR NO REPETIR 
	=============================================*/	

	public $validarPaises;

	public function ajaxValidarPaises(){

		$item = "paises";
		$valor = $this->validarPaises;

		$respuesta = ControladorPaises::ctrMostrarPaises($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR 
=============================================*/
if(isset($_POST["idPaises"])){

	$editar = new AjaxPaises();
	$editar -> idPaises = $_POST["idPaises"];
	$editar -> ajaxEditarPaises();

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