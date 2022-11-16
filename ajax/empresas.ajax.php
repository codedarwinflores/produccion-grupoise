<?php

require_once "../controladores/empresas.controlador.php";
require_once "../modelos/empresas.modelo.php";

class AjaxEmpresas{

	/*=============================================
	EDITAR USUARIO
	=============================================*/	

	public $idEmpresa;

	public function ajaxEditarEmpresas(){

		$item = "id";
		$valor = $this->idEmpresa;

		$respuesta = ControladorEmpresas::ctrMostrarEmpresas($item, $valor);

		echo json_encode($respuesta);

	}


	/*=============================================
	VALIDAR NO REPETIR EMPRESA
	=============================================*/	

	public $validarEmpresa;


	 function ajaxValidarEmpresa(){
		$validarEmpresa = $_POST["validarEmpresa"];

		$item = "codigo_empresa";
		$valor = $this->validarEmpresa;

		$respuesta = ControladorEmpresas::ctrMostrarEmpresas($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR USUARIO
=============================================*/
if(isset($_POST["idEmpresa"])){

	$editar = new AjaxEmpresas();
	$editar -> idEmpresa = $_POST["idEmpresa"];
	$editar -> ajaxEditarEmpresas();

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