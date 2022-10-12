<?php

require_once "../controladores/tipoarmas.controlador.php";
require_once "../modelos/tipoarmas.modelo.php";

class Ajaxtipoarmas{

	/*=============================================
	EDITAR REGISTRO
	=============================================*/	

	public $idtipoarmas;

	public function ajaxEditartipoarmas(){

		$item = "id";
		$valor = $this->idtipoarmas;

		$respuesta = Controladortipoarmas::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}


	/*=============================================
	VALIDAR NO REPETIR 
	=============================================*/	

	public $validartipoarmas;

	public function ajaxValidartipoarmas(){

		$item = "tipoarmas";
		$valor = $this->validartipoarmas;

		$respuesta = Controladortipoarmas::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR 
=============================================*/
if(isset($_POST["idtipoarmas"])){

	$editar = new Ajaxtipoarmas();
	$editar -> idtipoarmas = $_POST["idtipoarmas"];
	$editar -> ajaxEditartipoarmas();

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