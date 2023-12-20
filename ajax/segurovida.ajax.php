<?php

require_once "../controladores/segurovida.controlador.php";
require_once "../modelos/segurovida.modelo.php";

class Ajaxsegurovida{

	/*=============================================
	EDITAR REGISTRO
	=============================================*/	

	public $idsegurovida;

	public function ajaxEditarsegurovida(){

		$item = "id";
		$valor = $this->idsegurovida;

		$respuesta = Controladorsegurovida::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}


	/*=============================================
	VALIDAR NO REPETIR 
	=============================================*/	

	public $validarsegurovida;

	public function ajaxValidarsegurovida(){

		$item = "segurovida";
		$valor = $this->validarsegurovida;

		$respuesta = Controladorsegurovida::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR 
=============================================*/
if(isset($_POST["idsegurovida"])){

	$editar = new Ajaxsegurovida();
	$editar -> idsegurovida = $_POST["idsegurovida"];
	$editar -> ajaxEditarsegurovida();

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