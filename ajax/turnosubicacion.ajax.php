<?php

require_once "../controladores/turnosubicacion.controlador.php";
require_once "../modelos/tunosubicacion.modelo.php";

class Ajaxtbl_ubicaciones_turnos{

	/*=============================================
	EDITAR REGISTRO
	=============================================*/	

	public $idtbl_ubicaciones_turnos;

	public function ajaxEditartbl_ubicaciones_turnos(){

		$item = "id";
		$valor = $this->idtbl_ubicaciones_turnos;

		$respuesta = Controladortbl_ubicaciones_turnos::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}


	/*=============================================
	VALIDAR NO REPETIR 
	=============================================*/	

	public $validartbl_ubicaciones_turnos;

	public function ajaxValidartbl_ubicaciones_turnos(){

		$item = "tbl_ubicaciones_turnos";
		$valor = $this->validartbl_ubicaciones_turnos;

		$respuesta = Controladortbl_ubicaciones_turnos::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR 
=============================================*/
if(isset($_POST["idtbl_ubicaciones_turnos"])){

	$editar = new Ajaxtbl_ubicaciones_turnos();
	$editar -> idtbl_ubicaciones_turnos = $_POST["idtbl_ubicaciones_turnos"];
	$editar -> ajaxEditartbl_ubicaciones_turnos();

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