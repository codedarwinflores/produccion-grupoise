<?php

require_once "../controladores/abase.controlador.php";
require_once "../modelos/abase.modelo.php";

class Ajaxabase{

	/*=============================================
	EDITAR REGISTRO
	=============================================*/	

	public $idabase;

	public function ajaxEditarabase(){

		$item = "id";
		$valor = $this->idabase;

		$respuesta = Controladorabase::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}


	/*=============================================
	VALIDAR NO REPETIR 
	=============================================*/	

	public $validarabase;

	public function ajaxValidarabase(){

		$item = "abase";
		$valor = $this->validarabase;

		$respuesta = Controladorabase::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR 
=============================================*/
if(isset($_POST["idabase"])){

	$editar = new Ajaxabase();
	$editar -> idabase = $_POST["idabase"];
	$editar -> ajaxEditarabase();

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