<?php

require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";

class Ajaxclientes{

	/*=============================================
	EDITAR REGISTRO
	=============================================*/	

	public $idclientes;

	public function ajaxEditarclientes(){

		$item = "id";
		$valor = $this->idclientes;

		$respuesta = Controladorclientes::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}


	/*=============================================
	VALIDAR NO REPETIR 
	=============================================*/	

	public $validarclientes;

	public function ajaxValidarclientes(){

		$item = "clientes";
		$valor = $this->validarclientes;

		$respuesta = Controladorclientes::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR 
=============================================*/
if(isset($_POST["idclientes"])){

	$editar = new Ajaxclientes();
	$editar -> idclientes = $_POST["idclientes"];
	$editar -> ajaxEditarclientes();

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