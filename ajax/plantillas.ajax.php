<?php

require_once "../controladores/plantillas.controlador.php";
require_once "../modelos/plantillas.modelo.php";

class Ajaxplantillas{

	/*=============================================
	EDITAR REGISTRO
	=============================================*/	

	public $idplantillas;

	public function ajaxEditarplantillas(){

		$item = "id";
		$valor = $this->idplantillas;

		$respuesta = Controladorplantillas::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}


	/*=============================================
	VALIDAR NO REPETIR 
	=============================================*/	

	public $validarplantillas;

	public function ajaxValidarplantillas(){

		$item = "plantillas";
		$valor = $this->validarplantillas;

		$respuesta = Controladorplantillas::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR 
=============================================*/
if(isset($_POST["idplantillas"])){

	$editar = new Ajaxplantillas();
	$editar -> idplantillas = $_POST["idplantillas"];
	$editar -> ajaxEditarplantillas();

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