<?php

require_once "../controladores/detalleubicacion.controlador.php";
require_once "../modelos/detalleubicacion.modelo.php";

class Ajaxtbl_ubicaciones_detalle{

	/*=============================================
	EDITAR REGISTRO
	=============================================*/	

	public $idtbl_ubicaciones_detalle;

	public function ajaxEditartbl_ubicaciones_detalle(){

		$item = "id";
		$valor = $this->idtbl_ubicaciones_detalle;

		$respuesta = Controladortbl_ubicaciones_detalle::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}


	/*=============================================
	VALIDAR NO REPETIR 
	=============================================*/	

	public $validartbl_ubicaciones_detalle;

	public function ajaxValidartbl_ubicaciones_detalle(){

		$item = "tbl_ubicaciones_detalle";
		$valor = $this->validartbl_ubicaciones_detalle;

		$respuesta = Controladortbl_ubicaciones_detalle::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR 
=============================================*/
if(isset($_POST["idtbl_ubicaciones_detalle"])){

	$editar = new Ajaxtbl_ubicaciones_detalle();
	$editar -> idtbl_ubicaciones_detalle = $_POST["idtbl_ubicaciones_detalle"];
	$editar -> ajaxEditartbl_ubicaciones_detalle();

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