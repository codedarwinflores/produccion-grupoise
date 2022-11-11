<?php

require_once "../controladores/tipocelular.controlador.php";
require_once "../modelos/tipocelular.modelo.php";

class Ajaxtipocelular{

	/*=============================================
	EDITAR REGISTRO
	=============================================*/	

	public $idtipocelular;

	public function ajaxEditartipocelular(){

		$item = "id";
		$valor = $this->idtipocelular;

		$respuesta = Controladortipocelular::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}


	/*=============================================
	VALIDAR NO REPETIR 
	=============================================*/	

	public $validartipocelular;

	public function ajaxValidartipocelular(){

		$item = "tipocelular";
		$valor = $this->validartipocelular;

		$respuesta = Controladortipocelular::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR 
=============================================*/
if(isset($_POST["idtipocelular"])){

	$editar = new Ajaxtipocelular();
	$editar -> idtipocelular = $_POST["idtipocelular"];
	$editar -> ajaxEditartipocelular();

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