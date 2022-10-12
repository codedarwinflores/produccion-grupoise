<?php

require_once "../controladores/uniforme.controlador.php";
require_once "../modelos/uniforme.modelo.php";

class Ajaxuniforme{

	/*=============================================
	EDITAR REGISTRO
	=============================================*/	

	public $iduniforme;

	public function ajaxEditaruniforme(){

		$item = "id";
		$valor = $this->iduniforme;

		$respuesta = Controladoruniforme::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}


	/*=============================================
	VALIDAR NO REPETIR 
	=============================================*/	

	public $validaruniforme;

	public function ajaxValidaruniforme(){

		$item = "uniforme";
		$valor = $this->validaruniforme;

		$respuesta = Controladoruniforme::ctrMostrar($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR 
=============================================*/
if(isset($_POST["iduniforme"])){

	$editar = new Ajaxuniforme();
	$editar -> iduniforme = $_POST["iduniforme"];
	$editar -> ajaxEditaruniforme();

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