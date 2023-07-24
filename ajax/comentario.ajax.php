<?php

require_once "../controladores/comentario.controlador.php";
require_once "../modelos/comentario.modelo.php";

class Ajaxcomentario{

	/*=============================================
	EDITAR REGISTRO
	=============================================*/	

	public $idcomentario;

	public function ajaxEditarcomentario(){

		$item = "id";
		$valor = $this->idcomentario;

		$respuesta = Controladorcomentario::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}


	/*=============================================
	VALIDAR NO REPETIR 
	=============================================*/	

	public $validarcomentario;

	public function ajaxValidarcomentario(){

		$item = "comentario";
		$valor = $this->validarcomentario;

		$respuesta = Controladorcomentario::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR 
=============================================*/
if(isset($_POST["idcomentario"])){

	$editar = new Ajaxcomentario();
	$editar -> idcomentario = $_POST["idcomentario"];
	$editar -> ajaxEditarcomentario();

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