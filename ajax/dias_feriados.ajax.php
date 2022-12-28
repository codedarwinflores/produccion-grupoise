<?php

require_once "../controladores/dias_feriados.controlador.php";
require_once "../modelos/dias_feriados.modelo.php";

class Ajaxdias_feriados{

	/*=============================================
	EDITAR REGISTRO
	=============================================*/	

	public $iddias_feriados;

	public function ajaxEditardias_feriados(){

		$item = "id";
		$valor = $this->iddias_feriados;

		$respuesta = Controladordias_feriados::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}


	/*=============================================
	VALIDAR NO REPETIR 
	=============================================*/	

	public $validardias_feriados;

	public function ajaxValidardias_feriados(){

		$item = "dias_feriados";
		$valor = $this->validardias_feriados;

		$respuesta = Controladordias_feriados::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR 
=============================================*/
if(isset($_POST["iddias_feriados"])){

	$editar = new Ajaxdias_feriados();
	$editar -> iddias_feriados = $_POST["iddias_feriados"];
	$editar -> ajaxEditardias_feriados();

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