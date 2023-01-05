<?php

require_once "../controladores/retiro.controlador.php";
require_once "../modelos/retiro.modelo.php";

class Ajaxretiro{

	/*=============================================
	EDITAR REGISTRO
	=============================================*/	

	public $idretiro;

	public function ajaxEditarretiro(){

		$item = "id";
		$valor = $this->idretiro;

		$respuesta = Controladorretiro::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}


	/*=============================================
	VALIDAR NO REPETIR 
	=============================================*/	

	public $validarretiro;

	public function ajaxValidarretiro(){

		$item = "retiro";
		$valor = $this->validarretiro;

		$respuesta = Controladorretiro::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR 
=============================================*/
if(isset($_POST["idretiro"])){

	$editar = new Ajaxretiro();
	$editar -> idretiro = $_POST["idretiro"];
	$editar -> ajaxEditarretiro();

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