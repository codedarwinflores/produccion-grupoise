<?php

require_once "../controladores/sim.controlador.php";
require_once "../modelos/sim.modelo.php";

class Ajaxsim{

	/*=============================================
	EDITAR REGISTRO
	=============================================*/	

	public $idsim;

	public function ajaxEditarsim(){

		$item = "id";
		$valor = $this->idsim;

		$respuesta = Controladorsim::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}


	/*=============================================
	VALIDAR NO REPETIR 
	=============================================*/	

	public $validarsim;

	public function ajaxValidarsim(){

		$item = "sim";
		$valor = $this->validarsim;

		$respuesta = Controladorsim::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR 
=============================================*/
if(isset($_POST["idsim"])){

	$editar = new Ajaxsim();
	$editar -> idsim = $_POST["idsim"];
	$editar -> ajaxEditarsim();

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