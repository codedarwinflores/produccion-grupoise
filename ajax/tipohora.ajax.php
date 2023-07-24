<?php

require_once "../controladores/tipohora.controlador.php";
require_once "../modelos/tipohora.modelo.php";

class Ajaxtipohora{

	/*=============================================
	EDITAR REGISTRO
	=============================================*/	

	public $idtipohora;

	public function ajaxEditartipohora(){

		$item = "id";
		$valor = $this->idtipohora;

		$respuesta = Controladortipohora::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}


	/*=============================================
	VALIDAR NO REPETIR 
	=============================================*/	

	public $validartipohora;

	public function ajaxValidartipohora(){

		$item = "tipohora";
		$valor = $this->validartipohora;

		$respuesta = Controladortipohora::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR 
=============================================*/
if(isset($_POST["idtipohora"])){

	$editar = new Ajaxtipohora();
	$editar -> idtipohora = $_POST["idtipohora"];
	$editar -> ajaxEditartipohora();

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