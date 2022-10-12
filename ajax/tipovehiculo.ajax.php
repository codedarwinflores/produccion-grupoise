<?php

require_once "../controladores/tipovehiculo.controlador.php";
require_once "../modelos/tipovehiculo.modelo.php";

class Ajaxtipovehiculo{

	/*=============================================
	EDITAR REGISTRO
	=============================================*/	

	public $idtipovehiculo;

	public function ajaxEditartipovehiculo(){

		$item = "id";
		$valor = $this->idtipovehiculo;

		$respuesta = Controladortipovehiculo::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}


	/*=============================================
	VALIDAR NO REPETIR 
	=============================================*/	

	public $validartipovehiculo;

	public function ajaxValidartipovehiculo(){

		$item = "tipovehiculo";
		$valor = $this->validartipovehiculo;

		$respuesta = Controladortipovehiculo::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR 
=============================================*/
if(isset($_POST["idtipovehiculo"])){

	$editar = new Ajaxtipovehiculo();
	$editar -> idtipovehiculo = $_POST["idtipovehiculo"];
	$editar -> ajaxEditartipovehiculo();

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