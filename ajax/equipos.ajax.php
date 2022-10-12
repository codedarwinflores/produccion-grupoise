<?php

require_once "../controladores/equipos.controlador.php";
require_once "../modelos/equipos.modelo.php";

class Ajaxequipos{

	/*=============================================
	EDITAR REGISTRO
	=============================================*/	

	public $idequipos;

	public function ajaxEditarequipos(){

		$item = "id";
		$valor = $this->idequipos;

		$respuesta = Controladorequipos::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}


	/*=============================================
	VALIDAR NO REPETIR 
	=============================================*/	

	public $validarequipos;

	public function ajaxValidarequipos(){

		$item = "equipos";
		$valor = $this->validarequipos;

		$respuesta = Controladorequipos::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR 
=============================================*/
if(isset($_POST["idequipos"])){

	$editar = new Ajaxequipos();
	$editar -> idequipos = $_POST["idequipos"];
	$editar -> ajaxEditarequipos();

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