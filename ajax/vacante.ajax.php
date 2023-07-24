<?php

require_once "../controladores/vacante.controlador.php";
require_once "../modelos/vacante.modelo.php";

class Ajaxvacante{

	/*=============================================
	EDITAR REGISTRO
	=============================================*/	

	public $idvacante;

	public function ajaxEditarvacante(){

		$item = "id";
		$valor = $this->idvacante;

		$respuesta = Controladorvacante::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}


	/*=============================================
	VALIDAR NO REPETIR 
	=============================================*/	

	public $validarvacante;

	public function ajaxValidarvacante(){

		$item = "vacante";
		$valor = $this->validarvacante;

		$respuesta = Controladorvacante::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR 
=============================================*/
if(isset($_POST["idvacante"])){

	$editar = new Ajaxvacante();
	$editar -> idvacante = $_POST["idvacante"];
	$editar -> ajaxEditarvacante();

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