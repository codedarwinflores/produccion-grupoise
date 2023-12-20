<?php

require_once "../controladores/minutos.controlador.php";
require_once "../modelos/minutos.modelo.php";

class Ajaxminutos{

	/*=============================================
	EDITAR REGISTRO
	=============================================*/	

	public $idminutos;

	public function ajaxEditarminutos(){

		$item = "id";
		$valor = $this->idminutos;

		$respuesta = Controladorminutos::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}


	/*=============================================
	VALIDAR NO REPETIR 
	=============================================*/	

	public $validarminutos;

	public function ajaxValidarminutos(){

		$item = "minutos";
		$valor = $this->validarminutos;

		$respuesta = Controladorminutos::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR 
=============================================*/
if(isset($_POST["idminutos"])){

	$editar = new Ajaxminutos();
	$editar -> idminutos = $_POST["idminutos"];
	$editar -> ajaxEditarminutos();

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