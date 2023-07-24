<?php

require_once "../controladores/devengoubicacion.controlador.php";
require_once "../modelos/devengoubicacion.modelo.php";

class Ajaxdevengoubicacion{

	/*=============================================
	EDITAR REGISTRO
	=============================================*/	

	public $iddevengoubicacion;

	public function ajaxEditardevengoubicacion(){

		$item = "id";
		$valor = $this->iddevengoubicacion;

		$respuesta = Controladordevengoubicacion::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}


	/*=============================================
	VALIDAR NO REPETIR 
	=============================================*/	

	public $validardevengoubicacion;

	public function ajaxValidardevengoubicacion(){

		$item = "devengoubicacion";
		$valor = $this->validardevengoubicacion;

		$respuesta = Controladordevengoubicacion::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR 
=============================================*/
if(isset($_POST["iddevengoubicacion"])){

	$editar = new Ajaxdevengoubicacion();
	$editar -> iddevengoubicacion = $_POST["iddevengoubicacion"];
	$editar -> ajaxEditardevengoubicacion();

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