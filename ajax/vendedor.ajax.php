<?php

require_once "../controladores/vendedor.controlador.php";
require_once "../modelos/vendedor.modelo.php";

class Ajaxtbl_vendedor{

	/*=============================================
	EDITAR REGISTRO
	=============================================*/	

	public $idtbl_vendedor;

	public function ajaxEditartbl_vendedor(){

		$item = "id";
		$valor = $this->idtbl_vendedor;

		$respuesta = Controladortbl_vendedor::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}


	/*=============================================
	VALIDAR NO REPETIR 
	=============================================*/	

	public $validartbl_vendedor;

	public function ajaxValidartbl_vendedor(){

		$item = "tbl_vendedor";
		$valor = $this->validartbl_vendedor;

		$respuesta = Controladortbl_vendedor::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR 
=============================================*/
if(isset($_POST["idtbl_vendedor"])){

	$editar = new Ajaxtbl_vendedor();
	$editar -> idtbl_vendedor = $_POST["idtbl_vendedor"];
	$editar -> ajaxEditartbl_vendedor();

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