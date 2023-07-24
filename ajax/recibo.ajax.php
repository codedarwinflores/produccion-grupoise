<?php

require_once "../controladores/recibo.controlador.php";
require_once "../modelos/recibo.modelo.php";

class Ajaxrecibo{

	/*=============================================
	EDITAR REGISTRO
	=============================================*/	

	public $idrecibo;

	public function ajaxEditarrecibo(){

		$item = "id";
		$valor = $this->idrecibo;

		$respuesta = Controladorrecibo::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}


	/*=============================================
	VALIDAR NO REPETIR 
	=============================================*/	

	public $validarrecibo;

	public function ajaxValidarrecibo(){

		$item = "recibo";
		$valor = $this->validarrecibo;

		$respuesta = Controladorrecibo::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR 
=============================================*/
if(isset($_POST["idrecibo"])){

	$editar = new Ajaxrecibo();
	$editar -> idrecibo = $_POST["idrecibo"];
	$editar -> ajaxEditarrecibo();

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

/* ******************* */
