<?php

require_once "../controladores/coordinadorpatrulla.controlador.php";
require_once "../modelos/coordinadorpatrulla.modelo.php";

class Ajaxcoordinadorpatrulla{

	/*=============================================
	EDITAR REGISTRO
	=============================================*/	

	public $idcoordinadorpatrulla;

	public function ajaxEditarcoordinadorpatrulla(){

		$item = "id";
		$valor = $this->idcoordinadorpatrulla;

		$respuesta = Controladorcoordinadorpatrulla::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}


	/*=============================================
	VALIDAR NO REPETIR 
	=============================================*/	

	public $validarcoordinadorpatrulla;

	public function ajaxValidarcoordinadorpatrulla(){

		$item = "coordinadorpatrulla";
		$valor = $this->validarcoordinadorpatrulla;

		$respuesta = Controladorcoordinadorpatrulla::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR 
=============================================*/
if(isset($_POST["idcoordinadorpatrulla"])){

	$editar = new Ajaxcoordinadorpatrulla();
	$editar -> idcoordinadorpatrulla = $_POST["idcoordinadorpatrulla"];
	$editar -> ajaxEditarcoordinadorpatrulla();

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