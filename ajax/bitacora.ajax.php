<?php

require_once "../controladores/bitacora.controlador.php";
require_once "../modelos/bitacora.modelo.php";

class Ajaxbitacora{

	/*=============================================
	EDITAR REGISTRO
	=============================================*/	

	public $idbitacora;

	public function ajaxEditarbitacora(){

		$item = "id";
		$valor = $this->idbitacora;

		$respuesta = Controladorbitacora::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}


	/*=============================================
	VALIDAR NO REPETIR 
	=============================================*/	

	public $validarbitacora;

	public function ajaxValidarbitacora(){

		$item = "bitacora";
		$valor = $this->validarbitacora;

		$respuesta = Controladorbitacora::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR 
=============================================*/
if(isset($_POST["idbitacora"])){

	$editar = new Ajaxbitacora();
	$editar -> idbitacora = $_POST["idbitacora"];
	$editar -> ajaxEditarbitacora();

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