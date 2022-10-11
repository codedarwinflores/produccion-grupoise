<?php

require_once "../controladores/seminarios.controlador.php";
require_once "../modelos/seminarios.modelo.php";

class Ajaxseminarios{

	/*=============================================
	EDITAR REGISTRO
	=============================================*/	

	public $idseminarios;

	public function ajaxEditarseminarios(){

		$item = "id";
		$valor = $this->idseminarios;

		$respuesta = Controladorseminarios::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}


	/*=============================================
	VALIDAR NO REPETIR 
	=============================================*/	

	public $validarseminarios;

	public function ajaxValidarseminarios(){

		$item = "seminarios";
		$valor = $this->validarseminarios;

		$respuesta = Controladorseminarios::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR 
=============================================*/
if(isset($_POST["idseminarios"])){

	$editar = new Ajaxseminarios();
	$editar -> idseminarios = $_POST["idseminarios"];
	$editar -> ajaxEditarseminarios();

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