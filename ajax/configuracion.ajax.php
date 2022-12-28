<?php

require_once "../controladores/configuracion.controlador.php";
require_once "../modelos/configuracion.modelo.php";

class Ajaxconfiguracion{

	/*=============================================
	EDITAR REGISTRO
	=============================================*/	

	public $idconfiguracion;

	public function ajaxEditarconfiguracion(){

		$item = "id";
		$valor = $this->idconfiguracion;

		$respuesta = Controladorconfiguracion::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}


	/*=============================================
	VALIDAR NO REPETIR 
	=============================================*/	

	public $validarconfiguracion;

	public function ajaxValidarconfiguracion(){

		$item = "configuracion";
		$valor = $this->validarconfiguracion;

		$respuesta = Controladorconfiguracion::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR 
=============================================*/
if(isset($_POST["idconfiguracion"])){

	$editar = new Ajaxconfiguracion();
	$editar -> idconfiguracion = $_POST["idconfiguracion"];
	$editar -> ajaxEditarconfiguracion();

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