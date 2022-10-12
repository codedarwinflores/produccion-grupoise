<?php

require_once "../controladores/armas.controlador.php";
require_once "../modelos/armas.modelo.php";

class Ajaxarmas{

	/*=============================================
	EDITAR REGISTRO
	=============================================*/	

	public $idarmas;

	public function ajaxEditararmas(){

		$item = "id";
		$valor = $this->idarmas;

		$respuesta = Controladorarmas::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}


	/*=============================================
	VALIDAR NO REPETIR 
	=============================================*/	

	public $validararmas;

	public function ajaxValidararmas(){

		$item = "armas";
		$valor = $this->validararmas;

		$respuesta = Controladorarmas::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR 
=============================================*/
if(isset($_POST["idarmas"])){

	$editar = new Ajaxarmas();
	$editar -> idarmas = $_POST["idarmas"];
	$editar -> ajaxEditararmas();

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