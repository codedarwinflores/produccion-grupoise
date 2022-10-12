<?php

require_once "../controladores/transaccionespersonal.controlador.php";
require_once "../modelos/transaccionespersonal.modelo.php";

class Ajaxtransaccionespersonal{

	/*=============================================
	EDITAR REGISTRO
	=============================================*/	

	public $idtransaccionespersonal;

	public function ajaxEditartransaccionespersonal(){

		$item = "id";
		$valor = $this->idtransaccionespersonal;

		$respuesta = Controladortransaccionespersonal::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}


	/*=============================================
	VALIDAR NO REPETIR 
	=============================================*/	

	public $validartransaccionespersonal;

	public function ajaxValidartransaccionespersonal(){

		$item = "transaccionespersonal";
		$valor = $this->validartransaccionespersonal;

		$respuesta = Controladortransaccionespersonal::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR 
=============================================*/
if(isset($_POST["idtransaccionespersonal"])){

	$editar = new Ajaxtransaccionespersonal();
	$editar -> idtransaccionespersonal = $_POST["idtransaccionespersonal"];
	$editar -> ajaxEditartransaccionespersonal();

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