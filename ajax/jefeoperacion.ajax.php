<?php

require_once "../controladores/jefeoperacion.controlador.php";
require_once "../modelos/jefeoperacion.modelo.php";

class Ajaxjefeoperacion{

	/*=============================================
	EDITAR REGISTRO
	=============================================*/	

	public $idjefeoperacion;

	public function ajaxEditarjefeoperacion(){

		$item = "id";
		$valor = $this->idjefeoperacion;

		$respuesta = Controladorjefeoperacion::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}


	/*=============================================
	VALIDAR NO REPETIR 
	=============================================*/	

	public $validarjefeoperacion;

	public function ajaxValidarjefeoperacion(){

		$item = "jefeoperacion";
		$valor = $this->validarjefeoperacion;

		$respuesta = Controladorjefeoperacion::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR 
=============================================*/
if(isset($_POST["idjefeoperacion"])){

	$editar = new Ajaxjefeoperacion();
	$editar -> idjefeoperacion = $_POST["idjefeoperacion"];
	$editar -> ajaxEditarjefeoperacion();

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