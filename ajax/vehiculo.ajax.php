<?php

require_once "../controladores/vehiculo.controlador.php";
require_once "../modelos/vehiculo.modelo.php";

class Ajaxvehiculo{

	/*=============================================
	EDITAR REGISTRO
	=============================================*/	

	public $idvehiculo;

	public function ajaxEditarvehiculo(){

		$item = "id";
		$valor = $this->idvehiculo;

		$respuesta = Controladorvehiculo::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}


	/*=============================================
	VALIDAR NO REPETIR 
	=============================================*/	

	public $validarvehiculo;

	public function ajaxValidarvehiculo(){

		$item = "vehiculo";
		$valor = $this->validarvehiculo;

		$respuesta = Controladorvehiculo::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR 
=============================================*/
if(isset($_POST["idvehiculo"])){

	$editar = new Ajaxvehiculo();
	$editar -> idvehiculo = $_POST["idvehiculo"];
	$editar -> ajaxEditarvehiculo();

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