<?php

require_once "../controladores/movimientoequipo.controlador.php";
require_once "../modelos/movimientoequipo.modelo.php";

class Ajaxmovimientosequipos{

	/*=============================================
	EDITAR REGISTRO
	=============================================*/	

	public $idmovimientosequipos;

	public function ajaxEditarmovimientosequipos(){

		$item = "id";
		$valor = $this->idmovimientosequipos;

		$respuesta = Controladormovimientosequipos::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}


	/*=============================================
	VALIDAR NO REPETIR 
	=============================================*/	

	public $validarmovimientosequipos;

	public function ajaxValidarmovimientosequipos(){

		$item = "movimientosequipos";
		$valor = $this->validarmovimientosequipos;

		$respuesta = Controladormovimientosequipos::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR 
=============================================*/
if(isset($_POST["idmovimientosequipos"])){

	$editar = new Ajaxmovimientosequipos();
	$editar -> idmovimientosequipos = $_POST["idmovimientosequipos"];
	$editar -> ajaxEditarmovimientosequipos();

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