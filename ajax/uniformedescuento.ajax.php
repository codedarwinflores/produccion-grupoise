<?php

require_once "../controladores/uniformedescuento.controlador.php";
require_once "../modelos/uniformedescuento.modelo.php";

class Ajaxuniformedescuento{

	/*=============================================
	EDITAR REGISTRO
	=============================================*/	

	public $iduniformedescuento;

	public function ajaxEditaruniformedescuento(){

		$item = "id";
		$valor = $this->iduniformedescuento;

		$respuesta = Controladoruniformedescuento::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}


	/*=============================================
	VALIDAR NO REPETIR 
	=============================================*/	

	public $validaruniformedescuento;

	public function ajaxValidaruniformedescuento(){

		$item = "uniformedescuento";
		$valor = $this->validaruniformedescuento;

		$respuesta = Controladoruniformedescuento::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR 
=============================================*/
if(isset($_POST["iduniformedescuento"])){

	$editar = new Ajaxuniformedescuento();
	$editar -> iduniformedescuento = $_POST["iduniformedescuento"];
	$editar -> ajaxEditaruniformedescuento();

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