<?php

require_once "../controladores/agenteubicacion.controlador.php";
require_once "../modelos/agenteubicacion.modelo.php";

class Ajaxagenteubicacion{

	/*=============================================
	EDITAR REGISTRO
	=============================================*/	

	public $idagenteubicacion;

	public function ajaxEditaragenteubicacion(){

		$item = "id";
		$valor = $this->idagenteubicacion;

		$respuesta = Controladoragenteubicacion::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}


	/*=============================================
	VALIDAR NO REPETIR 
	=============================================*/	

	public $validaragenteubicacion;

	public function ajaxValidaragenteubicacion(){

		$item = "agenteubicacion";
		$valor = $this->validaragenteubicacion;

		$respuesta = Controladoragenteubicacion::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR 
=============================================*/
if(isset($_POST["idagenteubicacion"])){

	$editar = new Ajaxagenteubicacion();
	$editar -> idagenteubicacion = $_POST["idagenteubicacion"];
	$editar -> ajaxEditaragenteubicacion();

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