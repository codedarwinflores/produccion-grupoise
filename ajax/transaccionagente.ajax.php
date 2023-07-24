<?php

require_once "../controladores/transaccionagente.controlador.php";
require_once "../modelos/transaccionagente.modelo.php";

class Ajaxtransacciones_agente{

	/*=============================================
	EDITAR REGISTRO
	=============================================*/	

	public $idtransacciones_agente;

	public function ajaxEditartransacciones_agente(){

		$item = "id";
		$valor = $this->idtransacciones_agente;

		$respuesta = Controladortransacciones_agente::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}


	/*=============================================
	VALIDAR NO REPETIR 
	=============================================*/	

	public $validartransacciones_agente;

	public function ajaxValidartransacciones_agente(){

		$item = "transacciones_agente";
		$valor = $this->validartransacciones_agente;

		$respuesta = Controladortransacciones_agente::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR 
=============================================*/
if(isset($_POST["idtransacciones_agente"])){

	$editar = new Ajaxtransacciones_agente();
	$editar -> idtransacciones_agente = $_POST["idtransacciones_agente"];
	$editar -> ajaxEditartransacciones_agente();

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