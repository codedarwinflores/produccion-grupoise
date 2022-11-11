<?php

require_once "../controladores/tipootrosequipos.controlador.php";
require_once "../modelos/tipootrosequipos.modelo.php";

class Ajaxtipootrosequipos{

	/*=============================================
	EDITAR REGISTRO
	=============================================*/	

	public $idtipootrosequipos;

	public function ajaxEditartipootrosequipos(){

		$item = "id";
		$valor = $this->idtipootrosequipos;

		$respuesta = Controladortipootrosequipos::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}


	/*=============================================
	VALIDAR NO REPETIR 
	=============================================*/	

	public $validartipootrosequipos;

	public function ajaxValidartipootrosequipos(){

		$item = "tipootrosequipos";
		$valor = $this->validartipootrosequipos;

		$respuesta = Controladortipootrosequipos::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR 
=============================================*/
if(isset($_POST["idtipootrosequipos"])){

	$editar = new Ajaxtipootrosequipos();
	$editar -> idtipootrosequipos = $_POST["idtipootrosequipos"];
	$editar -> ajaxEditartipootrosequipos();

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