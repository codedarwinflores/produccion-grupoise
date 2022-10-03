<?php

require_once "../controladores/Cargos.controlador.php";
require_once "../modelos/Cargos.modelo.php";

class AjaxCargos{

	/*=============================================
	EDITAR REGISTRO
	=============================================*/	

	public $idCargos;

	public function ajaxEditarCargos(){

		$item = "id";
		$valor = $this->idCargos;

		$respuesta = ControladorCargos::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}


	/*=============================================
	VALIDAR NO REPETIR 
	=============================================*/	

	public $validarCargos;

	public function ajaxValidarCargos(){

		$item = "Cargos";
		$valor = $this->validarCargos;

		$respuesta = ControladorCargos::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR 
=============================================*/
if(isset($_POST["idCargos"])){

	$editar = new AjaxCargos();
	$editar -> idCargos = $_POST["idCargos"];
	$editar -> ajaxEditarCargos();

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