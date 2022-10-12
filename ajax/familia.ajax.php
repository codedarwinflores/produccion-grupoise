<?php

require_once "../controladores/familia.controlador.php";
require_once "../modelos/familia.modelo.php";

class Ajaxfamilia{

	/*=============================================
	EDITAR REGISTRO
	=============================================*/	

	public $idfamilia;

	public function ajaxEditarfamilia(){

		$item = "id";
		$valor = $this->idfamilia;

		$respuesta = Controladorfamilia::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}


	/*=============================================
	VALIDAR NO REPETIR 
	=============================================*/	

	public $validarfamilia;

	public function ajaxValidarfamilia(){

		$item = "familia";
		$valor = $this->validarfamilia;

		$respuesta = Controladorfamilia::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR 
=============================================*/
if(isset($_POST["idfamilia"])){

	$editar = new Ajaxfamilia();
	$editar -> idfamilia = $_POST["idfamilia"];
	$editar -> ajaxEditarfamilia();

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