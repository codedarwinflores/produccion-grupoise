<?php

require_once "../controladores/administrarpatrulla.controlador.php";
require_once "../modelos/administrarpatrulla.modelo.php";

class Ajaxadministrarpatrulla{

	/*=============================================
	EDITAR REGISTRO
	=============================================*/	

	public $idadministrarpatrulla;

	public function ajaxEditaradministrarpatrulla(){

		$item = "id";
		$valor = $this->idadministrarpatrulla;

		$respuesta = Controladoradministrarpatrulla::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}


	/*=============================================
	VALIDAR NO REPETIR 
	=============================================*/	

	public $validaradministrarpatrulla;

	public function ajaxValidaradministrarpatrulla(){

		$item = "administrarpatrulla";
		$valor = $this->validaradministrarpatrulla;

		$respuesta = Controladoradministrarpatrulla::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR 
=============================================*/
if(isset($_POST["idadministrarpatrulla"])){

	$editar = new Ajaxadministrarpatrulla();
	$editar -> idadministrarpatrulla = $_POST["idadministrarpatrulla"];
	$editar -> ajaxEditaradministrarpatrulla();

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