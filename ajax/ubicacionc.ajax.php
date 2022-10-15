<?php

require_once "../controladores/ubicacionc.controlador.php";
require_once "../modelos/ubicacionc.modelo.php";

class Ajaxubicacionc{

	/*=============================================
	EDITAR REGISTRO
	=============================================*/	

	public $idubicacionc;

	public function ajaxEditarubicacionc(){

		$item = "id";
		$valor = $this->idubicacionc;

		$respuesta = Controladorubicacionc::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}


	/*=============================================
	VALIDAR NO REPETIR 
	=============================================*/	

	public $validarubicacionc;

	public function ajaxValidarubicacionc(){

		$item = "ubicacionc";
		$valor = $this->validarubicacionc;

		$respuesta = Controladorubicacionc::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR 
=============================================*/
if(isset($_POST["idubicacionc"])){

	$editar = new Ajaxubicacionc();
	$editar -> idubicacionc = $_POST["idubicacionc"];
	$editar -> ajaxEditarubicacionc();

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