<?php

require_once "../controladores/regalo.controlador.php";
require_once "../modelos/regalo.modelo.php";

class Ajaxregalo{

	/*=============================================
	EDITAR REGISTRO
	=============================================*/	

	public $idregalo;

	public function ajaxEditarregalo(){

		$item = "id";
		$valor = $this->idregalo;

		$respuesta = Controladorregalo::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}


	/*=============================================
	VALIDAR NO REPETIR 
	=============================================*/	

	public $validarregalo;

	public function ajaxValidarregalo(){

		$item = "regalo";
		$valor = $this->validarregalo;

		$respuesta = Controladorregalo::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR 
=============================================*/
if(isset($_POST["idregalo"])){

	$editar = new Ajaxregalo();
	$editar -> idregalo = $_POST["idregalo"];
	$editar -> ajaxEditarregalo();

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