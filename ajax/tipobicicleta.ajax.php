<?php

require_once "../controladores/tipobicicleta.controlador.php";
require_once "../modelos/tipobicicleta.modelo.php";

class Ajaxtipobicicleta{

	/*=============================================
	EDITAR REGISTRO
	=============================================*/	

	public $idtipobicicleta;

	public function ajaxEditartipobicicleta(){

		$item = "id";
		$valor = $this->idtipobicicleta;

		$respuesta = Controladortipobicicleta::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}


	/*=============================================
	VALIDAR NO REPETIR 
	=============================================*/	

	public $validartipobicicleta;

	public function ajaxValidartipobicicleta(){

		$item = "tipobicicleta";
		$valor = $this->validartipobicicleta;

		$respuesta = Controladortipobicicleta::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR 
=============================================*/
if(isset($_POST["idtipobicicleta"])){

	$editar = new Ajaxtipobicicleta();
	$editar -> idtipobicicleta = $_POST["idtipobicicleta"];
	$editar -> ajaxEditartipobicicleta();

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