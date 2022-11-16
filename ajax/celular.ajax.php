<?php

require_once "../controladores/celular.controlador.php";
require_once "../modelos/celular.modelo.php";

class Ajaxcelular{

	/*=============================================
	EDITAR REGISTRO
	=============================================*/	

	public $idcelular;

	public function ajaxEditarcelular(){

		$item = "id";
		$valor = $this->idcelular;

		$respuesta = Controladorcelular::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}


	/*=============================================
	VALIDAR NO REPETIR 
	=============================================*/	

	public $validarcelular;

	public function ajaxValidarcelular(){

		$item = "celular";
		$valor = $this->validarcelular;

		$respuesta = Controladorcelular::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR 
=============================================*/
if(isset($_POST["idcelular"])){

	$editar = new Ajaxcelular();
	$editar -> idcelular = $_POST["idcelular"];
	$editar -> ajaxEditarcelular();

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