<?php

require_once "../controladores/ajustes.controlador.php";
require_once "../modelos/ajustes.modelo.php";

class Ajaxajustes{

	/*=============================================
	EDITAR REGISTRO
	=============================================*/	

	public $idajustes;

	public function ajaxEditarajustes(){

		$item = "id";
		$valor = $this->idajustes;

		$respuesta = Controladorajustes::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}


	/*=============================================
	VALIDAR NO REPETIR 
	=============================================*/	

	public $validarajustes;

	public function ajaxValidarajustes(){

		$item = "ajustes";
		$valor = $this->validarajustes;

		$respuesta = Controladorajustes::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR 
=============================================*/
if(isset($_POST["idajustes"])){

	$editar = new Ajaxajustes();
	$editar -> idajustes = $_POST["idajustes"];
	$editar -> ajaxEditarajustes();

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