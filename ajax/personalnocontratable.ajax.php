<?php

require_once "../controladores/personalnocontratable.controlador.php";
require_once "../modelos/personalnocontratable.modelo.php";

class Ajaxpersonal_no_contratable{

	/*=============================================
	EDITAR REGISTRO
	=============================================*/	

	public $idpersonal_no_contratable;

	public function ajaxEditarpersonal_no_contratable(){

		$item = "id";
		$valor = $this->idpersonal_no_contratable;

		$respuesta = Controladorpersonal_no_contratable::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}


	/*=============================================
	VALIDAR NO REPETIR 
	=============================================*/	

	public $validarpersonal_no_contratable;

	public function ajaxValidarpersonal_no_contratable(){

		$item = "personal_no_contratable";
		$valor = $this->validarpersonal_no_contratable;

		$respuesta = Controladorpersonal_no_contratable::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR 
=============================================*/
if(isset($_POST["idpersonal_no_contratable"])){

	$editar = new Ajaxpersonal_no_contratable();
	$editar -> idpersonal_no_contratable = $_POST["idpersonal_no_contratable"];
	$editar -> ajaxEditarpersonal_no_contratable();

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