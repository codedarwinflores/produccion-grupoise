<?php

require_once "../controladores/pedido.controlador.php";
require_once "../modelos/pedido.modelo.php";

class Ajaxpedido{

	/*=============================================
	EDITAR REGISTRO
	=============================================*/	

	public $idpedido;

	public function ajaxEditarpedido(){

		$item = "id";
		$valor = $this->idpedido;

		$respuesta = Controladorpedido::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}


	/*=============================================
	VALIDAR NO REPETIR 
	=============================================*/	

	public $validarpedido;

	public function ajaxValidarpedido(){

		$item = "pedido";
		$valor = $this->validarpedido;

		$respuesta = Controladorpedido::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR 
=============================================*/
if(isset($_POST["idpedido"])){

	$editar = new Ajaxpedido();
	$editar -> idpedido = $_POST["idpedido"];
	$editar -> ajaxEditarpedido();

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