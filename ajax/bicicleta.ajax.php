<?php

require_once "../controladores/bicicleta.controlador.php";
require_once "../modelos/bicicleta.modelo.php";

class Ajaxbicicleta{

	/*=============================================
	EDITAR REGISTRO
	=============================================*/	

	public $idbicicleta;

	public function ajaxEditarbicicleta(){

		$item = "id";
		$valor = $this->idbicicleta;

		$respuesta = Controladorbicicleta::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}


	/*=============================================
	VALIDAR NO REPETIR 
	=============================================*/	

	public $validarbicicleta;

	public function ajaxValidarbicicleta(){

		$item = "bicicleta";
		$valor = $this->validarbicicleta;

		$respuesta = Controladorbicicleta::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR 
=============================================*/
if(isset($_POST["idbicicleta"])){

	$editar = new Ajaxbicicleta();
	$editar -> idbicicleta = $_POST["idbicicleta"];
	$editar -> ajaxEditarbicicleta();

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