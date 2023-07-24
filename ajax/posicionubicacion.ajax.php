<?php

require_once "../controladores/posicionubicacion.controlador.php";
require_once "../modelos/posicionubicacion.modelo.php";

class Ajaxposicionubicacion{

	/*=============================================
	EDITAR REGISTRO
	=============================================*/	

	public $idposicionubicacion;

	public function ajaxEditarposicionubicacion(){

		$item = "id";
		$valor = $this->idposicionubicacion;

		$respuesta = Controladorposicionubicacion::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}


	/*=============================================
	VALIDAR NO REPETIR 
	=============================================*/	

	public $validarposicionubicacion;

	public function ajaxValidarposicionubicacion(){

		$item = "posicionubicacion";
		$valor = $this->validarposicionubicacion;

		$respuesta = Controladorposicionubicacion::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR 
=============================================*/
if(isset($_POST["idposicionubicacion"])){

	$editar = new Ajaxposicionubicacion();
	$editar -> idposicionubicacion = $_POST["idposicionubicacion"];
	$editar -> ajaxEditarposicionubicacion();

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