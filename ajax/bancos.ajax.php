<?php

require_once "../controladores/bancos.controlador.php";
require_once "../modelos/bancos.modelo.php";

class AjaxBancos{

	/*=============================================
	EDITAR REGISTRO
	=============================================*/	

	public $idBancos;

	public function ajaxEditarBancos(){

		$item = "id";
		$valor = $this->idBancos;

		$respuesta = ControladorBancos::ctrMostrarBancos($item, $valor);

		echo json_encode($respuesta);

	}


	/*=============================================
	VALIDAR NO REPETIR 
	=============================================*/	

	public $validarBancos;

	public function ajaxValidarBancos(){

		$item = "bancos";
		$valor = $this->validarEmpresa;

		$respuesta = ControladorBancos::ctrMostrarBancos($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR 
=============================================*/
if(isset($_POST["idBancos"])){

	$editar = new AjaxBancos();
	$editar -> idBancos = $_POST["idBancos"];
	$editar -> ajaxEditarBancos();

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