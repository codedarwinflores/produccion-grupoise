<?php

require_once "../controladores/series.controlador.php";
require_once "../modelos/series.modelo.php";

class Ajaxseries{

	/*=============================================
	EDITAR REGISTRO
	=============================================*/	

	public $idseries_ventas;

	public function ajaxEditarseries_ventas(){

		$item = "id";
		$valor = $this->idseries_ventas;

		$respuesta = Controladorseries_ventas::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}


	/*=============================================
	VALIDAR NO REPETIR 
	=============================================*/	

	public $validarseries_ventas;

	public function ajaxValidarseries_ventas(){

		$item = "series_ventas";
		$valor = $this->validarseries_ventas;

		$respuesta = Controladorseries_ventas::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR 
=============================================*/
if(isset($_POST["idseries_ventas"])){

	$editar = new Ajaxseries();
	$editar -> idseries_ventas = $_POST["idseries_ventas"];
	$editar -> ajaxEditarseries_ventas();

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