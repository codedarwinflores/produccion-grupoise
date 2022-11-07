<?php

require_once "../controladores/cargos.controlador.php";
require_once "../modelos/cargos.modelo.php";

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

	/*=============================================
	MOSTRAR CARGOS
	=============================================*/	
	public $codigoCARGO;
	public function ajaxMostrarCARGO(){
		$item = "nivel";
		$valor = $this->codigoCARGO;
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

/*=============================================
MOSTRAR CARGO
=============================================*/	
if(isset($_POST["nivel"])){
	$vercargo = new AjaxCargos();
	$vercargo -> codigoCARGO = $_POST["nivel"];
	$vercargo -> ajaxMostrarCARGO();
}